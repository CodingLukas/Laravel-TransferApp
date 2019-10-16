<?php

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
        DB::table('users')->insert([
            'name' => 'Test',
            'email' => 'test1@gmail.com',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Test2',
            'email' => 'test2@gmail.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('password'),
        ]);

        DB::table('transfers')->insert(
            ['receiver_id' => 1, 'sender_id' => 2, 'amount' => 100]
        );

        DB::table('transfers')->insert(
            ['receiver_id' => 2, 'sender_id' => 1, 'amount' => 200]
        );
    }
}
