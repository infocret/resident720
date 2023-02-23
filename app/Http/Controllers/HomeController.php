<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $condomid = env('CONDOMID', '0');
        // return view('home');
        //return view ('dashboard.dashboard');       
        return redirect(route('condominios.list',[$condomid]));
    }
}
