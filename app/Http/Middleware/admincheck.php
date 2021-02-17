<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class admincheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $user=User::where('loggedIn',1)->get();
        // if(!$user->admin==1){
        //     return redirect('admin');
        // }
        if(!session()->has('admin')){
            return redirect('admin');
        }
        return $next($request);
    }
}
