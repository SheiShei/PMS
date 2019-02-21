<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Brand;
use App\JobOrder;
use App\Board;
use App\Task;
use App\JoCreative;
use App\BPermission;
use App\Card;
use App\Sprint;
use App\UserStory;

use App\Events\AddListTaskEvent;
use App\Events\AddSprintEvent;
use App\Events\NewUSEvent;

use App\Notifications\BoardCreated;
use App\Notifications\BoardUserAdded;
use App\Notifications\AddBoardMember;
use App\Notifications\BoardCreateListSprint;
use App\Notifications\BoardCreateTask;
use App\Notifications\BoardAddUS;


use Hash;
use Carbon\Carbon;

use App\Notifications\JOCreativeCreated;

class AdminController extends Controller
{
    public function getUsersList(Request $request) {
        // return $request;
        if($request->notArchive){
            $query = User::with('role:id,name')->with('department:id,name')->orderBy('created_at', 'desc');
        }
        else {
            $query = User::onlyTrashed()->with('role:id,name')->with('department:id,name')->orderBy('deleted_at', 'desc');
        }

        if($request->filter) {
            $query->whereHas('role', function($role) use ($request) {
                $role->where('name', $request->filter);
            });
        }

        if($request->search) {
            $query->where('name', 'like', $request->search . '%');
        }

        $user = $query->paginate(10);
        // dd($request);
        return $user;
        // return $request;
    }

    public function addUsers(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'department_id' => $request->team,
            'picture'=> 'default.png',
            'bg_image'=> 'bg-default.jpeg'
        ]);

        return User::with('role:id,name')->with('department:id,name')->where('id', $user->id)->get();
    }

    public function updateUser(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'password' => 'string|min:6|nullable',
        ]);
        $user = User::findOrFail($request->id);
        
        if($request->password) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
                'department_id' => $request->team
           ]);        
        }
        else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                // 'password' => Hash::make($request->password),
                'role_id' => $request->role,
                'department_id' => $request->team
            ]);
        }
        if($user->role_id==4)
        {
            $brand = Brand::where('id', $user->brand_id)->first();
            $brand->update([
                'name' => $request->name,
            ]);
        }
        return User::with('role:id,name')->with('department:id,name')->where('id', $user->id)->get();
    }

    public function deleteUser(Request $request) {
        // return $request;
        $user = User::findOrFail($request->id);
        if($user->role_id==4)
        {
            $brand = Brand::where('id', $user->brand_id)->first();
            $brand->delete();
        }
        $user->delete();
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }

    public function restoreUser(Request $request) {
        // return $request->data['id'];
        $user = User::onlyTrashed()->where('id' , $request->data['id'])->restore();
        $client = User::findOrFail($request->data['id']);
        if($client->role_id==4)
        {
            $brand= Brand::onlyTrashed()->where('id' , $client->brand_id)->restore();
        }  
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }


    //Job Order
    public function createJOCreative(Request $request) {
        $joMain = json_decode($request->brand, true);
        $joDetails = json_decode($request->details, true);
        $joTasks = json_decode($request->tasks, true);

        if(!$joMain['board_id']) {
            $board = auth()->user()->boards()->create([
                'name' => $joMain['newBoard']['name'],
                'description' => null,
                'type' => $joMain['newBoard']['type'],
            ]);

            $joMain['board_id'] = $board->id;

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

                foreach ($joMain['newBoard']['ids'] as $key => $uid) {
                    $board->boardUsers()->attach($uid['id'], ['added_by' => auth()->user()->id, 'isAdmin' => false, 'bRole_id' => $po->id]);
                }
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
                    'name' => 'Project Leader'
                ]);
    
                $board->boardUsers()->attach(auth()->user()->id, ['added_by' => auth()->user()->id, 'isAdmin' => true, 'bRole_id' => $po->id]);
                $po->permissions()->attach($permissionsId);
    
                $po = $board->roles()->create([
                    'name' => 'Member'
                ]);
                $po->permissions()->attach($permissionsId);

                foreach ($joMain['newBoard']['ids'] as $key => $uid) {
                    $board->boardUsers()->attach($uid['id'], ['added_by' => auth()->user()->id, 'isAdmin' => false, 'bRole_id' => $po->id]);
                    $board->notify(new AddBoardMember($uid['name'], auth()->user()->name));
                    User::find($uid['id'])->notify(new BoardUserAdded($board->load('created_by')->toArray(), auth()->user()->name));
                }
            }
    
            $board->notify(new BoardCreated($board->load('created_by')->toJson()));
        }

        $newjo = JobOrder::create([
            'name' => $joMain['name'],
            'brand_id' => $joMain['brand_id'],
            'board_id' => $joMain['board_id'],
            'date_in' => $joMain['date_in'],
            'date_due' => $joMain['date_due'],
            'status' => $joMain['status'],
            'created_by' => auth()->user()->id,
            'type' => 1
        ]);

        foreach ($joTasks as $key => $task) {
            if($task['name']) {
                $card = Board::find($joMain['board_id'])->cards()->where('name', 'Backlog')->orderBy('created_at', 'asc')->first();
                $newTask = $newjo->tasks()->create([
                    'card_id' => $card->id,
                    'name' => $task['name'],
                    'due' => $task['due'],
                    'description' => $task['desc'],
                    'created_by' => auth()->user()->id,
                    'assigned_to' => $task['assign'],
                    'assigned_by' => auth()->user()->id,
                    'jo_id' => $newjo->id
                ]);
                
                if ($files = $request->file('files')) {
                    if($taskFiles = $task['files']) {
                        foreach ($files as $key => $file) {
                            foreach ($taskFiles as $key => $taskFile) {
                                if($file->getClientOriginalName() == $taskFile['filename']){
                                    $extension = $file->getClientOriginalExtension();
                                    // echo $taskFile['filename'];
                                    $newName = time() . $taskFile['filename'];
                                    $file->move('storage/task/', $newName);
                                    $newTask->files()->create([
                                        'original_filename' => $taskFile['filename'],
                                        'new_filename' => $newName,
                                        'extension' => $extension
                                    ]);
                                }
                            }
                            // echo $file->getClientOriginalName();
                        }
                    }
                }
            }
        }

        $media = '';
        foreach ($joDetails['media'] as $key => $e) {
            if(count($joDetails['media']) != $key+1) {
                $media = $media . $e . '.';
            }
            else {
                $media = $media . $e;
            }
        }
        $ad_type = '';
        foreach ($joDetails['ad_type'] as $key => $e) {
            // if(last) {
                $ad_type = $ad_type . $e . '.';
            // }
            // else {
            //     $media = $media . $e;
            // }
        }
        $file_type = '';
        foreach ($joDetails['file_type'] as $key => $e) {
            // if(last) {
                $file_type = $file_type . $e . '.';
            // }
            // else {
            //     $media = $media . $e;
            // }
        }

        $newjocreative = $newjo->jocreatives()->create([
            'media' => $media,
            'ad_type' => $ad_type,
            'file_type' => $file_type,
            'copy' => $joDetails['copy'],
            'post_caption' => $joDetails['post_caption'],
            'revisions' => $joDetails['revisions']
        ]);
        
        // $newjo2 = User::where('id',auth()->user()->id);

        auth()->user()->notify(new JOCreativeCreated($newjo->toArray(), auth()->user()->name));

        return JobOrder::with('jocreatives', 'tasks.files')->where('id', $newjo->id)->first();
    }
    
    public function createJOWeb(Request $request) {
        // return $request;
        $joMain = json_decode($request->brand, true);
        $joDetails = json_decode($request->details, true);
        $joTasks = json_decode($request->tasks, true);
        
        if(!$joMain['board_id']) {
            $board = auth()->user()->boards()->create([
                'name' => $joMain['newBoard']['name'],
                'description' => null,
                'type' => $joMain['newBoard']['type'],
            ]);

            $joMain['board_id'] = $board->id;

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

                foreach ($joMain['newBoard']['ids'] as $key => $uid) {
                    $board->boardUsers()->attach($uid['id'], ['added_by' => auth()->user()->id, 'isAdmin' => false, 'bRole_id' => $po->id]);
                    $board->notify(new AddBoardMember($uid['name'], auth()->user()->name));
                    User::find($uid['id'])->notify(new BoardUserAdded($board->load('created_by')->toArray(), auth()->user()->name));
                }
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
                    'name' => 'Project Leader'
                ]);
    
                $board->boardUsers()->attach(auth()->user()->id, ['added_by' => auth()->user()->id, 'isAdmin' => true, 'bRole_id' => $po->id]);
                $po->permissions()->attach($permissionsId);
    
                $po = $board->roles()->create([
                    'name' => 'Member'
                ]);
                $po->permissions()->attach($permissionsId);

                foreach ($joMain['newBoard']['ids'] as $key => $uid) {
                    $board->boardUsers()->attach($uid['id'], ['added_by' => auth()->user()->id, 'isAdmin' => false, 'bRole_id' => $po->id]);
                    $board->notify(new AddBoardMember($uid['name'], auth()->user()->name));
                    User::find($uid['id'])->notify(new BoardUserAdded($board->load('created_by')->toArray(), auth()->user()->name));
                }
            }
    
            $board->notify(new BoardCreated($board->load('created_by')->toJson()));
        }

        else {
            $board = Board::find($joMain['board_id']);
        }

        $newjo = JobOrder::create([
            'name' => $joMain['name'],
            'brand_id' => $joMain['brand_id'],
            'board_id' => $joMain['board_id'],
            'date_in' => $joMain['date_in'],
            'date_due' => $joMain['date_due'],
            'status' => $joMain['status'],
            'created_by' => auth()->user()->id,
            'type' => 2
        ]);

        // if board is kanban
        if($board->type == 1) {
            foreach ($joTasks as $key => $task) {
                if($task['name']) {
                    $card = Board::find($joMain['board_id'])->cards()->where('name', 'Backlog')->orderBy('created_at', 'asc')->first();
                    $newTask = $newjo->tasks()->create([
                        'card_id' => $card->id,
                        'name' => $task['name'],
                        'due' => $task['due'],
                        'description' => $task['desc'],
                        'created_by' => auth()->user()->id,
                        'assigned_to' => $task['assign'],
                        'assigned_by' => auth()->user()->id,
                        'jo_id' => $newjo->id
                    ]);
                    
                    if ($files = $request->file('files')) {
                        if($taskFiles = $task['files']) {
                            foreach ($files as $key => $file) {
                                foreach ($taskFiles as $key => $taskFile) {
                                    if($file->getClientOriginalName() == $taskFile['filename']){
                                        $extension = $file->getClientOriginalExtension();
                                        // echo $taskFile['filename'];
                                        $newName = time() . $taskFile['filename'];
                                        $file->move('storage/task/', $newName);
                                        $newTask->files()->create([
                                            'original_filename' => $taskFile['filename'],
                                            'new_filename' => $newName,
                                            'extension' => $extension
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        // if board is scrum
        else {
            $sprint = $board->sprints()->create([
                'name' => $joMain['name'],
                'type' => 2,
                'created_by' => auth()->user()->id,
                'started_at' => $joMain['date_in'],
                'due_date' => $joMain['date_due']
            ]);

            event(new AddSprintEvent($sprint->load(['us' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks' => function($q) {$q->orderBy('order', 'asc');}, 'us.tasks.assigned_to'])));

            $board->notify(new BoardCreateListSprint($sprint->load('created_by')->toJson(), 'sprint'));

            foreach ($joTasks as $key => $us) {
                $order = count($sprint->us()->get());
                $newus = UserStory::create([
                    'name' => $us['name'],
                    'description' => $us['desc'],
                    'created_by' => auth()->user()->id,
                    'points' => $us['points'],
                    'sprint_id' => $sprint->id,
                    'order' => $order+1
                ]);
                event(new NewUSEvent($newus, $board->id));
                $board->notify(new BoardAddUS(auth()->user()->name, $newus->name));

                foreach ($us['tasks'] as $key => $task) {
                    $torder = count($sprint->tasks()->get());
                    $newtask = Task::create([
                        'sprint_id' => $sprint->id,
                        'us_id' => $newus->id,
                        'name' => $task['name'],
                        'description' => $task['desc'],
                        'created_by' => auth()->user()->id,
                        'assigned_to' => $task['assign'],
                        'assigned_by' => auth()->user()->id,
                        'order' => $torder+1,
                        'status_order' => $torder+1,
                        'status' => 1,
                        'due' => $task['due'],
                        'jo_id' => $newjo->id
                    ]);

                    if ($files = $request->file('files')) {
                        if($taskFiles = $task['files']) {
                            foreach ($files as $key => $file) {
                                foreach ($taskFiles as $key => $taskFile) {
                                    if($file->getClientOriginalName() == $taskFile['filename']){
                                        $extension = $file->getClientOriginalExtension();
                                        // echo $taskFile['filename'];
                                        $newName = time() . $taskFile['filename'];
                                        $file->move('storage/task/', $newName);
                                        $newtask->files()->create([
                                            'original_filename' => $taskFile['filename'],
                                            'new_filename' => $newName,
                                            'extension' => $extension
                                        ]);
                                    }
                                }
                            }
                        }
                    }

                    event(new AddListTaskEvent($newtask->load('assigned_to'), $board->id));
                    $board->notify(new BoardCreateTask($newtask->load('created_by', 'us')->toJson()));
                }
            }
        }

        $target_list = '';
        foreach ($joDetails['target_list'] as $key => $e) {
            // if(last) {
                $target_list = $target_list . $e . '.';
            // }
            // else {
            //     $media = $media . $e;
            // }
        }
        $request_type = '';
        foreach ($joDetails['request_type'] as $key => $e) {
            // if(last) {
                $request_type = $request_type . $e . '.';
            // }
            // else {
            //     $media = $media . $e;
            // }
        }

        $newjoweb = $newjo->joweb()->create([
            'request_type' => $request_type,
            'target_list' => $target_list,
            'action_points' => $joDetails['action_points'],
            'tech' => $joDetails['tech'],
            'domain_transfer' => $joDetails['domain_transfer'],
            'domain_renewal' => $joDetails['domain_renewal'],
            'old_cpanel_uname' => $joDetails['old_cpanel_uname'],
            'old_cpanel_password' => $joDetails['old_cpanel_password'],
            'new_cpanel_uname' => $joDetails['new_cpanel_uname'],
            'new_cpanel_password' => $joDetails['new_cpanel_password'],
            'date_commerced' => $joDetails['date_commerced'],
            'date_ended' => $joDetails['date_ended'],
        ]);

        auth()->user()->notify(new JOCreativeCreated($newjo->toArray(), auth()->user()->name));

        return JobOrder::with('joweb', 'tasks.files')->where('id', $newjo->id)->first();
    }

    public function onLoad() {
        if(auth()->user()->role_id==1)
        {
            $brands = Brand::get();
        }
        else
        {
            $brands = Brand::where('acma_id',auth()->user()->id)->get();
        }
        return $brands;
    }

    public function getJoDetails(Request $request) {
        $jo = JobOrder::find($request->id);
        $type = $jo->type;
        $dateNow = Carbon::now()->toDateString();
        $users = User::with(['task_assigned_to' => function($q) use ($dateNow, $jo) {
            $q->orderBy('created_at', 'asc')->where('jo_id', $jo->id);
        }])->get();

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

        // return $tasks;

        if($type === 1) {
            $jobor = JobOrder::with(['brand.acma', 'board'])->with(['jocreatives.signedby', 'tasks.files', 'tasks.card', 'tasks.assigned_to'])->where('id', $request->id)->first();
            return response()->json(['jobor' => $jobor, 'workload' => $tasks]);
        }
        else if($type === 2) {
            $jobor = JobOrder::with(['brand.acma', 'board'])->with(['joweb.web_signed_by','joweb.acma_signed_by', 'tasks.card', 'tasks.files', 'tasks.assigned_to'])->where('id', $request->id)->first();
            return response()->json(['jobor' => $jobor, 'workload' => $tasks]);
        }
    }

    public function getJobOrders(Request $request) {
        $sort_key = explode(".",$request->sort)[0];
        $sort_type = explode(".",$request->sort)[1];
        if($request->notArchive=="true"){
            if($sort_key){
               if(auth()->user()->role_id==1) 
               {
                $query = JobOrder::with('brand:id,name')->with(['tasks.card'])->orderBy($sort_key, $sort_type);         
               }
               else
               {
                $query = JobOrder::with('brand:id,name')->with(['tasks.card'])->where('created_by',auth()->user()->id)->orderBy($sort_key, $sort_type);                         
               }
               }
        }
        else { 
           if($sort_key){
               if(auth()->user()->role_id==1)
               {
                 $query = JobOrder::onlyTrashed()->with('brand:id,name')->orderBy($sort_key, $sort_type);
                   
               }
               else{
                $query = JobOrder::onlyTrashed()->with('brand:id,name')->where('created_by',auth()->user()->id)->orderBy($sort_key, $sort_type);

               }
           }
         }


        if($request->search) {
            $query->where('name', 'like', $request->search.'%');
        }


        $jos = $query->get();
        return $jos;
    }

    public function deletejo(Request $request) {
        $jo = JobOrder::findOrFail($request->id);
        $jo->delete();
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }

    public function restorejo(Request $request) {
        
        $jo= JobOrder::onlyTrashed()->where('id' , $request->data['id'])->restore();
       
        return response()->json(['status' => 'success', 'message' => 'restores succesfully'], 200);
    }

    public function finishJOC(Request $request) {
        $jo = JobOrder::find($request->id);
        $user = User::where('email', $request->sign['email'])->first();
        if($user) {
            if(Hash::check($request->sign['password'], $user->password)) {
                $jo->jocreatives()->update([
                    'completed_at' => Carbon::now(),
                    'signed_by' => $user->id
                ]);
                $jo->update([
                    'status' => 2,
                ]);
                return response()->json(['status' => 'success', 'message' => 'Success'], 200);
            }
            else{
                return response()->json(['status' => 'error', 'message' => 'Unauthorize'], 401);
            }
        }
        else{
            return response()->json(['status' => 'error', 'message' => 'Unauthorize'], 401);
        }
    }

    public function finishJOW(Request $request) {
        $jo = JobOrder::find($request->id);
        if($request->proofed['check']) {
            $user = User::where('email', $request->proofed['email'])->where('department_id', 1)->first();
            if($user) {
                if(Hash::check($request->proofed['password'], $user->password)) {
                    $jo->joweb()->update([
                        'web_proofed_at' => Carbon::now(),
                        'web_proofed_by' => $user->id
                    ]);
                    // return response()->json(['status' => 'success', 'message' => 'Success', 'type' => 'web'], 200);
                }
                else{
                    return response()->json(['status' => 'error', 'message' => 'Unauthorize', 'type' => 'web'], 401);
                }
            }
            else{
                return response()->json(['status' => 'error', 'message' => 'Unauthorize', 'type' => 'web'], 401);
            }
        }

        if($request->approved['check']) {
            $user = User::where('email', $request->approved['email'])->whereIn('role_id', [1,2])->first();
            if($user) {
                if(Hash::check($request->approved['password'], $user->password)) {
                    $jo->joweb()->update([
                        'acma_proofed_at' => Carbon::now(),
                        'acma_proofed_by' => $user->id
                    ]);
                    // return response()->json(['status' => 'success', 'message' => 'Success', 'type' => 'acma'], 200);
                }
                else {
                    return response()->json(['status' => 'error', 'message' => 'Unauthorize', 'type' => 'acma'], 401);
                }
            }
            else {
                return response()->json(['status' => 'error', 'message' => 'Unauthorize', 'type' => 'acma'], 401);
            }
        }

        $joweb = $jo->joweb()->first();
        $acmaproofed = $joweb->acma_proofed_at;
        $webproofed = $joweb->web_proofed_at;
        if($webproofed != null && $acmaproofed != null) {
            $jo->update([
                'status' => 2
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Success', 'type' => 'acma'], 200); 
    }

    public function getJOBoardUsers(Request $request) {
        if($request->board_id) {
            $member =  Board::find($request->board_id)->boardUsers()->get();
            $not = User::whereNotIn('id', $member->pluck('id'))->where('brand_id', null)->get();
            return response()->json(['member' => $member, 'not' => $not]);
        }
        else {
            return User::where('brand_id', null)->get();
        }
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

        foreach ($request->ids as $key => $uid) {
            $user = User::find($uid);
            $board->notify(new AddBoardMember($user->name, auth()->user()->name));
            $user->notify(new BoardUserAdded($board->load('created_by')->toArray(), auth()->user()->name));
        }

        $member =  Board::find($request->board_id)->boardUsers()->get();
        $not = User::whereNotIn('id', $member->pluck('id'))->where('brand_id', null)->get();
        return response()->json(['member' => $member, 'not' => $not]);
    }
}
