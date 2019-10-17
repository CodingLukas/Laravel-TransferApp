<?php

namespace App\Classes;

use App\User;

class NumberGenerator {
    public function generateAccountNumber() {
        $number = rand(100000000, 999999999);

        // call the same function if the account number exists already
        if ($this->accountNumberExists($number)) {
            return $this->generateAccountNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    public function accountNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return User::where('account_number', $number)->exists();
    }
}