<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Brand;
use App\JobOrder;
use App\Board;
use App\Task;
use App\JoCreative;
use Hash;
use Carbon\Carbon;

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
            'bg_image'=> '1549014873pug.jpg'
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
        // if(!$request->password) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
                'department_id' => $request->team
            ]);
            if($user->role_id==4)
            {
                $brand = Brand::where('id', $user->brand_id)->first();
                $brand->update([
                    'name' => $request->name,
                ]);
            }
        // }

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
        // return response()->json($joTasks);

        $newjo = JobOrder::create([
            'name' => $joMain['name'],
            'brand_id' => $joMain['brand_id'],
            'date_in' => $joMain['date_in'],
            'date_due' => $joMain['date_due'],
            'status' => $joMain['status'],
            'created_by' => auth()->user()->id,
            'type' => 1
        ]);

        foreach ($joTasks as $key => $task) {
            if($task['name']) {
                $newTask = $newjo->tasks()->create([
                    'card_id' => 1,
                    'name' => $task['name'],
                    'description' => $task['desc'],
                    'created_by' => auth()->user()->id,
                    'assigned_to' => auth()->user()->id,
                    'assigned_by' => auth()->user()->id
                ]);
                
                if ($files = $request->file('files')) {
                    if($taskFiles = $task['files']) {
                        foreach ($files as $key => $file) {
                            foreach ($taskFiles as $key => $taskFile) {
                                if($file->getClientOriginalName() == $taskFile['filename']){
                                    // echo $taskFile['filename'];
                                    $newName = time() . $taskFile['filename'];
                                    $file->move('storage/task/', $newName);
                                    $newTask->files()->create([
                                        'original_filename' => $taskFile['filename'],
                                        'new_filename' => $newName,
                                        'extension' => $taskFile['type']
                                    ]);
                                }
                            }
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
        
        
        
        return JobOrder::with('jocreatives', 'tasks.files')->where('id', $newjo->id)->first();
    }
    
    public function createJOWeb(Request $request) {
        $joMain = json_decode($request->brand, true);
        $joDetails = json_decode($request->details, true);
        $joTasks = json_decode($request->tasks, true);
        // return $request;
        $newjo = JobOrder::create([
            'name' => $joMain['name'],
            'brand_id' => $joMain['brand_id'],
            'date_in' => $joMain['date_in'],
            'date_due' => $joMain['date_due'],
            'status' => $joMain['status'],
            'created_by' => auth()->user()->id,
            'type' => 2
        ]);

        foreach ($joTasks as $key => $task) {
            if($task['name']) {
                $newTask = $newjo->tasks()->create([
                    'card_id' => 1,
                    'name' => $task['name'],
                    'description' => $task['desc'],
                    'created_by' => auth()->user()->id,
                    'assigned_to' => auth()->user()->id,
                    'assigned_by' => auth()->user()->id
                ]);
                
                if ($files = $request->file('files')) {
                    if($taskFiles = $task['files']) {
                        foreach ($files as $key => $file) {
                            foreach ($taskFiles as $key => $taskFile) {
                                if($file->getClientOriginalName() == $taskFile['filename']){
                                    // echo $taskFile['filename'];
                                    $newName = time() . $taskFile['filename'];
                                    $file->move('storage/task/', $newName);
                                    $newTask->files()->create([
                                        'original_filename' => $taskFile['filename'],
                                        'new_filename' => $newName,
                                        'extension' => $taskFile['type']
                                    ]);
                                }
                            }
                        }
                    }
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
        $type = JobOrder::where('id',$request->id)->select('type')->first()['type'];
        if($type === 1) {
            return JobOrder::with('brand.acma')->with('jocreatives.signedby', 'tasks.files')->where('id', $request->id)->first();
        }
        else if($type === 2) {
            return JobOrder::with('brand.acma')->with('joweb.web_signed_by','joweb.acma_signed_by', 'tasks.files')->where('id', $request->id)->first();
        }
    }

    public function updateJOCreative(Request $request) {
        $jo = JobOrder::find($request->id);
        $joMain = $request->brand;
        $joDetails = $request->details;
        $jo->update([
            'name' => $joMain['name'],
            'brand_id' => $joMain['brand_id'],
            'date_in' => $joMain['date_in'],
            'date_due' => $joMain['date_due'],
            'status' => $joMain['status'],
        ]);

        $media = null;
        $file_type = null;
        $ad_type = null;

        if($joDetails['media']) {
            $media = '';
            foreach ($joDetails['media'] as $key => $e) {
                $media = $media . $e . '.';
            }
        }

        if($joDetails['ad_type']) {
            $ad_type = '';
            foreach ($joDetails['ad_type'] as $key => $e) {
                $ad_type = $ad_type . $e . '.';
            }
        }
        
        if($joDetails['file_type']) {
            $file_type = '';
            foreach ($joDetails['file_type'] as $key => $e) {
                $file_type = $file_type . $e . '.';
            }
        }

        $jo->jocreatives()->update([
            'media' => $media,
            'ad_type' => $ad_type,
            'file_type' => $file_type,
            'copy' => $joDetails['copy'],
            'copy' => $joDetails['post_caption'],
            'revisions' => $joDetails['revisions'],
        ]);
        return JobOrder::with('brand')->with('jocreatives.signedby', 'tasks.files')->where('id', $request->id)->first();
    }

    public function updateJOWeb(Request $request) {
        $jo = JobOrder::find($request->id);
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
        $joMain = $request->brand;
        $joDetails = $request->details;
        $jo->update([
            'name' => $joMain['name'],
            'brand_id' => $joMain['brand_id'],
            'date_in' => $joMain['date_in'],
            'date_due' => $joMain['date_due'],
            'status' => $joMain['status'],
        ]);

        $target_list = null;
        $request_type = null;

        if($joDetails['target_list']) {
            $target_list = '';
            foreach ($joDetails['target_list'] as $key => $e) {
                $target_list = $target_list . $e . '.';
            }
        }

        if($joDetails['request_type']) {
            $request_type = '';
            foreach ($joDetails['request_type'] as $key => $e) {
                $request_type = $request_type . $e . '.';
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

        $jo->joweb()->update([
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
        
        return JobOrder::with('brand')->with('joweb.web_signed_by','joweb.acma_signed_by', 'tasks.files')->where('id', $request->id)->first();
    }

    public function getJobOrders(Request $request) {
        $sort_key = explode(".",$request->sort)[0];
        $sort_type = explode(".",$request->sort)[1];
        if($request->notArchive=="true"){
            if($sort_key){
               if(auth()->user()->role_id==1) 
               {
                $query = JobOrder::with('brand:id,name')->orderBy($sort_key, $sort_type);         
               }
               else
               {
                $query = JobOrder::with('brand:id,name')->where('created_by',auth()->user()->id)->orderBy($sort_key, $sort_type);                         
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
}
