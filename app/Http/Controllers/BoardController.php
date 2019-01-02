<?php

namespace App\Http\Controllers;
use App\Board;
use App\Sprint;
use App\Card;
use App\Task;

use App\Events\AddListEvent;
use App\Events\DeleteListEvent;
use App\Events\UpdateListEvent;
use App\Events\UpdateListOrderEvent;
use App\Events\AddListTaskEvent;
use App\Events\UpdateListTaskEvent;
use App\Events\DeleteListTaskEvent;
use App\Events\AddTaskAttachmentEvent;
use App\Events\SendTaskCommentEvent;

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
        event(new AddListEvent($list->load('tasks.assigned_to')));

        return $list->load('tasks.assigned_to');
    }

    public function updateList(Request $request) {
        $list = Card::findOrFail($request->id);
        $list->update([
            'name' => $request->name
        ]);
        event(new UpdateListEvent($list) );

        return $list;
    }
    
    public function getBoardLists(Request $request) {
        $lists = Card::where('board_id', $request->id)->with(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to'])->orderBy('order' , 'asc')->get();

        return $lists;
    }

    public function deleteList(Request $request) {
        $list = Card::findOrFail($request->id);
        event(new DeleteListEvent($request->id, $list->board_id));
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
        $nlists = Card::where('board_id', $request->board_id)->with(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to'])->orderBy('order' , 'asc')->get();
        // print_r($nlists);
        event(new UpdateListOrderEvent($nlists->toJson(), $request->board_id));

        return response()->json('Updated Successfully.', 200);
    }
    
    public function getBoardMembers(Request $request) {
        $board = Board::find($request->board_id);
        return $board->boardUsers()->get();
    }

    public function addTask(Request $request) {
        $order = count(Card::find($request->list_id)->tasks()->get());
        $task = Task::create([
            'card_id' => $request->list_id,
            'name' => $request->name,
            'description' => $request->desc,
            'created_by' => auth()->user()->id,
            'assigned_to' => $request->assign_to,
            'assigned_by' => auth()->user()->id,
            'order' => $order+1,
            'points' => $request->points,
            'due' => $request->due,
        ]);
        if ($files = $request->file('files')) {
            foreach ($files as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $newName = time() . $originalName;
                $file->move('storage/task/', $newName);
                $task->files()->create([
                    'original_filename' => $originalName,
                    'new_filename' => $newName,
                    'extension' => $extension
                ]);                
            }
        }

        event(new AddListTaskEvent($task->load('assigned_to'), $request->board_id));
        return $task->load('assigned_to');
    }

    public function getTaskData(Request $request) {
        $task = Task::with('assigned_to', 'files')->where('id', $request->id)->first();
        return $task;
    }

    public function updateTask(Request $request) {
        $task = Task::find($request->id);
        $ta = [
            'points' => $request->points,
            'name' => $request->name,
            'description' => $request->desc
        ];

        if($request->assign_to != $task->assigned_to) {
            $ta['assigned_to'] = $request->assign_to;
            $ta['assigned_by'] = auth()->user()->id;
        }

        $task->update($ta);

        event(new UpdateListTaskEvent($task->load('assigned_to'), $request->board_id));

        return $task->load('assigned_to');
    }

    public function addAttachment(Request $request) {
        // dd($request);
        $task = Task::find($request->task_id);
        $attachments = [];
        if($files = $request->file('files')) {
            foreach ($files as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $newName = time() . $originalName;
                $file->move('storage/task/', $newName);
                $attach = $task->files()->create([
                    'original_filename' => $originalName,
                    'new_filename' => $newName,
                    'extension' => $extension
                ]); 
                
                array_push($attachments, $attach);               
            }
        }

        // dd($attachments);
        event(new AddTaskAttachmentEvent($attachments, $request->task_id));
        return response()->json($attachments);
    }

    public function taskPhoto(Request $request) {
        // return $request->filename;
        $task = Task::find($request->id);
        if($task->task_cover == $request->filename) {
            $task->update([
                'task_cover' => null
            ]);
        }
        else {
            $task->update([
                'task_cover' => $request->filename
            ]);
        }

        event(new UpdateListTaskEvent($task->load('assigned_to'), $request->board_id));

        return $task->load('assigned_to'); 
    }

    public function deleteTask(Request $request) {
        $task = Task::find($request->id);
        event(new DeleteListTaskEvent($task, $request->board_id));
        $task->delete();

        return $task;
    }

    public function updateTaskOrder(Request $request) {
        foreach ($request->tasks as $key => $task) {
            $toUp = Task::find($task['id']);
            $toUp->update([
                'order' => $task['order'],
                'card_id' => $task['card_id']
            ]);
        }

        $nlists = Card::where('board_id', $request->board_id)->with(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to'])->orderBy('order' , 'asc')->get();
        // print_r($nlists);
        event(new UpdateListOrderEvent($nlists->toJson(), $request->board_id));
    }

    public function sendComment(Request $request) {
        $task = Task::find($request->task_id);

        $comment = [];

        if($files = $request->file('files')){
            foreach ($files as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $newName = time() . $originalName;
                $file->move('storage/task/comment/', $newName);
                $newC = $task->comments()->create([
                    'original_filename' => $originalName,
                    'new_filename' => $newName,
                    'extension' => $extension,
                    'user_id' => auth()->user()->id
                ]);

                array_push($comment, $newC->load('user'));
            }
        }

        if($text = $request->text) {
            $newC = $task->comments()->create([
                'text' => $text,
                'user_id' => auth()->user()->id
            ]);

            array_push($comment, $newC->load('user'));
        }

        event(new SendTaskCommentEvent($comment, $request->task_id));

        return $comment;
    }

    public function getComments(Request $request) {
        $comments = Task::find($request->id)->comments()->with('user')->get();
        return $comments;
    }
    
    public function getCBoard(Request $request) {
        $board = Board::find($request->id);
        return $board;
    }
}
