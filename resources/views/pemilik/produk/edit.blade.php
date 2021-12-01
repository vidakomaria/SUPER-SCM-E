@extends('pemilik.layouts.main')
@section('container')
    <div class="m-0">
        <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
            <h4><a class="text-decoration-none text-black" href="/pemilik/produk">Produk</a> / Tambah Data</h4>
        </div>

        <div class="container-fluid mt-3 pt-2">
            <!--Add Produk-->
            <div class="container-fluid rounded-3 border mt-2">
                <form method="post" action="/pemilik/produk/{{ $produk->id }}">
                    @csrf
                    <table class="table table-borderless w-75">
                        <tr>
                            <td class="pe-5 py-2">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                            </td>
                            <td class="">
                                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                                       name="nama_produk" value="{{ old('nama_produk'), $produk->nama_produk }}">
                                @error('nama_produk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2">
                                <label for="id_kategori" class="form-label">Kategori</label>
                            </td>
                            <td>
                                <select class="form-select my-3 @error('id_kategori') is-invalid @enderror" name="id_kategori">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $kategori)
                                        @if($kategori->id == old('id_kategori'))
                                            <option value="{{ $kategori->id }}" selected>{{ ucwords($kategori->kategori) }}</option>
                                        @else
                                            <option value="{{ $kategori->id }}">{{ ucwords($kategori->kategori) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2">
                                <label for="harga" class="form-label">Harga</label>
                            </td>
                            <td>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                       name="harga" value="{{ old('harga'), $produk->harga }}">
                                @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="stok" class="form-label">Stok</label>
                            </td>
                            <td class="py-2">
                                <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok"
                                       value="{{ old('stok'), $produk->stok }}">
                                @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="justify-content-start">
                                <a href="/pemilik/produk" class="btn btn-add">Kembali</a>
                            </td>
                            <td class="pt-4 pb-2 d-grid gap-2 d-md-flex justify-content-end">
                                <button class="btn btn-add">Simpan</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
