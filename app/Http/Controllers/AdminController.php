<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Crime;
use App\Station;

class AdminController extends Controller
{
    public function show(){
    	return view('panel.admin.home');
    }

    public function users(){
    	$users = User::where('role_id','!=','1')->get();
    	return view('panel.admin.users');
    }

    public function stations(){
        return view('panel.admin.stations');
    }

    public function addNewstation(Request $request){
        $station = Station::create([
            'station' => $request['name']
        ]);
        if($station){
            return $station->id;
        } else {
            return '0';
        }
    }

    public function deleteStation($id){
        $station = Station::find($id);
        if($station->delete()){
            return '1';
        }
    }

    public function editStation($id, Request $request){
        $station = station::find($id);
        $station->station = $request['name'];

        if($station->save()){
            return '1';
        }
    }

    public function getAllUsers(){
        $users = User::where('role_id','!=','1')->get();

        $response = array();
        foreach ($users as $user) {
            if($user->role->role == 'director'){
                $temp = array(
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role->role,
                    'banned' => $user->banned
                );
            } else {
                $temp = array(
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'station' => $user->station->station,
                    'role' => $user->role->role,
                    'banned' => $user->banned
                );
            }
            array_push($response, json_encode($temp));
        }
        return json_encode($response);
    }

    public function banUser($id){
    	$user = User::find($id);

    	$user->banned = TRUE;

    	if($user->save()){
    		return '1';
    	} else {
    		return '0';
    	}
    }

    public function unbanUser($id){
    	$user = User::find($id);

    	$user->banned = FALSE;

    	if($user->save()){
    		return '1';
    	} else {
    		return '0';
    	}
    }

    public function newAdmin(){
        return view('panel.admin.admins');
    }

    public function createNewAdmin(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'username' => 'required|unique:users',
            'email'=>'required|unique:users|email',
            'phone'=>'required',
            'role'=>'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $newAdmin = User::create([
            'name'=>$request['name'],
            'username'=>$request['username'],
            'email'=>$request['email'],
            'phone'=>$request['phone'],
            'password'=>bcrypt($request['password']),
            'role_id'=>$request['role']
        ]);

        if($newAdmin){
            $notification = array(
                'message' => 'A new admin account has been added.', 
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function showReport(){
        $allCrimes = Crime::all();
        $crimes = array();

        foreach($allCrimes as $crime){
            if($crime->cases->count()){
                array_push($crimes, $crime);
            }
        }
        return view('panel.admin.report')->withCrimes($crimes);
    }
}
