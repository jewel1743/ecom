<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesRecords=[
            [
            'id' => 1,
            'parent_id' => 0,
            'section_id' => 1,
            'category_name' => 'T-Shirt',
            'category_image' => '',
            'category_discount' => 150,
            'description' => '',
            'url' => '/t-shirt',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            ],
            [
            'id' => 2,
            'parent_id' => 1,
            'section_id' => 1,
            'category_name' => 'Casual T-Shirt',
            'category_image' => '',
            'category_discount' => 190,
            'description' => '',
            'url' => '/t-shirt/casual-t-shirt',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            ],
        ];

        Category::insert($categoriesRecords);
    }
}
