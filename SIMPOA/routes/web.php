<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes - SIMPOA
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'beranda'])->name('beranda');
Route::get('/prosedur', [PageController::class, 'prosedur'])->name('prosedur');
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');