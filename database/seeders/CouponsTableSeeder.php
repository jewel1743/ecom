<?php

namespace Database\Seeders;

use App\Coupon;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponsRecord=[
            [
            'id' => 1,
            'coupon_option' => 'manual',
            'coupon_code' => 'test10',
            'categories' => 'Tshirt',
            'users' => 'samantha',
            'coupon_type' => 'single',
            'amount_type' => 'percentange',
            'amount' => 10,
            'expiry_date' => '2022-12-31',
            'status' => 0,
            ],
        ];

        Coupon::insert($couponsRecord);
    }
}
