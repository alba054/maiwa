<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BirahiController;
use App\Http\Controllers\api\HasilController;
use App\Http\Controllers\api\InsiminasiBuatanController;
use App\Http\Controllers\api\KabupatenController;
use App\Http\Controllers\api\LaporanController;
use App\Http\Controllers\api\MasterPerlakuanController;
use App\Http\Controllers\api\MasterSapiController;
use App\Http\Controllers\api\MetodeController;
use App\Http\Controllers\api\NotifikasiController;
use App\Http\Controllers\api\PanenController;
use App\Http\Controllers\api\PerformaController;
use App\Http\Controllers\api\PeriksaKebuntinganController;
use App\Http\Controllers\api\PerlakuanController;
use App\Http\Controllers\api\PeternakController;
use App\Http\Controllers\api\PeternakSapiController;
use App\Http\Controllers\api\SapiController;
use App\Http\Controllers\api\StrowController;
use App\Http\Controllers\api\UserController;
use App\Models\InsiminasiBuatan;
use App\Models\Notifikasi;
use App\Models\PeternakSapi;
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

Route::get('/peternak/{userId}', [PeternakController::class, 'index']);
Route::post('/peternak', [PeternakController::class, 'store']);
Route::put('/peternak/{id}', [PeternakController::class, 'update']);
Route::delete('/peternak/{id}/{userId}', [PeternakController::class, 'destroy']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/user/{id}', [UserController::class, 'show']);

Route::get('/pk/{userId}', [PeriksaKebuntinganController::class, 'index']);
Route::post('/pk', [PeriksaKebuntinganController::class, 'store']);
Route::put('/pk/{id}', [PeriksaKebuntinganController::class, 'update']);
Route::delete('/pk/{id}/{userId}', [PeriksaKebuntinganController::class, 'destroy']);

Route::get('/sapi/{userId}', [SapiController::class, 'index']);
Route::get('/master/sapi', [MasterSapiController::class, 'index']);
Route::post('/sapi', [SapiController::class, 'store']);

Route::get('/performa/{userId}', [PerformaController::class, 'index']);
Route::post('/performa', [PerformaController::class, 'store']);
Route::put('/performa/{id}', [PerformaController::class, 'update']);
Route::delete('/performa/{id}', [PerformaController::class, 'destroy']);

Route::get('/strow', [StrowController::class, 'index']);
Route::post('/strow', [StrowController::class, 'store']);
Route::put('/strow/{id}', [StrowController::class, 'update']);
Route::delete('/strow/{id}', [StrowController::class, 'destroy']);

Route::get('/ib/{id}', [InsiminasiBuatanController::class, 'index']);
Route::post('/ib', [InsiminasiBuatanController::class, 'store']);
Route::put('/ib/{id}', [InsiminasiBuatanController::class, 'update']);
Route::delete('/ib/{id}', [InsiminasiBuatanController::class, 'destroy']);

Route::get('/perlakuan/{userId}', [PerlakuanController::class, 'index']);
Route::post('/perlakuan', [PerlakuanController::class, 'store']);
Route::put('/perlakuan/{id}', [PerlakuanController::class, 'update']);
Route::delete('/perlakuan/{id}', [PerlakuanController::class, 'destroy']);

Route::get('/notif/{userId}', [NotifikasiController::class, 'index']);
Route::get('/laporan/{userId}', [LaporanController::class, 'index']);
Route::get('/metode', [MetodeController::class, 'index']);
Route::get('/hasil', [HasilController::class, 'index']);

Route::get('/export/{statusNo}/{id}', [App\Http\Controllers\ExportStrukController::class, 'ExportPKB']);

Route::get('/peternaksapi/{id}', [PeternakSapiController::class, 'index']);
Route::get('/perlakuan/master/obat', [MasterPerlakuanController::class, 'obat']);
Route::get('/perlakuan/master/vitamin', [MasterPerlakuanController::class, 'vitamin']);
Route::get('/perlakuan/master/vaksin', [MasterPerlakuanController::class, 'vaksin']);
Route::get('/perlakuan/master/hormon', [MasterPerlakuanController::class, 'hormon']);

Route::post('/birahi', [BirahiController::class, 'store']);

Route::get('/panen/{userId}', [PanenController::class, 'index']);
Route::post('/panen', [PanenController::class, 'store']);

// halo