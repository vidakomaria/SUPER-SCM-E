<?php

namespace App\Http\Livewire;

use App\Models\Checkout;
use App\Models\Keranjang;
use App\Models\ProdukSupplier;
use App\Models\User;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class PemilikKeranjangIndex extends Component
{
    public $selectedProduk;
    public $qty;
    public $total=0;

    public function cek()
    {
        dd ($this->qty);
    }

    public function sumTotal()
    {
        // if($this->selectedProduk){
            $grandTotal = 0;
            foreach ($this->selectedProduk as $id) {
                $keranjang = Keranjang::where('id', $id)->first();
                if($keranjang){
                    $grandTotal = $keranjang->subTotal + $grandTotal;
                }
                else{
                    $this->total = 0;
                }
            }
            $this->total = $grandTotal;
    }

    //edit kuantitas
    public function edit($produkId)
    {
        $keranjang = Keranjang::where('id', $produkId)->first();
        // dd($keranjang->qty);
        dd($this->qty);
    }

    public function checkout()
    {
        if (count(Checkout::all()) >= 1){
            Checkout::truncate();
        }
        if($this->selectedProduk){
            // dd($this->selectedProduk);
            foreach ($this->selectedProduk as $id) {
                $keranjang = Keranjang::where('id', $id)->first();

                $addCheckout = [
                    'id_pembeli'    => auth()->user()->id,
                    'id_produk'     => $keranjang->id_produk,
                    'qty'           => $keranjang->qty,
                    'subTotal'      => $keranjang->subTotal,
                    'id_supplier'   => $keranjang->id_supplier,
                ];
                Checkout::create($addCheckout);
            }
            return redirect()->to('/pemilik/checkout');
        }
        else{
            session()->flash('message', 'Produk tidak ada yang dipilih!');
        }
    }

    public function render()
    {
        if ($this->selectedProduk){
            $this->sumTotal();
        }

        $data = Keranjang::where('id_pembeli', auth()->user()->id)->get();
        $keranjang = $data->groupBy('id_supplier');

        return view('livewire.pemilik-keranjang-index',[
            'keranjang'   => $keranjang,
        ]);
    }
}
