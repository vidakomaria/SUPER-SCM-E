<?php

namespace Database\Seeders;

use App\Models\StatusPesanan;
use Illuminate\Database\Seeder;

class StatusPesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPesanan::create([
            'status'        => 'menunggu konfirmasi',
            'keterangan'    => 'biaya ongkos kirim akan ditambahkan oleh supplier'
        ]);
        StatusPesanan::create([
            'status'        => 'belum bayar',
            'keterangan'    => 'harap melakukan pembayaran sesuai dengan total pembayaran',
        ]);
        StatusPesanan::create([
            'status'        => 'menunggu konfirmasi pembayaran',
            'keterangan'    => 'pembayaran akan dikonfirmasi oleh supplier',
        ]);
        StatusPesanan::create([
            'status'        => 'diproses',
            'keterangan'    => 'supplier sedang memproses pesanan',
        ]);
        StatusPesanan::create([
            'status'        => 'dikirim',
            'keterangan'    => 'pesanan sedang dikirm',
        ]);
        StatusPesanan::create([
            'status'    => 'selesai',
            'keterangan'    => '',
        ]);
        StatusPesanan::create([
            'status'    => 'dibatalkan',
            'keterangan'    => '',
        ]);
        StatusPesanan::create([
            'status'        => 'pembayaran ditolak',
            'keterangan'    => 'pembayaran ditolak, periksa nominal dan sesuaikan dengan total pembayaran',
        ]);
    }
}
