<?php

namespace Database\Seeders;
use App\ProductAttribute;
use Illuminate\Database\Seeder;

class ProuductsAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributeRecords=[
           [
            'id' => 1,
            'product_id' => 9,
            'size' => 'Small',
            'sku' => 'BCT01-S',
            'price' => 1200,
            'stock' => 10
           ],
           [
            'id' => 2,
            'product_id' => 9,
            'size' => 'Medium',
            'sku' => 'BCT01-M',
            'price' => 1400,
            'stock' => 15
           ],
           [
            'id' => 3,
            'product_id' => 9,
            'size' => 'Large',
            'sku' => 'BCT01-L',
            'price' => 1600,
            'stock' => 20
           ],
        ];

        ProductAttribute::insert($productAttributeRecords);
    }
}
