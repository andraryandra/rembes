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
    // Route::resource('rembes-item', \App\Http\Controllers\Web\Rembes\RembesItemController::class);
    Route::controller(\App\Http\Controllers\Web\Rembes\RembesItemController::class)->group(function () {
        Route::get('rembes-item/{id}', 'index')->name('rembes-item.index');
        Route::get('rembes-item/create/{id}', 'create')->name('rembes-item.create');
        Route::post('rembes-item/store/{id}', 'store')->name('rembes-item.store');
        // Route::get('rembes-item/{id}', 'show')->name('rembes-item.show');
        Route::get('rembes-item/{rembes}/{id}/edit', 'edit')->name('rembes-item.edit');
        Route::put('rembes-item/{rembes}/{id}', 'update')->name('rembes-item.update');
        Route::delete('rembes-item/delete/{rembes}/{id}', 'destroy')->name('rembes-item.destroy');
    });

    Route::resource('category-tahun', \App\Http\Controllers\Web\CategoryTahun\CategoryTahunController::class);
});
