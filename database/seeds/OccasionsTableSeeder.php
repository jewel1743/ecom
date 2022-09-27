<?php

use App\Occasion;
use Illuminate\Database\Seeder;

class OccasionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $occasionsRecord=[
            ['id' => 1, 'name' => 'Casual', 'status' => 1],
            ['id' => 2, 'name' => 'Formal', 'status' => 1],
        ];

        Occasion::insert($occasionsRecord);
    }
}
