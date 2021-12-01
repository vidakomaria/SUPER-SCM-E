<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\ProdukPemilik;
use Illuminate\Http\Request;

class ProdukPemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = ProdukPemilik::all();
        return view('pemilik.produk.index', [
            'produks'   => $produk,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pemilik.produk.create', [
            'categories'    => KategoriProduk::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_produk'   => 'required|alpha',
            'harga'         => 'required|numeric|min:1',
            'stok'          => 'required|numeric|min:1',
            'id_kategori'   => 'required',
        ];
        $validatedData = $request->validate($rules);
        ProdukPemilik::create($validatedData);

        return redirect('/pemilik/produk')->with('success', 'Produk Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProdukPemilik  $produkPemilik
     * @return \Illuminate\Http\Response
     */
    public function show(ProdukPemilik $produkPemilik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProdukPemilik  $produkPemilik
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdukPemilik $produkPemilik)
    {
        dd($produkPemilik->id);
        return view('pemilik.produk.edit',[
            'produk'        => $produkPemilik,
            'categories'    => KategoriProduk::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProdukPemilik  $produkPemilik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdukPemilik $produkPemilik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProdukPemilik  $produkPemilik
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdukPemilik $produkPemilik)
    {
        //
    }
}
