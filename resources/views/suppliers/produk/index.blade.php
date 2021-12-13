@extends('layouts.main')
@section('container')
    <div class="m-0">
        <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
            <h4>Produk</h4>
        </div>

        <div class="container-fluid pt-2 ms-0 ps-0">
        <livewire:supplier.produk-index></livewire:supplier.produk-index>

        </div>
    </div>
@endsection
