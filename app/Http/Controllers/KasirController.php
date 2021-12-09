<?php

namespace App\Http\Controllers;

use App\Models\PenjualanPemilik;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        return view('pemilik.kasir.index');
    }

    public function nota($id_penjualan)
    {
        $penjualan = PenjualanPemilik::where('id', $id_penjualan)->first();
        return view('pemilik.kasir.nota',[
            'penjualan' => $penjualan,
        ]);
    }
}
