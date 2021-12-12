<?php

namespace App\Http\Livewire\Pemilik\Pesanan;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\StatusPesanan;
use Livewire\Component;

class PesananIndex extends Component
{
    public $status= 'all' ;

    public function status($status)
    {
        $this->status = $status;
    }

    public function jmlh ()
    {
        $countPesanan = collect();
        foreach (StatusPesanan::all() as $idStatus){
            $status = Pesanan::where('id_pembeli', auth()->user()->id)
                ->where('id_statusPesanan', $idStatus->id)->get();
//            $countPesanan = push($status->count());
            $countPesanan->put($idStatus->status,$status->count());
        }
        $pesananAll = Pesanan::where('id_pembeli', auth()->user()->id)->get();
        $countPesanan->put("all", $pesananAll->count());
        return $countPesanan;
    }

    public function render()
    {
        $countPesanan = $this->jmlh();
        if ($this->status == 'all'){
            $pesanan = Pesanan::where('id_pembeli', auth()->user()->id)->get();
        }
        else{
            $pesanan = Pesanan::where('id_pembeli', auth()->user()->id)
                                ->where('id_statusPesanan', $this->status)->get();
        };

        return view('livewire.pemilik.pesanan.pesanan-index',[
            'pesanan'   => $pesanan,
            'status'    => $this->status,
            'countPesanan'  => $countPesanan,
        ]);
    }
}
