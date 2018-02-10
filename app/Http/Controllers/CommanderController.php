<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crime;

class CommanderController extends Controller
{
    public function show(){
        $crimes = Crime::all();
    	return view('panel.commander.home')->withCrimes($crimes);
    }

    public function addCrimeNumber($id, Request $request){
    	$crime = Crime::find($id);

    	$crime->number = $request['number'];

    	if($crime->save()){
    		return $crime->name;
    	}
    }
}
