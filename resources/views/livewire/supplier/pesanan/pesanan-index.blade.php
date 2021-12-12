<div>
    <div class="container mt-3 mx-0 px-0">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- status pesanan -->
        <div class="mb-2 d-flex justify-content-between my-2 mx-2">
            <button type="button" wire:click="status('all')" class="btn px-1 mx-0 rounded-pill
                @if($status == 'all') text-info @endif">
                Semua <span class="badge rounded-pill bg-primary">{{ $countPesanan["all"] }}</span>
            </button>
            <button type="button" wire:click="status(1)" class="btn  mx-0 px-1 rounded-pill
                @if($status == 1) text-info @endif">
                Belum Dikonfirmasi <span class="badge rounded-pill bg-primary">{{ $countPesanan["menunggu konfirmasi"] }}</span>
            </button>
            <button type="button" wire:click="status(2)" class="btn px-1 mx-0 rounded-pill
                @if($status == 2) text-info @endif">
                Belum Bayar <span class="badge rounded-pill bg-primary">{{ $countPesanan["belum bayar"] }}</span>
            </button>
            <button type="button" wire:click="status(3)" class="btn px-1 mx-0 rounded-pill col-2
                @if($status == 3) text-info @endif">
                Menunggu Konfirmasi Pembayaran <span class="badge rounded-pill bg-primary">{{ $countPesanan["menunggu konfirmasi pembayaran"] }}</span>
            </button>
            <button type="button" wire:click="status(8)" class="btn px-1 mx-0 rounded-pill
                @if($status == 8) text-info @endif">
                Pembayaran Ditolak <span class="badge rounded-pill bg-primary">{{ $countPesanan["pembayaran ditolak"] }}</span>
            </button>
            <button type="button" wire:click="status(4)" class="btn px-1 mx-0 rounded-pill
                @if($status == 4) text-info @endif">
                Dikemas <span class="badge rounded-pill bg-primary">{{ $countPesanan["diproses"] }}</span>
            </button>
            <button type="button" wire:click="status(5)" class="btn px-1 mx-0 rounded-pill
                @if($status == 5) text-info @endif">
                Dikirim <span class="badge rounded-pill bg-primary">{{ $countPesanan["dikirim"] }}</span>
            </button>
            <button type="button" wire:click="status(6)" class="btn px-1 mx-0 rounded-pill
                @if($status == 6) text-info @endif">
                Selesai <span class="badge rounded-pill bg-primary">{{ $countPesanan["selesai"] }}</span>
            </button>
            <button type="button" wire:click="status(7)" class="btn px-1 mx-0 rounded-pill
                @if($status == 7) text-info @endif">
                Dibatalkan <span class="badge rounded-pill bg-primary">{{ $countPesanan["dibatalkan"] }}</span>
            </button>
        </div>

        <!-- Isi pesanan -->
        @if($pesanan->count())
            @foreach($pesanan as $pesanan)
                <div class="card mb-3 p-2">
                    <h6 class="card-title">{{ $pesanan->pembeli->nama }}</h6>
                    <div class="row border g-0 my-1">
{{--                        <div class="col-1 align-self-center mx-1 me-3">--}}
{{--                            <img src="{{ asset('/storage/' . $pesanan->detail->produk->image) }}" class="img-fluid rounded-start" >--}}
{{--                        </div>--}}
                        <div class="col m-2">
                            <div class="d-flex align-items-center bd-highlight">
                                <!-- kiri -->
                                <div class="p-2 bd-highlight">
                                    <div class="row m-0 p-0">
                                        <strong>{{ ucwords($pesanan->detail->produk->nama_produk) }}</strong>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <p class="mb-0">{{ $pesanan->detail->qty }} x Rp. {{ number_format($pesanan->detail->produk->harga) }}</p>

                                        @if ($pesanan->jumlahProduk > 1)
                                            <p>+ {{ number_format($pesanan->jumlahProduk-1) }} Produk lainnya</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- kanan -->
                                <div class="ms-auto p-3 bd-highlight text-start">
                                    <div class="mb-1">Tanggal Pemesanan : {{ date('d/m/Y',strtotime($pesanan->tanggal)) }}</div>
                                    <div class="mb-1">
                                        Status Pesanan : {{ ucwords($pesanan->status->status) }}
                                    </div>
                                    <div class="mb-1">
                                        <a href="/supplier/pesanan/{{ $pesanan->id }}">Detail Pesanan</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-2 p-2 bg-light justify-content-end">
                                <strong class="text-end">Total Pembayaran : Rp. {{ number_format($pesanan->totalPesanan + $pesanan->pengiriman->ongkir) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col mt-3">
                <div class="card">
                    <div class="card-body align-center bg-light">
                        <h6 class="card-title text-center">Tidak Ada Pesanan</h6>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
