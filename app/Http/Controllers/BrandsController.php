<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand; //mga model na kailangan sa controller na to like include in CI
use App\Tandem;
use App\JobOrder;
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

        if($request->id) {
            $query= Brand::with('tandem:id,name')->where('id', $request->id);
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
        
        $fileName = null;
        if (request()->hasFile($request->logo)) {
           $file = request()->file($request->logo);
           $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
           $file->move('./images/', $fileName);    
           }

        $brand = Brand::create([
            'name' => $request->name,
            'contact_person' => $request->contact_person,
            'telephone' => $request->telephone,
            'mobile' => $request->mobile,
            'tandem_id' => $request->tandem_id,
            'logo' => $fileName,
            'about' => $request->about
           
        ]);

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

}
