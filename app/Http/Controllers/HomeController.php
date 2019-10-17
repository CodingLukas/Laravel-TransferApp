<?php

namespace App\Http\Controllers;

use App\User;
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
        $accountNumber = auth()->user()->account_number;
        $sentList = Transfer::where('sender_account', $accountNumber)->get();
        $receivedList = Transfer::where('receiver_account', $accountNumber)->get();
        return view('home')->with(compact('sentList','receivedList'));
    }

}
