<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('id_pembeli')->constrained('users');
            $table->foreignId('id_supplier')->constrained('users');
            $table->integer('jumlahProduk');
            $table->integer('totalPesanan');
            $table->string('catatan');
            $table->foreignId('id_statusPesanan')->constrained('status_pesanan');
//            $table->integer('ongkir');
//            $table->string('pengiriman');
//            $table->string('alamat');
//            $table->string('kodePengiriman');
//            $table->string('buktiPembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
