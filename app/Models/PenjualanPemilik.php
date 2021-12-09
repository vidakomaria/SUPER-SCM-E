<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanPemilik extends Model
{
    use HasFactory;
    protected $table = 'penjualan_pemilik';
    protected $guarded =[];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualanPemilik::class, 'id_penjualan');
    }
}
