<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\ProdukSupplier;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjang = Keranjang::where('id_pembeli', auth()->user()->id)->get();

        return view('pemilik.keranjang.index',[
            'keranjang'     => $keranjang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
          'qty' => 'required|numeric|min:1'
        ];
        $keranjang = Keranjang::where('id_pembeli',auth()->user()->id)
            ->where('id_produk', $request->id)
            ->first();

        $validatedData = $request->validate($rules);

        $produk = ProdukSupplier::where('id', $request->id)->first();

        $validatedData=[
            'id_produk'     => $request->id,
            'id_pembeli'    => auth()->user()->id,
            'qty'           => $request->qty,
            'id_supplier'   => $request->id_supplier,
            'subTotal'      => $validatedData['qty'] * $produk->harga,
        ];

        if ($keranjang){
            $update = $validatedData;
            // $update['qty'] = $keranjang->qty + $validatedData['qty'];
            Keranjang::where('id_produk',$validatedData['id_produk'])
                ->update($update);
        }
        else {
            Keranjang::create($validatedData);
        }

        return redirect()->back()-> with('success','Produk ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keranjang $keranjang)
    {
        //
    }
}
