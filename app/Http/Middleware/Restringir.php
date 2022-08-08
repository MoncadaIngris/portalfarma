<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Restringir
{
    public function handle(Request $request, Closure $next)
    {
        if (isset(auth()->user()->empleados->vacaciones->inicio)) {
            if (auth()->user()->empleados->vacaciones->inicio <= date("Y-m-d") && auth()->user()->empleados->vacaciones->final >= date("Y-m-d")) {

                Auth::logout();
                
                return redirect()->route('login')
                ->with('a', 'activar');
            }
        }
        return $next($request);

    }
}
