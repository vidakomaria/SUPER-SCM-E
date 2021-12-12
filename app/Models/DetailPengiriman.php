<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengiriman extends Model
{
    use HasFactory;
    protected $table = 'detail_pengiriman';
    protected  $guarded =  [];

    public function metodePengiriman(){
        return $this->belongsTo(Pengiriman::class, 'id_pengiriman');
    }
}
