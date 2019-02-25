<?php

use Illuminate\Database\Seeder;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('product_categories')->insert([
            [
            'id' => '8', 
            'category_name' => 'Digital Camera',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'id' => '9',
            'category_name' => 'Film Camera',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'id' => '10',   
            'category_name' => 'Lens',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'id' => '11',
            'category_name' => 'flash',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'id' => '13',
            'category_name' => 'Accessories',
            'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
