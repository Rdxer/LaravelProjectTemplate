<?php

namespace App\Http\Controllers;

use App\Tools\Tools;
use App\User;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $u = Auth::user();
//
//        $u->phone = Tools::rand_word(11);
//
//        dd($u->updated_at);

        return view('home');

    }
}
