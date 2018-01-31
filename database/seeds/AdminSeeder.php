<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name'=>'admin',
        	'email'=>'admin@dcireports.com',
        	'phone'=>'0000000000',
        	'password'=>bcrypt('password'),
        	'role_id'=>1,
        ]);
    }
}
