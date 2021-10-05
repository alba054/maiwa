<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/notif', [App\Http\Controllers\NotifikasiController::class, 'index'])->name('notif');


Route::group(['middleware' => ['auth']], function () {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/{page}', [App\Http\Controllers\AdminController::class, 'index']);
});


