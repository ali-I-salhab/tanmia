<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\session;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (Auth::check()) {
            // dd("wwe");
            // check if user authenticated
            if (Auth::user()->role === "user") {
                return $next($request);
            } else {
                // clear all session
                Session::flush();
             
                return redirect()->route("login");
            }
        } else {
            return redirect()->route("login");
        }
    }
}
