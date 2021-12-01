<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama'   => 'Pedagang Sayur',
            'email'     => 'supplier_sayur@gmail.com',
            'tmptLahir' => 'Jember',
            'tglLahir'  => '1990-11-01',
            'noTelp'    => '081234567890',
            'alamat'    => 'Jl. Kalimantan 5A',
            'username'  => 'supplier1',
            'password'  => bcrypt(12345),
            'role'      => 'supplier'
        ]);

        User::create([
            'nama'   => 'Pedagang Buah',
            'email'     => 'supplier_buah@gmail.com',
            'tmptLahir' => 'Surabaya',
            'tglLahir'  => '1995-01-20',
            'noTelp'    => '081234567892',
            'alamat'    => 'Jl. Merdeka 12',
            'username'  => 'supplier2',
            'password'  => bcrypt(12345),
            'role'      => 'supplier'
        ]);

        User::create([
            'nama'      => 'Pemilik Toko',
            'email'     => 'mracangMarket@gmail.com',
            'tmptLahir' => 'Surabaya',
            'tglLahir'  => '1991-12-14',
            'noTelp'    => '081234567893',
            'alamat'    => 'Jl. Kalisari Timur Gg 2B No.Kav.7, RT.002/RW.05, Kalisari, Kec. Mulyorejo, Kota SBY, Jawa Timur 60112',
            'username'  => 'owner1',
            'password'  => bcrypt(12345),
            'role'      => 'pemilik_toko'
        ]);
    }
}
