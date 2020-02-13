<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            'account_name' => 'きわっち',
            'email' => 'ymnkknt3@gmail.com',
            'password' => 'orange1212',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}