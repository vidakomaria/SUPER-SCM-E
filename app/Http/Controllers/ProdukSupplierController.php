<?php

namespace App\Http\Controllers;

use App\Models\EtalaseSupplier;
use App\Models\KategoriProduk;
use App\Models\Keranjang;
use App\Models\ProdukSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = ProdukSupplier::with('kategori')
            ->where('id_supplier',auth()->user()->id)->get();
        return view('suppliers.produk.index',[
            'produks' => $produk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.produk.create',[
            'categories' => KategoriProduk::all()
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
        $validatedData = $request->validate([
            'nama_produk'    => 'required',
            'id_kategori'   => 'required',
            'harga'         => 'required',
            'stok'          => 'required',
            'image'         => 'image|file|max:1024',
            'status'        => 'required',
            'deskripsi'     => 'required',
        ]);

        if ($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('produk-suppliers');
        }
        else {
            $validatedData['image'] = "produk-suppliers/default.png";
        }

        $validatedData["id_kategori"]   = $request->id_kategori;
        $validatedData['id_supplier']   = auth()->user()->id;

        ProdukSupplier::create($validatedData);

        $produk = ProdukSupplier::latest()->first();

        if($validatedData["status"] == 'tampil'){
            $etalase = [
                'id_produk'     => $produk['id'],
                'id_supplier'   => $produk['id_supplier']
            ];
            EtalaseSupplier::create($etalase);
        }

        return redirect('/supplier/produk')->with('success', 'Produk Berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProdukSupplier $produk
     * @return \Illuminate\Http\Response
     */
    public function show(ProdukSupplier $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProdukSupplier $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdukSupplier $produk)
    {
        $category = KategoriProduk::all();
        return view('suppliers.produk.edit',[
            'produk'        => $produk,
            'categories'    => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProdukSupplier  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdukSupplier $produk)
    {
        $validatedData = $request->validate([
            'nama_produk'    => 'required',
            'id_kategori'   => 'required',
            'harga'         => 'required',
            'stok'          => 'required',
            'image'         => 'image|file|max:1024',
            'status'        => 'required',
            'deskripsi'     => 'required',
        ]);

        if ($request->file('image')){
            if ($request->oldImage != "produk-suppliers/default.png"){
                Storage::delete($request->oldImage);
            }
            //utk save img ke storage
            $validatedData['image'] = $request->file('image')->store('produk-suppliers');
        }

        $validatedData["id_kategori"]   = $request->id_kategori;
        $validatedData['id_supplier']   = auth()->user()->id;

        $etalase = [
            'id_produk'     => $produk['id'],
            'id_supplier'   => $validatedData['id_supplier'],
        ];

        if ($produk->status == 'arsip'){
            if($validatedData['status'] == 'tampil'){
                EtalaseSupplier::create($etalase);
            }
        }
        elseif ($produk->status == 'tampil'){
            if($validatedData['status'] == 'arsip'){
                EtalaseSupplier::where('id_produk',$produk->id)->delete();
            }
        }
        ProdukSupplier::where('id', $produk->id)
            ->update($validatedData);

        return redirect('/supplier/produk')->with('success', 'Produk Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProdukSupplier  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdukSupplier $produk)
    {
        if ($produk->image != "produk-suppliers/default.png"){
            Storage::delete($produk->image);
        }

        EtalaseSupplier::destroy('id_produk', $produk->id);
        Keranjang::destroy('id_produk', $produk->id);
        ProdukSupplier::destroy($produk->id);
        return redirect('/supplier/produk')->with('success', 'Produk dihapus');
    }


}
