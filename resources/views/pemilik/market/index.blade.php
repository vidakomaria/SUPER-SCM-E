@extends('pemilik.layouts.main')

@section('container')
    <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
        <h4>Pasar</h4>
    </div>
    @if(session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!--Card-->
    <div class="row mt-3">
        @foreach($etalase as $produk)
            <div class="col-3">
                <div class="card" >
                    <div class="col">
                        <a href="/pemilik/produk/{{ $produk->produk->id }}/edit" class="text-decoration-none" style="color: black">
                            <img class="card-img-top" src="{{ asset('/storage/' . $produk->produk->image) }}">
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="d-flex bd-highlight">
                            <div class="flex-grow-1 bd-highlight"><h5 class="card-title">{{ $produk->produk->nama_produk }}</h5></div>
                            <div class="bd-highlight">
                                <a href="#" class="text-decoration-none" style="color: black">
                                    <div class="bg-info mx-2 py-1 px-2 rounded d-inline">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card-text m-2">
                            <div class="row">Rp. {{ number_format($produk->produk->harga) }}</div>

                            <div class="row">Stok  : {{ $produk->produk->stok }}</div>

                            <div class="row align-middle justify-content-end">
                                <div class="col mt-1">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

