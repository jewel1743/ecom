<?php

namespace Database\Seeders;

use App\DeliveryAddress;
use Illuminate\Database\Seeder;

class DeliveryAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryAddressRecords=[
            [
                'user_id' => 1,
                'name' => 'jewel mahmud',
                'address' => 'kashipur,kalai,joypurhat',
                'city' => 'kalai',
                'district' => 'joypurhat',
                'division' => 'rajshahi',
                'phone' => '01744164396',
                'pincode' => '1234',
                'status' => 1
            ],
            [
                'user_id' => 1,
                'name' => 'Jamisha mahmud',
                'address' => 'kashipur,kalai,joypurhat',
                'city' => 'kalai',
                'district' => 'joypurhat',
                'division' => 'rajshahi',
                'phone' => '01977164396',
                'pincode' => '12345',
                'status' => 1
            ],
        ];

        DeliveryAddress::insert($deliveryAddressRecords);
    }
}
