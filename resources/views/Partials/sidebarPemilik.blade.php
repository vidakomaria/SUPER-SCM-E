<div class="sidebar shadow">
    <div class="p-3 text-center">
        <strong>SUPER</strong>
    </div>
    <ul class="nav flex-column align-items-stretch mb-auto ml-4">
        <div class="d-flex flex-column pt-4">
{{--            <li class="nav-item my-2">--}}
{{--                <a href="/pemilik" class="nav-link text-white {{ Request::is('/') ? 'active' : '' }}" aria-current="page">--}}
{{--                    <i class="bi bi-house-door me-3"></i>Home</a>--}}
{{--            </li>--}}
            <li class="nav-item my-2">
                <a href="/pemilik/pasar" class="nav-link text-white {{ Request::is('pemilik/pasar*') ? 'active' : '' }}" aria-current="page">
                    <i class="bi bi-shop me-3"></i>Pasar</a>
            </li>
            <li class="nav-item my-2">
                <a href="/pemilik/produk" class="nav-link text-white {{ Request::is('pemilik/produk*') ? 'active' : '' }}" aria-current="page">
                    <i class="bi bi-box-seam me-3"></i>Produk</a>
            </li>
            <li class="nav-item my-2">
                <a href="/pemilik/pesanan" class="nav-link text-white {{ Request::is('pemilik/pesanan*') ? 'active' : '' }}" aria-current="page">
                    <i class="bi bi-journal-text me-3"></i>Pesanan</a>
            </li>
            <li class="nav-item my-2">
                <a href="/pemilik/keranjang" class="nav-link text-white {{ Request::is('pemilik/keranjang*') ? 'active' : '' }}" aria-current="page">
                    <i class="bi bi-cart4 me-3"></i>Keranjang</a>
            </li>
            <li class="nav-item my-2">
                <a href="/pemilik/kasir" class="nav-link text-white {{ Request::is('pemilik/kasir*') ? 'active' : '' }}" aria-current="page">
                    <i class="bi bi-calculator me-3"></i>Kasir</a>
            </li>
        </div>
        <div class="row dropdown d-flex align-items-stretch flex-column position-absolute bottom-0 start-0 m-3">
            @auth()
                <a href="" class="link-dark text-decoration-none dropdown-toggle text-white" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('/storage/produk-suppliers/V97Cgpma9oLLC8gn2DTmyL8M41EcBL3faLazbvte.png') }}" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>{{ auth()->user()->username }}</strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="/pemilik/akun/{{ auth()->user()->id }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" onclick="return confirm('Anda Yakin Ingin Keluar?')"
                                class="dropdown-item" aria-current="page">
                            <i class="bi bi-box-arrow-right"></i>  Logout
                        </button>
                    </form>
                </ul>
            @endauth
        </div>
    </ul>
</div>
