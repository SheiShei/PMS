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

        $userinfo = User::findOrFail(auth()->user()->id);
        $input=$request->all();
        
        if($request->picture){
            $filename_path = md5(time().uniqid()).".png"; 
            $data1 = explode( ',', $request->picture);
            $file1 = base64_decode( $data1[ 1 ] );
            file_put_contents("storage/".$filename_path, $file1);
           }
        else{
            $name= $request->pic;
            $filename_path = str_replace('/storage/', '', $name);
           
        }

        if($file = $request->file('bg_image')){
            $name = time() . $file->getClientOriginalName();
            $file->move('storage/', $name);
            $input['bg_image'] = $name;
        }
        else{
           $name= $input['bg_image'];
           $input['bg_image'] = str_replace('/storage/', '', $name);
        }

        if($input['password'])
        {
            $userinfo->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => bcrypt($input['password']),
                'bg_image' => $input['bg_image'],
                'picture' => $filename_path,

            ]);
        }
        else{
            $userinfo->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'bg_image' => $input['bg_image'],
                'picture' => $filename_path,
            ]);
        }
        //   $userinfo->update($input);
            

       return User::with('role:id,name')->with('department:id,name')->where('id', $request->id)->first();

    }


}