@extends('pemilik.layouts.main')

@section('container')

    <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
        <a href="#" class="text-decoration-none text-black"><h4>Checkout</h4></a>
    </div>
    <div class="container mt-3 mx-0 px-0 mb-5 pb-5">
        <livewire:pemilik.checkout-index>

        </livewire:pemilik.checkout-index>
    </div>
@endsection
