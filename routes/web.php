<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Livewire\Home\Home;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

Route::group(['middleware' => ['auth']], function () {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/sapi/{sapi:eartag}', [App\Http\Controllers\SapiController::class, 'show'])->name('sapi.show');
    Route::get('/pages/{page}', [App\Http\Controllers\AdminController::class, 'index']);
    
    Route::get('/export/pkb/{statusNo}/{id}', [App\Http\Controllers\ExportStrukController::class, 'ExportPKB']);
    
    // Route::resource('/post', PostController::class);
    // Route::get('post/delete/{id}', [PostController::class, 'destroy']);

    // Route::get('post/create', App\Http\Livewire\Post\Create::class)->name('post.create');

    Route::prefix('posts')->group(function () {
        Route::get('index', [PostController::class, 'index'])->name('posts.index');
        Route::get('create', [PostController::class, 'create'])->name('posts.create');
        Route::post('create', [PostController::class, 'store'])->name('posts.store');
        Route::get('{post:slug}', [PostController::class, 'show'])->name('posts.show');
        Route::get('{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('{post:slug}/edit', [PostController::class, 'update'])->name('posts.update'); 
    });

    Route::get('/download', function () {
        return response()->download(storage_path('app/public/apk/mbc.apk'));
    });

    
});


