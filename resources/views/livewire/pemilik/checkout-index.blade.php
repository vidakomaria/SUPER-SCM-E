<div>
    <form method="post" action="/pemilik/pesanan">
        @csrf
        @foreach($checkouts as $data)
            @php
                $totalSup = 0
            @endphp
            <div class="card mb-3 p-2">
                <h6 class="card-title">{{ $data[0]->supplier->nama }}</h6>
                @foreach($data as $produk)
                    <div class="row g-0 border my-1">
                        <div class="col-1 align-self-center mx-1 me-3">
                            <img src="{{ asset('/storage/' . $produk->produk->image) }}" class="img-fluid rounded-start" >
                        </div>
                        <div class="col-md-8 m-2">
                            <div class="row"><h6>{{ ucwords($produk->produk->nama_produk) }}</h6></div>
                            <div class="row mt-2">
                                <div class="col-2">Harga</div>
                                <div class="col">Rp. {{ number_format($produk->produk->harga) }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-2">Kuantitas</div>
                                <div class="col">{{ $produk->qty }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-2">Sub Total</div>
                                <div class="col">{{ $produk->subTotal }}</div>
                            </div>
                        </div>
                        @php
                            $totalSup = $totalSup + $produk->subTotal
                        @endphp
                    </div>
                @endforeach
                <div class="row mt-2">
                    <div class="col-3">Pilih Pengiriman</div>
                    <div class="col">
                        <select wire:model="pengiriman" name="pengiriman[{{ $produk->id_supplier }}]" class = "form-select  @error('pengiriman') is-invalid @enderror">
                            <option value="">Pilih Pengiriman</option>
                            <option value="ambil sendiri">Ambil Sendiri</option>
                            <option value="diantar">Diantar</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">Alamat</div>
                    <div class="col">
                        @if($pengiriman == "diantar")
                            <textarea class="form-control" name="alamat">{{ auth()->user()->alamat }}</textarea>
                        @else
                            <textarea class="form-control" disabled>-</textarea>
                        @endif
                    </div>
                </div>
                <div class=" col-8 g-0 border my-2 px-2">
                    <div class="row">
                        <div class="col-4 me-4 py-2">Total Pesanan</div>
                        <div class="col py-2">Rp. {{ number_format($totalSup) }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 me-4 py-2">Biaya ongkir</div>
                        @if($pengiriman == 'diantar')
                            <div class="col bg-light p-2 mx-1">*Biaya pengiriman akan diinfokan oleh supplier*</div>
                        @else
                            <div class="col">-</div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-4 me-4 py-2">Total Pembayaran</div>
                        <div class="col py-2">Rp. {{ number_format($totalSup) }}</div>
                    </div>
                    <div class="row">
                        @if($pengiriman == 'diantar')
                            <div class="col p-2 bg-light mx-1">*Total Pembayaran akan berubah sesuai biaya ongkir dari supplier*</div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row g-0 border my-1 p-2">
            <div class="col-2 me-4"><strong>Total</strong></div>
            <div class="col"><strong>Rp. {{ number_format($produk->sum('subTotal')) }}</strong></div>
        </div>
{{--        <button type="submit">Pesan</button>--}}

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPesan">
            Pesan
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalPesan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">Konfirmasi Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin untuk melakukan pemesanan?
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
