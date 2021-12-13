@extends('layouts.main')
@section('container')
    <div class="m-0">
        <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
            <h4><a class="text-decoration-none text-black" href="/pemilik/pasar">Pasar</a> / Detail Produk</h4>
        </div>

        <div class="d-flex bd-highlight pt-2 pe-3">
            <div class="p-2 flex-grow-1 bd-highlight">
                <a href="/pemilik/pasar" class="btn btn-add mb-3">Kembali</a>
                @if(session()->has('success'))
                    <div class="alert alert-secondary col-lg-8" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="p-2 bd-highlight">
                <a href="/pemilik/keranjang" class="btn btn-primary position-relative">
                    <i class="bi bi-cart4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $keranjang->count() }}</span>
                </a>
            </div>
        </div>

        <!--Isi Market-->
        <div class="card mb-3 ">
            <div class="row g-0">
                <div class="col-md-4 p-3 py-4">
                    <img src="{{ asset('/storage/' . $produk->produk->image) }}" class="img-preview img-fluid">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row"><h3>{{ ucwords($produk->produk->nama_produk) }}</h3></div>
                        <div class="row">
                            <div class="col-2">Terjual</div>
                            <div class="col">{{ number_format($produk->produk->terjual) }}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-2">Harga</div>
                            <div class="col"><h5>Rp. {{ number_format($produk->produk->harga) }}</h5></div>
                        </div>
                        <form method="post" action="/pemilik/keranjang">
                            @csrf
                            <input type="hidden" name="id" value="{{ $produk->id_produk }}">
                            <input type="hidden" name="id_supplier" value="{{ $produk->id_supplier }}">
                            <div class="row mt-2">
                                <div class="col-2">Kuantitas</div>
                                <div class="col-4">
                                    <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror">
                                    @error('qty')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex bd-highlight">
                                <div class="pt-3 flex-fill bd-highlight">
                                    <button type="submit" class="btn btn-add"><i class="bi bi-cart4 me-2"></i>Masukkan Keranjang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <div class="d-flex mx-3 p-2 px-3 bd-highlight bg-light"><h5>Deskripsi</h5></div>
                <div class="row g-0 mx-3 ps-3 pe-5 pb-3">Toko {{ $produk->supplier->nama }}</div>
                <div class="row g-0 mx-3 ps-3 pe-5 pb-3">{{ ucfirst($produk->produk->deskripsi) }}</div>
            </div>
        </div>
    </div>


@endsection
