<?php

use App\Banner;
use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecords=[
            ['id' => 1, 'image' => 'banner1.png', 'title' => 'Black T-Shirt', 'link' => '', 'alt' => 'Black T-Shirt'],
            ['id' => 2, 'image' => 'banner2.png', 'title' => 'White T-Shirt', 'link' => '', 'alt' => 'White T-Shirt'],
            ['id' => 3, 'image' => 'banner3.png', 'title' => 'Blue T-Shirt', 'link' => '', 'alt' => 'Blue T-Shirt'],
        ];

        Banner::insert($bannerRecords); //avabe insert krle creted and updated null thake
    }
}
