<?php

use App\ProductImage;
use Illuminate\Database\Seeder;

class ProuductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImagesRecords=[
            [
                'id' => 1,
                'product_id' => 7,
                'images' => 'Black  Formal Tshirt1662172332.jpg',
                'status' => 1,

            ],
        ];

        ProductImage::insert($productImagesRecords);
    }
}
