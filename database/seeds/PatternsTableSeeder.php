<?php

use App\Pattern;
use Illuminate\Database\Seeder;

class PatternsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patternsRecord=[
            ['id' => 1, 'name' => 'Printed', 'status' => 1],
            ['id' => 2, 'name' => 'Striped', 'status' => 1],
        ];

        Pattern::insert($patternsRecord);
    }
}
