<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\MahasiswaController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('product', ProductsController::class);
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('mahasiswa/pdf', [MahasiswaController::class, 'cetak_pdf'])->name('mahasiswa.cetak_pdf');
// Route::get('/mahasiswas', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::resource('mahasiswa', MahasiswaController::class);

