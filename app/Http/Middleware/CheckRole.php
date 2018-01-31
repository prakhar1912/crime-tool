<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $userRole = auth()->user()->role->role;
        $banned = auth()->user()->banned;

        if($banned){
            auth()->logout();
            $notification = array(
                'message' => 'Your account has been banned.', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else{
            if($userRole == $role){
                return $next($request);
            } else {
                $notification = array(
                    'message' => 'You must be a '.$role.' to access this page', 
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }
    }
}
