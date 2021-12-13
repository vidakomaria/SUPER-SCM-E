@extends('Layouts.nota')
@section('container')
    <div class="border bg-white mt-2">
        <div class="text-center mb-4">
            <div style="font-weight: bold">MRACANG MARKET</div>
            Jl. Kalisari Timur Gg 2B No.Kav.7, <br> Kota SBY, Jawa Timur 60112
        </div>
        <div>
            <table class="table table-borderless">
                <tr>
                    <td>Kasir</td>
                    <td>: {{ auth()->user()->nama }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>: {{ date('d/m/Y', strtotime($penjualan->tgl)) }}</td>
                </tr>
            </table>
        </div>
        <div>
            <table class="table table-borderless">
                <tr style="border-top:1px dashed; border-bottom:1px dashed">
                    <td >Nama</td>
                    <td class="text-center">qty</td>
                    <td class="text-center">Harga</td>
                    <td class="text-center">Total</td>
                </tr>
                @foreach(($penjualan->detailPenjualan) as $item )
                    <tr>
                        <td>{{ ucwords($item->produk->nama_produk) }}</td>
                        <td class="text-center">{{ $item->qty }}</td>
                        <td class="text-center">{{ number_format($item->produk->harga) }}</td>
                        <td class="text-center">{{ number_format($item->total) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div>
            <table class="table table-borderless">
                <tr style="border-top:1px dashed">
                    <td>Total</td>
                    <td>Rp. {{ number_format($penjualan->grand_total) }}</td>
                </tr>
                <tr>
                    <td>Tunai</td>
                    <td>Rp. {{ number_format($penjualan->bayar) }}</td>
                </tr>
                <tr style="border-bottom:1px dashed">
                    <td>Kembali</td>
                    <td>Rp. {{ number_format($penjualan->kembali) }}</td>
                </tr>
            </table>
        </div>
        <div class="text-center">TERIMA KASIH</div>
    </div>

   <script>
        window.print()
    </script>

@endsection
