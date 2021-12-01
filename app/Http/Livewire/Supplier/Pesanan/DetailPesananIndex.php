<?php

namespace App\Http\Livewire\Supplier\Pesanan;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Livewire\Component;

class DetailPesananIndex extends Component
{
    //ambil id pesanan dari component sebelumnya
    public $idPesanan;

    //input
    public $status;
    public $ongkir;
    public $pesan = '';
    public $kodePengiriman ='';

    public $listStatus;
    public $disable ="disabled";
    public $btn     = "Edit";

    public function addStatus()
    {
        $this->listStatus = collect([
            [
                'idStatus'          => 1,
                'statusChange'      => 'konfirmasi',
                'idStatusChange'    => 2,
                'disable'           => null,
            ],
            [
                'idStatus'          => 3,
                'statusChange'      => 'dikirm',
                'idStatusChange'    => 4
            ],
        ]);
    }

    public function edit()
    {
        $pesanan = Pesanan::where('id', $this->idPesanan)->first();

        if ($this->btn == "Edit"){
            $this->disable = null;
            $this->btn = "Save";
        }
        elseif ($this->btn == "Save"){

            $currentStatus = $this->listStatus->where('idStatus', $pesanan->id_status_pesanan)->first();
            if ($currentStatus != null){
                $updatePesanan = [
                    'id_status_pesanan' => $this->status,
                    'ongkir'            => $this->ongkir,
                    'kodePengiriman'    => $this->kodePengiriman,
                    'pesan'             => $this->pesan,
                ];
                if ($this->status == null){
                    $updatePesanan['id_status_pesanan'] = $pesanan->id_status_pesanan;
                }
                if ($this->ongkir == null){
                    $updatePesanan['ongkir'] = 0;
                }
                $pesanan->update($updatePesanan);
            }

//            dd($updatePesanan);
            $this->disable = 'disabled';
            $this->btn = "Edit";
        }
    }

    public function render()
    {
        $this->addStatus();
//        dd($this->listStatus->where('idStatus',1));
        $pesananAll = Pesanan::where('id',$this->idPesanan)->first();

        $pesanan = DetailPesanan::where('id_pesanan' , $this->idPesanan)->get();
        return view('livewire.supplier.pesanan.detail-pesanan-index',[
            'pesanan'   => $pesanan,
            'listStatus' => $this->listStatus,
            'pesananAll'     => $pesananAll,
        ]);
    }
}
