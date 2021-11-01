<?php

namespace App\Http\Controllers;

use App\Models\EtalaseSupplier;
use App\Models\ProdukSupplier;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(){
        return view('pemilik.market.index',[
            'etalase'   => EtalaseSupplier::all(),
        ]);
    }
}
