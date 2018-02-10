<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crime;
use App\Report;
use App\User;

class DirectorController extends Controller
{
    public function show(){
    	$allCrimes = Crime::all();
    	$crimes = array();

    	foreach($allCrimes as $crime){
    		if($crime->cases->count()){
    			array_push($crimes, $crime);
    		}
    	}
    	return view('panel.director.home')->withCrimes($crimes);
    }

    public function showCases($crime){
    	$cases = Crime::find($crime)->cases;

    	return view('panel.director.cases')->withCases($cases);
    }

    public function showCase($case){
    	$case = Report::find($case);

    	return view('panel.director.case')->withCase($case);
    }

    public function casesPerStation(){
        return view('panel.director.stations');
    }

    public function showAllCases(){
        return view('panel.director.all');
    }

    public function showAllCommanders(){
        return view('panel.director.commanders');
    }

    public function getAllCommanders(){
        $commanders = User::where('role_id','=','2')->get();

        $response = array();
        foreach ($commanders as $commander) {
            $temp = array(
                'id' => $commander->id,
                'name' => $commander->name,
                'station' => $commander->station->station
            );
            array_push($response, $temp);
        }

        return json_encode($response);
    }

    public function reassignCommander(Request $request, $commander){
        $commander = User::find($commander);
        $new_station = $request['station_id'];

        $commander->station_id = $new_station;
        if($commander->save()){
            return $commander->station->station;
        }
    }
}
