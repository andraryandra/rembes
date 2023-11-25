<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');

Auth::routes();

Route::get('/redirect', [App\Http\Controllers\Auth\RedirectAuthController::class, 'redirect'])->name('redirect');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

    Route::get('/home/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

    Route::resource('roles', \App\Http\Controllers\Auth\RoleController::class);
    Route::resource('users', \App\Http\Controllers\Auth\UserController::class);
    Route::resource('rembes', \App\Http\Controllers\Web\Rembes\RembesController::class);
});
