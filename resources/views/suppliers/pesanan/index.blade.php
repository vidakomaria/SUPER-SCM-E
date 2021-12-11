@extends('layouts.main')
@section('container')
    <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
        <a href="/supplier/pesanan" class="text-decoration-none text-black">
            <h4>Daftar Pesanan</h4>
        </a>
    </div>

    <!--Card-->
    <livewire:supplier.pesanan.pesanan-index>

    </livewire:supplier.pesanan.pesanan-index>
@endsection
