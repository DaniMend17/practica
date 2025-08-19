<?php

// use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
Route::resource('permissions', PermissionController::class);
