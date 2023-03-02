<?php

use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\JenisBarangController;
use App\Http\Controllers\API\ReportTransaksiController;
use App\Http\Controllers\API\TransaksiController;
use App\Http\Controllers\API\TransaksiDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::apiResource('jenis_barangs', JenisBarangController::class);
Route::apiResource('barangs', BarangController::class);
Route::apiResource('transaksi', TransaksiController::class);
Route::apiResource('transaksi_detail', TransaksiDetailController::class);

Route::get('reportTrx', [ReportTransaksiController::class, 'index']);
Route::get('compareTrx', [ReportTransaksiController::class, 'compareJenis']);
