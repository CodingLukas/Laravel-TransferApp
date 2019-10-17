<?php

use App\Classes\NumberGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);

        $numberGenerator = new NumberGenerator();

        DB::table('users')->insert([
            'name' => 'Test',
            'email' => 'test1@gmail.com',
            'password' => bcrypt('password'),
            'account_number' => '111222333',
            'balance' => '800,'
        ]);

        DB::table('users')->insert([
            'name' => 'Test2',
            'email' => 'test2@gmail.com',
            'password' => bcrypt('password'),
            'account_number' => '444555666',
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
            'account_number' => $numberGenerator ->generateAccountNumber(),
        ]);

        DB::table('transfers')->insert(
            ['receiver_account' => 111222333, 'sender_account' => 444555666, 'amount' => 100]
        );

        DB::table('transfers')->insert(
            ['receiver_account' => 444555666, 'sender_account' => 111222333, 'amount' => 200]
        );

        DB::table('transfers')->insert( // transfer from system
            ['receiver_account' => 111222333, 'sender_account' => 000000000, 'amount' => 1000]
        );
    }
}
