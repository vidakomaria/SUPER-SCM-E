<?php

namespace Database\Seeders;

use App\Models\Pengiriman;
use Illuminate\Database\Seeder;

class PengirimanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Pengiriman::create([
            'pengiriman'    => 'ambil sendiri'
        ]);
        Pengiriman::create([
            'pengiriman'    => 'diantar'
        ]);
    }
}
