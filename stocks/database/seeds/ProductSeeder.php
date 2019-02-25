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
            'picture_path' => '13_25_02_2019_Resize.jpg',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'category_id' => '8',	
            'product_name' => 'Fuji X-Pro2',
            'price' => 28000,
            'picture_path' => '14_25_02_2019_Resize.jpg',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'category_id' => '9',	
            'product_name' => 'Leica M6',
            'price' => 41000,
            'picture_path' => '15_25_02_2019_Resize.jpg',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'category_id' => '10',	
            'product_name' => 'Fujinon XF 10-24MM F/4.0 R OIS',
            'price' => 25000,
            'picture_path' => '16_25_02_2019_Resize.jpg',
            'created_at' => date('Y-m-d H:i:s')
            ],
             [
            'category_id' => '13',  
            'product_name' => 'Peak Design Everyday Sling Camera Bag 10L',
            'price' => 7000,
            'picture_path' => '17_25_02_2019_Resize.jpg',
            'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
