<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand;
use App\Workbook;
use App\WorkbookFile;

class WorkbookController extends Controller
{
    public function uploadWorkbookFiles(Request $request) {
        $file = $request->file('file');

        $origname = $file->getClientOriginalName();
        $newname = time() . $origname;
        $file->move('storage/workbook/', $newname);

        return response([
            'new_filename' => $newname,
            'original_filename' => $origname,
        ], 200);
    }

    public function newWorkbook(Request $request) {
        $files = $request->get('files');
        $wName = $request->get('name');
        $wDesc = $request->get('desc');
        $wBID = $request->get('brand');

        $newWB = Workbook::create([
            'name' => $wName,
            'description' => $wDesc,
            'brand_id' => $wBID,
            'status' => 1,
            'created_by' => auth()->user()->id
        ]);

        foreach ($files as $key => $file) {
            $newWB->files()->create([
                'original_filename' => $file['response']['original_filename'],
                'new_filename' => $file['response']['new_filename'],
                'caption' => $file['caption'],
            ]);
        }

        return $newWB->load('files');
    }

    public function onCreate(Request $request) {
        $brands = Brand::all();

        return response()->json(['brands' => $brands]);
    }

    public function getAllWorkbooks(Request $request) {
        // $callback = function($q) {
        //     $q->where
        // };
        $workbooks = Workbook::all();
        return $workbooks->load('brand');
    }
}
