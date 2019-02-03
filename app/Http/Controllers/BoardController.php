<?php

namespace App\Http\Controllers;
use App\Board;
use App\Sprint;
use App\Card;
use App\Task;
use App\User;
use App\UserStory;
use App\Progress;

use Carbon\Carbon;

use App\Events\AddListEvent;
use App\Events\DeleteListEvent;
use App\Events\UpdateListEvent;
use App\Events\UpdateListOrderEvent;
use App\Events\AddListTaskEvent;
use App\Events\UpdateListTaskEvent;
use App\Events\DeleteListTaskEvent;
use App\Events\AddTaskAttachmentEvent;
use App\Events\SendTaskCommentEvent;

use App\Events\AddSprintEvent;
use App\Events\UpdateSprintEvent;
use App\Events\FinishSprintEvent;
use App\Events\DeleteSprintEvent;
use App\Events\SprintTaskOrderEvent;
use App\Events\ISprintTaskOrderEvent;

use App\Events\CreateBoardEvent;
use App\Events\UpdateBoardEvent;
use App\Events\DeleteBoardEvent;

use App\Notifications\BoardCreated;
use App\Notifications\BoardUserAdded;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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
                'name' => 'Backlog',
                'created_by' => auth()->user()->id,
                'type' => 1
            ]);
        }   

        $board->notify(new BoardCreated($board->load('created_by')->toJson()));

        foreach ($board->boardUsers()->get() as $key => $user) {
            $user->notify(new BoardUserAdded($board->load('created_by')->toJson(), $user->toJson()));
        }
        // Notification::send($board, new BoardCreated($board->load('created_by')->toJson()));
        // Notification::send($board->boardUsers()->get(), new BoardCreated($board->load('created_by')->toJson()));
        
        event(new CreateBoardEvent($board->load('boardUsers.department', 'boardUsers.role')));

        return $board->load('boardUsers.department', 'boardUsers.role');
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
        event(new DeleteBoardEvent($board->load('boardUsers.department', 'boardUsers.role')));
        $board->delete();
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }

    public function updateBoard(Request $request) {
        $board = Board::findOrFail($request->id);
        $board->boardUsers()->sync([]);
        if($request->share == null) {
            $board->update([
                'name' => $request->name,
                'privacy' => 1,
            ]);
        }
        else {
            $board->update([
                'name' => $request->name,
                'privacy' => 2,
            ]);

            $board->boardUsers()->attach($request->newId, ['added_by' => auth()->user()->id]);
        }

        $board->boardUsers()->attach(auth()->user()->id, ['added_by' => auth()->user()->id]);

        event(new UpdateBoardEvent($board->load('boardUsers.department', 'boardUsers.role')));

        return $board->load('boardUsers.department', 'boardUsers.role');
    }

    public function getUserBoards(Request $request) {
        $query = Board::with('boardUsers.department', 'boardUsers.role')->whereHas('boardUsers', function($query) {
            $query->where('user_id', auth()->user()->id);
        })->orderBy('created_at', 'desc');

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

        if($request->assigned_to) {
            
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
            'due' => $request->due,
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

    public function getScrumLists(Request $request) {
        $board = Board::find($request->id);

        $sprints = $board->sprints()->with(['us' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks.assigned_to'])->orderBy('created_at', 'asc')->get();
        foreach ($sprints as $key => $sprint) {
            if($sprint->due_date == Carbon::now()->toDateString()){
                $sprint->update([
                    'finished_at' => Carbon::now()->toDateString()
                ]);
            }
        }

        return $sprints;
    }

    public function addsprint(Request $request) {
        $board = Board::find($request->id);
        $sprint = $board->sprints()->create([
            'name' => $request->name,
            'goals' => $request->goals,
            'started_at' => $request->interval[0],
            'due_date' => $request->interval[1],
            'created_by' => auth()->user()->id,
            'type' => 2
        ]);

        event(new AddSprintEvent($sprint->load('tasks')));

        return $sprint->load(['us' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks.assigned_to']);
    }

    public function updateSprint(Request $request) {
        $sprint = Sprint::find($request->id);
        
        $sprint->update([
            'name' => $request->name
        ]);

        event(new UpdateSprintEvent($sprint->load('tasks')));

        return $sprint->load('tasks');
    }
    
    public function deleteSprint(Request $request) {
        $sprint = Sprint::find($request->id);
        // event(new DeleteSprintEvent($sprint));
        $backlogid = Sprint::where('board_id', $sprint->board_id)->where('name', 'Backlog')->first()->id;

        foreach ($sprint->us as $key => $us) {
            $us->update([
                'sprint_id' => $backlogid
            ]);

            foreach ($us->tasks()->get() as $key => $task) {
                $task->update([
                    'sprint_id' => $backlogid
                ]);
            }
        }

        $sprint->delete();

        $sprints = Sprint::where('board_id', $sprint->board_id)->with(['us' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks.assigned_to'])->orderBy('created_at', 'asc')->get();

        return $sprints;
    }

    public function addSprintTask(Request $request) {
        // return $request;
        $order = count(Sprint::find($request->sprint_id)->tasks()->get());
        if($request->status) {
            $task = Task::create([
                'sprint_id' => $request->sprint_id,
                'us_id' => $request->us_id,
                'name' => $request->name,
                'description' => $request->desc,
                'created_by' => auth()->user()->id,
                'assigned_to' => $request->assign_to,
                'assigned_by' => auth()->user()->id,
                'order' => $order+1,
                'status_order' => $order+1,
                'status' => $request->status,
                'points' => $request->points,
                'due' => $request->due,
            ]);
        }
        else {
            $task = Task::create([
                'sprint_id' => $request->sprint_id,
                'us_id' => $request->us_id,
                'name' => $request->name,
                'description' => $request->desc,
                'created_by' => auth()->user()->id,
                'assigned_to' => $request->assign_to,
                'assigned_by' => auth()->user()->id,
                'order' => $order+1,
                'status_order' => $order+1,
                'status' => 1,
                'points' => $request->points,
                'due' => $request->due,
            ]);
        }
        
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

        event(new AddListTaskEvent($task->load('assigned_to'), Sprint::find($request->sprint_id)->board_id));

        return $task->load('assigned_to');
    }

    public function updateSprintOrder(Request $request) {
        foreach ($request->us as $key => $u) {
            $toUp = UserStory::find($u['id']);
            $toUp->update([
                'order' => $u['order'],
                'sprint_id' => $u['sprint_id']
            ]);
            foreach ($toUp->tasks()->get() as $key => $task) {
                $task->update([
                    'sprint_id' => $u['sprint_id']
                ]);
            }
        }

        $nlists = Sprint::where('board_id', $request->board_id)->with(['us' => function($q) {$q->orderBy('order', 'asc');}])->orderBy('created_at' , 'asc')->get();
        // print_r($nlists);
        // event(new SprintTaskOrderEvent($nlists->toJson(), $request->board_id));

        return response()->json('Updated Successfully.', 200);
    }

    public function getSprintTasks(Request $request) {
        $board = Board::find($request->id);

        return $board->sprints()->with(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to'])->orderBy('created_at', 'asc')->get();
    }

    public function updateSprintTaskOrder(Request $request) {
        $tasks = Sprint::find($request->sprint_id)->tasks()->get();

        foreach ($tasks as $key => $task) {
            $id = $task->id;
            foreach ($request->tasks as $updateTask) {
                if($updateTask['id'] == $id) {
                    $task->update([
                        'order' => $updateTask['order'],
                        'status' => $updateTask['status'],
                        'us_id' => $updateTask['us_id']
                    ]);
                }
            }
        }
        // $nlists = Sprint::where('board_id', $request->board_id)->with(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to'])->orderBy('created_at' , 'asc')->get();
        // print_r($nlists);
        // event(new ISprintTaskOrderEvent($nlists->toJson(), $request->board_id));

        return response()->json('Updated Successfully.', 200);
    }

    public function finishSprint(Request $request) {
        $sprint = Sprint::where('id', $request->id)->with('tasks')->first();
        $sprint->update([
            'finished_at' => Carbon::now()->toDateString()
        ]);

        $backlogid = Sprint::where('board_id', $sprint->board_id)->where('name', 'Backlog')->first()->id;

        foreach ($sprint->tasks as $key => $task) {
            if($task['status'] != 4) {
                $task->update([
                    'sprint_id' => $backlogid
                ]);
            }
        }

        $sprints = Board::find($sprint->board_id)->sprints()->with(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to'])->orderBy('created_at', 'asc')->get();
        
        event(new FinishSprintEvent($sprints->toJson(), $sprint->board_id));
        
        return $sprints;

    }

    public function verifyBoardUsers(Request $request) {
        $board = Board::where('id',$request->id)->where('type',$request->type)->first();

        if($board) {
            $verify = $board->boardUsers()->whereIn('user_id', [auth()->user()->id]);
            if($verify) {
                if($request->sprint_id) {
                    $sprint = $board->sprints()->where('id', $request->sprint_id)->first();
                    if($sprint) {
                        return response()->json(['status' => 'authenticated'], 200);
                    }
                    return response()->json(['status' => 'error'], 200);
                }
                return response()->json(['status' => 'authenticated'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        return response()->json(['status' => 'error'], 200);
    }

    public function testFunc(Request $request) {
        // return $request;
        // $date1 = new \DateTime(Carbon::now()->toDateString());
        // $date2 = new \DateTime('2019-01-11');
        // $days  = $date2->diff($date1)->format('%a');
        // return $days+1;
        $dateNow = Carbon::now()->toDateString();

        $query = User::with(['task_assigned_to' => function($q) use ($dateNow) {
            $q->whereDate('due', '>=', $dateNow)->orderBy('created_at', 'asc');
        }]);

        if($request->team) {
            $query->where('department_id', $request->team);
        }

        $users = $query->get();

        // return $users;

        $tasks = [];

        foreach ($users as $key => $user) {
            $dependentOn = null;
            foreach ($user->task_assigned_to as $key => $task) {

                $date1 = new \DateTime(Carbon::now()->toDateString());
                $date2 = new \DateTime($task['created_at']->toDateString());
                $progressDays  = $date1->diff($date2)->format('%a');

                $start = new \DateTime($task['created_at']->toDateString());
                $end = new \DateTime($task['due']);
                $durationDays  = $end->diff($start)->format('%a');


                
                if($progressDays <= 0) {
                    $progressDays = 0;
                }
                else {
                    $progressDays ++;
                }
                $durationDays ++;

                $pPer = ($progressDays/$durationDays) * 100;
                
                if($key == 0) {
                    $parentId = $task['id'];
                    $mT = array(
                        'id' => $task['id'], 
                        'label' => $task['name'],
                        'user' => '<img src="'.$user['picture'].'" class="workload-user-pic" />&nbsp;&nbsp;<a target="_blank" style="color:#0077c0;">'.$user['name'].'</a>',
                        'start' => $task['created_at']->toDateString(),
                        'end' => $task['due'],
                        'duration' => $durationDays * 24 * 60 * 60,
                        'progress' => round($pPer, 0),
                        'key' => $key,
                        'type' => 'task',
                    );
                }
                else {
                    $mT = array(
                        'id' => $task['id'], 
                        'label' => $task['name'],
                        'user' => '',
                        'start' => $task['created_at']->toDateString(),
                        'end' => $task['due'],
                        'duration' => $durationDays * 24 * 60 * 60,
                        'progress' => round($pPer, 0),
                        'key' => $key,
                        'parentId' => $parentId,
                        'dependentOn' => $dependentOn,
                        'type' => 'task',
                    );
                }

                $dependentOn = [$task['id']];
                
                
                array_push($tasks, $mT);
            }
        }

        return response()->json($tasks);
    }

    public function getUserNotifications(Request $request) {
        $user = User::find($request->id);
        // return $user->notifications()->get();
        $notifs = [];

        foreach ($user->notifications as $notification) {
            // echo $notification->type;
            array_push($notifs, $notification);
        }

        return $notifs;
    }

    public function newUS(Request $request) {
        $order = count(Sprint::find($request->sprint_id)->us()->get());
        $us = UserStory::create([
            'name' => $request->name,
            'description' => $request->desc,
            'created_by' => auth()->user()->id,
            'points' => $request->points,
            'sprint_id' => $request->sprint_id,
            'order' => $order+1
        ]);

        return $us;
    }

    public function getUSData(Request $request) {
        $us = UserStory::where('id', $request->us_id)->with(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to'])->first();

        return $us;
    }

    public function updateUS(Request $request) {
        $us = UserStory::find($request->us_id);

        $us->update([
            'name' => $request->name,
            'description' => $request->desc,
            'points' => $request->points
        ]);

        return $us;
    }

    public function deleteUS(Request $request) {
        $us = UserStory::find($request->id);
        $us->delete();

        return $us;
    }

    public function monitorTask(Request $request) {
        $sprint = Sprint::find($request->task['sprint_id']);
        $totalSprintPoints = 0;
        $pointsFinished = 0;
        foreach ($sprint->us()->get() as $key => $story) {
            $totalSprintPoints = $totalSprintPoints + $story->points;
            $tUSTask = count($story->tasks()->get());
            $tUSTaskCompleted = 0;
            if($tUSTask) {
                foreach ($story->tasks()->get() as $key => $usTask) {
                    if($usTask->status == 4) {
                        $tUSTaskCompleted++;
                    }
                }
                if($tUSTask == $tUSTaskCompleted) {
                    $pointsFinished = $pointsFinished + $story->points;
                }
            }
        }

        $totalSprintPoints = $totalSprintPoints - $pointsFinished;

        $todo = 0;
        $in_progress = 0;
        $for_test = 0;
        $closed = 0;

        foreach ($sprint->tasks()->get() as $key => $task) {
            if($task->status == 1) {
                $todo++;
            }
            if($task->status == 2) {
                $in_progress++;
            }
            if($task->status == 3) {
                $for_test++;
            }
            if($task->status == 4) {
                $closed++;
            }
        }

        // if($totalUSTask == $totalUSTaskCompleted) {
            Progress::create([
                'sprint_id' => $request->task['sprint_id'],
                'remaining_points' => $totalSprintPoints,
                'todo' => $todo,
                'in_progress' => $in_progress,
                'for_test' => $for_test,
                'closed' => $closed,
            ]);
        // }

    }

    public function monitorUS(Request $request) {
        $sprint = Sprint::find($request->us['sprint_id']); 
        $totalSprintPoints = 0;
        $pointsFinished = 0;
        foreach ($sprint->us()->get() as $key => $story) {
            $totalSprintPoints = $totalSprintPoints + $story->points;
            $tUSTask = count($story->tasks()->get());
            $tUSTaskCompleted = 0;
            if($tUSTask) {
                foreach ($story->tasks()->get() as $key => $usTask) {
                    if($usTask->status == 4) {
                        $tUSTaskCompleted++;
                    }
                }
                if($tUSTask == $tUSTaskCompleted) {
                    $pointsFinished = $pointsFinished + $story->points;
                }
            }
        }

        $totalSprintPoints = $totalSprintPoints - $pointsFinished;

        $todo = 0;
        $in_progress = 0;
        $for_test = 0;
        $closed = 0;

        foreach ($sprint->tasks()->get() as $key => $task) {
            if($task->status == 1) {
                $todo++;
            }
            if($task->status == 2) {
                $in_progress++;
            }
            if($task->status == 3) {
                $for_test++;
            }
            if($task->status == 4) {
                $closed++;
            }
        }

        Progress::create([
            'sprint_id' => $request->us['sprint_id'],
            'remaining_points' => $totalSprintPoints,
            'todo' => $todo,
            'in_progress' => $in_progress,
            'for_test' => $for_test,
            'closed' => $closed,
        ]);
    }

    public function monitorRemovedUS(Request $request) {
        $sprint = Sprint::find($request->sprint_id);
        $totalSprintPoints = 0;
        $pointsFinished = 0;
        foreach ($sprint->us()->get() as $key => $story) {
            $totalSprintPoints = $totalSprintPoints + $story->points;
            $tUSTask = count($story->tasks()->get());
            $tUSTaskCompleted = 0;
            if($tUSTask) {
                foreach ($story->tasks()->get() as $key => $usTask) {
                    if($usTask->status == 4) {
                        $tUSTaskCompleted++;
                    }
                }
                if($tUSTask == $tUSTaskCompleted) {
                    $pointsFinished = $pointsFinished + $story->points;
                }
            }
        }

        $totalSprintPoints = $totalSprintPoints - $pointsFinished;

        $todo = 0;
        $in_progress = 0;
        $for_test = 0;
        $closed = 0;

        foreach ($sprint->tasks()->get() as $key => $task) {
            if($task->status == 1) {
                $todo++;
            }
            if($task->status == 2) {
                $in_progress++;
            }
            if($task->status == 3) {
                $for_test++;
            }
            if($task->status == 4) {
                $closed++;
            }
        }
        
        Progress::create([
            'sprint_id' => $request->sprint_id,
            'remaining_points' => $totalSprintPoints,
            'todo' => $todo,
            'in_progress' => $in_progress,
            'for_test' => $for_test,
            'closed' => $closed,
        ]);
    }

    public function getBD(Request $request) {
        // return $request;
        $bdData = [];

        $tdData = [];
        $ipData = [];
        $ftData = [];
        $cData = [];

        foreach ($request->dates as $key => $date) {
            $newdate = Carbon::parse($date);
            // if($key == 0) {
            //     $statData = Progress::where('sprint_id', $request->sprint_id)->orderBy('created_at', 'asc')->first();
            //     $singleData = array(
            //         'x' => $date,
            //         'y' => $statData->remaining_points
            //     );
            //     array_push($bdData, $singleData);
            // }
            // else {
                if($newdate <= Carbon::now()) {
                    $statData = Progress::where('sprint_id', $request->sprint_id)->whereDate('created_at', '<=', $date)->orderBy('created_at', 'desc')->first();
                    $singleData = array(
                        'x' => $date,
                        'y' => $statData->remaining_points
                    );

                    $tdSingleData = array(
                        'x' => $date,
                        'y' => $statData->todo
                    );
                    $ipSingleData = array(
                        'x' => $date,
                        'y' => $statData->in_progress
                    );
                    $ftSingleData = array(
                        'x' => $date,
                        'y' => $statData->for_test
                    );
                    $cSingleData = array(
                        'x' => $date,
                        'y' => $statData->closed
                    );
                }
                else{
                    $singleData = array(
                        'x' => $date,
                        'y' => null
                    );
                    $tdSingleData = array(
                        'x' => $date,
                        'y' => null
                    );
                    $ipSingleData = array(
                        'x' => $date,
                        'y' => null
                    );
                    $ftSingleData = array(
                        'x' => $date,
                        'y' => null
                    );
                    $cSingleData = array(
                        'x' => $date,
                        'y' => null
                    );
                }

            array_push($tdData, $tdSingleData);
            array_push($ipData, $ipSingleData);
            array_push($ftData, $ftSingleData);
            array_push($cData, $cSingleData);
            // }
            

            array_push($bdData, $singleData);
        }

        return response()->json(['data' => $bdData, 'todo' => $tdData, 'in_progress' => $ipData, 'for_test' => $ftData, 'closed' => $cData]);
    }

    public function setAsDoneList(Request $request) {
        $cards = Board::find($request->board_id)->cards()->get();

        foreach ($cards as $key => $card) {
            if($card->id == $request->card_id) {
                $card->update([
                    'isDone' => true
                ]);
            }
            else {
                $card->update([
                    'isDone' => false
                ]);
            }
        }

        $lists = Card::where('board_id', $request->board_id)->with(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to'])->orderBy('order' , 'asc')->get();

        return $lists;
    }

    public function monitorAddTask(Request $request) {
        $card = Card::find($request->task['card_id']);

        if($card->isDone) {
            $totalDoneTask = count($card->tasks()->get());
            Progress::create([
                'board_id' => $card->board_id ,
                'completed_tasks' => $totalDoneTask
            ]);
        }
    }
    
    public function monitorRemovedTask(Request $request) {
        $card = Card::find($request->list_id);

        if($card->isDone) {
            $totalDoneTask = count($card->tasks()->get());
            Progress::create([
                'board_id' => $card->board_id ,
                'completed_tasks' => $totalDoneTask
            ]);
        }
    }

    public function getBUData(Request $request) {
        $buData = [];

        foreach ($request->dates as $key => $date) {
            $newdate = Carbon::parse($date);
            if($newdate <= Carbon::now()) {
                $statData = Progress::where('board_id', $request->board_id)->whereDate('created_at', '<=', $date)->orderBy('created_at', 'desc')->first();
                if($statData) {
                    $singleData = array(
                        'x' => $date,
                        'y' => $statData->completed_tasks
                    );
                }
                else {
                    $singleData = array(
                        'x' => $date,
                        'y' => 0
                    );
                }
            }
            else {
                $singleData = array(
                    'x' => $date,
                    'y' => null
                );
            }

            array_push($buData, $singleData);
        }

        return response()->json(['data' => $buData]);
    }
}
