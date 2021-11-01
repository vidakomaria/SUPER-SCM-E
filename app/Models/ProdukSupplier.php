<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukSupplier extends Model
{
    use HasFactory;
    protected $table = 'produk_supplier';
    protected $guarded =[];

    public function kategori(){
        return $this->belongsTo(KategoriProduk::class,'id_kategori');
    }
}
