<?php

namespace Database\Seeders;
use App\Fit;
use Illuminate\Database\Seeder;

class FitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fitsRecord=[
            ['id' => 1, 'name' => 'Slim Fit', 'status' => 1],
            ['id' => 2, 'name' => 'Regular Fit', 'status' => 1],
        ];

        Fit::insert($fitsRecord);
    }
}
