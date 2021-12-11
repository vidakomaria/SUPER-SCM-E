<div>
    <!--Detail Produk-->
    <div class="container-fluid rounded-3 border my-2 pb-3">
        <div class="d-flex justify-content-between my-2">
            <!-- produk -->
            <div class="col-5 me-0 pe-0">
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
                        @foreach ($pesanan as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->produk->nama_produk }}</td>
                                <td>{{ $value->qty }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="row table-responsive rounded-3 border mx-1 pe-0 me-0">
                    <table class="table table-borderless m-0">
                        <tr>
                            <th class="pe-2">Total Pesanan</th>
                            <td>:</td>
                            <td>Rp. {{ number_format($pesananAll->grand_total) }}</td>
                        </tr>
                        <tr>
                            <th class="pe-2">Ongkir</th>
                            <td>:</td>
                            <td>Rp. {{ number_format($pesananAll->ongkir) }}</td>
                        </tr>
                        @if($pesananAll->pengiriman == 'diantar' AND $pesananAll->id_status_pesanan == 1)
                            <tr class="pt-0">
                                <td colspan="3">
                                    <p class="fw-lighter fst-italic">*{{ ucfirst($pesananAll->status->keterangan) }}</p>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th class="pe-2">Total Pembayaran</th>
                            <td>:</td>
                            <td>Rp. {{ number_format($pesananAll->grand_total + $pesananAll->ongkir) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="vr"></div>

            <!--col Kanan-->
            <div class="col-6">
                <strong class="mt-2">Detail Pemesanan <hr></strong>
                <div class="row table-responsive m-0">
                    <table class="table table-borderless m-0">
                        <tr>
                            <th class="pe-2">Status Pesanan</th>
                            <td>:</td>
                            <td>{{ ucwords($pesananAll->status->status) }}</td>
                        </tr>
                        <!--Cek metode pengiriman-->
                        @if($pesananAll->pengiriman == "diantar")
                            @php
                                $pengiriman = 'Pengiriman';
                                $alamat     = $pesananAll->alamat;
                                $kodePengiriman = $pesananAll->kodePengirman;
                                $notePengiriman = "*Kode Pengiriman akan diinfokan oleh Supplier";
                            @endphp
                        @elseif($pesananAll->pengiriman == "ambil sendiri")
                            @php
                                $pengiriman = 'Pengambilan';
                                $alamat     = $pesananAll->supplier->alamat;
                                $kodePengiriman = "-";
                                $notePengiriman = "";
                            @endphp
                        @endif
                        <tr>
                            <th class="pe-2">Alamat {{ $pengiriman }}</th>
                            <td>:</td>
                            <td>
                                {{ $alamat }}
                            </td>
                        </tr>
                        <tr>
                            <th class="pe-2">Catatan</th>
                            <td>:</td>
                            <td>{{ $pesananAll->pesan }}</td>
                        </tr>
                        <tr>
                            <th class="pe-2">Kode Pengiriman</th>
                            <td>:</td>
                            <td>
                                {{ $kodePengiriman }}
                                <p class="fw-lighter fst-italic">{{ $notePengiriman }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th class="pe-2">Bukti Pembayaran</th>
                            <td>:</td>
                            <td>
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalBuktiPembayaran">
                                    Lihat Bukti Pembayaran
                                </button>
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalDetailPembayaran">
                                    Rincian Tujuan Pembayaran
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                @if($pesananAll->id_status_pesanan == 2)
                    <button class="btn btn-add">Tambah Bukti Pembayaran</button>
                @else
                    <button class="btn btn-add" disabled>Tambah Bukti Pembayaran</button>
                @endif

            </div>
            <!--End col kanan-->
        </div>
    </div>

    <!-- Modal Bukti-->
    <div class="modal fade" id="modalBuktiPembayaran" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($pesananAll->buktiPembayaran == '')
                        <div class="row bg-light justify-content-center p-2 m-1 py-3 ">
                            <strong class="text-center fs-5">Bukti Pembayaran Belum ditambahakan</strong>
                        </div>
                    @else
                        <img class="card-img-top" src="{{ asset('/storage/bukti-pembayaran/L8WnDTM9axDYS0OBD1cFRT7SwGmswIvSJq9akrRD.jpg') }}">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alamat Pembayaran-->
    <div class="modal fade" id="modalDetailPembayaran" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rincian Tujuan Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($pesananAll->buktiPembayaran == '')
                        <div class="row bg-light justify-content-center p-2 m-1 py-3 ">
                            <table>
                                <tr>
                                    <th></th>
                                </tr>
                            </table>
                        </div>
                    @else
                        <img class="card-img-top" src="{{ asset('/storage/bukti-pembayaran/L8WnDTM9axDYS0OBD1cFRT7SwGmswIvSJq9akrRD.jpg') }}">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
