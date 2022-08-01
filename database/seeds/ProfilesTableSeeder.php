<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            [
                'id'=>1,
                'user_id'=>1,
                'phonenumber'=>'011151552928',
                'city'=>'Denpasar',
                'address'=>'Sidakarya',
            ],
            [
                'id'=>2,
                'user_id'=>2,
                'phonenumber'=>'08215551234',
                'city'=>'Badung',
                'address'=>'Jimbaran',
            ],

        ]);
    }
}