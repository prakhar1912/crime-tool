<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crime;

class PanelController extends Controller
{
    public function redirect(){
    	$role = auth()->user()->role->role;

    	return redirect('/home/'.$role);
    }

    public function getAllCrimes(){
        $crimes = Crime::all();

        $response = array();
        foreach ($crimes as $crime) {
            $temp = array(
                'id' => $crime->id,
                'name' => $crime->name,
                'number' => $crime->number
            );
            array_push($response, json_encode($temp));
        }
        return json_encode($response);
    }

    public function addNewCrime(Request $request){
        $crime = Crime::create([
            'name' => $request['name'],
            'number' => $request['number']
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
        $crime->number = $request['number'];

        if($crime->save()){
            return '1';
        }
    }
}
