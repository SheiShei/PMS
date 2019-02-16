<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Brand;
use App\JobOrder;
use App\Board;
use App\BoardUser;
use App\Task;
// use App\Tandem;
use App\Message;
use App\JoCreative;
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

        $no_jo= JobOrder::count();

        $dash_admin= ([
            'users' => $no_users,
            'jos' => $no_jo,
            'notif' => $users

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
        

        // $notif = Board::with(['notifications'])->where('created_by',auth()->user()->id)->first();

        // foreach($notif in $messcount.notifications)
        // foreach ($notif['notifications'] as $key => $notifs) {
        //     foreach ($notifs['data'] as $key => $notif1) {
               
        //             $messcount[] = $notif1;
              
        //         // $messcount = $notif1['data'];
        //     }
           
        // }

        $dash_acma= ([
            'handled_brands' => $no_brands,
            'jo_created' => $no_jo,
            'active_jo' => $no_activejo,
            // 'messco' => $messcount['data']

        ]);        
        return $dash_acma;
    }
    public function display_joborders()
    {
        $user = User::where('id', auth()->user()->id)->first();

        if($user['role_id']==2)
        {
            $display_jo = JobOrder::where('created_by', auth()->user()->id)->with('brand:id,name')->get();
        }
        if($user['role_id']==4)
        {
            $display_jo = JobOrder::where('brand_id', $user['brand_id'])->get();
        }

        return $display_jo;

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

        // $query= Task::with('card:id,board_id')->where('assigned_to', auth()->user()->id)->whereDate('due', '<', Carbon::today()->toDateString());
        // $duetaskcount = $query->count();

        // $messcount = Message::with('sender')->where('receiver_id', auth()->user()->id)->where('action', 1)->count();

        // $messcount = Board::with(['notifications'])->where('created_by',auth()->user()->id)->first();

        $emp_dash = [];
        $emp_dash=([
            'activetasks' => $activetasks,
            'totaltasks' => $tasks,
            'totalboards' => $boards, 
            // 'duetaskcount' => $duetaskcount,
            // 'messcount' => $messcount
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
        $client_dash = [];
        $client_dash=([
            'jocount' => $jocount,
            'today' => $date,
            // 'totalboards' => $boards, 
            // 'duetaskcount' => $duetaskcount,
            // 'messcount' => $messcount
        ]);
        return $client_dash;
    }
    



}