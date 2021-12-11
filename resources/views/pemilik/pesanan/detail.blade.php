@extends('layouts.main')
@section('container')
    <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
        <a href="/supplier/pesanan" class="text-decoration-none text-black">
            <h4>
                Daftar Pesanan</a>
        / Detail Pesanan</h4>
    </div>

    <div class="pb-5">
        <livewire:pemilik.pesanan.pesanan-detail :idPesanan="$id">

        </livewire:pemilik.pesanan.pesanan-detail>
    </div>
@endsection
