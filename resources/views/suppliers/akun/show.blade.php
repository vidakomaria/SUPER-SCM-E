@extends('suppliers.layouts.main')
@section('container')
    <div class="m-0">
        <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
            <h4>Profil</h4>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="container-fluid mt-3 pt-2 ms-0 ps-0">
            <div class="col border">
                <div class="card-body">
                    <table>
                        <tr>
                            <th scope="row" class="">Nama</th>
                            <td class="px-3">:</td>
                            <td class="py-2">{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="">Username</th>
                            <td class="px-3">:</td>
                            <td class="py-2">{{ $user->username }}</td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex bd-highlight">
                    <div class="p-2 flex-fill bd-highlight"><a href="/supplier/akun/{{ auth()->user()->id }}/edit" class="btn btn-add">Edit</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
