<?php

namespace App\Http\Livewire\Supplier;

use App\Models\EtalaseSupplier;
use App\Models\Pesanan;
use App\Models\ProdukSupplier;
use Livewire\Component;

class ProdukIndex extends Component
{
    public $tampilan = 'all';

    public function all(){
        $this->tampilan = 'all';
    }
    public function etalase(){
        $this->tampilan = 'tampil';
    }

    public function arsip(){
        $this->tampilan = 'arsip';
    }

    public function render()
    {
        if ($this->tampilan == 'all'){
            $produks = ProdukSupplier::where('id_supplier', auth()->user()->id)->get();
        }
        else{
            $produks = ProdukSupplier::where('id_supplier', auth()->user()->id)
                ->where('status', $this->tampilan)->get();
        };

//        $produk = ProdukSupplier::with('kategori')
//            ->where('id_supplier',auth()->user()->id)->get();

        return view('livewire.supplier.produk-index',[
            'produks' => $produks,
        ]);
    }
}
