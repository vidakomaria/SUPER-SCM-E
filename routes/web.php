<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AkunSupplierController;
use App\Http\Controllers\ProdukSupplierController;
use App\Http\Controllers\EtalaseSupplierController;
use App\Http\Controllers\MarketController;

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

Route::get('/', function (){
    return redirect('akun');
});
Route::resource('akun', AkunController::class);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//supplier akun
Route::resource('supplier/akun', AkunSupplierController::class);
Route::get('/supplier', function (){
    return view('suppliers.home.index');});

//supplier produk
Route::resource('supplier/produk', ProdukSupplierController::class);

//supplier etalase
Route::get('/supplier/etalase', [EtalaseSupplierController::class, 'tampil']);
Route::get('/supplier/arsip', [EtalaseSupplierController::class, 'arsip']);

//pemilik
Route::get('/pemilik', function (){
    return view('pemilik.home.index');
});
//pasar
Route::get('/pemilik/pasar', [MarketController::class, 'index']);
