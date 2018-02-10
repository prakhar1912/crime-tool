<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crime;
use App\Station;

class PanelController extends Controller
{
    public function redirect(){
    	$role = auth()->user()->role->role;

    	return redirect('/home/'.$role);
    }
}
