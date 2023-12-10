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
    Route::controller(App\Http\Controllers\Web\Rembes\RembesController::class)->group(function () {
        Route::get('rembes', 'index')->name('rembes.index');
        Route::get('rembes/create', 'create')->name('rembes.create');
        Route::post('rembes/store', 'store')->name('rembes.store');
        Route::get('rembes/{id}', 'show')->name('rembes.show');
        Route::get('rembes/{id}/edit', 'edit')->name('rembes.edit');
        Route::put('rembes/{id}', 'update')->name('rembes.update');
        Route::delete('rembes/delete/{id}', 'destroy')->name('rembes.destroy');
    });

    Route::controller(\App\Http\Controllers\Web\Rembes\RembesItemController::class)->group(function () {
        Route::get('{rembes}/edit/{id}', 'edit')->name('rembes-item.edit');
        Route::put('update/{rembes}/{id}', 'update')->name('rembes-item.update');
        Route::delete('rembes-item/delete/{rembes}/{id}', 'destroy')->name('rembes-item.destroy');
        Route::get('rembes-item/{id}', 'index')->name('rembes-item.index');
        Route::get('rembes-item/create/{id}', 'create')->name('rembes-item.create');
        Route::post('rembes-item/store/{id}', 'store')->name('rembes-item.store');
        Route::get('rembes-item/show/{id}', 'show')->name('rembes-item.show');
    });



    Route::resource('category-tahun', \App\Http\Controllers\Web\CategoryTahun\CategoryTahunController::class);

    Route::controller(\App\Http\Controllers\Web\Rembes\RembesApprovalController::class)->group(function () {
        Route::get('submission-approved', 'index')->name('submission-approved.index');
        Route::get('submission/create', 'create')->name('submission.create');
        // Route::post('submission/store', 'store')->name('submission.store');
        Route::get('submission/{id}', 'show')->name('submission.show');
        Route::get('submission/reimburseItem{id}', 'reimburseItem')->name('submission.reimburseItem');
        Route::get('submission/{id}/edit', 'edit')->name('submission.edit');
        Route::post('submission/update', 'update')->name('submission.update');
        Route::post('submission/updateOneReimburse/{id}', 'updateOneReimburse')->name('submission.updateOneReimburse');
        // Route::delete('submission/delete/{id}', 'destroy')->name('submission.destroy');
        Route::get('submission/{id}/invoice', 'invoice')->name('submission.invoice');
        Route::post('/submission/{id}/comment', 'commentStore')->name('submission.commentStore');
        Route::put('/submission/{id}/comment', 'commentUpdate')->name('submission.commentUpdate');
    });
});
