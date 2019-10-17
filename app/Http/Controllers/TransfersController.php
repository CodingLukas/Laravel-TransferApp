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
        $sender_account = auth()->user()->account_number;
        $amount = $request->input('amount');

        $sender_balance = $request->user()->balance;


        if($sender_balance-$amount > 0 ){
            if(DB::table('users')->where('account_number', $receiver_account)->exists()){

                $user_id = User::where('account_number', $receiver_account)->value('id');
                $receiver_balance= User::find($user_id)->balance;

                DB::table('users')
                    ->where('account_number', $receiver_account)
                    ->update(['balance' => $receiver_balance+$amount]);

                DB::table('users')
                    ->where('account_number', $sender_account)
                    ->update(['balance' => $sender_balance-$amount]);

                DB::table('transfers')->insert(
                    ['receiver_account' => $receiver_account, 'sender_account' => $sender_account, 'amount' => $amount]
                );

            }else echo "Account doesn't exist!";
        }else echo "Not enough money to transfer!";

        return redirect('home');

    }
}
