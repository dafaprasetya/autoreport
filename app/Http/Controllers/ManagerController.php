<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(Request $request) {
        $tanggal = $request->input('tanggal');
        $waktu = $request->input('waktu');
        $data = [
            'title' => 'Admin | Manager',
            'tanggal' => $tanggal,
            'waktu' => $waktu ? $waktu : 'whereMonth',
        ];
        return view('admin.manager.index', $data);
    }
}
