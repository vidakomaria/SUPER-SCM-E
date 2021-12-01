@extends('layouts.landing')
@section('container')
    <div class="form-signin container-login bordered">
        <form method="post" action="/akun">
            @csrf
            <h1 class="h3 mb-3 fw-normal text-center mb-5">Register</h1>

            <div class="row">
                <div class="col">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control input-register @error('nama') is-invalid @enderror"
                               name="nama" placeholder="Nama" value="{{ old('nama') }}">
                        <label for="nama" class="pt-2">Nama</label>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control @error('tmptLahir') is-invalid @enderror"
                               name="tmptLahir" placeholder="Tempat Lahir" value="{{ old('tmptLahir') }}">
                        <label for="tmptLahir" class="pt-2">Tempat Lahir</label>
                        @error('tmptLahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating my-3">
                        <input type="number" class="form-control @error('noTelp') is-invalid @enderror"
                               name="noTelp" placeholder="No. Telepon" value="{{ old('noTelp') }}">
                        <label for="noTelp" class="pt-2">No. Telepon</label>
                        @error('noTelp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                               name="username" placeholder="Username" value="{{ old('username') }}">
                        <label for="username" class="pt-2">Username</label>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <select class="form-select my-3 @error('role') is-invalid @enderror"
                                name="role">
                            <option value="">Mendaftar sebagai</option>
                            <option value="supplier">Supplier</option>
                            <option value="pemilik_toko">Pemilik Toko</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!--Kanan-->
                <div class="col">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                               name="email" placeholder="Email" value="{{ old('email') }}">
                        <label for="email" class="pt-2">Email</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating my-3">
                        <input type="date" class="form-control @error('tglLahir') is-invalid @enderror"
                               name="tglLahir" placeholder="Tanggal Lahir" value="{{ old('tglLahir') }}">
                        <label for="tglLahir" class="pt-2">Tanggal lahir</label>
                        @error('tglLahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating my-3">
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                               name="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
                        <label for="alamat" class="pt-2">Alamat</label>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating my-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" placeholder="Password" value="{{ old('password') }}">
                        <label for="password" class="pt-2">Password</label>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>




            <div class="row">
                <a href="/" class="row justify-content-start ps-4">Have Account? Login</a>
            </div>
            <button class="w-100 btn btn-lg" type="submit">Register</button>
        </form>
    </div>
@endsection
