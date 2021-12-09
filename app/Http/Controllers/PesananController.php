<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
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
        foreach ($request->pengiriman as $key => $value) {
            // dd($key);
            $checkout   = Checkout::where('id_supplier', $key)->get();
            // dd($checkout->count(), $key);
            if ($value=='ambil sendiri'){
                $alamat = "";
            }
            elseif ($value=='diantar') {
                $alamat = $request->alamat;
            }

            $pesanan    = Pesanan::create([
                'tanggal'       => Carbon::now(),
                'id_pembeli'    => auth()->user()->id,
                'total_produk'  => $checkout->count(),
                'grand_total'   => $checkout->sum('subTotal'),
                'pengiriman'    => $value,
                'alamat'        => $alamat,
                'ongkir'        => 0,
                'pesan'         => '',
                'kodePengiriman'    =>'',
                'buktiPembayaran'   => '',
                'id_status_pesanan'     => 1,
                'id_supplier'   => $key,
            ]);
//             dd($checkout);

            foreach ($checkout as $produk) {
                $produkSupplier = ProdukSupplier::where('id', $produk->id_produk)->first();

                DetailPesanan::create([
                    'id_pesanan'    => $pesanan->id,
                    'id_produk'     => $produk->id_produk,
                    'qty'           => $produk->qty,
                    'harga'         => $produkSupplier->harga,
                    'total'         => $produk->qty * $produkSupplier->harga,
                ]);

                //update stok produk supplier
//                $produkSupplier = ProdukSupplier::where('id', $produk->id_produk)->first();
//                dd($produkSupplier);
                $stok = $produkSupplier->stok - $produk->qty;
                ProdukSupplier::where('id', $produk->id_produk)
                    ->update(['stok' => $stok]);
            }
        }

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
//        dd($request->oldImage);
        $validatedData = $request->validate([
            'buktiPembayaran'  => 'image|file|max:1024',
        ]);
        if ($request->file('buktiPembayaran')){
            Storage::delete($request->oldImage);
            //utk save img ke storage
            $validatedData['buktiPembayaran'] = $request->file('buktiPembayaran')->store('bukti-pembayaran');
        }
        $validatedData['id_status_pesanan'] = 3;
        Pesanan::where('id',$id)->update($validatedData);
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
