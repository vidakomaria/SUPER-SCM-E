@extends('pemilik.layouts.main')

@section('container')
    <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
        <a href="/pemilik/pesanan" class="text-decoration-none text-black"><h4>Pesanan</h4></a>
    </div>

    <!--Card-->
    <livewire:pemilik.pesanan-index>

    </livewire:pemilik.pesan-index>

@endsection

