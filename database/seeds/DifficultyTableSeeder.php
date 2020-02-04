<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DifficultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('difficulties')->insert([
            [ 'name' => '初級',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [ 'name' => '中級',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [ 'name' => '上級',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            ]);
    }
}
