@extends('layouts.main')
@section('container')
    <div class="m-0">
        <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
            <h4><a class="text-decoration-none text-black" href="/supplier/produk">Produk</a> / Detail Produk</h4>
        </div>

        <div class="container-fluid ms-0 ps-0 mt-3 pt-2">
            <!--Detail Produk-->
            <a href="{{ url()->previous() }}" class="btn btn-add mb-3">Kembali</a>
            <form method="post" action="/supplier/produk/{{ $produk->id }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card mb-3 ">
                    <div class="row g-0">
                        <div class="col-md-4 p-3 py-4">
                            <input type="hidden" name="oldImage" value="{{ $produk->image }}">
                            @if($produk->image)
                                <img src="{{ asset('/storage/' . $produk->image) }}" class="img-preview img-fluid">
{{--                                <img src="{{ asset('/storage/' . $produk->image) }}" class="img-preview img-fluid rounded-start">--}}
                            @else
                                <img class="img-preview img-fluid">
                            @endif

                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" onchange="previewImage()">
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <th scope="row" class="">
                                            <label for="nama_produk" class="form-label">Nama Produk</label>
                                        </th>
                                        <td class="px-3">:</td>
                                        <td class="py-2">
                                            <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                                                   name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}">
                                            @error('nama_produk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="pb-2">
                                            <label for="id_kategori" class="form-label">Kategori</label>
                                        </th>
                                        <td class="px-3 pb-2">:</td>
                                        <td class="pb-2">
                                            <select class="form-select @error('id_kategori') is-invalid @enderror" name="id_kategori">
                                                <option value="">Pilih Kategori</option>
                                                @foreach($categories as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ ucwords($kategori->kategori) }}</option>
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
                                        <th scope="row" class="pb-2">
                                            <label for="harga" class="form-label">Harga</label>
                                        </th>
                                        <td class="px-3 pb-2">:</td>
                                        <td class="pb-2">
                                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                                       name="harga" value="{{ $produk->harga }}">
                                            @error('harga')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="pb-2">Stok</th>
                                        <td class="px-3 pb-2">:</td>
                                        <td class="pb-2">
                                            <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                                   name="stok" value="{{ $produk->stok }}">
                                            @error('stok')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="pb-2">Status</th>
                                        <td class="px-3 pb-2">:</td>
                                        <td class="pb-2">
                                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                                <option value="">Pilih Status</option>
                                                @if($produk->status == 'arsip')
                                                    <option value="{{ $produk->status }}" selected>{{ ucfirst($produk->status) }}</option>
                                                    <option value="tampil">Tampil</option>
                                                @elseif($produk->status == 'tampil')
                                                    <option value="{{ $produk->status }}" selected>{{ ucfirst($produk->status) }}</option>
                                                    <option value="arsip">Arsip</option>
                                                @endif

                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Deskripsi</th>
                                        <td class="px-3">:</td>
                                        <td>
                                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                                      placeholder="Deskripsi Produk">{{ $produk->deskripsi }}
                                            </textarea>
                                            @error('deskripsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="d-flex bd-highlight">
                                <div class="p-2 flex-fill bd-highlight"><button type="submit" class="btn btn-add">Simpan</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
