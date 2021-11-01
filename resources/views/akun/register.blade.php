@extends('layouts.main')
@section('container')
    <div class="form-signin container-login bordered">
        <form method="post" action="/akun">
            @csrf
            <h1 class="h3 mb-3 fw-normal text-center mb-5">Register</h1>

            <div class="form-floating my-3">
                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                       name="nama" placeholder="Nama">
                <label for="nama">Nama</label>
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-floating my-3">
                <input type="text" class="form-control @error('username') is-invalid @enderror"
                       name="username" placeholder="Username">
                <label for="username">Username</label>
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-floating my-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" placeholder="Password">
                <label for="password">Password</label>
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <select class="form-select my-3 @error('role') is-invalid @enderror" name="role">
                    <option value="">Mendaftar sebagai</option>
                    <option value="supplier">Supplier</option>
                    <option value="pemilik_toko">Pemilik Toko</option>
                </select>
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="row">
                <a href="/" class="row justify-content-start ps-4">Have Account? Login</a>
            </div>
            <button class="w-100 btn btn-lg" type="submit">Register</button>
        </form>
    </div>
@endsection
