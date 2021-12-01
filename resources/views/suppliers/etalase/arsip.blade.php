@extends('suppliers.layouts.main')
@section('container')
    <div class="m-0">
        <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
            <h4><a href="/supplier/produk" class="text-decoration-none text-black">Produk</a> / Arsip</h4>
        </div>

        <div class="container-fluid mt-3 pt-2 ms-0 p-0">
            <div class="d-flex justify-content-end">
                <a href="/supplier/etalase" class="bg-warning rounded py-1 px-3 mx-2 text-decoration-none text-white">Etalase</a>
                <a href="/supplier/arsip" class="bg-warning rounded py-1 px-3 mx-2 text-decoration-none text-black">Arsip</a>
            </div>
        </div>

        <!--Card-->
        <div class="row">
            @if($produks->count())
                @foreach($produks as $produk)
                    <div class="col-3">
                        <div class="card" >
                            <div class="col">
                                <a href="/supplier/produk/{{ $produk->id }}/edit" class="text-decoration-none" style="color: black">
                                    <img class="card-img-top" src="{{ asset('/storage/' . $produk->image) }}">
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                                <div class="card-text">
                                    <table>
                                        <tr>
                                            <td>Rp. </td>
                                            <td class="px-2">{{ number_format($produk->harga) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Stok</td>
                                            <td class="px-2">{{ $produk->stok }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col mt-3">
                    <div class="card">
                        <div class="card-body align-center bg-light">
                            <h6 class="card-title text-center">Tidak Ada Produk di Arsip</h6>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
