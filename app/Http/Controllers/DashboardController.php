<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Brand;
use App\JobOrder;
use App\Board;
use App\BoardUser;
use App\Task;
use App\Workbook;
use App\Message;
use App\JoCreative;
use App\WorkbookFile;
use Illuminate\Notifications\Notification;
use Hash;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function date()
    {
       
        $date =  Carbon::now()->format('l, F j, Y');        
        return $date;
    }

    public function dashboard_admin()
    {
        $users= User::with(['role:id,name', 'notifications'])->get();
        $no_users= $users->count();
        $wb= Workbook::count();

        $no_jo= JobOrder::count();

        $dash_admin= ([
            'users' => $no_users,
            'jos' => $no_jo,
            'wb' => $wb

        ]);        
        return $dash_admin;
    }
     public function dashboard_acma()
    {
        // $query = Tandem::where('acma_id', auth()->user()->id);
        // $tandem = $query->first();
        $no_brands = Brand::where('acma_id', auth()->user()->id)->count();

        $query2 = JobOrder::where('created_by', auth()->user()->id)->with('brand:id,name');
        $no_jo = $query2->count();
        $no_activejo = $query2->where('status', 1)->count();

        $wb = Workbook::where('created_by', auth()->user()->id)->count();
        

        $dash_acma= ([
            'handled_brands' => $no_brands,
            'jo_created' => $no_jo,
            'active_jo' => $no_activejo,
            'workbookss' => $wb,
        ]);        
        return $dash_acma;
    }
    public function display_joborders(Request $request)
    {
        // $sort_key = explode(".",$request->sort)[0];
        // $sort_type = explode(".",$request->sort)[1];
        if($request->notArchive=="true"){
        
               if(auth()->user()->role_id==2) 
               {
                $query = JobOrder::with('brand:id,name')->with(['tasks.card'])->where('created_by',auth()->user()->id);                         
                    
               }
               if(auth()->user()->role_id==4)
               {
                    
                    $query= JobOrder::where('brand_id', auth()->user()->id);
                
                }
               
            }        


        if($request->search) {
            $query->where('name', 'like', $request->search.'%');
        }


        $jos = $query->get();

        if($request->notArchive=="true"){
            foreach ($jos as $key => $jo) {
                if($jo->date_due) {
                    $nTD = 0;

                    foreach ($jo->tasks as $key => $task) {
                        if($task->card_id) {
                            if($task->card->isDone) {
                                $nTD++;
                            }
                        }
                        else {
                            if($task->status == 4) {
                                $nTD++;
                            }
                        }
                    }

                    // echo $nTD;
                    
                    if($nTD == $jo->tasks()->count()) { #Check if all JO tasks is complete;
                        if($jo->type == 1) { #if Job Order type is Creative
                            if($jo->jocreatives()->first()->signed_by) {
                                $jo->update([
                                    'status' => 4 #if signed in, set JO status to 4; 4=Complete
                                ]);
                            }
                            else {
                                // echo '3';
                                $jo->update([
                                    'status' => 3 #if not, set JO status to 3; 3=task Completed (No signoff)
                                ]);
                            }
                        }
                        else { #if Job Order type is Web
                            if($jo->joweb()->first()->web_proofed_at && $jo->joweb()->first()->acma_proofed_at) {
                                $jo->update([
                                    'status' => 4
                                ]);
                            }
                            else {
                                // echo '3';
                                $jo->update([
                                    'status' => 3
                                ]);
                            }
                        }
                    }
                    else { #if all JO tasks is not yet Done; hence JO status is = 1; 1=Active
                        $due = new Carbon($jo->date_due);
                        $dueDate = $due->toDatestring();
            
                        $today = new Carbon();
                        $todayDate = $today->toDateString();
                        
                        if($dueDate < $todayDate) { #check if Job Order is already Overdue
                            $jo->update([
                                'status' => 2 #set JO status to 2; 2=Overdue
                            ]);
                        }

                        else {
                            $jo->update([
                                'status' => 1
                            ]);
                        }
                    }
                }
            }  
        }
        if($request->status){
            $jos= $jos->where('status',$request->status);
            
           }
 
        return $jos;
    }
    public function dashboard_emp()
    {
        $task= Task::whereHas('card', function($q){
            $q->where('isDone', true);})->where('assigned_to', auth()->user()->id);
        $tasks= $task->count();

        $tasks2= Task::where('assigned_to', auth()->user()->id)->where('status','!=', 4)->count();

        $activetasks= $tasks + $tasks2;

        $tasks=Task::where('assigned_to', auth()->user()->id)->count();

        $boards = BoardUser::where('user_id', auth()->user()->id)->count();

        
        $emp_dash = [];
        $emp_dash=([
            'activetasks' => $activetasks,
            'totaltasks' => $tasks,
            'totalboards' => $boards, 

        ]);
      
        return $emp_dash;   
    }

    public function reminder_tasks()
    {
        $query= Task::with(['card.board','sprint.board'])->where('assigned_to', auth()->user()->id)->whereDate('due', '>=', Carbon::today()->toDateString());
        $taskreminder= $query->orderBy('due', 'asc')->get();
        return $taskreminder;
        // return $query;

    }
    public function overdued_tasks()
    {
        $query= Task::with(['card.board','sprint.board'])->where('assigned_to', auth()->user()->id)->whereDate('due', '<', Carbon::today()->toDateString());
        $taskreminder= $query->orderBy('due', 'asc')->get();
        return $taskreminder;
        //return $taskr;
    }
    
    public function display_messages()
    {
        $query = Message::with('sender')->where('receiver_id', auth()->user()->id)->where('action', 1)->orderBy('created_at','desc');
        $messages = $query->get();
        return $messages;
    }

    public function display_notifs()
    {
        
        $notification = User::with(['role:id,name', 'notifications'])->where('id',auth()->user()->id)->first();
        $notifs = [];
        foreach ($notification->notifications()->orderBy('created_at','asc')->get() as $key => $notif) {
             array_push($notifs, $notif);
        }

        return $notifs;
    }

    public function dashboard_client()
    {   $user = User::where('id', auth()->user()->id)->first();
        $jocount = JobOrder::where('brand_id', $user['brand_id'])->count();
        $date =  Carbon::today()->toDateString();
        $callback = function($q) {
            $q->where('id', auth()->user()->brand_id);
        };
        $urworkbooks = Workbook::with(['brand.acma', 'created_by'])->whereHas('brand', $callback)->where('reviewed_at',null)->orderBy('created_at','asc')->count();
        $rworkbooks = Workbook::with(['brand.acma', 'created_by'])->whereHas('brand', $callback)->where('reviewed_at','!=',null)->orderBy('reviewed_at','asc')->count();
        $total = Workbook::with(['brand.acma', 'created_by'])->whereHas('brand', $callback)->count();
        $client_dash = [];
        $client_dash=([
            'jocount' => $jocount,
            'today' => $date,
            'reviewed' => $rworkbooks, 
            'unreviewed' => $urworkbooks,
             'total' => $total
        ]);
        return $client_dash;
    }

    public function display_urworkbooks()
    {  
        // if(auth()->user()->role_id == 1) {
        //     $workbooks = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }]);
        // }
        if(auth()->user()->role_id == 2) {
            $callback = function($q) {
                $q->where('acma_id', auth()->user()->id);
            };
            $urworkbooks = Workbook::with(['brand.acma', 'created_by'])->whereHas('brand', $callback)->where('reviewed_at',null)->orderBy('created_at','asc');
        }
        if(auth()->user()->role_id == 4) {
            $callback = function($q) {
                $q->where('id', auth()->user()->brand_id);
            };
            $urworkbooks = Workbook::with(['brand.acma', 'created_by'])->whereHas('brand', $callback)->where('reviewed_at',null)->orderBy('created_at','asc');
            // $urworkbooks = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->whereHas('brand', $callback);
        }
        return $urworkbooks->get();

     }

     public function display_rworkbooks()
     {  
         // if(auth()->user()->role_id == 1) {
         //     $workbooks = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }]);
         // }
         if(auth()->user()->role_id == 2) {
             $callback = function($q) {
                 $q->where('acma_id', auth()->user()->id);
             };
             $urworkbooks = Workbook::with(['brand.acma', 'created_by'])->whereHas('brand', $callback)->where('reviewed_at','!=',null)->orderBy('reviewed_at','asc');
         }
         if(auth()->user()->role_id == 4) {
             $callback = function($q) {
                 $q->where('id', auth()->user()->brand_id);
             };
             $urworkbooks = Workbook::with(['brand.acma', 'created_by'])->whereHas('brand', $callback)->where('reviewed_at','!=',null)->orderBy('reviewed_at','asc');
         }
         return $urworkbooks->get();
 
      }
    
    
   



}