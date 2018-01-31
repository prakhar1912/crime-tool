<?php

use Illuminate\Database\Seeder;

class CrimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crimes')->insert([
        	'name'=>'Homicide'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Offences Against Morality'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Other Offences Against Persons'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Robbery'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Breakings'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Theft of Stock'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Stealing'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Theft by Servant'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Vehicle and other thefts'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Dangerous Drugs'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Traffic Offences'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Criminal Damage'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Economic Crimes'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Corruption'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Offences involving Police Officers'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Offences involving Tourists'
        ]);
        DB::table('crimes')->insert([
        	'name'=>'Other Penal Code Offences'
        ]);
    }
}
