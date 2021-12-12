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
                            <td>Rp. {{ number_format($pesananAll->totalPesanan) }}</td>
                        </tr>
                        <tr>
                            <th class="pe-2">Ongkir</th>
                            <td>:</td>
                            <td>Rp. {{ number_format($pesananAll->pengiriman->ongkir) }}</td>
                        </tr>
                        @if($pesananAll->pengiriman->id_pengiriman == 2 AND $pesananAll->id_statusPesanan == 1)
                            <tr class="pt-0">
                                <td colspan="3">
                                    <p class="fw-lighter fst-italic">*{{ ucfirst($pesananAll->status->keterangan) }}</p>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th class="pe-2">Total Pembayaran</th>
                            <td>:</td>
                            <td>Rp. {{ number_format($pesananAll->totalPesanan + $pesananAll->pengiriman->ongkir) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="vr"></div>

            <!--col Kanan-->
            <div class="col-6">
                <div class="d-flex justify-content-between">
                    <strong class="mt-2">Detail Pemesanan</strong>
                    @if($pesananAll->id_statusPesanan == 5)
                        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalSelesai">Pesanan Selesai</button>
                    @else
                        <button class="btn btn-add" disabled>Pesanan Selesai</button>
                    @endif
                </div>
                <hr>
                <div class="row table-responsive m-0">
                    <table class="table table-borderless m-0">
                        <tr>
                            <th class="pe-2">Status Pesanan</th>
                            <td>:</td>
                            <td>
                                {{ ucwords($pesananAll->status->status) }}
                                @if($pesananAll->id_statusPesanan == 8)
                                    <p class="fw-lighter fst-italic m-0 p-1 bg-light">*Pembayaran ditolak harap melakukan pembaruan bukti pembayaran</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="pe-2">Pengiriman</th>
                            <td>:</td>
                            <td>{{ ucwords($pesananAll->pengiriman->metodePengiriman->pengiriman) }}</td>
                        </tr>
                        <tr>
                            @if($pesananAll->pengiriman->id_pengiriman == 1)
                                <th class="pe-2">Alamat Pengambilan</th>
                                <td>:</td>
                                <td>{{ $pesananAll->pengiriman->alamatPengambilan }}</td>
                            @elseif($pesananAll->pengiriman->id_pengiriman == 2)
                                <th class="pe-2">Alamat Pengiriman</th>
                                <td>:</td>
                                <td>{{ $pesananAll->pengiriman->alamatPengiriman }}</td>
                            @endif
                        </tr>
                        <tr>
                            <th class="pe-2">Catatan Supplier</th>
                            <td>:</td>
                            <td>{{ $pesananAll->catatan }}</td>
                        </tr>
                        <tr>
                            <th class="pe-2">Kode Pengiriman</th>
                            <td>:</td>
                            <td>
                                @if($pesananAll->pengiriman->id_pengiriman == 1)
                                    -
                                @elseif($pesananAll->pengiriman->id_pengiriman == 2)
                                    @if($pesananAll->pengiriman->kodePengiriman == '')
                                        <p class="fw-lighter fst-italic m-0 p-1 bg-light">* Kode Pengiriman belum ditambahkan</p>
                                    @else
                                        {{ $pesananAll->pengiriman->kodePengiriman }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="pe-2">Bukti Pembayaran</th>
                            <td>:</td>
                            <td>
                                <button type="button" class="btn text-decoration-underline" data-bs-toggle="modal" data-bs-target="#modalBuktiPembayaran">
                                    Lihat Bukti Pembayaran
                                </button>
                                <button type="button" class="btn text-decoration-underline" data-bs-toggle="modal" data-bs-target="#modalDetailPembayaran">
                                    Rincian Tujuan Pembayaran
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                @if($pesananAll->id_statusPesanan == 2)
                    <button class="btn btn-add" wire:click="addBukti" {{ $btnAdd }}>Tambah Bukti Pembayaran</button>
                @elseif($pesananAll->id_statusPesanan == 8)
                    <button class="btn btn-add" wire:click="addBukti" {{ $btnAdd }}>Perbarui Bukti Pembayaran</button>
                @else
                    <button class="btn btn-add" disabled>Tambah Bukti Pembayaran</button>
                @endif
                <!--Form bukti pembayaran-->
                @if($add == 'on')
                    <div class="border rounded-3 my-2 p-2 bg-light">
                        <form method="post" action="/pemilik/pesanan/{{ $idPesanan }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mt-3 align-center">
                                <div class="col-auto">
                                    <label for="buktiPembayaran" class="form-label fw-bold">Bukti Pembayaran</label>
                                </div>
                                <div class="col">
                                    <input type="hidden" name="oldImage" value="{{ $pesananAll->pembayaran->buktiPembayaran }}">
                                    <input type="file" class="form-control @error('buktiPembayaran') is-invalid @enderror"
                                           id="buktiPembayaran" name="buktiPembayaran" value="{{ old('buktiPembayaran') }}" onchange="previewImage()">

                                    @error('buktiPembayaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row my-2 justify-content-center">
                                @if($pesananAll->pembayaran->buktiPembayaran)
                                    <img src="{{ asset('/storage/' . $pesananAll->pembayaran->buktiPembayaran) }}" class="img-preview img-fluid">
                                @else
                                    <img class="img-preview img-fluid col-md-6">
                                @endif
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-3">
                                    <button type="submit" class="btn btn-add" onclick="return confirm('Kirim Bukti Pembayaran?')">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                    @if($pesananAll->pembayaran->buktiPembayaran == '')
                        @if($pesananAll->id_statusPesanan == 2)
                            <div class="row bg-light justify-content-center p-2 m-1 py-3 ">
                                <p class="text-center fs-5 fst-italic fw-bold">* Harap segera melakukan pembayaran</p>
                            </div>
                        @else
                            <div class="row justify-content-center m-1 ">
                                <strong class="text-center fs-5 p-0 m-0 bg-light p-2">Bukti Pembayaran Belum ditambahakan</strong>
                            </div>
                        @endif
                    @else
                        <img class="card-img-top" src="{{ asset('/storage/'.$pesananAll->pembayaran->buktiPembayaran) }}">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Rekening Pembayaran-->
    <div class="modal fade" id="modalDetailPembayaran" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rincian Tujuan Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($pesananAll->pembayaran->id_detailRekening == null)
                        <div class="row bg-light justify-content-center p-2 m-1 py-3 ">
                            <p class="fw-lighter fst-italic m-0 p-1 bg-light">
                                * Supplier akan segera menambahkan detail tujuan rekening setelah pemesanan dikonfirmasi
                            </p>
                        </div>
                    @else
                        <div class="row bg-light justify-content-center p-2 m-1 py-3 ">
                            <table>
                                <tr>
                                    <td class="py-2"><strong>Total Pembayaran</strong></td>
                                    <td class="px-2">:</td>
                                    <td>Rp. {{ number_format($pesananAll->totalPesanan + $pesananAll->pengiriman->ongkir) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2"><strong>Nama Bank</strong></td>
                                    <td class="px-2">:</td>
                                    <td>{{ $pesananAll->pembayaran->rekening->namaBank }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2"><strong>No. Rekening</strong></td>
                                    <td class="px-2">:</td>
                                    <td>{{ $pesananAll->pembayaran->rekening->no_rekening }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2"><strong>Nama Pemilik Rekening</strong></td>
                                    <td class="px-2">:</td>
                                    <td>{{ $pesananAll->pembayaran->rekening->namaAkunBank }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p class="fw-normal fst-italic bg-white p-2">*Harap melakukan pembayaran sesuai dengan yang sudah tertera</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Selesai Pesanan-->
    <div class="modal fade" id="modalSelesai" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="fw-bolder">Selesaikan Pesanan</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-row text-center">
                    <p class="text-center">
                        Pastikan Pesanan sudah diterima dan sudah sesuai
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="selesaiPesanan" class="btn btn-primary">Selesai</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(){
            const image = document.querySelector('#buktiPembayaran');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
</div>
