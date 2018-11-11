<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class AdminController extends Controller
{
    public function getUsersList(Request $request) {
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
            'department_id' => $request->team
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
        // }

        return User::with('role:id,name')->with('department:id,name')->where('id', $user->id)->get();
    }

    public function deleteUser(Request $request) {
        // return $request;
        $user = User::findOrFail($request->id);
        $user->delete();
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }

    public function restoreUser(Request $request) {
        // return $request->data['id'];
        $user = User::onlyTrashed()->where('id' , $request->data['id'])->restore();
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }
}
