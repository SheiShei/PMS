<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand;
use App\JobOrder;
use App\Workbook;

class VerifierController extends Controller
{
    public function verifyBrands() {
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
            return response()->json(['status' => 'authenticated'], 200);
        }
        return response()->json(['status' => 'error'], 200);
    }

    public function verifyAddJO() {
        if(auth()->user()->role_id == 2) {
            return response()->json(['status' => 'authenticated'], 200);
        }
        return response()->json(['status' => 'error'], 200);
    }

    public function verifyBrandProfile(Request $request) {
        if(auth()->user()->role_id == 1) {
            $brand = Brand::find($request->brand);
            if($brand) {
                return response()->json(['status' => 'authenticated'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        else if(auth()->user()->role_id == 2){
            $brand = auth()->user()->acma()->where('id', $request->brand)->first();
            if($brand) {
                return response()->json(['status' => 'authenticated'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        return response()->json(['status' => 'error'], 200);
    }

    public function verifyAllJOList() {
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 4) {
            return response()->json(['status' => 'authenticated'], 200);
        }
        return response()->json(['status' => 'error'], 200);
    }

    public function verifyJOView(Request $request) {
        if(auth()->user()->role_id == 1) {
            $jo = JobOrder::find($request->jo);
            if($jo) {
                return response()->json(['status' => 'authenticated'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        else if(auth()->user()->role_id == 2) {
            $jo = JobOrder::find($request->jo);
            if($jo) {
                $brand = Brand::where('id', $jo->brand_id)->where('acma_id', auth()->user()->id)->first();
                if($brand) {
                    return response()->json(['status' => 'authenticated'], 200);
                }
                return response()->json(['status' => 'error'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        else if(auth()->user()->role_id == 4) {
            $jo = JobOrder::where('id', $request->jo)->where('brand_id', auth()->user()->brand_id)->first();
            if($jo) {
                return response()->json(['status' => 'authenticated'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        return response()->json(['status' => 'error'], 200);
    }

    public function verifyWorkbookList() {
        if(auth()->user()->role_id != 4) {
            return response()->json(['status' => 'authenticated'], 200);
        }
        return response()->json(['status' => 'error'], 200);
    }

    public function verifyCWorkbook(Request $request) {
        if(auth()->user()->role_id == 1) {
            $wb = Workbook::find($request->wb);
            if($wb) {
                return response()->json(['status' => 'authenticated'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        else if(auth()->user()->role_id == 2) {
            $wb = Workbook::find($request->wb);
            if($wb) {
                $brand = Brand::where('id', $wb->brand_id)->where('acma_id', auth()->user()->id)->first();
                if($brand) {
                    return response()->json(['status' => 'authenticated'], 200);
                }
                return response()->json(['status' => 'error'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        else if(auth()->user()->role_id == 4) {
            $wb = Workbook::where('id', $request->wb)->where('brand_id', auth()->user()->brand_id)->first();
            if($wb) {
                return response()->json(['status' => 'authenticated'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        return response()->json(['status' => 'error'], 200);
    }

    public function verifyReviewWorkbook(Request $request) {
        if(auth()->user()->role_id == 4) {
            $wb = Workbook::where('id', $request->wb)->where('brand_id', auth()->user()->brand_id)->first();
            if($wb) {
                return response()->json(['status' => 'authenticated'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        return response()->json(['status' => 'error'], 200);
    }

    public function verifyViewWorkbook(Request $request) {
        if(auth()->user()->role_id == 1) {
            $wb = Workbook::find($request->wb);
            if($wb) {
                return response()->json(['status' => 'authenticated'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        else if(auth()->user()->role_id == 2) {
            $wb = Workbook::find($request->wb);
            if($wb) {
                $brand = Brand::where('id', $wb->brand_id)->where('acma_id', auth()->user()->id)->first();
                if($brand) {
                    return response()->json(['status' => 'authenticated'], 200);
                }
                return response()->json(['status' => 'error'], 200);
            }
            return response()->json(['status' => 'error'], 200);
        }
        return response()->json(['status' => 'error'], 200);
    }
}
