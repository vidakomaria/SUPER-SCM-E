<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use App\Models\ProdukSupplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            KategoriProdukSeeder::class,
            UserSeeder::class,
            ProdukSupplierSeeder::class,
            StatusPesananSeeder::class,
            PengirimanSeeder::class,
        ]);
    }
}
