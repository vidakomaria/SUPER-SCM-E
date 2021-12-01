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
            $table->integer('total_produk');
            $table->integer('grand_total');
            $table->string('pengiriman');
            $table->integer('ongkir');
            $table->string('alamat');
            $table->string('pesan');
            $table->string('kodePengiriman');
            $table->string('buktiPembayaran');
            $table->foreignId('id_status_pesanan')->constrained('status_pesanan');
            $table->foreignId('id_supplier')->constrained('users');
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
