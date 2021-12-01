<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AkunSupplierController;
use App\Http\Controllers\ProdukSupplierController;
use App\Http\Controllers\EtalaseSupplierController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\AkunPemilikController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukPemilik;
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
//supplier akun
//Route::resource('supplier/akun', AkunSupplierController::class);
Route::get('/supplier', function (){
    return view('home.index');});

//supplier produk
Route::resource('supplier/produk', ProdukSupplierController::class);

//supplier etalase
Route::get('/supplier/etalase', [EtalaseSupplierController::class, 'tampil']);
Route::get('/supplier/arsip', [EtalaseSupplierController::class, 'arsip']);

//supplier pesanan
Route::get('/supplier/pesanan', [PesananController::class, 'supplierDaftarPesanan']);
Route::get('/supplier/pesanan/detail/{id}', [PesananController::class, 'supplierDetailPesanan']);

//pemilik
Route::get('/pemilik', function (){
    return view('pemilik.home.index');
});
//pemilik akun
//Route::resource('/pemilik/akun', AkunPemilikController::class);
//pemilik pasar
Route::get('/pemilik/pasar', [MarketController::class, 'index']);
Route::get('/pemilik/pasar/detail/{id}',[MarketController::class,'detail']);

//keranjang
Route::resource('/pemilik/keranjang', KeranjangController::class);
//checkout
Route::get('/pemilik/checkout', [CheckoutController::class, 'index']);
//pesan
Route::post('/pemilik/pesanan/pesan', [PesananController::class, 'create']);
Route::get('/pemilik/pesanan', [PesananController::class, 'index']);
Route::get('/pemilik/pesanan/detail/{id}', [PesananController::class, 'detail']);
//pemilik produk
Route::resource('/pemilik/produk', ProdukPemilikController::class);
