@extends('layouts.landing')
@section('container')
    <div class="form-signin container-login bordered">
        @if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form method="post" action="/login">
            @csrf
            <h1 class="h3 mb-3 fw-normal text-center">Login</h1>

            <div class="form-floating my-4">
                <input type="text" name="username" placeholder="Username"
                       class="form-control @error('username') is-invalid @enderror">
                <label for="username">Username</label>

                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating my-4">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <div class="row">
                <a href="/akun/create" class="row justify-content-end pe-3">Register</a>
            </div>
            <button class="w-100 btn btn-lg" type="submit">Login</button>
        </form>
    </div>
@endsection
