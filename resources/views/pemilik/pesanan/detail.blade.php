@extends('pemilik.layouts.main')
@section('container')
    <div class="m-0">
        <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
            <h4><a class="text-decoration-none text-black" href="/pemilik/pesanan">Pesanan</a> / Detail Pesanan</h4>
        </div>

        <div class="container-fluid mt-3 pt-2">
            <!--Detail Produk-->
{{--            {{ dd($pesanan) }}--}}
            <div class="container-fluid rounded-3 border mt-2">
                @foreach ($pesanan as $pesanan)
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection
