<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Station;

class StationController extends Controller
{
    public function getStations(){
        $stations = Station::all();

        $response = array();
        foreach ($stations as $station) {
            if(count($station->cases)){
                $temp = array(
                    'id' => $station->id,
                    'station' => $station->station
                );
                array_push($response, json_encode($temp));
            }
        }
        return json_encode($response);
    }

    public function getAllStations(){
        $stations = Station::all();

        $response = array();
        foreach ($stations as $station) {
            $temp = array(
                'id' => $station->id,
                'station' => $station->station
            );
            array_push($response, json_encode($temp));
        }
        return json_encode($response);
    }
    public function getCases($station){
        $cases = Station::find($station)->cases;

        $response = array();
        foreach($cases as $case){
            $temp = array(
                'id' => $case->id,
                'title' => $case->title,
                'crime' => $case->crime->name,
                'status' => $case->status
            );

            array_push($response, $temp);
        }

        return json_encode($response);
    }
}
