@extends('layouts.main')
@section('container')
    <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
        <a href="/supplier/pesanan" class="text-decoration-none text-black">
            <h4>
                Daftar Pesanan</a>
                / Detail Pesanan</h4>
    </div>

    <div class="container-fluid mt-3 pt-2">
        <livewire:supplier.pesanan.detail-pesanan-index :idPesanan="$id">

        </livewire:supplier.pesanan.detail-pesanan-index>
    </div>

@endsection
