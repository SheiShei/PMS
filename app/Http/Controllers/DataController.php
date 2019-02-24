<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\StickyNote;
use App\Conversation;
use App\Events\AddConversationEvent;
use App\Events\DirectMessageEvent;
use App\Message;
use Webpatser\Uuid\Uuid;
use Illuminate\Pagination\Paginator;

use App\Events\SendTextMessageEvent;
use App\Events\SendMessageArrayEvent;
use App\Events\RemoveConvoMemberEvent;
use App\Events\AddConvoMemberEvent;

use App\Notifications\ReceiveMessage;


class DataController extends Controller
{
    // notes
    public function getNotes() {
        $notes = auth()->user()->sticky_notes()->select('id', 'title', 'content', 'order')->orderBy('order', 'asc')->get();
        return $notes;
    }

    public function updateNoteOrder(Request $request) {
        // return $request;

        $notes = auth()->user()->sticky_notes()->get();

        foreach ($notes as $key => $note) {
            $id = $note->id;
            foreach ($request->notes as $updateNote) {
                if($updateNote['id'] == $id) {
                    $note->update(['order' => $updateNote['order']]);
                }
            }
        }

        return response('Updated Successfully.', 200);
    }

    public function addNote(Request $request) {
        // return $request;
        $newNote = StickyNote::create([
            'title' => $request->title,
            'content' => $request->content,
            'order' => $request->order,
            'user_id' => auth()->user()->id
        ]);

        return $newNote;
    }

    public function updateNote(Request $request) {
        $note = StickyNote::findOrFail($request->id);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
            'order' => $request->order,
            'user_id' => auth()->user()->id
        ]);

        return $note;
    }

    public function deleteNote(Request $request) {
        $note = StickyNote::findOrFail($request->id);
        $note->delete();
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }
    // end of notes

    // message tab
    public function addconvo(Request $request) {
        $request->validate([
            'name' => 'required|string|max:150'
        ]);
        
        $newConvo = Conversation::create([
            'name' => $request->name,
            'type' => 2,
            'created_by' => auth()->user()->id
        ]);

        $newConvo->users()->attach(auth()->user()->id, ['added_by' => auth()->user()->id]);

        Message::create([
            'sender_id' => auth()->user()->id,
            'conversation_id' => $newConvo->id,
            'action' => 2
        ]);

        if($request->ids) {
            $data = array();
            foreach ($request->ids as $key => $id) {
                array_push($data, [
                    'id' => Uuid::generate()->string,
                    'sender_id' => auth()->user()->id,
                    'receiver_id' => $id,
                    'conversation_id' => $newConvo->id,
                    'action' => 3,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s')
                ]);
            }
            Message::insert($data);

            $newConvo->users()->attach($request->ids, ['added_by' => auth()->user()->id]);
        }

        $users = $newConvo->users()->select('slug')->get();

        $newConversation = [
            'newConvo' => $newConvo,
            'users' => $users
        ];

        event(new AddConversationEvent($newConversation));

        return $newConvo->only(['id', 'name', 'slug', 'type', 'created_at']);

        // return $request->ids;
    }

    public function getConvoList(Request $request) {
        if($request->search){
            $convos = auth()->user()->conversations()->where('name', 'like', $request->search.'%')->get();
        }
        else{
            $convos = auth()->user()->conversations()->get();
        }
        
        return $convos;
    }

    public function getConvoUsers(Request $request) {
        $users = Conversation::where('id' , $request->slug)->with('created_by:id,name,slug')->first();
        if($users) {
            $members = $users->users()->get();
            return response()->json(['convo' => $users, 'users' => $members], 200);
        }

        $receiver = User::where('slug' , $request->slug)->first();
        return response()->json(['receiver' => $receiver], 200);
        // return $request->slug;

    }

    public function getNotMembers(Request $request) {
        $users = Conversation::where('id' , $request->slug)->with('created_by:id,name,slug')->first();
        if($users) {
            $members = $users->users()->get();
            $memberId = [];
            foreach($members as $user) {
                array_push($memberId, $user->id);
            }
            $notMember = User::whereNotIn('id', $memberId)->select('id','name','slug')->get();
            return $notMember;
        }

        // return $request;
    }

    public function addConvoMember(Request $request) {
        $convo = Conversation::where('id' , $request->slug)->first();
        // $data = array();
        // foreach ($request->ids as $id) {
        //     array_push($data, [
        //         'id' => Uuid::generate()->string,
        //         'sender_id' => auth()->user()->id,
        //         'conversation_id' => $convo->id,
        //         'receiver_id' => $id,
        //         'action' => 3,
        //         'created_at'=>date('Y-m-d H:i:s'),
        //         'updated_at'=> date('Y-m-d H:i:s')
        //     ]);
        // }
        // Message::insert($data);

        $newM = [];

        foreach ($request->ids as $id) {
            $messages = $convo->messages()->create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $id,
                'action' => 3,
            ]);

            $message = Message::where('id', $messages->id)->with('sender:id,slug,name,picture')->with('receiver:id,slug,name,picture')->first();
            // event(new DirectMessageEvent($message, NULL, $convo));
            array_push($newM, $message);
        }

        $convo->users()->attach($request->ids, ['added_by' => auth()->user()->id]);

        event(new RemoveConvoMemberEvent($newM, $request->slug));

        $users = $convo->users()->select('slug')->get();
        $newConversation = [
            'newConvo' => $convo,
            'users' => $users
        ];

        event(new AddConvoMemberEvent($newConversation));

        return $newM;
    }

    public function removeConvoMember(Request $request) {
        $convo = Conversation::where('id' , $request->slug)->first();

        $newM = [];

        foreach ($request->ids as $id) {
            $messages = $convo->messages()->create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $id,
                'action' => 4,
            ]);

            $message = Message::where('id', $messages->id)->with('sender:id,slug,name,picture')->with('receiver:id,slug,name,picture')->first();
            // event(new DirectMessageEvent($message, NULL, $convo));
            array_push($newM, $message);

        }

        $convo->users()->detach($request->ids);

        event(new RemoveConvoMemberEvent($newM, $request->slug));
        
        return $newM;
    }

    public function verifyConvoUsers(Request $request) {
        $users = Conversation::where('id' , $request->slug)->first();
        
        if($users) {
            $verify = $users->users()->whereIn('user_id', [auth()->user()->id])->first();
            if($verify) {
                return response()->json(['status' => 'authenticated'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }

        $users = User::where('slug' , $request->slug)->first();

        if($users) {
            return response()->json(['status' => 'authenticated'], 200);
        }
        return response()->json(['status' => 'error'], 200);
    }

    public function getConvoMessages(Request $request) {
        $convo = Conversation::find($request->slug);

        if(!$convo) {
            $receiverId = User::where('slug', $request->slug)->first()->id;
            if($request->page == '') {
                $lastpage = Message::whereIn('sender_id', [auth()->user()->id, $receiverId])->whereIn('receiver_id', [auth()->user()->id, $receiverId])->where('action', 1)->orderBy('created_at', 'asc')->paginate(10)->lastPage();
                Paginator::currentPageResolver(function () use ($lastpage) {
                    return $lastpage;
                });
            }
    
            $messages = Message::whereIn('sender_id', [auth()->user()->id, $receiverId])->whereIn('receiver_id', [auth()->user()->id, $receiverId])->where('action', 1)->with('sender:id,name,picture')->with('receiver:id,name,picture')->orderBy('created_at', 'asc')->paginate(10);
            return response()->json($messages);
        } 

        if($request->page == '') {
            $lastpage = Message::with('sender:id,name,picture')->with('receiver:id,name,picture')->where('conversation_id', $request->slug)->orderBy('created_at', 'asc')->paginate(10)->lastPage();
            Paginator::currentPageResolver(function () use ($lastpage) {
                return $lastpage;
            });
        }

        $messages = Message::with('sender:id,name,picture')->with('receiver:id,name,picture')->where('conversation_id', $request->slug)->orderBy('created_at', 'asc')->paginate(10);
        return response()->json($messages);
    }

    public function newMessage(Request $request) {
        $convo = Conversation::find($request->convo);

        $messages = auth()->user()->sender()->create([
            'text' => $request->text,
            'conversation_id' => $request->convo,
            'receiver_id' => $request->receiver
        ]);

        if(!$convo) {
            $receiverData = User::find($request->receiver);
            $message = Message::where('id', $messages->id)->with('sender:id,name,picture')->first();
            // event(new DirectMessageEvent($message, $receiverData, NULL));
            event(new DirectMessageEvent($message, $receiverData, NULL));
        }
        else {
            $convoData = Conversation::find($request->convo);
            $message = Message::where('id', $messages->id)->with('sender:id,name,picture')->first();
            // event(new DirectMessageEvent($message, NULL, $convoData));
            event(new DirectMessageEvent($message, NULL, $convoData));
        }
        // $receivers = User::findOrFail($request->receiver);  
        // $receivers->notify(new ReceiveMessage($receivers->toArray()));        

        $newM = Message::where('id', $messages->id)->with('sender:id,slug,name,picture')->with('receiver:id,slug,name,picture')->first();

        event(new SendTextMessageEvent($newM->toJson()));

        return $newM;
    }

    public function updateRead(Request $request) {

        // $convo = Conversation::find($request->slug);
        // $now = Carbon\Carbon::now();
        // if(!$convo) {
        //     $messages = Message::where('sender_id', auth()->user()->id)
        //                         ->where('receiver_id', $request->slug)
        //                         ->where('read', NULL)
        //                         ->update([
        //                             'read' => $now
        //                         ]);
            
        //     return $messages;
        // } 

        // $messages = Message::where('conversation_id', $request->slug)->get();
        // return $messages;
    }

    public function sendFiles(Request $request) {
        if($files = $request->file('files')){
            $convo = Conversation::find($request->convo);

            $data = array();

            $mFiles = [];

            if(!$convo) {
                foreach ($files as $key => $file) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $newName = time() . $originalName;
                    $file->move('storage/messages/', $newName);
                    $messages = auth()->user()->sender()->create([
                        'original_filename' => $originalName,
                        'new_filename' => $newName,
                        'extension' => $extension,
                        'receiver_id' => $request->receiver,
                    ]);
                    
                    $message = Message::where('id', $messages->id)->with('sender:id,slug,name,picture')->with('receiver:id,slug,name,picture')->first();
                    array_push($mFiles, $message);
                    // $receiverData = User::find($request->receiver);
                    // event(new DirectMessageEvent($message, $receiverData, NULL));
                }

                event(new SendMessageArrayEvent($mFiles, auth()->user()->slug));
            }
            else {
                foreach ($files as $key => $file) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $newName = time() . $originalName;
                    $file->move('storage/messages/', $newName);
                    $messages = auth()->user()->sender()->create([
                        'original_filename' => $originalName,
                        'new_filename' => $newName,
                        'extension' => $extension,
                        'conversation_id' => $request->convo
                    ]);

                    $message = Message::where('id', $messages->id)->with('sender:id,slug,name,picture')->with('receiver:id,slug,name,picture')->first();
                    array_push($mFiles, $message);
                    // $convoData = Conversation::find($request->convo);
                    // event(new DirectMessageEvent($message, NULL, $convoData));
                }

                event(new SendMessageArrayEvent($mFiles, $request->convo));
            }

            return $mFiles;
            // return 'shei';
        }
    }

    // edn of message t'ab
    


}
