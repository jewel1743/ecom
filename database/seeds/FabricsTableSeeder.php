<?php

use App\Fabric;
use Illuminate\Database\Seeder;

class FabricsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fabricsRecord=[
            ['id' => 1, 'name' => 'Cotton', 'status' => 1],
            ['id' => 2, 'name' => 'Plyester', 'status' => 1],
        ];

        Fabric::insert($fabricsRecord);
    }
}
