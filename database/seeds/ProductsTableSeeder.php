<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsRecords=[
            [
                'id' => 1,
                'section_id' => 1,
                'category_id' => 2,
                'product_name' => 'Blue Casual Tshirt',
                'product_code' => 'BCT01',
                'product_color' => 'Blue',
                'product_price' => 1520,
                'product_discount' => 10,
                'product_weight' => 250,
                'product_video' => '',
                'main_image' => 'test/jest.jpg',
                'short_description' => '',
                'long_description' => '',
                'wash_care' => '',
                'fabric' => '',
                'pattern' => '',
                'sleeve' => '',
                'fit' => '',
                'occasion' => '',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'is_featured' => 'Yes',
                'status' => 1,
            ],
            [
                'id' => 2,
                'section_id' => 1,
                'category_id' => 2,
                'product_name' => 'White Casual Tshirt',
                'product_code' => 'BCT02',
                'product_color' => 'White',
                'product_price' => 1520,
                'product_discount' => 10,
                'product_weight' => 250,
                'product_video' => '',
                'main_image' => 'test/jest.jpg',
                'short_description' => '',
                'long_description' => '',
                'wash_care' => '',
                'fabric' => '',
                'pattern' => '',
                'sleeve' => '',
                'fit' => '',
                'occasion' => '',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'is_featured' => 'No',
                'status' => 1,
            ]
        ];

        foreach($productsRecords as $record){
            Product::create($record);
        }
    }
}
