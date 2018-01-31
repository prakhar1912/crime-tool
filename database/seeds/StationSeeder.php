<?php

use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stations')->insert([
        	'station'=>'Rift Valley'
        ]);
        DB::table('stations')->insert([
        	'station'=>'Coast'
        ]);
        DB::table('stations')->insert([
        	'station'=>'Central'
        ]);
        DB::table('stations')->insert([
        	'station'=>'North Eastern'
        ]);
        DB::table('stations')->insert([
        	'station'=>'Nairobi'
        ]);
        DB::table('stations')->insert([
        	'station'=>'Western'
        ]);
        DB::table('stations')->insert([
        	'station'=>'Eastern'
        ]);
        DB::table('stations')->insert([
        	'station'=>'Nyanza'
        ]);
    }
}
