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
                        <table class="col-12">
                            <tr>
                                <th scope="row" class=""><label for="nama" class="form-label">Nama</label></th>
                                <td class="px-2">:</td>
                                <td class="py-2 pe-3">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                           name="nama" value="{{ old('nama', $user->nama) }}">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                                <th class="ps-5">Email</th>
                                <td class="px-2">:</td>
                                <td class="py-2">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <th scope="row" class=""><label class="form-label">Tempat, <br>Tanggal Lahir</label></th>
                                <td class="px-2">:</td>
                                <td class="pb-2 pe-3">
                                    <input type="text" class="form-control my-2 @error('tmptLahir') is-invalid @enderror"
                                           name="tmptLahir" value="{{ old('tmptLahir', $user->tmptLahir) }}">
                                    @error('tmptLahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <input type="date" class="form-control @error('tglLahir') is-invalid @enderror"
                                           name="tglLahir" value="{{ old('tglLahir', $user->tglLahir) }}">
                                    @error('tglLahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                                <th scope="row" class="ps-5"><label for="alamat" class="form-label">Alamat</label></th>
                                <td class="px-2">:</td>
                                <td class="py-2">
                                    <textarea name="alamat" class="form-control py-2 @error('alamat') is-invalid @enderror">{{ old('alamat', $user->alamat) }}</textarea>
                                    {{--                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"--}}
                                    {{--                                           name="alamat" value="{{ $user->alamat }}">--}}
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class=""><label for="namaBank" class="form-label">Nama Bank</label></th>
                                <td class="px-2">:</td>
                                <td class="py-2 pe-3">
                                    <input type="text" class="form-control @error('namaBank') is-invalid @enderror"
                                           name="namaBank" value="{{ old('namaBank', $user->rekening->namaBank) }}">
                                    @error('namaBank')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>

                                <th scope="row" class="ps-5"><label for="namaAkunBank" class="form-label">Nama Pemilik <br>Rekening</label></th>
                                <td class="px-2">:</td>
                                <td class="py-2">
                                    <input type="text" class="form-control @error('namaAkunBank') is-invalid @enderror"
                                           name="namaAkunBank" value="{{ old('namaAkunBank', $user->rekening->namaAkunBank) }}">
                                    @error('namaAkunBank')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class=""><label for="no_rekening" class="form-label">Nomor Rekening</label></th>
                                <td class="px-2">:</td>
                                <td class="py-2 pe-3">
                                    @if($user->rekening->no_rekening == 0)
                                        <input type="number" class="form-control @error('no_rekening') is-invalid @enderror"
                                           name="no_rekening" value="{{ old('no_rekening') }}">
                                    @else
                                        <input type="number" class="form-control @error('no_rekening') is-invalid @enderror"
                                               name="no_rekening" value="{{ old('no_rekening', $user->rekening->no_rekening) }}">
                                    @endif

                                    @error('no_rekening')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                                <th scope="row" class="ps-5"><label for="noTelp" class="form-label">No. Telepon</label></th>
                                <td class="px-2">:</td>
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
                                <th scope="row" class=""><label for="username" class="form-label">Username</label></th>
                                <td class="px-2">:</td>
                                <td class="py-2 pe-3">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                           name="username" value="{{ $user->username }}">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>

                                <th scope="row" class="ps-5"><label for="password" class="form-label">Password</label></th>
                                <td class="px-2">:</td>
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
