<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand; //mga model na kailangan sa controller na to like include in CI
// use App\Tandem;
use App\JobOrder;
use App\User;
use Hash;
use File;
use App\Notifications\AssignedBrand;


class BrandsController extends Controller
{


    public function getBrands(Request $request) {
        if($request->notArchive){
            if($request->filtercategory){
                if(auth()->user()->role_id==1)
                {
                $query = Brand::with('acma:id,name')->orderBy($request->filtercategory, $request->filterposition);
                }
                else
                {
                $query = Brand::with('acma:id,name')->where('acma_id',auth()->user()->id)->orderBy($request->filtercategory, $request->filterposition);
                }
            }
        }
        else { 
            if($request->filtercategory){
                if(auth()->user()->role_id==1)
                {
                  $query = Brand::onlyTrashed()->with('acma:id,name')->orderBy($request->filtercategory, $request->filterposition);
                }
                else
                {
                $query = Brand::onlyTrashed()->with('acma:id,name')->where('acma_id',auth()->user()->id)->orderBy($request->filtercategory, $request->filterposition);

                }
            }
         }
        
        if($request->search) {
            $query->where('name', 'like', $request->search . '%');
        }

        $brand = $query->paginate(10);
        return $brand;

         }

    public function addBrands(Request $request) {
        
        $request->validate([
            'name' => 'required|string|max:255',
           'contact_person' => 'required|string|max:255',
           'acma_id' => 'required',

        ]);

        $input = $request->all();
        $name = null;
    
        if($file = $request->file('logo')){
            $name = time() . $file->getClientOriginalName();
            $file->move('storage/logo/', $name);
            // $file->copy('/images/logo/'.$name, '/images');
            copy('storage/logo/'.$name, 'storage/'.$name);
            $input['logo'] = $name;
        }
        if(!$request->hasFile('logo')){
            $input['logo'] = 'logooo2.png';
        }

        $brand = Brand::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'mobile' => $request->mobile,
            'acma_id' => $request->acma_id,
            'about' => $request->about,
            'logo' => $input['logo'],
            'contact_person' => $request->contact_person
        ]);

        $user = User::create([
            'brand_id' => $brand->id,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'role_id'=>4,
            'picture'=>$input['logo'],
            'bg_image'=>'1549014873pug.jpg' //pwede kasing di magupload ng picture so may defaul dun sa if, hindi pwedeng $name lang
        ]);

        $acma = User::find($request->acma_id);

        $acma->notify(new AssignedBrand(auth()->user()->name, $brand->toArray()));
        return Brand::with('acma:id,name')->where('id', $brand->id)->get();

    }

    public function deleteBrands(Request $request) {
       
        $brand = Brand::findOrFail($request->id);
        $brand->delete();
        $user = User::where('brand_id', $request->id)->first();
        $user->delete();
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }

    public function restoreBrands(Request $request) {
        
        $brand= Brand::onlyTrashed()->where('id' , $request->data['id'])->restore();
        $user= User::onlyTrashed()->where('brand_id' , $request->data['id'])->restore();
        return response()->json(['status' => 'success', 'message' => 'restores succesfully'], 200);
    }

    public function getTandemsList() {
        $tandems = User::where('role_id',2)->get();
        return $tandems;
    }

    public function getBrandJos(Request $request) {
        $sort_key = explode(".",$request->sort)[0];
        $sort_type = explode(".",$request->sort)[1];
        $query = JobOrder::where('brand_id', $request->id)->with('brand:id,name')->orderBy($sort_key, $sort_type);

        if($request->search) {
            $query->where('name', 'like', $request->search.'%');
        }

        $jo = $query->get();
        return $jo;
    }
    
    public function getOnebrand(Request $request) {
        $query= Brand::with('acma:id,name')->where('id', $request->id);
       // $brand = Brand::with('tandem:id,name')->where('id', $request->id);
        $brand = $query->first();
        return $brand;

    }

    public function updateBrand(Request $request) {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'contact_person' => 'required|string|max:255',
        //     'telephone' => 'required|string|max:15',
        //     'mobile' => 'required',
        //     'tandem_id' => 'required',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6',
        // ]);
        
        //$brand = Brand::findOrFail($request->file('id'));
        $brand = Brand::findOrFail($request->id);
        $user = User::where('brand_id', $request->id)->first();
        $input = $request->all();
        
        if($file = $request->file('logo')){
            $name = time() . $file->getClientOriginalName();
            $file->move('storage/', $name);
            $input['logo'] = $name;
        }
        else{
            $name1= $input['logo'];
            $input['logo'] = str_replace('/storage/','',$name1);
            echo($input['logo']);
         }
        
        $brand->update($input);
        $user->update([
            'name' => $input['name'],
            'picture' => $input['logo']
        ]);


        return Brand::with('acma:id,name')->where('id', $brand->id)->get();
    }

    public function testFileUpload(Request $request) {
        dd($request);
        return $request;
    }



}
