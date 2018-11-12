<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\StickyNote;
use App\Conversation;
use App\Events\AddConversationEvent;

class DataController extends Controller
{
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

        if($request->ids) {
            $newConvo->users()->attach($request->ids, ['added_by' => auth()->user()->id]);
        }

        $newConvo->activities()->create([
            'main' => auth()->user()->id,
            'action' => 1
        ]);

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

}
