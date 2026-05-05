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

// routes/web.php
Route::get('/wawasan', function () {
    return view('wawasan');
});

Route::get('/', [PageController::class, 'beranda'])->name('beranda');
Route::get('/prosedur', [PageController::class, 'prosedur'])->name('prosedur');
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/wawasan', [PageController::class, 'wawasan'])->name('wawasan');
Route::get('/form', [PageController::class, 'form'])->name('form');

Route::get('/form', [WaterAnalysisController::class, 'form'])->name('form');
Route::post('/analyze', [WaterAnalysisController::class, 'analyze'])->name('analyze');
Route::get('/hasil', [WaterAnalysisController::class, 'hasil'])->name('hasil');