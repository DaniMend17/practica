<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //* Dentro del objeto request podemos acceder a la información del usuario autenticado.
        //* $request->user() me devulve el usuario autenticado.
        if ($request->user()->is_admin == 0) {
            return  redirect()->route('home');
        }

        return $next($request);
    }
}
