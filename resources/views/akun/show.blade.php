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
                        @if(auth()->user()->role == 'supplier')
                                <tr>
                                    <th scope="row" class="">Nomor Rekening</th>
                                    <td class="px-3 py-2">:</td>
                                    <td class="py-2">
                                        @if($user->rekening->no_rekening == 0)
                                            <p class="fw-light fst-italic m-0 p-0">*No. Rekening belum ditambahkan</p>
                                        @else
                                            {{ $user->rekening->no_rekening }}
                                        @endif
                                    </td>
{{--                                    <td>--}}
{{--                                        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalAkunBank">--}}
{{--                                            Edit Akun Bank--}}
{{--                                        </button>--}}
{{--                                    </td>--}}
                                </tr>
                        @endif
                        <tr>
                            <th scope="row" class="">Username</th>
                            <td class="px-3">:</td>
                            <td class="py-2">{{ $user->username }}</td>
                        </tr>
                    </table>
                </div>
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
        </div>
    </div>

    <!--Edit/Update-->
    @if($user->rekening != null)
        @php
            $action = '/supplier/rekening/'.auth()->user()->id;
        @endphp
    @elseif($user->rekening == null)
        @php
            $action = '/supplier/rekening/';
        @endphp
    @endif

    <!-- Modal Akun Bank-->
    <div class="modal fade" id="modalAkunBank" data-bs-backdrop="static" data-bs-keyboard="false" >
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Akun Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ $action }}">
                    @if($user->rekening != null)
                        @method('put')
                    @endif
                    @csrf
                    <div class="modal-body">
                        <table>
                        <tr>
                            <td>Nama Bank</td>
                            <td class="px-3">:</td>
                            <td  class="py-2">
                                @if($user->rekening != null)
                                    <input type="text" class="form-control" name="namaBank" value="{{ $user->rekening->namaBank, old('namaBank') }}" @error('namaBank') is-invalid @enderror">
                                @else
                                    <input type="text" class="form-control" name="namaBank" value="{{ old('namaBank') }}" @error('namaBank') is-invalid @enderror">
                                @endif
                                @error('namaBank')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Akun Bank</td>
                            <td class="px-3">:</td>
                            <td  class="py-2">
                                @if($user->rekening != null)
                                    <input type="text" class="form-control" name="namaAkunBank" value="{{ $user->rekening->namaAkunBank, old('namaAkunBank') }}" @error('namaAkunBank') is-invalid @enderror">
                                @else
                                    <input type="text" class="form-control" name="namaAkunBank" value="{{ old('namaAkunBank') }}" @error('namaAkunBank') is-invalid @enderror">
                                @endif

                                @error('namaAkunBank')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Rekening</td>
                            <td class="px-3">:</td>
                            <td  class="py-2">
                                @if($user->rekening != null)
                                    <input type="number" class="form-control" name="no_rekening" value="{{ $user->rekening->no_rekening, old('no_rekening') }}" @error('no_rekening') is-invalid @enderror">
                                @else
                                    <input type="number" class="form-control" name="no_rekening" value="{{ old('no_rekening') }}" @error('no_rekening') is-invalid @enderror">
                                @endif

                                @error('no_Rekening')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                    </table>

                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-add">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
