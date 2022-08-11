<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Restringir
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->empleados->vacaciones->inicio <= date("Y-m-d") && auth()->user()->empleados->vacaciones->final >= date("Y-m-d")) {
Auth::logout();
        
            // redireccionamos a donde queremos
            return redirect()->route('login')
            ->with('a', 'activar');
        }
        return $next($request);

    }
}
