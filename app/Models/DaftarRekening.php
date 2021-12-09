<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarRekening extends Model
{
    use HasFactory;
    protected $table = 'daftar_rekening';
    protected $guarded =[];

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
