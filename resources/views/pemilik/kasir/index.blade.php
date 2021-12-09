@extends('layouts.main')
@section('container')
    <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
        <a href="/pemilik/kasir" class="text-decoration-none text-black"><h4>Kasir</h4></a>
    </div>

    <!--Card-->
    <livewire:kasir-index>

    </livewire:kasir-index>
@endsection
