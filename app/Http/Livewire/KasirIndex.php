<?php

namespace App\Http\Livewire;

use App\Models\DetailPenjualanPemilik;
use App\Models\PenjualanPemilik;
use App\Models\ProdukPemilik;
use App\Models\TransaksiKasir;
use Carbon\Carbon;
use Livewire\Component;

class KasirIndex extends Component
{
    public $id_produk;
    public $qty;

    public $tgl;

    public $bayar;

    public function clear()
    {
        $this->id_produk = null;
        $this->qty = null;
        $this->bayar = null;
    }

    public function add()
    {
        $produk     = ProdukPemilik::where('id',$this->id_produk)->first();
        $transaksi = TransaksiKasir::where('id_produk', $this->id_produk)->first();

        $this->validate(['id_produk' => 'required']);

        //cek stok

        if ($transaksi){
            $this->validate(['qty' => 'required|min:1|numeric|max:'.($produk->stok - $transaksi->qty)]);
            $updateTransaksi =[
                'qty'       => $transaksi->qty + $this->qty,
                'sub_total' => ($transaksi->qty + $this->qty) * $produk->harga,
            ];
            $transaksi->update($updateTransaksi);
        } else{
            $this->validate(['qty' => 'required|min:1|max:'.$produk->stok]);
            $newTransaksi   = [
                'id_produk'     => $this->id_produk,
                'qty'           => $this->qty,
                'sub_total'     => $this->qty*$produk->harga,
            ];
            TransaksiKasir::create($newTransaksi);
        }

        $this->clear();
    }

    public function save()
    {
        $transaksi  = TransaksiKasir::all();
        $total      = $transaksi->sum('sub_total');

        $rules = [
            'bayar'     => 'required|gte:'.$total,
        ];
        $this->validate($rules);

        //add to Penjualan pemilik
        $penjualan = PenjualanPemilik::create([
            'tgl'           => Carbon::now(),
            'grand_total'   => $total,
            'bayar'         => $this->bayar,
            'kembali'       => $this->bayar - $total,
        ]);
        foreach ($transaksi as $value){
            $newDetail = [
                'id_penjualan'  => $penjualan->id,
                'id_produk'     => $value->id_produk,
                'qty'           => $value->qty,
                'harga'         => $value->produk->harga,
                'total'         => $value->sub_total,
            ];
            DetailPenjualanPemilik::create($newDetail);
        }
        TransaksiKasir::truncate();
        $this->clear();
        return $penjualan->id;
    }

    public function nota()
    {
        $id_penjualan = $this->save();
        $this->redirect('/pemilik/kasir/nota/'.$id_penjualan);
    }

    public function noNota()
    {
        $this->save();
    }

    public function deleteTransaction ($id)
    {
        TransaksiKasir::where('id',$id)->delete();
    }

    public function render()
    {
        $this->tgl = Carbon::now()->format('d/M/Y H:i');
        $produk = ProdukPemilik::all();
        return view('livewire.kasir-index',[
            'produk'    => $produk,
            'transactions' => TransaksiKasir::all(),
        ]);
    }
}
