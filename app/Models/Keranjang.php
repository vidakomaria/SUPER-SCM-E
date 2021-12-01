<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';

    protected $guarded = [];

    public function produk(){
        return $this->belongsTo(ProdukSupplier::class, 'id_produk');
    }

    public function pembeli(){
        return $this->belongsTo(User::class, 'id_pembeli');
    }

    public function supplier(){
        return $this->belongsTo(User::class, 'id_supplier');
    }
}
