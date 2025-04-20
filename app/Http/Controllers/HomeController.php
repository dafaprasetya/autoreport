<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->jabatan == 'Staff') {
            if (Auth::user()->bagian == 'Service') {
                return redirect()->route('dashboardService');
            }
            else if (Auth::user()->bagian == 'IT'){
                return redirect()->route('itadmin');
            }
        }
        return view('home');
    }
}
