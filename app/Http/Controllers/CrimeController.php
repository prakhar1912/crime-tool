<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crime;
use App\Station;

class CrimeController extends Controller
{
    public function getAllCrimes(){
        $crimes = Crime::all();

        $response = array();
        foreach ($crimes as $crime) {
            $number = $crime->cases->count();
            $temp = array(
                'id' => $crime->id,
                'name' => $crime->name,
                'number' => count($crime->cases)
            );
            array_push($response, json_encode($temp));
        }
        return json_encode($response);
    }

    public function addNewCrime(Request $request){
        $crime = Crime::create([
            'name' => $request['name']
        ]);
        if($crime){
            return $crime->id;
        } else {
            return '0';
        }
    }

    public function deleteCrime($id){
        $crime = Crime::find($id);
        if($crime->delete()){
            return '1';
        }
    }

    public function editCrime($id, Request $request){
        $crime = Crime::find($id);
        $crime->name = $request['name'];

        if($crime->save()){
            return '1';
        }
    }
}
