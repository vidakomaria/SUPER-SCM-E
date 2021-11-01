<?php

namespace App\Http\Controllers;

use App\Models\EtalaseSupplier;
use App\Models\ProdukSupplier;
use Illuminate\Http\Request;

class EtalaseSupplierController extends Controller
{
    public function tampil(){
        $etalase = EtalaseSupplier::with('produk','supplier')
            ->where('id_supplier', auth()->user()->id)->get();
        return view('suppliers.etalase.tampil',[
            'produks'    => $etalase
        ]);
    }

    public function arsip(){
        $produk = ProdukSupplier::where([
            ['status','arsip'],
            ['id_supplier', auth()->user()->id],
        ])->get();

        return view('suppliers.etalase.arsip',[
            'produks'    => $produk
        ]);
    }
}
