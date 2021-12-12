<div>
    <form method="post" action="/pemilik/pesanan">
        @csrf
        <div class="container-fluid rounded-3 border my-2 pb-3">
            <div class="d-flex justify-content-between my-2 mx-0 p-0">
                <!-- produk -->
                <div class="col-5 me-0 pe-0">
                    <strong class="mt-2">Detail Produk <hr></strong>
                    <table>
                        @foreach($checkouts as $produk)
                            <tr>
                                <td class="col-3 py-2 px-1">
                                    <img src="{{ asset('/storage/' . $produk->produk->image) }}" class="img-fluid rounded-start" >
                                </td>
                                <td class="ps-2">
                                    <div class="row">
                                        <strong>{{ $produk->produk->nama_produk }}</strong>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">Kuantitas</div>
                                        <div class="col">{{ $produk->qty }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">Sub Total</div>
                                        <div class="col">{{ $produk->subTotal }}</div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="row bg-light p-2 my-2">
                        <div class="col fw-bold">Total Pesanan</div>
                        <div class="col fw-bold">Rp. {{ number_format($checkouts->sum('subTotal')) }}</div>
                    </div>
                </div>
                <div class="vr p-0 m-0"></div>

                <!-- Pemesanan -->
                <div class="col-5 me-0 pe-0">
                    <strong class="mt-2">Detail Pemesanan <hr></strong>
                    <table>
                        <tr>
                            <td><strong>Supplier</strong></td>
                            <td class="px-1">:</td>
                            <td class="pb-2">{{ $checkouts[0]->supplier->nama }}</td>
                        </tr>
                        <tr>
                            <td><strong>Pilih Pengiriman</strong></td>
                            <td class="px-1">:</td>
                            <td class="py-2">
                                <select wire:model="pengiriman" name="pengiriman" class = "form-select  @error('pengiriman') is-invalid @enderror">
                                    <option value="">Pilih Pengiriman</option>
                                    @foreach($opsiPengiriman as $opsiPengiriman)
                                        @if(old('pengiriman') == $opsiPengiriman->id)
                                            <option value="{{ $opsiPengiriman->id }}" selected>{{ ucwords($opsiPengiriman->pengiriman) }}</option>
                                        @else
                                            <option value="{{ $opsiPengiriman->id }}">{{ ucwords($opsiPengiriman->pengiriman) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('pengiriman')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Catatan</strong></td>
                            <td class="px-1">:</td>
                            <td class="py-2">
                                <textarea name="catatan" class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if($pengiriman == 2)
                                    <strong>Alamat Pengiriman</strong>
                                @elseif($pengiriman == 1)
                                    <strong>Alamat Pengambilan</strong>
                                @else
                                    <strong>Alamat</strong>
                                @endif
                            </td>
                            <td class="px-1">:</td>
                            <td class="py-2">
                                @if($pengiriman == 2)
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ auth()->user()->alamat }}</textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                @elseif($pengiriman == 1)
                                    <p class="fw-lighter fst-italic m-0 p-0">*Alamat Pengambilan akan diinformasikan oleh Supplier</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Biaya Pengiriman</strong></td>
                            <td class="px-1">:</td>
                            <td class="py-2">
                                @if($pengiriman == 2)
                                    <div class="col bg-light p-2 mx-1">
                                        <p class="fw-lighter fst-italic m-1 p-0">*Biaya pengiriman akan diinfokan oleh supplier*</p></div>
                                @else
                                    <div class="col">-</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Total Pembayaran</strong></td>
                            <td class="px-1">:</td>
                            <td class="py-2">
                                @if($pengiriman == 2)
                                    Rp. {{ number_format($checkouts->sum('subTotal')) }}
                                    <p class="fw-lighter fst-italic m-0 p-0 bg-light">*Total Pembayaran akan berubah sesuai dengan biaya pengiriman*</p>
                                @else
                                    Rp. {{ number_format($checkouts->sum('subTotal')) }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalPesan">
            Pesan
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalPesan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">Yakin untuk melakukan pemesanan?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Pastikan semua data yang diinputkan sudah benar
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Iya</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
