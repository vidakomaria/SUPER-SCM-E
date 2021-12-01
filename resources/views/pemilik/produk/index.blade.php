@extends('pemilik.layouts.main')

@section('container')
    <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
        <h4>Produk</h4>
    </div>
    @if(session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container-fluid mt-3 pt-2 ms-0 ps-0">
        <div class="d-flex bd-highlight">
            <div class="flex-grow-1 bd-highlight">
                <a href="/pemilik/produk/create"><button class="btn btn-add">Tambah Data</button></a>
            </div>
        </div>

        <!--Table Produk-->
        <div class="mt-3 border rounded">
            <table class="table table-striped table-borderless table-hover">
                <thead>
                <tr>
                    <th scope="col" class="col-1">No</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($produks as $produk)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $produk->nama_produk }}</td>
                        <td>{{ $produk->harga }}</td>
                        <td>{{ $produk->stok }}</td>
                        <td>{{ $produk->kategori->kategori }}</td>
                        <td>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <a href="/pemilik/produk/{{ $produk->id }}/edit" class="bg-info rounded p-1 px-2 text-white">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <form method="post" action="/pemilik/produk/{{ $produk->id }}">
                                        @method('delete')
                                        @csrf
                                        <button class="bg-danger rounded p-1 px-2 mt-0 pt-0 text-white" style="border: none"
                                                onclick="return confirm('Yakin Menghapus Produk?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
