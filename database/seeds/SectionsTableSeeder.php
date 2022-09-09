<?php


use Illuminate\Database\Seeder;
use App\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionsRecords=[
            [
                'name' => 'Men',
                'status' => 1,
            ],
            [
                'name' => 'Women',
                'status' => 1,
            ],
            [
                'name' => 'Kids',
                'status' => 1,
            ],
        ];

        foreach($sectionsRecords as $record){
            Section::create($record);
        }
    }
}
