<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DataController extends Controller
{
    public function index(Request $request)
    {
        // $columns = ['name', 'email', 'created_at'];

        // $length = $request->input('length');
        // $column = $request->input('column'); //Index
        // $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = User::select('id', 'created_at', 'name', 'email')->orderBy( 'created_at' , 'desc');

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }

        $users = $query->paginate(15);
        return ['data' => $users, 'draw' => $request->input('draw')];
    }
}
