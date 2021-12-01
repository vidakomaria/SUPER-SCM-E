@extends('layouts.main')
@section('container')
    <div class="m-0">
        <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
            @if(auth()->user()->role == 'supplier')
                @php
                    $action = '/supplier/akun/';
                @endphp
            @elseif(auth()->user()->role == 'pemilik_toko')
                @php
                    $action = '/pemilik/akun/';
                @endphp
            @endif
                <h4><a href="{{ $action . auth()->user()->id }}" class="text-decoration-none text-black">Profil</a> / Edit</h4>
        </div>
        <div class="container-fluid mt-3 pt-2 ms-0 ps-0">
            <div class="pt-2">
                @if(session()->has('success'))
                    <div class="alert alert-success col-lg-8" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="col border">
                <div class="card-body">
                    <form method="post" action="{{ $action . auth()->user()->id }}">
                        @method('put')
                        @csrf
                        <table class="col-10">
                            <tr>
                                <th scope="row" class=""><label for="nama" class="form-label">Nama</label></th>
                                <td class="px-3">:</td>
                                <td class="py-2">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                           name="nama" value="{{ $user->nama }}">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class=""><label for="email" class="form-label">Email</label></th>
                                <td class="px-3">:</td>
                                <td class="py-2">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ $user->email }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class=""><label class="form-label">Tempat Tanggal Lahir</label></th>
                                <td class="px-3">:</td>
                                <td class="py-2">
                                    <input type="text" class="form-control @error('tmptLahir') is-invalid @enderror"
                                           name="tmptLahir" value="{{ $user->tmptLahir }}">
                                    @error('tmptLahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="date" class="form-control @error('tglLahir') is-invalid @enderror"
                                           name="tglLahir" value="{{ $user->tglLahir }}">
                                    @error('tglLahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class=""><label for="noTelp" class="form-label">No. Telepon</label></th>
                                <td class="px-3">:</td>
                                <td class="py-2">
                                    <input type="number" class="form-control @error('noTelp') is-invalid @enderror"
                                           name="noTelp" value="0{{ $user->noTelp }}">
                                    @error('noTelp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class=""><label for="alamat" class="form-label">Alamat</label></th>
                                <td class="px-3">:</td>
                                <td class="py-2">
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                           name="alamat" value="{{ $user->alamat }}">
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class=""><label for="username" class="form-label">Username</label></th>
                                <td class="px-3">:</td>
                                <td class="py-2">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                           name="username" value="{{ $user->username }}">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class=""><label for="password" class="form-label">Password</label></th>
                                <td class="px-3">:</td>
                                <td class="py-2">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                        </table>
                        <div class="d-flex bd-highlight">
                            <div class="p-2 flex-fill bd-highlight"><button type="submit" class="btn btn-add">Simpan</button></div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
