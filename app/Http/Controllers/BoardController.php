<?php

namespace App\Http\Controllers;
use App\Board;
use App\Sprint;
use App\Card;
use App\Task;
use App\User;
use App\UserStory;
use App\Progress;
use App\BPermission;
use App\BRole;
use App\Brand;
use App\JobOrder;

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

use App\Events\NewUSEvent;
use App\Events\DeleteUSEvent;
use App\Events\UpdateUSEvent;

use App\Notifications\BoardCreated;
use App\Notifications\BoardUserAdded;
use App\Notifications\AddBoardMember;
use App\Notifications\BoardSetAsAdmin;
use App\Notifications\BoardCreateListSprint;
use App\Notifications\BoardCreateTask;
use App\Notifications\BoardUpdateTask;
use App\Notifications\BoardAssignTask;
use App\Notifications\BoardDeleteTask;
use App\Notifications\BoardDetailsUpdate;
use App\Notifications\BoardSetRole;
use App\Notifications\BoardUpdateListSprint;
use App\Notifications\BoardDeleteListSprint;
use App\Notifications\BoardCardMove;
use App\Notifications\BoardRemoveMember;
use App\Notifications\BoardAddUS;
use App\Notifications\BoardDeleteUS;
use App\Notifications\BoardUpdateUS;
use App\Notifications\UserRemovefromBoard;
use App\Notifications\UserAssignTask;
use App\Notifications\UserBoardSetRole;
use App\Notifications\UserBoardDetailsUpdate;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class BoardController extends Controller
{
    public function newBoard(Request $request) {
        $board = auth()->user()->boards()->create([
            'name' => $request->name,
            'description' => $request->desc,
            'type' => $request->type,
        ]);

        if($board->type == 2) {
            $permissionsId = BPermission::where('type', '!=' ,'list')->get()->pluck('id');
            $sprint = $board->sprints()->create([
                'name' => 'Backlog',
                'created_by' => auth()->user()->id,
                'type' => 1
            ]);

            $po = $board->roles()->create([
                'name' => 'Product Owner'
            ]);

            $board->boardUsers()->attach(auth()->user()->id, ['added_by' => auth()->user()->id, 'isAdmin' => true, 'bRole_id' => $po->id]);
            $po->permissions()->attach($permissionsId);

            $po = $board->roles()->create([
                'name' => 'Scrum Master'
            ]);
            $po->permissions()->attach($permissionsId);

            $po = $board->roles()->create([
                'name' => 'Development Team'
            ]);
            $po->permissions()->attach($permissionsId);
        }   

        else {
            $permissionsId = BPermission::where('type','task')->orWhere('type', 'list')->get()->pluck('id');

            $list = Card::create([
                'name' => 'Backlog',
                'board_id' => $board->id,
                'created_by' => auth()->user()->id,
                'order' => 1,
            ]);
            Card::create([
                'name' => 'Done',
                'board_id' => $board->id,
                'created_by' => auth()->user()->id,
                'order' => 1,
                'isDone' => true
            ]);

            $po = $board->roles()->create([
                'name' => 'Project Leader',
                'created_by' => auth()->user()->id
            ]);

            $board->boardUsers()->attach(auth()->user()->id, ['added_by' => auth()->user()->id, 'isAdmin' => true, 'bRole_id' => $po->id]);
            $po->permissions()->attach($permissionsId);

            $po = $board->roles()->create([
                'name' => 'Member'
            ]);
            $po->permissions()->attach($permissionsId);
        }

        $board->notify(new BoardCreated($board->load('created_by')->toJson()));

        // foreach ($board->boardUsers()->get() as $key => $user) {
        //     $user->notify(new BoardUserAdded($board->load('created_by')->toArray(), auth()->user()->name));
        // }
        // Notification::send($board, new BoardCreated($board->load('created_by')->toJson()));
        // Notification::send($board->boardUsers()->get(), new BoardCreated($board->load('created_by')->toJson()));
        
        // event(new CreateBoardEvent($board->load('boardUsers.department', 'boardUsers.role')));

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
        event(new DeleteBoardEvent($request->id));
        $board->delete();
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }

    public function updateBoard(Request $request) {
        // dd($request);
        $input = $request->all();
        $board = Board::findOrFail($request->id);
        
        if($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('storage/boards/', $name);
            $input['image'] = $name;
            
            $board->update([
                'name' => $input['name'],
                'description' => $input['desc'],
                'board_image' => $input['image'],
            ]);
        }

        $board->update([
            'name' => $input['name'],
            'description' => $input['desc'],
        ]);

        event(new UpdateBoardEvent($board->load('boardUsers.department', 'boardUsers.role')));


        foreach ($board->boardUsers()->get() as $key => $user) {
            $user->notify(new UserBoardDetailsUpdate($board->toArray(), auth()->user()->name));
        }

        $board->notify(new BoardDetailsUpdate(auth()->user()->name));

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

        Board::find($request->board_id)->notify(new BoardCreateListSprint($list->load('created_by')->toJson(), 'list'));

        return $list->load('tasks.assigned_to');
    }

    public function updateList(Request $request) {
        $list = Card::findOrFail($request->id);

        $oldName = $list->name;

        $list->update([
            'name' => $request->name
        ]);
        event(new UpdateListEvent($list) );

        Board::find($list->board_id)->notify(new BoardUpdateListSprint(auth()->user()->name, $oldName, $list->name, 'list'));

        return $list;
    }
    
    public function getBoardLists(Request $request) {
        $lists = Card::where('board_id', $request->id)->with(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to', 'tasks.joborder'])->orderBy('order' , 'asc')->get();

        return $lists;
    }

    public function deleteList(Request $request) {
        $list = Card::findOrFail($request->id);
        event(new DeleteListEvent($request->id, $list->board_id));
        $list->delete();

        Board::find($list->board_id)->notify(new BoardDeleteListSprint(auth()->user()->name, $list->name, 'list'));
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
        $card = Card::find($request->list_id);
        $order = count($card->tasks()->get());
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

        $user = User::find($request->assign_to);
        $boardname = Board::find($card->board_id);
        $update=false;
// 
        Board::find($card->board_id)->notify(new BoardCreateTask($task->load('created_by', 'card')->toJson()));
        Board::find($card->board_id)->notify(new BoardAssignTask(auth()->user()->name, $task->name, $user->name));
        $user->notify(new UserAssignTask(auth()->user()->name, $task->name, $boardname->toArray(), $update));

        if($request->assigned_to) {
            
        }

        event(new AddListTaskEvent($task->load('assigned_to'), $request->board_id));
        return $task->load('assigned_to');
    }

    public function getTaskData(Request $request) {
        $task = Task::with('assigned_to', 'files', 'joborder')->where('id', $request->id)->first();
        return $task;
    }

    public function updateTask(Request $request) {
        $task = Task::find($request->id);

        if($task->card_id) {
            $board = Card::find($task->card_id)->board_id;
            $board = Board::find($board);
        }
        else {
            $board = Sprint::find($task->sprint_id)->board_id;
            $board = Board::find($board);
        }
        
        $ta = [
            'due' => $request->due,
            'name' => $request->name,
            'description' => $request->desc
        ];

        if($request->assign_to != $task->assigned_to) {
            $ta['assigned_to'] = $request->assign_to;
            $ta['assigned_by'] = auth()->user()->id;

            $user = User::find($request->assign_to);
            $update=false;

            $user->notify(new UserAssignTask(auth()->user()->name, $task->name, $board->toArray(), $update));

            $board->notify(new BoardAssignTask(auth()->user()->name, $task->name, $user->name));
        }

        $task->update($ta);

        event(new UpdateListTaskEvent($task->load('assigned_to'), $request->board_id));
        $user = User::find($task->assigned_to);
        $update = true;

        $user->notify(new UserAssignTask(auth()->user()->name, $task->name, $board->toArray(), $update));

        $board->notify(new BoardUpdateTask($task->load('created_by')->toJson()));

        return $task->load('assigned_to');
    }

    public function addAttachment(Request $request) {
        // dd($request);
        $task = Task::where('id',$request->task_id)->with(['sprint.board','card.board'])->first();
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

        // $user = User::find($task->assigned_to);
        // $update = true;
        // $board =  Board::find($task->sprint->board->id);

        // $user->notify(new UserAssignTask(auth()->user()->name, $task->name, $board->toArray(), $update));
        // dd($attachments);
        
        event(new AddTaskAttachmentEvent($attachments, $request->task_id));
        if($task->card_id)
        {
        $user = User::find($task->assigned_to);
        $update = true;
        $board =  Board::find($task->card->board->id);

        $user->notify(new UserAssignTask(auth()->user()->name, $task->name, $board->toArray(), $update));
        Board::find($task->card->board->id)->notify(new BoardUpdateTask($task->load('created_by')->toJson()));   
        }
        else{
        $user = User::find($task->assigned_to);
        $update = true;
        $board =  Board::find($task->sprint->board->id);

        $user->notify(new UserAssignTask(auth()->user()->name, $task->name, $board->toArray(), $update));
        Board::find($task->sprint->board->id)->notify(new BoardUpdateTask($task->load('created_by')->toJson()));
        }
        return response()->json($attachments);
    }

    public function taskPhoto(Request $request) {
        // return $request->filename;
        $task = Task::where('id',$request->id)->with(['sprint.board'])->first();
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
        if($task->card_id)
        {
        $user = User::find($task->assigned_to);
        $update = true;
        $board =  Board::find($task->card->board->id);

        $user->notify(new UserAssignTask(auth()->user()->name, $task->name, $board->toArray(), $update));
        Board::find($task->card->board->id)->notify(new BoardUpdateTask($task->load('created_by')->toJson()));   
        }
        else{
        $user = User::find($task->assigned_to);
        $update = true;
        $board =  Board::find($task->sprint->board->id);

        $user->notify(new UserAssignTask(auth()->user()->name, $task->name, $board->toArray(), $update));
        Board::find($task->sprint->board->id)->notify(new BoardUpdateTask($task->load('created_by')->toJson()));
        }
        return $task->load('assigned_to'); 
    }

    public function deleteTask(Request $request) {
        $task = Task::find($request->id);
        event(new DeleteListTaskEvent($task->toArray(), $request->board_id));
        $task->delete();

        Board::find($request->board_id)->notify(new BoardDeleteTask(auth()->user()->name, $task->name));

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
        $board = Board::where('id',$request->id)->with(['bu' => function($q) {$q->orderBy('isAdmin', 'desc');}, 'notifications' => function($q) {$q->orderBy('created_at', 'desc');}])->first();
        if($board->type == 1) {
            $permissions = BPermission::where('type','task')->orWhere('type', 'list')->get();
            $checkedPer = $board->roles()->where('name', 'Member')->with('permissions')->first();
            $checkedPer = $checkedPer->toArray();
            $checkedPer['permissions'] = collect($checkedPer['permissions'])->pluck('id');
        }
        else {
            $permissions = BPermission::where('type', '!=' ,'list')->get();
            $checkedPer = $board->roles()->with('permissions')->get();
            $checkedPer = $checkedPer->toArray();
            foreach ($checkedPer as $key => $role) {
                $checkedPer[$key]['permissions'] = collect($role['permissions'])->pluck('id');
            }
        }
        $boards = $board->toJson();
        $pivotArr = [];
        $nBoard = json_decode($boards, true);
        foreach ($board->bu as $key => $user) {
            $pivot = $user->pivot->brole()->first()->toJson();
            array_push($pivotArr, $pivot);
        }
        foreach ($nBoard['bu'] as $key => $bu) {
            // array_push($bu['pivot'], $pivotArr[$key]);
            $bu['pivot']['role'] = json_decode($pivotArr[$key], true);
            // print_r($bu);
            $nBoard['bu'][$key] = $bu;
        }
        // dd($boards);

        //permissions
        $userRoleID = auth()->user()->userBoards()->where('board_id', $request->id)->first()->pivot->bRole_id;
        $isAdmin = auth()->user()->userBoards()->where('board_id', $request->id)->first()->pivot->isAdmin;
        
        $all = [];

        foreach ($permissions as $key => $per) {
            $role = $per->roles()->find($userRoleID);

            if($role || $isAdmin) {
                $arr = array(
                    'type' => $per->type,
                    'name' => $per->name,
                    'isAuthenticated' => true
                );

                array_push($all, $arr);
            }
            else {
                $arr = array(
                    'type' => $per->type,
                    'name' => $per->name,
                    'isAuthenticated' => false
                );

                array_push($all, $arr);
            }
        }

        return response()->json(['data' => $nBoard, 'permissions' => $permissions, 'role_permissions' => $checkedPer, 'userPermit' => $all]);
    }

    public function getScrumLists(Request $request) {
        $board = Board::find($request->id);

        $sprints = $board->sprints()->with(['us' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks.assigned_to', 'tasks.joborder', 'us.tasks.joborder'])->orderBy('created_at', 'asc')->get();
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

        event(new AddSprintEvent($sprint->load(['us' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks.assigned_to'])));

        $board->notify(new BoardCreateListSprint($sprint->load('created_by')->toJson(), 'sprint'));

        return $sprint->load(['us' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks.assigned_to']);
    }

    public function updateSprint(Request $request) {
        $sprint = Sprint::find($request->id);

        $oldName = $sprint->name;
        
        $sprint->update([
            'name' => $request->name
        ]);

        event(new UpdateSprintEvent($sprint->load('tasks')));

        Board::find($sprint->board_id)->notify(new BoardUpdateListSprint(auth()->user()->name, $oldName, $sprint->name, 'sprint'));

        return $sprint->load('tasks');
    }
    
    public function deleteSprint(Request $request) {
        $sprint = Sprint::find($request->id);
        event(new DeleteSprintEvent($sprint->toArray()));
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

        Board::find($sprint->board_id)->notify(new BoardDeleteListSprint(auth()->user()->name, $sprint->name, 'sprint'));

        $sprints = Sprint::where('board_id', $sprint->board_id)->with(['us' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks.assigned_to'])->orderBy('created_at', 'asc')->get();

        return $sprints;
    }

    public function addSprintTask(Request $request) {
        // return $request;
        $sprint = Sprint::find($request->sprint_id);
        $order = count($sprint->tasks()->get());
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
        Board::find($sprint->board_id)->notify(new BoardCreateTask($task->load('created_by', 'us')->toJson()));

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

        $sprints = Sprint::where('board_id', $request->board_id)->with(['us' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks.assigned_to'])->orderBy('created_at', 'asc')->get();
        // print_r($nlists);
        event(new SprintTaskOrderEvent($sprints->toJson(), $request->board_id));

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
                        $userRoleID = auth()->user()->userBoards()->where('board_id', $request->id)->first()->pivot->bRole_id;
        
                        $taskPermission = BPermission::where('type', 'sprint')->where('name', 'View')->first();

                        $role = $taskPermission->roles()->find($userRoleID);

                        if($role) {
                            return response()->json(['status' => 'authenticated'], 200);
                        }

                        return response()->json(['status' => 'error'], 200);
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
        $query = User::with(['task_assigned_to' => function($q) use ($dateNow, $request) {
            // $task = $q->with('card')->first();
            $q->orderBy('created_at', 'asc');

            if($request->task_status) {
                if($request->task_status == 'Active') {
                        $q->whereDate('due', '>=', $dateNow)->where(function ($wq) {
                            $wq->whereHas('card', function($cq) {
                                $cq->where('isDone', false);
                            })->orWhere('status', '!=', 4);
                        });
                }
                if($request->task_status == 'Overdue') {
                        $q->whereDate('due', '<=', $dateNow)->where(function ($wq) {
                            $wq->whereHas('card', function($cq) {
                                $cq->where('isDone', false);
                            })->orWhere('status', '!=', 4);
                        });
                }
                if($request->task_status == 'Completed') {
                        $q->where(function ($wq) {
                            $wq->whereHas('card', function($cq) {
                                $cq->where('isDone', true);
                            })->orWhere('status', 4);
                        });
                }
            }
        },'tasks']);

        if($request->type == 'byteam') {
            

            if($request->team) {
                $query->where('department_id', $request->team);
            }
        }

        else {
            if($request->jo) {
                $jo = JobOrder::find($request->jo);
                $query = User::with(['task_assigned_to' => function($q) use ($dateNow, $jo, $request) {
                    $q->orderBy('created_at', 'asc')->where('jo_id', $jo->id);

                    if($request->task_status) {
                        if($request->task_status == 'Active') {
                                $q->whereDate('due', '>=', $dateNow)->where(function ($wq) {
                                    $wq->whereHas('card', function($cq) {
                                        $cq->where('isDone', false);
                                    })->orWhere('status', '!=', 4);
                                });
                        }
                        if($request->task_status == 'Overdue') {
                                $q->whereDate('due', '<', $dateNow)->where(function ($wq) {
                                    $wq->whereHas('card', function($cq) {
                                        $cq->where('isDone', false);
                                    })->orWhere('status', '!=', 4);
                                });
                        }
                        if($request->task_status == 'Completed') {
                                $q->where(function ($wq) {
                                    $wq->whereHas('card', function($cq) {
                                        $cq->where('isDone', true);
                                    })->orWhere('status', 4);
                                });
                        }
                    }

                }]);
            }
            if($request->brand && !$request->jo) {
                $brand = Brand::find($request->brand);

                $query = User::with(['task_assigned_to' => function($q) use ($dateNow, $brand, $request) {
                    $q->orderBy('created_at', 'asc')->whereHas('joborder', function($jq) use ($brand) {
                        $jq->where('brand_id', $brand->id);
                    });

                    if($request->task_status) {
                        if($request->task_status == 'Active') {
                                $q->whereDate('due', '>=', $dateNow)->where(function ($wq) {
                                    $wq->whereHas('card', function($cq) {
                                        $cq->where('isDone', false);
                                    })->orWhere('status', '!=', 4);
                                });
                        }
                        if($request->task_status == 'Overdue') {
                                $q->whereDate('due', '<=', $dateNow)->where(function ($wq) {
                                    $wq->whereHas('card', function($cq) {
                                        $cq->where('isDone', false);
                                    })->orWhere('status', '!=', 4);
                                });
                        }
                        if($request->task_status == 'Completed') {
                                $q->where(function ($wq) {
                                    $wq->whereHas('card', function($cq) {
                                        $cq->where('isDone', true);
                                    })->orWhere('status', 4);
                                });
                        }
                    }
                    
                }]);
                
            }
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

                if($task['card_id']) {
                    if($task['card']['isDone']) {
                        $status = 'Completed';
                    }
                    else {
                        $due = new Carbon($task['due']);
                        $dueDate = $due->toDatestring();

                        $today = new Carbon();
                        $todayDate = $today->toDateString();

                        if($dueDate < $todayDate) {
                            $status = 'Overdue';
                        }

                        else {
                            if($dueDate == $todayDate) {
                                $status = 'Due Today';
                            }
                            else {
                                $diff = $today->diffInDays($due) + 1;
                                if($diff == 1) {
                                   $status = 'Due Tomorrow';
                                }
                                if($diff > 1) {
                                   $status = 'Active';
                                }
                            }
                        }
                    }
                }
                else {
                    if($task['status'] == 4) {
                        $status = 'Completed';
                    }
                    else {
                        $due = new Carbon($task['due']);
                        $dueDate = $due->toDatestring();

                        $today = new Carbon();
                        $todayDate = $today->toDateString();

                        if($dueDate < $todayDate) {
                            $status = 'Overdue';
                        }

                        else {
                            if($dueDate == $todayDate) {
                                $status = 'Due Today';
                            }
                            else {
                                $diff = $today->diffInDays($due) + 1;
                                if($diff == 1) {
                                    $status = 'Due Tomorrow';
                                }
                                if($diff > 1) {
                                    $status = 'Active';
                                }
                            }
                        }
                    }
                }
                
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
                        'status' => $status
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
                        'status' => $status
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
        $sprint = Sprint::find($request->sprint_id);
        $order = count($sprint->us()->get());
        $us = UserStory::create([
            'name' => $request->name,
            'description' => $request->desc,
            'created_by' => auth()->user()->id,
            'points' => $request->points,
            'sprint_id' => $request->sprint_id,
            'order' => $order+1
        ]);

        event(new NewUSEvent($us, $sprint->board_id));
        Board::find($sprint->board_id)->notify(new BoardAddUS(auth()->user()->name, $us->name));

        return $us;
    }

    public function getUSData(Request $request) {
        $us = UserStory::where('id', $request->us_id)->with(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to'])->first();

        return $us;
    }

    public function updateUS(Request $request) {
        $us = UserStory::where('id',$request->us_id)->with('sprint.board')->first();

        $us->update([
            'name' => $request->name,
            'description' => $request->desc,
            'points' => $request->points
        ]);

        event(new UpdateUSEvent($us->load(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to']), $request->board_id));

        Board::find($us->sprint->board->id)->notify(new BoardUpdateUS(auth()->user()->name, $us->name));

        return $us;
    }

    public function deleteUS(Request $request) {
        $us = UserStory::where('id',$request->id)->with('sprint.board')->first();
        event(new DeleteUSEvent($us->toArray(), $request->board_id));
        $us->delete();

        Board::find($us->sprint->board->id)->notify(new BoardDeleteUS(auth()->user()->name, $us->name));


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
        
        Progress::create([
            'jo_id' => $request->task['jo_id'] ,
            'remaining_points' => $todo+$in_progress+$for_test
        ]);

        if($request->task['status'] == 1) {
            $status = 'To do';
        }
        else if($request->task['status'] == 2) {
            $status = 'In Progress';
        }
        else if($request->task['status'] == 3) {
            $status = 'Ready for Test';
        }
        else if($request->task['status'] == 4) {
            $status = 'Closed';
        }

        Board::find($sprint->board_id)->notify(new BoardCardMove(auth()->user()->name, $request->task['name'], $status, 'task'));

    }

    public function monitorUS(Request $request) {
        $sprint = Sprint::find($request->us['sprint_id']); 
        
        if($sprint->type == 2) {
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

        Board::find($sprint->board_id)->notify(new BoardCardMove(auth()->user()->name, $request->us['name'], $sprint->name, 'user story'));

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

        $totalDoneTask = count(Card::find($request->card_id)->tasks()->get());
        Progress::create([
            'board_id' => $request->board_id ,
            'completed_tasks' => $totalDoneTask
        ]);

        $lists = Card::where('board_id', $request->board_id)->with(['tasks' => function($q) {$q->orderBy('order', 'asc');},'tasks.assigned_to'])->orderBy('order' , 'asc')->get();
        event(new UpdateListOrderEvent($lists->toJson(), $request->board_id));

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

            if($request->task['jo_id']) {
                $jo = JobOrder::find($request->task['jo_id'])->load('tasks.card');
                $totalRemainingTask = 0;
    
                foreach ($jo->tasks as $key => $task) {
                    if($task->card_id) {
                        if(!$task->card->isDone) {
                            $totalRemainingTask++;
                        }
                    }
                }
    
                Progress::create([
                    'jo_id' => $jo->id ,
                    'remaining_points' => $totalRemainingTask
                ]);
            }
        }

        Board::find($card->board_id)->notify(new BoardCardMove(auth()->user()->name, $request->task['name'], $card->name, 'task'));

    }
    
    public function monitorRemovedTask(Request $request) {
        $card = Card::find($request->list_id);

        if($card->isDone) {
            $totalDoneTask = count($card->tasks()->get());
            Progress::create([
                'board_id' => $card->board_id ,
                'completed_tasks' => $totalDoneTask
            ]);
            if($request->task['jo_id']) {
                $jo = JobOrder::find($request->task['jo_id'])->load('tasks.card');
                $totalRemainingTask = 0;
    
                foreach ($jo->tasks as $key => $task) {
                    if($task->card_id) {
                        if(!$task->card->isDone) {
                            $totalRemainingTask++;
                        }
                    }
                }
    
                Progress::create([
                    'jo_id' => $jo->id ,
                    'remaining_points' => $totalRemainingTask
                ]);
            }
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

    public function permissionChanged(Request $request) {
        $role = BRole::find($request->role_id);
        $role->permissions()->sync($request->permissions_id);
        $newRole = $role->load('permissions')->toArray();
        $newRole['permissions'] = collect($newRole['permissions'])->pluck('id');
        return $newRole;
    }

    public function getBoardNotMembers(Request $request) {
        $boardUsersId = Board::find($request->board_id)->boardUsers()->get()->pluck('id');
        $query = User::whereNotIn('id',$boardUsersId);

        if($request->search) {
            $query->where('name', 'like', $request->search . '%');
        }

        $notMembers = $query->get();

        return response()->json($notMembers);
    }

    public function addBoardMember(Request $request) {
        $board = Board::find($request->board_id);
        if($board->type == 1) {
            $role = $board->roles()->where('name', 'Member')->first();
        }
        else {
            $role = $board->roles()->where('name', 'Development Team')->first();
        }
        $board->boardUsers()->attach($request->ids, ['added_by' => auth()->user()->id, 'isAdmin' => false, 'bRole_id' => $role->id]);
        // return $board->load('bu');
        $boards = $board->load('bu');
        $pivotArr = [];
        $nBoard = json_decode($boards, true);
        foreach ($board->bu as $key => $user) {
            $pivot = $user->pivot->brole()->first()->toJson();
            array_push($pivotArr, $pivot);
        }
        foreach ($nBoard['bu'] as $key => $bu) {
            // array_push($bu['pivot'], $pivotArr[$key]);
            $bu['pivot']['role'] = json_decode($pivotArr[$key], true);
            // print_r($bu);
            $nBoard['bu'][$key] = $bu;
        }

        $boardUsersId = $board->boardUsers()->get()->pluck('id');
        $users = User::whereNotIn('id',$boardUsersId)->get();

        foreach ($request->ids as $key => $uid) {
            $user = User::find($uid);
            $board->notify(new AddBoardMember($user->name, auth()->user()->name));
            $user->notify(new BoardUserAdded($board->load('created_by')->toArray(), auth()->user()->name));
        }
    

        event(new CreateBoardEvent($board->load('boardUsers.department', 'boardUsers.role')));

        return response()->json(['data' => $nBoard, 'users' => $users]);
    }

    public function removeBoardMember(Request $request) {
        $board = Board::find($request->board_id);
        $board->boardUsers()->detach($request->user_id);
        $boards = $board->load('bu');
        $pivotArr = [];
        $nBoard = json_decode($boards, true);
        foreach ($board->bu as $key => $user) {
            $pivot = $user->pivot->brole()->first()->toJson();
            array_push($pivotArr, $pivot);
        }
        foreach ($nBoard['bu'] as $key => $bu) {
            // array_push($bu['pivot'], $pivotArr[$key]);
            $bu['pivot']['role'] = json_decode($pivotArr[$key], true);
            // print_r($bu);
            $nBoard['bu'][$key] = $bu;
        }

        $boardUsersId = $board->boardUsers()->get()->pluck('id');
        $users = User::whereNotIn('id',$boardUsersId)->get();

        $ruser = User::find($request->user_id);

        $ruser->notify(new UserRemovefromBoard(auth()->user()->name, $board->toArray(), $ruser->toArray()));
        
        $board->notify(new BoardRemoveMember(auth()->user()->name, $ruser->name));
        event(new DeleteBoardEvent($request->board_id));

        return response()->json(['data' => $nBoard, 'users' => $users]);
    }

    public function setAsAdmin(Request $request) {
        $board = Board::find($request->board_id);
        $board->boardUsers()->syncWithoutDetaching([$request->user_id => ['isAdmin' => (bool) !$request->isAdmin, 'added_by' => auth()->user()->id, 'bRole_id' => $request->role_id]]);

        $user = User::find($request->user_id);
        $role = null;

        $user->notify(new UserBoardSetRole(auth()->user()->name, $role, $board->toArray()));
        $board->notify(new BoardSetAsAdmin($user->name, auth()->user()->name));
    }
    
    public function changeRole(Request $request) {
        $board = Board::find($request->board_id);
        $board->boardUsers()->syncWithoutDetaching([$request->user_id => ['isAdmin' => (bool) $request->admin, 'added_by' => auth()->user()->id, 'bRole_id' => $request->role_id]]);

        $user = User::find($request->user_id);
        $role = BRole::find($request->role_id);

        $user->notify(new UserBoardSetRole(auth()->user()->name, $role->name, $board->toArray()));
        
        $board->notify(new BoardSetRole(auth()->user()->name, $user->name, $role->name));
    }

    public function verifyKanbanTask(Request $request) {
        $userRoleID = auth()->user()->userBoards()->where('board_id', $request->board_id)->first()->pivot->bRole_id;
        
        $taskPermission = BPermission::where('type', $request->type)->where('name', $request->action)->first();

        $role = $taskPermission->roles()->find($userRoleID);

        if($role) {
            return response()->json(['status' => 'authenticated'], 200);
        }

        // echo $userRoleID;

        return response()->json(['status' => 'error'], 200);
    }

    public function verifyListKanban(Request $request) {
        // echo $userRoleID;

        return response()->json($all, 200);
    }

    public function onWorkloadCreate(Request $request) {
        $brands = Brand::all();

        return $brands->load('jos');
    }

    public function filterWorkloadStatus(Request $request) {
        return $request;
    }
}
