<?php

namespace App\Http\Controllers;

use App\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use DB;

class TransfersController extends Controller
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

    public function index()
    {
        return View('transfer.index');
    }

    public function transfer(Request $request)
    {
        $this->validate($request, [
            'account' => 'required',
            'amount' => 'required',
        ]);

        $receiver_account = $request->input('account');
        $sender_account = auth()->user()->account;
        $amount = $request->input('amount');

        $sender_balance = $request->user()->amount;

        if($sender_balance-$amount > 0 ){
            if(DB::table('transfers')->where('receiver_account', $receiver_account)->exists()){

                $receiver_balance= User::find($receiver_account)->balance;

                DB::table('users')
                    ->where('id', $receiver_account)
                    ->update(['balance' => $receiver_balance+$amount]);

                DB::table('users')
                    ->where('id', $sender_account)
                    ->update(['balance' => $sender_balance-$amount]);

                DB::table('transfers')->insert(
                    ['receiver_account' => $receiver_account, 'sender_account' => $sender_account, 'amount' => $amount]
                );

            }else echo "Account doesn't exist!";
        }else echo "Not enough money to transfer!";

        return redirect('home');

    }
}
