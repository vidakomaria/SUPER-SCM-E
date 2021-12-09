<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\DetailPesanan;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\ProdukSupplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class PesananController2 extends Controller
{
    public function index()
    {
        return view('pemilik.pesanan.index');
    }

    public function create(Request $request)
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
                'grand_total'   => $checkout->sum('subTotal'),
                'total_produk'  => $checkout->count(),
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
                DetailPesanan::create([
                    'id_pesanan'    => $pesanan->id,
                    'id_produk'     => $produk->id_produk,
                    'qty'           => $produk->qty,
                    'subTotal'      => $produk->subTotal,
                ]);

                //update stok produk supplier
                $produkSupplier = ProdukSupplier::where('id', $produk->id_produk)->first();
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

    public function detail($id)
    {
        $pesanan = DetailPesanan::where('id_pesanan', $id)->get();
        if (auth()->user()->role == 'supplier')
            return view('supplier.pesanan.detail',[
                'pesanan'   => $pesanan,
            ]);
        elseif (auth()->user()->role == 'pemilik_toko'){
            return view('pemilik.pesanan.detail',[
                'pesanan'   => $pesanan,
            ]);
        }
    }

    public function supplierDaftarPesanan()
    {
        return view('suppliers.pesanan.index');
    }

    public function detailPesanan($id)
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

    public function updatePesanan()
    {
        dd('masuk sini');
    }
}
