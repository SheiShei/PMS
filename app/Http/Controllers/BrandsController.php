<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand; //mga model na kailangan sa controller na to like include in CI
use App\Tandem;
use Hash;
use File;

class BrandsController extends Controller
{


    public function getBrands(Request $request) {
        if($request->notArchive){
            if($request->filtercategory){
                $query = Brand::with('tandem:id,name')->orderBy($request->filtercategory, $request->filterposition);
            }
        }
        else { 
            if($request->filtercategory){
            $query = Brand::onlyTrashed()->with('tandem:id,name')->orderBy($request->filtercategory, $request->filterposition);
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
           'telephone' => 'required|string|max:15',
           'mobile' => 'required',
           'tandem_id' => 'required',
           //'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        
        $input = $request->all();
    
        if($file = $request->file('logo')){
            $name = time() . $file->getClientOriginalName();
            $file->move('./images/logo', $name);
            $input['logo'] = $name;
        }
        if(!$request->hasFile('logo')){
            $input['logo'] = 'logooo2.png';
        }

        $brand = Brand::create($input);

        return Brand::with('tandem:id,name')->where('id', $brand->id)->get();

    }

    public function deleteBrands(Request $request) {
       
        $brand = Brand::findOrFail($request->id);
        $brand->delete();
        return response()->json(['status' => 'success', 'message' => 'deleted succesfully'], 200);
    }

    public function restoreBrands(Request $request) {
        
        $brand= Brand::onlyTrashed()->where('id' , $request->data['id'])->restore();
        return response()->json(['status' => 'success', 'message' => 'restores succesfully'], 200);
    }

    public function getTandemsList() {
        $tandems = Tandem::all();
        return $tandems;
    }

    public function getOnebrand(Request $request) {
        $query= Brand::with('tandem:id,name')->where('id', $request->id);
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
        // ]);
        
        //$brand = Brand::findOrFail($request->file('id'));
        $brand = Brand::findOrFail($request->id);
        $input = $request->all();
       
        if($file = $request->file('logo')){
            $name = time() . $file->getClientOriginalName();
            $file->move('./images/logo', $name);
            $input['logo'] = $name;
        }
        

       // dd($request);
        $brand->update($input);

        return Brand::with('tandem:id,name')->where('id', $brand->id)->get();
    }

    public function testFileUpload(Request $request) {
        dd($request);
        return $request;
    }

}
