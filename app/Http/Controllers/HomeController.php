<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transfer;

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
    public function show()
    {
        $sentList = Transfer::where('sender_id', auth()->id())->get();
        $receivedList = Transfer::where('receiver_id', auth()->id())->get();
        return view('home')->with(compact('sentList','receivedList'));
    }

}
