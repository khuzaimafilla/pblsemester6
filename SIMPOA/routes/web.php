<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WaterAnalysisController;

/*
|--------------------------------------------------------------------------
| Web Routes - SIMPOA
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'beranda'])->name('beranda');
Route::get('/prosedur', [PageController::class, 'prosedur'])->name('prosedur');
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');

Route::get('/analisa', [WaterAnalysisController::class, 'index'])->name('analisa');
Route::post('/analyze', [WaterAnalysisController::class, 'analyze'])->name('analyze');