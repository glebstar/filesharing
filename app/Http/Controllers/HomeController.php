<?php

namespace App\Http\Controllers;

use Auth;
use App\File;

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
        return view('home', [
            'files' => File::where('user_id', Auth::id())->orderBy('id')->paginate(5)
        ]);
    }
}
