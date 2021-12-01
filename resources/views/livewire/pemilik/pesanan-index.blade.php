<div>
    <div class="container mt-3 mx-0 px-0">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- status pesanan -->
        <div class="mb-2">
            <button type="button" wire:click="status('all')" class="btn  me-2 rounded-pill
                @if($status == 'all') bg-warning @endif">Semua</button>
            <button type="button" wire:click="status(1)" class="btn  me-2 rounded-pill
                @if($status == 1) bg-warning @endif">Menunggu Konfirmasi</button>
            <button type="button" wire:click="status(2)" class="btn  me-2 rounded-pill
                @if($status == 2) bg-warning @endif">Belum Bayar</button>
            <button type="button" wire:click="status(3)" class="btn  me-2 rounded-pill
                @if($status == 3) bg-warning @endif">Diproses</button>
            <button type="button" wire:click="status(4)" class="btn  me-2 rounded-pill
                @if($status == 4) bg-warning @endif">Dikirim</button>
            <button type="button" wire:click="status(5)" class="btn  me-2 rounded-pill
                @if($status == 5) bg-warning @endif">Selesai</button>
            <button type="button" wire:click="status(6)" class="btn  me-2 rounded-pill
                @if($status == 6) bg-warning @endif">Dibatalkan</button>
        </div>

        @if($pesanan->count())
            @foreach($pesanan as $pesanan)
                <div class="card mb-3 p-2">
                    <h6 class="card-title">{{ $pesanan->supplier->nama }}</h6>
                    <div class="row border g-0 my-1">
                        <div class="col-1 align-self-center mx-1 me-3">
                            <img src="{{ asset('/storage/' . $pesanan->detail->produk->image) }}" class="img-fluid rounded-start" >
                        </div>
                        <div class="col m-2">
                            <div class="d-flex align-items-center bd-highlight mb-3">
                                <div class="p-2 bd-highlight">
                                    <div class="row">
                                        <strong>{{ ucwords($pesanan->detail->produk->nama_produk) }}</strong>
                                    </div>
                                    <div class="row">
                                        <p>{{ $pesanan->detail->qty }} x Rp. {{ number_format($pesanan->detail->produk->harga) }}</p>
                                    </div>
                                </div>
                                <div class="ms-auto p-2 bd-highlight">
                                    Total Pesanan : Rp. {{ number_format($pesanan->grand_total) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex flex-row-reverse bd-highlight mb-2">
                                <div class="bd-highlight">
                                    <a href="/pemilik/pesanan/detail/{{ $pesanan->id }}">Detail Pesanan</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col mt-3">
                <div class="card">
                    <div class="card-body align-center bg-light">
                        <h6 class="card-title text-center">Tidak Ada Produk</h6>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
