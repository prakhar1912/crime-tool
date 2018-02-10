<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request){ 	
    	if (Auth::attempt(['username' => $request->login, 'password' => $request->password]) || Auth::attempt(['email'=> $request->login, 'password' => $request->password])) {
    		return redirect('/home');
		}
		else{
			$notification = array(
                'message' => 'These credentials do not match our records.', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
		}
    }
}
