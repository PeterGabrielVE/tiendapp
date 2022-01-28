<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Nevera',
            'size' => 'S',
            'observations' => 'Test 1',
            'id_brand' => '1',
            'quantity_inventory' => '10',
            'boarding_date' => '2021-01-01',
        ]);

        DB::table('products')->insert([
            'name' => 'Telefono',
            'size' => 'M',
            'observations' => 'Test 2',
            'id_brand' => '2',
            'quantity_inventory' => '25',
            'boarding_date' => '2021-01-02',
        ]);

        DB::table('products')->insert([
            'name' => 'TV',
            'size' => 'L',
            'observations' => 'Test 3',
            'id_brand' => '3',
            'quantity_inventory' => '50',
            'boarding_date' => '2021-01-03',
        ]);

        DB::table('products')->insert([
            'name' => 'Audifono',
            'size' => 'S',
            'observations' => 'Test 4',
            'id_brand' => '4',
            'quantity_inventory' => '230',
            'boarding_date' => '2021-01-04',
        ]);
    }
}
