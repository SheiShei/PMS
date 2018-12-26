<?php

namespace App\Http\Controllers;
use App\Board;
use App\Sprint;
use App\Card;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function newBoard(Request $request) {
        // return $request;
        if($request->share == null) {
            $board = auth()->user()->boards()->create([
                'name' => $request->name,
                'privacy' => 1,
                'type' => $request->type,
            ]);
        }
        else {
            $board = auth()->user()->boards()->create([
                'name' => $request->name,
                'privacy' => 2,
                'type' => $request->type,
            ]);

            $board->boardUsers()->attach($request->ids, ['added_by' => auth()->user()->id]);
        }

        $board->boardUsers()->attach(auth()->user()->id, ['added_by' => auth()->user()->id]);

        if($board->type == 2) {
            $sprint = $board->sprints()->create([
                'name' => 'Sprint 1',
                'created_by' => auth()->user()->id
            ]);
        }   

        return $board;
    }

    public function newSprint(Request $request) {
        $board_id = $request->board_id;
        $board = Board::find($board_id);

        $sprint = $board->sprints->create([
            'name' => $request->name,
            'created_by' => auth()->user()->id
        ]);

        $sprint->cards->create([
            'name' => 'New',
            'created_by' => auth()->user()->id
        ]);

        return $sprint;
    }

    public function newCard(Request $request) {
        if($request->board_id) {
            $fk = Board::find($board_id);
        }
        if($request->sprint_id) {
            $fk = Sprint::find($board_id);
        }

        $card = $fk->cards->create([
            'name' => $request->name,
            'created_by' => auth()->user()->id
        ]);

        return $card;
    }

    public function deleteBoard(Request $request) {
        $board = Board::findOrFail($request->id);
        $board->delete();
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }

    public function updateBoard(Request $request) {
        $board = Board::findOrFail($request->id);
        $board->update([
            'name' => $request->name
        ]);
    }

    public function getUserBoards(Request $request) {
        $query = Board::whereHas('boardUsers', function($query) {
            $query->where('user_id', auth()->user()->id);
        });

        if($request->type) {
            $query->where('type', $request->type);
        }

        if($request->privacy) {
            $query->where('privacy', $request->privacy);
        }

        $boards = $query->get();

        return $boards;
    }

    public function createList(Request $request) {
        $list = Card::create([
            'name' => 'Task List',
            'board_id' => $request->board_id,
            'created_by' => auth()->user()->id,
            'order' => $request->order,
        ]);

        return $list;
    }

    public function updateList(Request $request) {
        $list = Card::findOrFail($request->id);
        $list->update([
            'name' => $request->name
        ]);

        return $list;
    }
    
    public function getBoardLists(Request $request) {
        $lists = Card::where('board_id', $request->id)->orderBy('order' , 'asc')->get();

        return $lists;
    }

    public function deleteList(Request $request) {
        $list = Card::findOrFail($request->id);
        $list->delete();
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }

    public function updateListOrder(Request $request) {
        $lists = Board::find($request->board_id)->cards()->get();

        foreach ($lists as $key => $list) {
            $id = $list->id;
            foreach ($request->lists as $updateList) {
                if($updateList['id'] == $id) {
                    $list->update(['order' => $updateList['order']]);
                }
            }
        }

        return response()->json('Updated Successfully.', 200);
    }
}
