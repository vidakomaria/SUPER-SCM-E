<?php

namespace App\Http\Livewire\Pemilik\Pesanan;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Livewire\Component;

class PesananDetail extends Component
{
    public $idPesanan;

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
