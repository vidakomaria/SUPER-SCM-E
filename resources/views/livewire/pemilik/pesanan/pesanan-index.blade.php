<div>
    <div class="container mt-3 mx-0 px-0">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- status pesanan -->
        <div class="mb-2 d-flex flex-wrap my-2 mx-2">
            <div class="mx-2">
                <button type="button" wire:click="status('all')" class="btn m-0 p-0
                @if($status == 'all') text-info @endif">
                    Semua ({{ $countPesanan["all"] }})</button>
            </div>
            <div class="mx-2">
                <button type="button" wire:click="status(1)" class="btn m-0 p-0
                @if($status == 1) text-info @endif">
                    Belum Dikonfirmasi ({{ $countPesanan["menunggu konfirmasi"] }})
                </button>
            </div>
            <div class="mx-2">
                <button type="button" wire:click="status(2)" class="btn m-0 p-0
                @if($status == 2) text-info @endif">
                    Belum Bayar ({{ $countPesanan["belum bayar"] }})
                </button>
            </div>
            <div class="mx-2">
                <button type="button" wire:click="status(8)" class="btn m-0 p-0
                @if($status == 8) text-info @endif">
                    Pembayaran Ditolak ({{ $countPesanan["pembayaran ditolak"] }})
                </button>
            </div>
            <div class="mx-2">
                <button type="button" wire:click="status(3)" class="btn m-0 p-0
                @if($status == 3) text-info @endif">
                    Menunggu Konfirmasi Pembayaran ({{ $countPesanan["menunggu konfirmasi pembayaran"] }})
                </button>
            </div>
            <div class="mx-2">
                <button type="button" wire:click="status(4)" class="btn m-0 p-0
                @if($status == 4) text-info @endif">
                    Dikemas ({{ $countPesanan["diproses"] }})
                </button>
            </div>
            <div class="mx-2">
                <button type="button" wire:click="status(5)" class="btn m-0 p-0
                @if($status == 5) text-info @endif">
                    Dikirim ({{ $countPesanan["dikirim"] }})
                </button>
            </div>
            <div class="mx-2">
                <button type="button" wire:click="status(6)" class="btn m-0 p-0
                @if($status == 6) text-info @endif">
                    Selesai ({{ $countPesanan["selesai"] }})
                </button>
            </div>
            <div class="mx-2">
                <button type="button" wire:click="status(9)" class="btn m-0 p-0
                @if($status == 9) text-info @endif">
                    Permintaan Pembatalan ({{ $countPesanan["permintaan pembatalan"] }})
                </button>
            </div>
            <div class="mx-2">
                <button type="button" wire:click="status(7)" class="btn m-0 p-0
                @if($status == 7) text-info @endif">
                    Dibatalkan ({{ $countPesanan["dibatalkan"] }})
                </button>
            </div>
            <div class="mx-2">
                <button type="button" wire:click="status(10)" class="btn m-0 p-0
                @if($status == 10) text-info @endif">
                    Pengambilan ({{ $countPesanan["pengambilan"] }})
                </button>
            </div>
        </div>

        <!-- Isi pesanan -->
        @if($pesanan->count())
            @foreach($pesanan as $pesanan)
                <div class="card mb-3 p-2">
                    <h6 class="card-title">{{ $pesanan->pembeli->nama }}</h6>
                    <div class="row border g-0 my-1">
                    <!-- <div class="col-1 align-self-center mx-1 me-3">
                            <img src="{{ asset('/storage/' . $pesanan->detail->produk->image) }}" class="img-fluid rounded-start" >
                        </div> -->
                        <div class="col m-2">
                            <div class="d-flex align-items-center bd-highlight">
                                <!-- kiri -->
                                <div class="p-2 bd-highlight">
                                    <div class="row m-0 p-0">
                                        <strong>{{ ucwords($pesanan->detail->produk->nama_produk) }}</strong>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <p class="mb-0">{{ $pesanan->detail->qty }} x Rp. {{ number_format($pesanan->detail->produk->harga) }}</p>

                                        @if ($pesanan->total_produk > 1)
                                            <p>+ {{ number_format($pesanan->total_produk-1) }} Produk lainnya</p>
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
                                        <a href="/pemilik/pesanan/{{ $pesanan->id }}">Detail Pesanan</a>
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
