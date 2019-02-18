<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand;
use App\Workbook;
use App\WorkbookFile;

use Carbon\Carbon;

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
            $newFile = $newWB->files()->create([
                'isApproved' => false
            ]);

            $newFile->revisions()->create([
                'original_filename' => $file['response']['original_filename'],
                'new_filename' => $file['response']['new_filename'],
                'caption' => $file['caption'],
            ]);
        }

        return $newWB->load(['brand', 'created_by', 'files.revisions']);
    }

    public function onCreate(Request $request) {
        $brands = Brand::where('acma_id', auth()->user()->id)->get();

        return response()->json(['brands' => $brands]);
    }

    public function getAllWorkbooks(Request $request) {
        if(auth()->user()->role_id == 1) {
            $workbooks = Workbook::with(['brand', 'created_by', 'files.revisions'])->get();
        }
        if(auth()->user()->role_id == 2) {
            $callback = function($q) {
                $q->where('acma_id', auth()->user()->id);
            };
            $workbooks = Workbook::with(['brand', 'created_by', 'files.revisions'])->whereHas('brand', $callback)->get();
        }
        if(auth()->user()->role_id == 4) {
            $callback = function($q) {
                $q->where('id', auth()->user()->brand_id);
            };
            $workbooks = Workbook::with(['brand', 'created_by', 'files.revisions'])->whereHas('brand', $callback)->get();
        }
        return $workbooks;
    }

    public function getCWorkbook(Request $request) {
        $workbook = Workbook::find($request->id);

        return $workbook->load('files.revisions');
    }

    public function reviewWB(Request $request) {
        $origWB = Workbook::find($request->id);

        $origWB->update([
            'reviewed_at' => Carbon::now()
        ]);

        foreach ($request->get('files') as $key => $rfiles) { 
            foreach ($origWB->files as $key => $ofiles) {
                if($ofiles->id == $rfiles['id']) {
                    $upFile = $ofiles->revisions()->orderBy('created_at', 'desc')->first();
                    $upFile->update([
                        'comment' => $rfiles['revisions'][0]['comment'],
                        'rating' => $rfiles['revisions'][0]['rating']
                    ]);
                }
            }
        }

        return Workbook::find($request->id)->load(['brand', 'created_by', 'files.revisions']);
    }

    public function UpdateWorkbook(Request $request) {
        $file = $request->file('files');

        $origname = $file->getClientOriginalName();
        $newname = time() . $origname;
        $file->move('storage/workbook/', $newname);

        $workbook = Workbook::with('files');
        $file1= $workbook->files()->where('id',$request->id);
        $rev=$file1->revisions()->create([
            'original_filename' => $origname,
            'new_filename' => $newname,
            'caption' => $request->desc,
        ]);
        // $files = $request->get('files');
        // $wName = $request->get('name');
        // $wDesc = $request->get('desc');
        // $wBID = $request->get('brand');

       

      
        }


    
  
}
