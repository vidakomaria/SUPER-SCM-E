<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtalaseSupplier extends Model
{
    use HasFactory;
    protected $table = 'etalase_supplier';
    protected $guarded =[];

    public function produk(){
        return $this->belongsTo(ProdukSupplier::class, 'id_produk');
    }

    public function supplier(){
        return $this->belongsTo(User::class, 'id_supplier');
    }
}
