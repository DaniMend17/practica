<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        //*Agregamos nuevas rutas que se encuentran en routes/admin.php
        then: function () {
            //*Para acceder a las rutas del archivo admin.php, se debe tener autenticación por el parametro 'auth'.
            Route::middleware('web', 'auth')
                //*Defino que todas las rutas del archivo admin.php tendran el prefijo 'admin'
                ->prefix('admin')
                //*Defino que todas las rutas del archivo admin.php tendran el nombre 'admin.'
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
