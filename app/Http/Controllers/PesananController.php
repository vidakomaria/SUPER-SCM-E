<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\DetailPembayaran;
use App\Models\DetailPengiriman;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\ProdukSupplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'pemilik_toko'){
            return view('pemilik.pesanan.index');
        }
        elseif (auth()->user()->role == 'supplier'){
            return view('suppliers.pesanan.index');
        }
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
//        dd($request->pengiriman);
        $rules['pengiriman'] = 'required';

//        if ($request->pengiriman = 2){
//            $rules['alamat'] = 'required';
//        }
        $request->validate($rules);

        $checkout   = Checkout::all();

        $newPesanan = [
            'tanggal'       => Carbon::now(),
            'id_pembeli'    => auth()->user()->id,
            'id_supplier'   => $checkout[0]->id_supplier,
            'jumlahProduk'  => $checkout->count(),
            'totalPesanan'  => $checkout->sum('subTotal'),
            'catatan'       => $request->catatan,
            'id_statusPesanan'     => 1,
        ];
        if ($request->catatan == null){
            $newPesanan['catatan']  = '';
        }
            $pesanan = Pesanan::create($newPesanan);
//        dd($newPesanan);

        foreach ($checkout as $produk) {
            $produkSupplier = ProdukSupplier::where('id', $produk->id_produk)->first();
            $newDetailPesanan = [
                'id_pesanan'    => $pesanan->id,
                'id_produk'     => $produk->id_produk,
                'qty'           => $produk->qty,
                'harga'         => $produkSupplier->harga,
            ];
            DetailPesanan::create($newDetailPesanan);
            //update stok produk supplier
            $stok = $produkSupplier->stok - $produk->qty;
            ProdukSupplier::where('id', $produk->id_produk)
                ->update(['stok' => $stok]);
        }

        //detail pengiriman
        $newDetailPengiriman =[
            'id_pesanan'        => $pesanan->id,
            'ongkir'            => 0,
            'kodePengiriman'    => '',
            'alamatPengiriman'  => '',
            'alamatPengambilan' => '',
            'id_pengiriman'     => $request->pengiriman,
        ];
        if ($request->pengiriman == 2){
            //diantar
            $newDetailPengiriman['alamatPengiriman']   = $request->alamat;
        }
        DetailPengiriman::create($newDetailPengiriman);

        //detail pembayaran
        $newDetailPembayaran =[
            'id_pesanan'        => $pesanan->id,
            'id_detailRekening' => null,
            'buktiPembayaran'   => '',
        ];
        DetailPembayaran::create($newDetailPembayaran);

        $checkoutAll = Checkout::all();
        if ($checkoutAll){
            Checkout::truncate();
        }
        return redirect('/pemilik/pesanan')->with('message', 'Produk dipesan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesanan = DetailPesanan::where('id_pesanan', $id)->get();
        $pesananAll = Pesanan::where('id',$id)->first();
        // dd($pesanan);
        if (auth()->user()->role == 'supplier'){
            return view('suppliers.pesanan.detail',[
                'pesanan' => $pesanan,
                'id'    => $id,
            ]);
        }
        elseif (auth()->user()->role == 'pemilik_toko'){
            return view('pemilik.pesanan.detail',[
                'id'            => $id,
                'pesanan'       => $pesanan,
                'pesananAll'    => $pesananAll,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pembayaran = DetailPembayaran::where('id_pesanan', $id)->first();
//        dd($request->buktiPembayaran);
        $validatedData = $request->validate([
            'buktiPembayaran'  => 'required|image|file|max:1024',
        ]);

        if ($request->oldImage){
            Storage::delete($request->oldImage);
        }
        if ($request->file('buktiPembayaran')){
            //utk save img ke storage
            $validatedData['buktiPembayaran'] = $request->file('buktiPembayaran')->store('bukti-pembayaran');
        }
        DetailPembayaran::where('id_pesanan', $id)->update($validatedData);

        $updateStatus  = ['id_statusPesanan' => 3];
        Pesanan::where('id',$id)->update($updateStatus);

        return redirect('/pemilik/pesanan/'.$id)->with('success', 'Bukti pembayaran berhasil diupload');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
