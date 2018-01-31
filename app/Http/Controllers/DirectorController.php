<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crime;

class DirectorController extends Controller
{
    public function show(){
    	$crimes = Crime::where('number','!=','0')->get();
    	return view('panel.director.home')->withCrimes($crimes);
    }
}
