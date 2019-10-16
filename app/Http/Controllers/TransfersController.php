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

        $receiver_id = $request->input('account');
        $sender_id = auth()->user()->id;
        $amount = $request->input('amount');

        $sender_balance = $request->user()->amount;

        if($sender_balance-$amount > 0 ){
            if(DB::table('transfers')->where('receiver_id', $receiver_id)->exists()){

                $receiver_balance= User::find($receiver_id)->amount;

                DB::table('users')
                    ->where('id', $receiver_id)
                    ->update(['amount' => $receiver_balance+$amount]);

                DB::table('users')
                    ->where('id', $sender_id)
                    ->update(['amount' => $sender_balance-$amount]);

                DB::table('transfers')->insert(
                    ['receiver_id' => $receiver_id, 'sender_id' => $sender_id, 'amount' => $amount]
                );

            }else echo "Account doesn't exist!";
        }else echo "Not enough money to transfer!";

        return redirect('home');

    }
}
