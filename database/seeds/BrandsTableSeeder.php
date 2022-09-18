<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords=[
            ['id' => 1, 'brand_name' => 'Lee', 'status' => 1],
            ['id' => 2, 'brand_name' => 'Bata', 'status' => 1],
            ['id' => 3, 'brand_name' => 'Apex', 'status' => 1],
            ['id' => 4, 'brand_name' => 'H & M', 'status' => 1],
        ];

        Brand::insert($brandRecords);
    }
}
