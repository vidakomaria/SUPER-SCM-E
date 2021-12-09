<?php

namespace Database\Seeders;

use App\Models\EtalaseSupplier;
use App\Models\ProdukSupplier;
use Illuminate\Database\Seeder;

class ProdukSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProdukSupplier::create([
            'nama_produk'   => 'Kangkung',
            'id_kategori'   => 1,
            'harga'         => 5000,
            'stok'          => 1000,
            'image'         => 'produk-suppliers/default.png',
            'status'        => 'tampil',
            'deskripsi'     => 'Harga per ikat',
            'id_supplier'   => 1,
            'terjual'       => 0,
        ]);
        ProdukSupplier::create([
            'nama_produk'   => 'Sawi',
            'id_kategori'   => 1,
            'harga'         => 6000,
            'stok'          => 1000,
            'image'         => 'produk-suppliers/default.png',
            'status'        => 'tampil',
            'deskripsi'     => 'Harga per ikat',
            'id_supplier'   => 1,
            'terjual'       => 0,
        ]);
        //Supplier 2
        ProdukSupplier::create([
            'nama_produk'   => 'Mangga',
            'id_kategori'   => 2,
            'harga'         => 15000,
            'stok'          => 200,
            'image'         => 'produk-suppliers/default.png',
            'status'        => 'tampil',
            'deskripsi'     => 'Harga per Kilogram',
            'id_supplier'   => 2,
            'terjual'       => 0,
        ]);
        ProdukSupplier::create([
            'nama_produk'   => 'Jeruk',
            'id_kategori'   => 2,
            'harga'         => 18000,
            'stok'          => 100,
            'image'         => 'produk-suppliers/default.png',
            'status'        => 'tampil',
            'deskripsi'     => 'Harga per Kilogram',
            'id_supplier'   => 2,
            'terjual'       => 0,
        ]);

        //etalase
        EtalaseSupplier::create([
            'id_produk'     => 1,
            'id_supplier'   => 1,
        ]);
        EtalaseSupplier::create([
            'id_produk'     => 2,
            'id_supplier'   => 1,
        ]);
        EtalaseSupplier::create([
            'id_produk'     => 3,
            'id_supplier'   => 2,
        ]);
        EtalaseSupplier::create([
            'id_produk'     => 4,
            'id_supplier'   => 2,
        ]);
    }
}
