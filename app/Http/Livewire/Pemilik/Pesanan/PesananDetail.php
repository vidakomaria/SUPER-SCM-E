<?php

namespace App\Http\Livewire\Pemilik\Pesanan;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\ProdukSupplier;
use App\Models\Rekening;
use Livewire\Component;

class PesananDetail extends Component
{
    //dari view & controller sebelumnya
    public $idPesanan;

    //untuk add gambar bukti
    public $add = 'off';
    public $btnAdd = null;

    public function addBukti()
    {
        $this->add = 'on';
        $this->btnAdd = 'disabled';
    }

    public function selesaiPesanan()
    {
        $detailPesanan = DetailPesanan::where('id_pesanan', $this->idPesanan)->get();
//        dd($detailPesanan);
        foreach ($detailPesanan as $produk){
            $produkSupplier = ProdukSupplier::where('id', $produk->id_produk)->first();
            $updateStok = [
                'terjual' => $produkSupplier->terjual + $produk->qty,
            ];
            $produkSupplier->update($updateStok);
        }
        Pesanan::where('id', $this->idPesanan)->update(['id_statusPesanan'  => 6]);
        return $this->redirect('/pemilik/pesanan/'.$this->idPesanan);
    }

    public function render()
    {
//        dd($this->idPesanan);
        $pesananAll = Pesanan::where('id',$this->idPesanan)->first();

        $pesanan = DetailPesanan::where('id_pesanan' , $this->idPesanan)->get();
        return view('livewire.pemilik.pesanan.pesanan-detail',[
            'pesanan'   => $pesanan,
//            'listStatus' => $this->listStatus,
            'pesananAll'     => $pesananAll,
        ]);
    }
}
