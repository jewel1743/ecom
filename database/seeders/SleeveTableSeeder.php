<?php

namespace Database\Seeders;
use App\Sleeve;
use Illuminate\Database\Seeder;

class SleeveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sleevesRecord=[
            ['id' => 1, 'name' => 'Full Sleeve', 'status' => 1],
            ['id' => 2, 'name' => 'Half Sleeve', 'status' => 1],
        ];

        Sleeve::insert($sleevesRecord);
    }
}
