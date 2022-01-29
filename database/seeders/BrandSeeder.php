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
            'reference' => 'LG01',
        ]);

        DB::table('brands')->insert([
            'name' => 'Samsung',
            'reference' => 'A02',
        ]);

        DB::table('brands')->insert([
            'name' => 'Xiaomi',
            'reference' => 'Note9',
        ]);

        DB::table('brands')->insert([
            'name' => 'Aiwa',
            'reference' => 'ssmarttv',
        ]);
    }
}
