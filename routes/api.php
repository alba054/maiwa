<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\InsiminasiBuatanController;
use App\Http\Controllers\api\KabupatenController;
use App\Http\Controllers\api\NotifikasiController;
use App\Http\Controllers\api\PerformaController;
use App\Http\Controllers\api\PeriksaKebuntinganController;
use App\Http\Controllers\api\PerlakuanController;
use App\Http\Controllers\api\PeternakController;
use App\Http\Controllers\api\SapiController;
use App\Http\Controllers\api\StrowController;
use App\Models\InsiminasiBuatan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/kabupaten', [KabupatenController::class, 'kabupaten']);

Route::get('/peternak/{id}', [PeternakController::class, 'indexById']);
Route::post('/peternak', [PeternakController::class, 'store']);
Route::put('/peternak/{id}', [PeternakController::class, 'update']);
Route::delete('/peternak/{id}/{userId}', [PeternakController::class, 'destroy']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/pk', [PeriksaKebuntinganController::class, 'index']);
Route::post('/pk', [PeriksaKebuntinganController::class, 'store']);
Route::put('/pk/{id}', [PeriksaKebuntinganController::class, 'update']);
Route::delete('/pk/{id}', [PeriksaKebuntinganController::class, 'destroy']);

Route::get('/sapi', [SapiController::class, 'index']);

Route::get('/performa', [PerformaController::class, 'index']);
Route::post('/performa', [PerformaController::class, 'store']);
Route::put('/performa/{id}', [PerformaController::class, 'update']);
Route::delete('/performa/{id}', [PerformaController::class, 'destroy']);

Route::get('/strow', [StrowController::class, 'index']);
Route::post('/strow', [StrowController::class, 'store']);
Route::put('/strow/{id}', [StrowController::class, 'update']);
Route::delete('/strow/{id}', [StrowController::class, 'destroy']);

Route::get('/ib', [InsiminasiBuatanController::class, 'index']);
Route::post('/ib', [InsiminasiBuatanController::class, 'store']);
Route::put('/ib/{id}', [InsiminasiBuatanController::class, 'update']);
Route::delete('/ib/{id}', [InsiminasiBuatanController::class, 'destroy']);

Route::get('/perlakuan', [PerlakuanController::class, 'index']);
Route::post('/perlakuan', [PerlakuanController::class, 'store']);
Route::put('/perlakuan/{id}', [PerlakuanController::class, 'update']);
Route::delete('/perlakuan/{id}', [PerlakuanController::class, 'destroy']);

Route::get('/notif/{id}', [NotifikasiController::class, 'index']);

// halo