<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    //
    protected $fillable = [
        'amount', 'sender_account', 'receiver_account',
    ];
}
