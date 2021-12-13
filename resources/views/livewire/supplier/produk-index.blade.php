<div>
    <div class="container-fluid mt-3 pt-2 ms-0 ps-0">
        <div class="d-flex bd-highlight mb-2">
            <div class="flex-grow-1 bd-highlight">
                <a href="/supplier/produk/create"><button class="btn btn-add">Tambah Data</button></a>
            </div>
            <div class="bd-highlight">
                <button wire:click="all" class="btn bg-warning rounded mx-2 @if($tampilan == 'all') text-dark fw-bold @else text-white @endif">
                    Semua</button>
            </div>
            <div class="bd-highlight">
                <button wire:click="etalase" class="btn bg-warning rounded mx-2 @if($tampilan == 'tampil') text-dark fw-bold @else text-white @endif">
                    Etalase</button>
            </div>
            <div class="bd-highlight">
                <button wire:click="arsip" class="btn bg-warning rounded mx-2 @if($tampilan == 'arsip') text-dark fw-bold @else text-white @endif">
                    Arsip</button>
        </div>

        <div class="pt-2">
            @if(session()->has('success'))
                <div class="alert alert-success col-lg-8" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    <!--Card-->
    <div class="row">
        @foreach($produks as $produk)
            <div class="col-3">
                <div class="card" >
                    <div class="col">
                        <a href="/supplier/produk/{{ $produk->id }}/edit" class="text-decoration-none" style="color: black">
                            <img class="card-img-top" src="{{ asset('/storage/' . $produk->image) }}">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                        <div class="card-text">
                            <div class="row">
                                <div class="col">Rp. {{ number_format($produk->harga) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">Stok  : {{ $produk->stok }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">Terjual  : {{ $produk->terjual }}
                                </div>
                            </div>
                            <div class="row align-middle">
                                <div class="col mt-1">
                                    <a href="/supplier/produk/{{ $produk->id }}/edit" class="text-decoration-none" style="color: black">
                                        <div class="bg-info mx-2 py-1 px-2 rounded d-inline">
                                            <i class="bi bi-pencil-square"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <form method="post" action="/supplier/produk/{{ $produk->id }}">
                                        @method('delete')
                                        @csrf
                                        <button class="bg-danger mx-2 py-1 px-2 rounded" style="border: none"
                                                onclick="return confirm('Yakin Menghapus Produk?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
