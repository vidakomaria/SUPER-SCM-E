@extends('suppliers.layouts.main')
@section('container')
    <div class="m-0">
        <div class="container-fluid rounded-3 border bg-white mt-2 pt-2 shadow-sm" style="height: 50px">
            <h4>Profil</h4>
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
                    <form method="post" action="/supplier/akun/{{ auth()->user()->id }}">
                        @method('put')
                        @csrf
                        <table>
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
                                <th scope="row" class=""><label for="username" class="form-label">Password</label></th>
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
