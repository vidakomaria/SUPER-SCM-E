@extends('layouts.main')
@section('container')
    <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
        <a href="/supplier/pesanan" class="text-decoration-none text-black">
            <h4>
                Daftar Pesanan</a>
        / Detail Pesanan</h4>
    </div>

    <div class="container-fluid mt-3 pt-2">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!--Detail Produk-->
        <div class="container-fluid rounded-3 border mt-2">
            <div class="d-flex justify-content-between my-2">
                <!-- produk -->
                <div class="col">
                    <!--Tabel detail produk-->
                    <strong class="mt-2">Detail Produk <hr></strong>
                    <div class="row table-responsive m-1 justify-content-center">
                        <table class="table table-borderless text-center">
                            <thead>
                            <tr>
                                <th scope="col" class="col-1">No</th>
                                <th scope="col" class="col-4">Produk</th>
                                <th scope="col" class="col-2">Kuantitas</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pesanan as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->produk->nama_produk }}</td>
                                    <td>{{ $value->qty }}</td>
                                </tr>
                            @endforeach
                            <tr class="bg-light">
                                <td colspan="3" class="text-start pe-3">
                                    <div class="row">
                                        <div class="col-3">
                                            <strong>Total Pesanan</strong>
                                        </div>
                                        <div class="col">
                                            <strong>: Rp. {{ number_format($pesanan->sum('subTotal')) }}</strong>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-light">
                                <td colspan="3" class="text-start pe-3">
                                    <div class="row">
                                        <div class="col-3">
                                            <strong>Total Pembayaran</strong>
                                        </div>
                                        <div class="col">
                                            <strong>: Rp. {{ number_format($pesananAll->grand_total + $pesananAll->ongkir) }}</strong>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @if($pesananAll->pengiriman == "diantar")
                        <div class="row ms-0 col-8">
                            <strong class="mt-2 mb-2">Alamat Pengiriman</strong>
                            <textarea class="form-control bg-white" disabled>{{ $pesananAll->alamat }}</textarea>
                        </div>
                    @endif
                    <div class="row m-2">
                        Bukti Pembayaran
                        <form method="post" action="/pemilik/pesanan/{{ $id }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="col-6">
                                <input type="hidden" name="oldImage" value="{{ $pesananAll->buktiPembayaran }}">
                                @if($pesananAll->buktiPembayaran)
                                    <img src="{{ asset('/storage/' . $pesananAll->buktiPembayaran) }}" class="img-preview img-fluid">
                                    {{--                                <img src="{{ asset('/storage/' . $produk->image) }}" class="img-preview img-fluid rounded-start">--}}
                                @else
                                    <img class="img-preview img-fluid">
                                @endif

                                <input type="file" class="form-control mt-2 @error('buktiPembayaran') is-invalid @enderror"
                                       id="image" name="buktiPembayaran" onchange="previewImage()">

                                @error('buktiPembayaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <button type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!--col Kanan-->

                <!--End col kanan-->
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
