<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthLoginUser
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()) {
            return redirect('/Login-Page');
        }else if(Auth::check() && Auth::user()->role_user != 3 ){

            return redirect('/Login-Page');
        }else if(Auth::user()->status == 1 ){

            return redirect('/user_block');
        }else{
            return $next($request);   
        }

     
    }
}
