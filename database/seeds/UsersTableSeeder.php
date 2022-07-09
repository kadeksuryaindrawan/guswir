<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'=>1,
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('admin123'),
                'role'=>'Admin'
            ],
            [
                'id'=>2,
                'name'=>'Surya',
                'email'=>'surya123@gmail.com',
                'password'=>Hash::make('surya123'),
                'role'=>'Customer'
            ],
        ]);
    }
}