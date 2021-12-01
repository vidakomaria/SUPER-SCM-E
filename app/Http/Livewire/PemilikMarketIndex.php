<?php

namespace App\Http\Livewire;

use App\Models\EtalaseSupplier;
use App\Models\Keranjang;
use App\Models\ProdukSupplier;
use Livewire\Component;

class PemilikMarketIndex extends Component
{
    public function addCart($id, $id_supplier)
    {
        $keranjang = Keranjang::where('id_pembeli',auth()->user()->id)
            ->where('id_produk', $id)
            ->first();

        $produk = ProdukSupplier::where('id', $id)->first();

        $data = [
            'id_produk'     => $id,
            'id_pembeli'    => auth()->user()->id,
            'qty'           => 1,
            'id_supplier'   => $id_supplier,
        ];
        $data['subTotal'] = $data['qty'] * $produk->harga;

        if ($keranjang){
            $data['qty']        = $keranjang->qty + 1;
            $data['subTotal']   = $data['qty'] * $produk->harga;
            Keranjang::where('id_produk', $data['id_produk'])
                ->update($data);
        }
        else {
            Keranjang::create($data);
        }

        session()->flash('success', 'Produk ditambahkan');
    }

    public function render()
    {
        $keranjang = Keranjang::where('id_pembeli', auth()->user()->id)->get();
        return view('livewire.pemilik-market-index',[
            'etalase'   => EtalaseSupplier::all(),
            'keranjang' => $keranjang,
        ]);
    }
}
