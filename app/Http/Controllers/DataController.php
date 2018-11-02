<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\StickyNote;

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
}
