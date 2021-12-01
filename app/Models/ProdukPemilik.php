<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukPemilik extends Model
{
    use HasFactory;

    protected $table = "produk_pemilik";
    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo(KategoriProduk::class,'id_kategori');
    }
}
