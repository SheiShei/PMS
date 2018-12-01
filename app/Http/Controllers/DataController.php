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

        foreach ($request->ids as $id) {
            $messages = $convo->messages()->create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $id,
                'action' => 3,
            ]);

            $message = Message::where('id', $messages->id)->with('sender:id,name,picture')->with('receiver:id,name,picture')->first();
            event(new DirectMessageEvent($message, NULL, $convo));
        }

        $convo->users()->attach($request->ids, ['added_by' => auth()->user()->id]);

        // return $request;
    }

    public function removeConvoMember(Request $request) {
        $convo = Conversation::where('id' , $request->slug)->first();

        foreach ($request->ids as $id) {
            $messages = $convo->messages()->create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $id,
                'action' => 4,
            ]);

            $message = Message::where('id', $messages->id)->with('sender:id,name,picture')->with('receiver:id,name,picture')->first();
            event(new DirectMessageEvent($message, NULL, $convo));

        }

        $convo->users()->detach($request->ids);
        
        // return $request;
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
            $messages = Message::where('sender_id', auth()->user()->id)->where('receiver_id', $receiverId)->where('action', 1)->with('sender:id,name,picture')->with('receiver:id,name,picture')->orderBy('created_at', 'asc')->get();
            
            return $messages;
        } 

        $messages = Message::with('sender:id,name,picture')->with('receiver:id,name,picture')->where('conversation_id', $request->slug)->orderBy('created_at', 'asc')->get();
        return $messages;
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
            broadcast(new DirectMessageEvent($message, $receiverData, NULL))->toOthers();
        }
        else {
            $convoData = Conversation::find($request->convo);
            $message = Message::where('id', $messages->id)->with('sender:id,name,picture')->first();
            // event(new DirectMessageEvent($message, NULL, $convoData));
            broadcast(new DirectMessageEvent($message, NULL, $convoData))->toOthers();
        }

        return Message::where('id', $messages->id)->with('sender:id,name,picture')->first();
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

            if(!$convo) {
                foreach ($files as $key => $file) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $messages = auth()->user()->sender()->create([
                        'original_filename' => $originalName,
                        'new_filename' => Uuid::generate()->string . '.' . $extension,
                        'extension' => $extension,
                        'receiver_id' => $request->receiver,
                    ]);
                    
                    $message = Message::where('id', $messages->id)->with('sender:id,name,picture')->first();
                    $receiverData = User::find($request->receiver);
                    event(new DirectMessageEvent($message, $receiverData, NULL));
                }
            }
            else {
                foreach ($files as $key => $file) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $newName = Uuid::generate()->string . '.' . $extension;
                    $file->move('storage/messages/', $newName);
                    $messages = auth()->user()->sender()->create([
                        'original_filename' => $originalName,
                        'new_filename' => $newName,
                        'extension' => $extension,
                        'conversation_id' => $request->convo
                    ]);

                    $message = Message::where('id', $messages->id)->with('sender:id,name,picture')->first();
                    $convoData = Conversation::find($request->convo);
                    event(new DirectMessageEvent($message, NULL, $convoData));
                }
            }

            return $messages;
            // return 'shei';
        }
    }

    // edn of message tab

}
