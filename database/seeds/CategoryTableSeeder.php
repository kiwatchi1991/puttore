<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([

        [ 'name' => 'HTML/CSS',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [ 'name' => 'JavaScript',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [ 'name' => 'PHP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        ]);
    }
}
