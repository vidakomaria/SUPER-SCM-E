<div>
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            @if(session()->has('success'))
                <div class="alert alert-secondary col-lg-8" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="p-2 bd-highlight"></div>
        <div class="p-2 bd-highlight">
            <a href="/pemilik/keranjang" class="btn btn-primary position-relative">
                <i class="bi bi-cart4"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $keranjang->count() }}</span>
            </a>
        </div>
    </div>

    <!--Card-->
    <div class="row mt-3">
        @foreach($etalase as $produk)
            <div class="col-3">
                <div class="card" >
                    <div class="col">
                        <a href="/pemilik/pasar/detail/{{ $produk->produk->id }}" class="text-decoration-none" style="color: black">
                            <img class="card-img-top" src="{{ asset('/storage/' . $produk->produk->image) }}">
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="d-flex bd-highlight">
                            <div class="flex-grow-1 bd-highlight"><h5 class="card-title">{{ $produk->produk->nama_produk }}</h5></div>
                            <div class="bd-highlight">
                                <button wire:click="addCart({{ $produk->produk->id }},{{ $produk->id_supplier }})" class="btn bg-info mx-2 py-1 px-2 rounded">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-text m-2">
                            <div class="row">Rp. {{ number_format($produk->produk->harga) }}</div>

                            <div class="row">Stok  : {{ $produk->produk->stok }}</div>

                            <div class="row align-middle justify-content-center mt-2">
                                ( {{ $produk->supplier->nama }} )
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
