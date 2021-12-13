<?php

namespace App\Http\Livewire\Supplier\Pesanan;

use App\Models\DetailPembayaran;
use App\Models\DetailPengiriman;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\ProdukSupplier;
use App\Models\Rekening;
use Livewire\Component;

class DetailPesananIndex extends Component
{
    //ambil id pesanan dari component sebelumnya
    public $idPesanan;

    //input
    public $status;
    public $ongkir;
    public $catatan = '';
    public $kodePengiriman ='';

    public $listStatus;
    public $disable ="disabled";
    public $btn     = "Edit";

    public function addStatus()
    {
        $this->listStatus = collect([
            [
                'idStatus'          => 1,
                'statusChange'      => ['konfirmasi'],
                'idStatusChange'    => [2],
                'disable'           => 'disabled',
            ],
            [
                'idStatus'          => 3,
                'statusChange'      => ['konfirmasi pembayaran','pembayaran ditolak'],
                'idStatusChange'    => [4,8],
                'disable'           => null
            ],
            [
                'idStatus'          => 4,
                'statusChange'      => ['Pesanan dkirim'],
                'idStatusChange'    => [5],
                'disable'           => null
            ],
            [
                'idStatus'          => 8,
                'statusChange'      => ['konfirmasi pembayaran','pembayaran ditolak'],
                'idStatusChange'    => [4,8],
                'disable'           => null
            ],
            [
                'idStatus'          => 9,
                'statusChange'      => ['konfirmasi pembatalan'],
                'idStatusChange'    => [7],
                'disable'           => null
            ],
        ]);
    }

    public function edit()
    {
        $pesanan = Pesanan::where('id', $this->idPesanan)->first();
        $this->disable = null;
        $this->ongkir = $pesanan->pengiriman->ongkir;
        $this->kodePengiriman = $pesanan->pengiriman->kodePengiriman;
        $this->catatan = $pesanan->catatan;
//        dd($this->kodePengiriman);
    }

    public function save()
    {
        $pesanan = Pesanan::where('id', $this->idPesanan)->first();

        //apakah status sekarang ada di daftar status yg bisa diedit
        $currentStatus = $this->listStatus->where('idStatus', $pesanan->id_statusPesanan)->first();

        if ($currentStatus != null){
            $updatePesanan = [
                'id_statusPesanan' => $this->status,
                'catatan'             => $this->catatan,
            ];

            //update detail pengiriman
            $detailPengiriman = [
                'ongkir'            => $this->ongkir,
                'kodePengiriman'    => $this->kodePengiriman,
            ];
            DetailPengiriman::where('id_pesanan', $pesanan->id)->update($detailPengiriman);

            //update detail pembayaran
            $rekening = Rekening::where('id_user', auth()->user()->id)->first();
            $detailPembayaran = [
                'id_detailRekening' => $rekening->id,
            ];
            DetailPembayaran::where('id_pesanan', $pesanan->id)->update($detailPembayaran);

            if ($this->status == null){
                $updatePesanan['id_statusPesanan'] = $pesanan->id_statusPesanan;
            }
            if ($this->ongkir == null){
                $detailPengiriman['ongkir'] = 0;
            }

            //update produk jika dibatalkan
            if ($this->status == 7){
                $detailPesanan = DetailPesanan::where('id_pesanan',$this->idPesanan)->get();
                foreach ($detailPesanan as $produk){
                    $produkSupplier = ProdukSupplier::where('id', $produk->id_produk)->first();
                    $produkSupplier->update([
                        'stok'  => $produkSupplier->stok + $produk->qty,
                    ]);
                }
            }
            $pesanan->update($updatePesanan);
        }

//            dd($updatePesanan);
        $this->disable = 'disabled';
        $this->btn = "Edit";
    }

    public function render()
    {
        $this->addStatus();
//        dd($this->listStatus->where('idStatus',1));
        $pesananAll = Pesanan::where('id',$this->idPesanan)->first();
        $rekening = Rekening::where('id_user', auth()->user()->id)->first();

        $pesanan = DetailPesanan::where('id_pesanan' , $this->idPesanan)->get();
        return view('livewire.supplier.pesanan.detail-pesanan-index',[
            'pesanan'   => $pesanan,
            'listStatus' => $this->listStatus,
            'pesananAll'     => $pesananAll,
            'rekening'   => $rekening,
        ]);
    }
}
