<div>
    <div class="container mt-3 mx-0 px-0">
        <div class="d-flex bd-highlight mb-3" style="background-color: #E9D8A6">
            <div class="me-auto p-2 bd-highlight">Total</div>
            <div class="p-2 bd-highlight">Rp. </div>
            <div class="p-2 bd-highlight">{{ number_format($total) }}</div>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($keranjang->count())
            <form method="post" wire:submit.prevent="checkout">
                @csrf
                @foreach($keranjang as $data)
                    <div class="card mb-3 p-2">
                        <h6 class="card-title">{{ $data[0]->supplier->nama }}</h6>
                        @foreach($data as $produk)
                            <div class="row g-0 border my-1">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input wire:model="selectedProduk.{{ $produk->id }}" name="id_produk" class="form-check-input" type="checkbox" value="{{ $produk->id }}">
                                    </div>
                                </div>
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
                                        <div class="col">
                                            <a href="/pemilik/pasar/detail/{{ $produk->id_produk }}">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <button type="submit" class="btn btn-add mb-3">Checkout</button>
            </form>
        @else
            <div class="col mt-3">
                <div class="card">
                    <div class="card-body align-center bg-light">
                        <h6 class="card-title text-center">Tidak Ada Produk di Keranjang</h6>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
