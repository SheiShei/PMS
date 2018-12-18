<?php

namespace App\Http\Controllers;
use App\Board;
use App\Sprint;
use App\Card;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function newBoard(Request $request) {
        $board = auth()->user()->boards()->create([
            'name' => $request->name,
            'type' => $request->type
        ]);

        if($board->type == 1) {
            $board->cards->create([
                'name' => 'New',
                'created_by' => auth()->user()->id
            ]);
        } 
        else{
            $sprint = $board->sprints->create([
                'name' => 'Sprint 1',
                'created_by' => auth()->user()->id
            ]);

            $sprint->cards->create([
                'name' => 'New',
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
}
