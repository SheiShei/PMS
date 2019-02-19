<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;


class SettingsController extends Controller
{
 public function getuser_info()
    {
        $query = User::with('role:id,name')->with('department:id,name')->where('id', auth()->user()->id);
        $userinfo= $query->first();
        return $userinfo;
    }

public function updatemyself(Request $request) {

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
        //     'password' => 'string|min:6|nullable',
        // ]);
        //dd($request);
        $userinfo = User::findOrFail($request->id);
        $input=$request->all();
        

        if($file = $request->file('bg_image')){
            $name = time() . $file->getClientOriginalName();
            $file->move('storage/', $name);
            $input['bg_image'] = $name;
        }
        else{
           $name= $input['bg_image'];
           $input['bg_image'] = str_replace('/storage/', '', $name);
        //    echo($input['bg_image']);
        }
        // if($files = $request->file('picture')){
        //     $name = time() . $files->getClientOriginalName();
        //     $files->make($input['picture'])->resize(300, 300)->save(public_path('storage/' . $name));
        //     // $files->move('storage/', $name);
        //     $input['picture'] = $name;
        //     echo($request->file('picture'));
        // }
        // else{
        //    $name= $input['picture'];
        //    $input['picture'] = str_replace('/storage/', '', $name);
        // //    echo($input['bg_image']);
        // }

        if($input['password'])
        {
            $userinfo->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => bcrypt($input['password']),
                'bg_image' => $input['bg_image'],
                // 'picture' => $input['picture'],

            ]);
        }
        else{
            $userinfo->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'bg_image' => $input['bg_image'],
                // 'picture' => $input['picture']

            ]);
        }
        //   $userinfo->update($input);
            

       return User::with('role:id,name')->with('department:id,name')->where('id', $request->id)->first();

    }


}