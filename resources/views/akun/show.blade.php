@extends('layouts.main')
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
        <div class="container-fluid rounded-3 border mt-2">
            <div class="d-flex justify-content-between my-2">
                <div class="col-6 row m-1">
                    <table class="table-responsive">
                            <tr>
                                <th scope="row" class="">Nama</th>
                                <td class="px-3">:</td>
                                <td class="py-2">{{ $user->nama }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="">Email</th>
                                <td class="px-3">:</td>
                                <td class="py-2">{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="">Tempat Tanggal Lahir</th>
                                <td class="px-3">:</td>
                                <td class="py-2">{{ $user->tmptLahir . ", " . $user->tglLahir }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="">Nomor Telepon</th>
                                <td class="px-3">:</td>
                                <td class="py-2">0{{ $user->noTelp }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="">Alamat</th>
                                <td class="px-3">:</td>
                                <td class="py-2">{{ $user->alamat }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="">Username</th>
                                <td class="px-3">:</td>
                                <td class="py-2">{{ $user->username }}</td>
                            </tr>
                        </table>

                    <div class="d-flex bd-highlight">
                        @if(auth()->user()->role == 'supplier')
                            <div class="p-2 flex-fill bd-highlight">
                                <a href="/supplier/akun/{{ auth()->user()->id }}/edit" class="btn btn-add">Edit Profil</a>
                            </div>
                        @elseif(auth()->user()->role == 'pemilik_toko')
                            <div class="p-2 flex-fill bd-highlight">
                                <a href="/pemilik/akun/{{ auth()->user()->id }}/edit" class="btn btn-add">Edit Profil</a>
                            </div>
                        @endif
                    </div>
                </div>

                @if(auth()->user()->role == 'supplier')
                    <div class="vr"></div>
                    <div class="col-5">
                        <livewire:rekening-index>
                        </livewire:rekening-index>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
