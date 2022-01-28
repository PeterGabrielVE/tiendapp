<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'LG',
        ]);

        DB::table('brands')->insert([
            'name' => 'Samsung',
        ]);

        DB::table('brands')->insert([
            'name' => 'Xiaomi',
        ]);

        DB::table('brands')->insert([
            'name' => 'Aiwa',
        ]);
    }
}
