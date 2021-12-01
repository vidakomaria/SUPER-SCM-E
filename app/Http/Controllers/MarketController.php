<?php

namespace App\Http\Controllers;

use App\Models\EtalaseSupplier;
use App\Models\Keranjang;
use App\Models\ProdukSupplier;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(){
        return view('pemilik.market.index',[
            'etalase'   => EtalaseSupplier::all(),
        ]);
    }

    public function detail($id){
        $produk     = EtalaseSupplier::where('id_produk',$id)->first();
        $keranjang  = Keranjang::where('id_pembeli', auth()->user()->id)->get();

        return view('pemilik.market.detail',[
            'produk'    => $produk,
            'keranjang' => $keranjang,
        ]);
    }
}
