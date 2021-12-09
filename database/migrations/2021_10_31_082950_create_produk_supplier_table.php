<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->foreignId('id_kategori')->constrained('kategori_produk');
            $table->integer('harga');
            $table->integer('stok');
            $table->string('image')->nullable();
            $table->string('status');
            $table->text('deskripsi');
            $table->integer('terjual');
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
        Schema::dropIfExists('produk_supplier');
    }
}
