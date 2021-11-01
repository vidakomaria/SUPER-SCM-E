<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = [
            'sayuran','buah','daging','telur',
            'ikan','kerupuk','minuman','frozen food'
        ];
        foreach ($kategori as $value){
            KategoriProduk::create([
                'kategori' => $value
            ]);
        }
    }
}
