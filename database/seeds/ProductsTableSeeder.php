<?php

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
        DB::table('products')->insert([
            [
                'id'=>1,
                'name'=>'AIR JORDAN 1 X OFF-WHITE NRG "OFF WHITE UNC"',
                'brand'=>'Nike',
                'price'=>900000,
                'image'=>'products/1.jpg',
                'gender'=>'Female',
                'category'=>'Shoes',
                'quantity'=>1
            ],
            [
                'id'=>2,
                'name'=>'STUSSY X AIR ZOOM SPIRIDON CAGED "PURE PLATINUM"',
                'brand'=>'Nike',
                'price'=>150000,
                'image'=>'products/2.jpg',
                'gender'=>'Unisex',
                'category'=>'Shoes',
                'quantity'=>12
            ],
            [
                'id'=>3,
                'name'=>'SUPREME X AIR FORCE 1 LOW "BOX LOGO - WHITE"',
                'brand'=>'Nike',
                'price'=>300000,
                'image'=>'products/3.jpg',
                'gender'=>'Male',
                'category'=>'Shoes',
                'quantity'=>1
            ],
            [
                'id'=>4,
                'name'=>'SACAI X LDV WAFFLE "BLACK NYLON"',
                'brand'=>'Nike',
                'price'=>200000,
                'image'=>'products/4.jpg',
                'gender'=>'Male',
                'category'=>'Shoes',
                'quantity'=>1
            ],
            [
                'id'=>5,
                'name'=>'AIR JORDAN 1 RETRO HIGH "SHATTERED BACKBOARD"',
                'brand'=>'Nike',
                'price'=>100000,
                'image'=>'products/5.jpg',
                'gender'=>'Male',
                'category'=>'Shoes',
                'quantity'=>14
            ],

        ]);
    }
}