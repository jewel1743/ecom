<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords= [
            [
                'id' => 1,
                'name' => 'Jewel Mahmud',
                'phone' => '01744164396',
                'type' => 'admin',
                'email' => 'jewel@gmail.com',
                'password' => Hash::make(12345678),
                'image' => '',
                'status' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Tanzila Mahmud',
                'phone' => '01744164396',
                'type' => 'admin',
                'email' => 'tanzila@gmail.com',
                'password' => Hash::make(12345678),
                'image' => '',
                'status' => 1,
            ],
        ];

        //Admin::insert($adminRecords); avebe korle loop er dorkar nai jst avabe dilei hobe

        foreach($adminRecords as $record){
            Admin::create($record);
        }
    }
}
