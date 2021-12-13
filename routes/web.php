<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AkunSupplierController;
use App\Http\Controllers\ProdukSupplierController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\AkunPemilikController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\DaftarRekeningController;
use App\Http\Controllers\ProdukPemilikController;
use App\Models\Checkout;
use App\Models\Pesanan;

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

//akun
Route::resource('supplier/akun', AkunController::class);
Route::resource('pemilik/akun', AkunController::class);

//supplier produk
Route::resource('supplier/produk', ProdukSupplierController::class);

//supplier pesanan
Route::resource('/supplier/pesanan', PesananController::class);

// akun bank
Route::resource('/supplier/rekening', DaftarRekeningController::class);

//pemilik
Route::get('/pemilik', function (){
    return view('home.index');
});
//pemilik pasar
Route::get('/pemilik/pasar', [MarketController::class, 'index']);
Route::get('/pemilik/pasar/detail/{id}',[MarketController::class,'detail']);

//keranjang
Route::resource('/pemilik/keranjang', KeranjangController::class);
//checkout
Route::get('/pemilik/checkout', [CheckoutController::class, 'index']);

//pemilik produk
Route::resource('/pemilik/produk', ProdukPemilikController::class);
//pemilik pesanan
Route::resource('/pemilik/pesanan', PesananController::class);

//Kasir
Route::get('/pemilik/kasir', [KasirController::class,'index']);
Route::get('/pemilik/kasir/nota/{id_penjualan}', [KasirController::class, 'nota']);

