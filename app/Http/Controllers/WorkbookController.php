<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand;
use App\Workbook;
use App\WorkbookFile;
use App\User;
use App\Notifications\ReviewedWorkbook;
use App\Notifications\SendforRevision;


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
        if($request->isArchive) {
            if(auth()->user()->role_id == 1) {
                $query = Workbook::onlyTrashed()->with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }]);
            }
            if(auth()->user()->role_id == 2) {
                $callback = function($q) {
                    $q->where('acma_id', auth()->user()->id);
                };
                $query = Workbook::onlyTrashed()->with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->whereHas('brand', $callback);
            }
            if(auth()->user()->role_id == 4) {
                $callback = function($q) {
                    $q->where('id', auth()->user()->brand_id);
                };
                $query = Workbook::onlyTrashed()->with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->whereHas('brand', $callback);
            }
        }
        else {
            if(auth()->user()->role_id == 1) {
                $query = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }]);
            }
            if(auth()->user()->role_id == 2) {
                $callback = function($q) {
                    $q->where('acma_id', auth()->user()->id);
                };
                $query = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->whereHas('brand', $callback);
            }
            if(auth()->user()->role_id == 4) {
                $callback = function($q) {
                    $q->where('id', auth()->user()->brand_id);
                };
                $query = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->whereHas('brand', $callback);
            }
        }

        if($request->search) {
            $query->where('name', 'like', $request->search.'%');
        }

        if($request->status == 'reviewed') {
            $query->where('reviewed_at', '!=', null);
        }

        if($request->status == 'for_reviewed') {
            $query->where('reviewed_at', null);
        }

        if($request->brand) {
            $query->where('brand_id', $request->brand);
        }

        $workbooks = $query->get();
        return $workbooks;
    }

    public function getCWorkbook(Request $request) {
        $workbook = Workbook::find($request->id);

        return $workbook->load(['files.revisions'=> function($q){$q->orderBy('created_at','desc'); }]);
    }

    public function reviewWB(Request $request) {
        $origWB = Workbook::with(['brand:id,name'])->find($request->id);

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

        $fileLength = 0;
        $rating = 0;

        foreach ($origWB->files as $key => $filer) {
            $fileLength++;
            $lrev = $filer->revisions()->orderBy('created_at', 'desc')->first();
            $rating = $rating + $lrev->rating;
        }

        $aveR = $rating / $fileLength;

        $origWB->update([
            'reviewed_at' => Carbon::now(),
            'overall_rating' => $aveR
        ]);

        $user= User::find($origWB->created_by);
        // $user->notify(new ReviewedWorkbook($origWB->toArray()));
        return Workbook::find($request->id)->load(['brand', 'created_by', 'files.revisions']);
    }

    public function UpdateWorkbook(Request $request) {
        $file = $request->file('files');

        $origname = $file->getClientOriginalName();
        $newname = time() . $origname;
        $file->move('storage/workbook/', $newname);

        $nfile = WorkbookFile::with('workbook.brand')->find($request->id);
        $rev=$nfile->revisions()->create([
            'original_filename' => $origname,
            'new_filename' => $newname,
            'caption' => $request->caption,
        ]);
      

        // return $rev;
        if(auth()->user()->role_id == 1) {
            $workbooks = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->get();
        }
        if(auth()->user()->role_id == 2) {
            $callback = function($q) {
                $q->where('acma_id', auth()->user()->id);
            };
            $workbooks = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->whereHas('brand', $callback)->get();
        }
        if(auth()->user()->role_id == 4) {
            $callback = function($q) {
                $q->where('id', auth()->user()->brand_id);
            };
            $workbooks = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->whereHas('brand', $callback)->get();
        }
        

        return $workbooks;
      
    }

    public function deleteWB(Request $request) {
        $wb = Workbook::find($request->id);
        $wb->delete();
    }
    
    public function restoreWB(Request $request) {
        $wb = Workbook::onlyTrashed()->where('id' , $request->id)->restore();

        if($request->data['isArchive']) {
            if(auth()->user()->role_id == 1) {
                $query = Workbook::onlyTrashed()->with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }]);
            }
            if(auth()->user()->role_id == 2) {
                $callback = function($q) {
                    $q->where('acma_id', auth()->user()->id);
                };
                $query = Workbook::onlyTrashed()->with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->whereHas('brand', $callback);
            }
            if(auth()->user()->role_id == 4) {
                $callback = function($q) {
                    $q->where('id', auth()->user()->brand_id);
                };
                $query = Workbook::onlyTrashed()->with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->whereHas('brand', $callback);
            }
        }
        else {
            if(auth()->user()->role_id == 1) {
                $query = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }]);
            }
            if(auth()->user()->role_id == 2) {
                $callback = function($q) {
                    $q->where('acma_id', auth()->user()->id);
                };
                $query = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->whereHas('brand', $callback);
            }
            if(auth()->user()->role_id == 4) {
                $callback = function($q) {
                    $q->where('id', auth()->user()->brand_id);
                };
                $query = Workbook::with(['brand', 'created_by', 'files.revisions'=> function($q1){$q1->orderBy('created_at','desc'); }])->whereHas('brand', $callback);
            }
        }

        if($request->data['search']) {
            $query->where('name', 'like', $request->data['search'].'%');
        }

        if($request->data['status'] == 'reviewed') {
            $query->where('reviewed_at', '!=', null);
        }

        if($request->data['status'] == 'for_reviewed') {
            $query->where('reviewed_at', null);
        }

        if($request->data['brand']) {
            $query->where('brand_id', $request->data['brand']);
        }

        $workbooks = $query->get();
        return $workbooks;
    }
  
}
