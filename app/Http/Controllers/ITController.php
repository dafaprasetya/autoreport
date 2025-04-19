<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ITController extends Controller
{
    public function __construct()
    {
        // echo 'hai';
    }
    public function index(Request $request){
        $this->middleware('jabatan:IT');
        $data = [
            'title' => 'Admin Dashboard',
        ];
        return view('admin.IT.index', $data);
    }
}
