<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('products')->insert([
            [
            'category_id' => '8',
            'product_name' => 'Fuji XE-3',
            'price' => 20000,
            'picture_path' => '1_24_02_2019_Resize.jpg',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'category_id' => '8',	
            'product_name' => 'Fuji X-Pro2',
            'price' => 28000,
            'picture_path' => '4_24_02_2019_Resize.jpg',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'category_id' => '9',	
            'product_name' => 'Leica M6',
            'price' => 41000,
            'picture_path' => '5_24_02_2019_Resize.jpg',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'category_id' => '10',	
            'product_name' => 'Fujinon XF 10-24MM F/4.0 R OIS',
            'price' => 25000,
            'picture_path' => '6_24_02_2019_Resize.jpg',
            'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
