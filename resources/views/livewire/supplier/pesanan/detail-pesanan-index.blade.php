<div>
    <!--Detail Produk-->
    <div class="container-fluid rounded-3 border mt-2">
        <div class="d-flex justify-content-between my-2">
            <!-- produk -->
            <div class="col-5">
                <!--Tabel detail produk-->
                <strong class="mt-2">Detail Produk <hr></strong>
                <div class="row table-responsive m-1">
                    <table class="table table-borderless text-center">
                        <thead>
                        <tr>
                            <th scope="col" class="col-1">No</th>
                            <th scope="col">Produk</th>
                            <th scope="col" class="col-2">Kuantitas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pesanan as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->produk->nama_produk }}</td>
                                <td>{{ $value->qty }}</td>
                            </tr>
                        @endforeach
                        <tr class="bg-light">
                            <td colspan="3" class="text-start pe-3">
                                <div class="row">
                                    <div class="col">
                                        <strong>Total Pesanan</strong>
                                    </div>
                                    <div class="col">
                                        <strong>: Rp. {{ number_format($pesananAll->grand_total) }}</strong>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bg-light">
                            <td colspan="3" class="text-start pe-3">
                                <div class="row">
                                    <div class="col">
                                        <strong>Total Pembayaran</strong>
                                    </div>
                                    <div class="col">
                                        <strong>: Rp. {{ number_format($pesananAll->grand_total + $pesananAll->ongkir) }}</strong>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="vr"></div>

            <!--col Kanan-->
            <div class="col-6">
                <strong class="mt-2">Detail Pemesanan <hr></strong>
                <!--Utk ubah-->
                @php
                    $currentStatus = $listStatus->where('idStatus',$pesananAll->id_status_pesanan)->first();
                @endphp
                <div class="row table-responsive m-0">
                    <table class="table table-borderless m-0">
                        <tr>
                            <td>Status Pesanan</td>
                            <td>
                                @if($currentStatus != null)
                                    <select wire:model="status" class="form-select" {{ $disable }}>
                                        <option value="{{ $currentStatus['idStatus'] }}">{{ ucwords($value->pesanan->status->status) }}</option>
                                        @foreach($currentStatus['idStatusChange'] as $key => $statusChange)
                                            <option value="{{ $statusChange }}">
                                                {{ ucwords($currentStatus['statusChange'][$key]) }}</option>
                                        @endforeach
                                    </select>
{{--                                        <option value="{{ $currentStatus['idStatusChange'] }}">--}}
{{--                                            {{ ucwords($currentStatus["statusChange"]) }}</option>--}}
                                @else
                                    <select wire:model="status" class="form-select" disabled>
                                        <option>{{ ucwords($value->pesanan->status->status) }}</option>
                                    </select>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Pengiriman</td>
                            <td>{{ ucwords($value->pesanan->pengiriman) }}</td>
                        </tr>
                        <tr>
                            <td>Biaya Pengiriman</td>
                            <td>
                                @if($value->pesanan->pengiriman == "ambil sendiri")
                                    <input type="text" class="form-control" value="" disabled placeholder="-">
                                @elseif($value->pesanan->pengiriman == "diantar")
                                    @if($pesananAll->id_status_pesanan == 1)
                                        <input type="number" wire:model="ongkir" class="form-control" {{ $disable }} placeholder="{{ ($pesananAll->ongkir) }}">
                                        <p class="fw-lighter fst-italic m-0 p-0">* Biaya pengiriman akan diinformasikan kepada Pemesan</p>
                                    @else
                                        <input type="number" wire:model="ongkir" class="form-control" disabled placeholder="{{ ($pesananAll->ongkir) }}">
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Kode Pengiriman</td>
                            <td>
                                @if($pesananAll->pengiriman == "ambil sendiri")
                                    <input type="text" class="form-control" value="" disabled placeholder="-">
                                @elseif($pesananAll->pengiriman == "diantar")
                                    @if($pesananAll->id_status_pesanan == 4 )
                                        <input type="text" wire:model="kodePengiriman" class="form-control" {{ $disable }}>
                                    @else
                                        <input type="text" class="form-control" disabled value="{{ $pesananAll->kodePengiriman }}">
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td>
                                <textarea wire:model="pesan" class="form-control" {{ $disable }} placeholder="{{ $pesananAll->pesan }}">{{ $pesananAll->pesan }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat Tujuan Pengiriman</td>
                            <td>
                                @if($pesananAll->pengiriman == "diantar")
                                    {{ $pesananAll->alamat }}
{{--                                    <textarea class="form-control bg-white" disabled>{{ $pesananAll->alamat }}</textarea>--}}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Bukti Pembayaran</td>
                            <td>
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalBukti">
                                    Lihat Bukti Pembayaran</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <button wire:click="edit" class="btn btn-add">Edit</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Simpan
                </button>
            </div>
            <!--End col kanan-->
        </div>
    </div>

    <!-- Modal Confirm -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="staticBackdropLabel">Yakin menyimpan perubahan?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Pastikan semua data telah terisi dengan benar
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button wire:click="save" class="btn btn-primary" data-bs-dismiss="modal">Yakin</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bukti-->
    <div class="modal fade" id="modalBukti" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @if($pesananAll->buktiPembayaran)
                        <img src="{{ asset('/storage/' . $pesananAll->buktiPembayaran) }}" class="img-preview img-fluid">
                    @else
                        <strong class="fst-italic text-center">Belum Ada Bukti Pembayaran</strong>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
