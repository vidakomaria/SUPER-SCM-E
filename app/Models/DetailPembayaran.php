<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaran extends Model
{
    use HasFactory;
    protected $table = 'detail_pembayaran';
    protected $guarded = [];

    public function rekening(){
        return $this->belongsTo(Rekening::class, 'id_detailRekening');
    }
}
