<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $guarded = [];

    public function pembeli(){
        return $this->belongsTo(User::class, 'id_pembeli');
    }

    public function supplier(){
        return $this->belongsTo(User::class, 'id_supplier');
    }

    public function status(){
        return $this->belongsTo(StatusPesanan::class, 'id_status_pesanan');
    }

    public function detail(){
        return $this->belongsTo(DetailPesanan::class, 'id','id_pesanan');
    }
}
