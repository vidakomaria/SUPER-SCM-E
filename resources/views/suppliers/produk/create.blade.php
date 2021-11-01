@extends('suppliers.layouts.main')
@section('container')
    <div class="m-0">
        <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
            <h4><a class="text-decoration-none text-black" href="/supplier/produk">Produk</a> / Tambah Data</h4>
        </div>

        <div class="container-fluid mt-3 pt-2">
            <!--Add Produk-->
            <div class="container-fluid rounded-3 border mt-2">
                <form method="post" action="/supplier/produk" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-borderless w-75">
                        <tr>
                            <td class="pe-5 py-2">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                            </td>
                            <td class="">
                                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                                       name="nama_produk" value="{{ old('nama_produk') }}">
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
                                        @if(old('id_kategori') == $kategori->id)
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
                                <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}">
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
                                <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok') }}">
                                @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="status" class="form-label">Status</label>
                            </td>
                            <td class="py-2">
                                <select class="form-select my-3 @error('status') is-invalid @enderror" name="status">
                                    <option value="">Pilih Status</option>
                                    <option value="arsip">Arsipkan</option>
                                    <option value="tampil">Tampilkan</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="image" class="form-label">Gambar</label>
                            </td>
                            <td>
                                <img class="img-preview img-fluid mb-3 col-md-4 p-3 py-4">
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" value="{{ old('image') }}" onchange="previewImage()">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="deskripsi" class="form-label ">Deskripsi</label>
                            </td>
                            <td class="py-2">
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi Produk">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="justify-content-start">
                                <a href="/supplier/produk" class="btn btn-add">Kembali</a>
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
