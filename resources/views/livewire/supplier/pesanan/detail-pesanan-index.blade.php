<div>
    <!--Detail Produk-->
    <div class="container-fluid rounded-3 border mt-2">
        <div class="d-flex justify-content-between my-2">
            <!-- produk -->
            <div class="col-6">
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
                                        <strong>: Rp. {{ number_format($pesanan->sum('subTotal')) }}</strong>
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
                <div class="row m-2">
                    @if($pesananAll->pengiriman == "diantar")
                    Alamat Tujuan :
                    <textarea class="form-control bg-white" disabled>{{ $pesananAll->alamat }}</textarea>
                    @endif
                </div>
                <div class="row m-2">
                    Bukti Pembayaran
                    <img src="{{ asset('/storage/' . $pesananAll->buktiPembayaran) }}" class="img-preview img-fluid">
                </div>
            </div>
            <div class="vr"></div>

            <!--col Kanan-->
            <div class="col-5">
                <strong class="mt-2">Detail Pesanan <hr></strong>
                <!--Utk ubah-->
                @php
                    $currentStatus = $listStatus->where('idStatus',$pesananAll->id_status_pesanan)->first();
                    if($currentStatus != null){
                        $able = $currentStatus['disable'];
                    }
                    else{
                        $able = 'disabled';
                    }
                @endphp
                <div class="row table-responsive m-0">
                    <table class="table table-borderless m-0">
                        <tbody>
                            <tr>
                                <td>Status Pesanan</td>
                                <td>
                                    @if($currentStatus != null)
                                        <select wire:model="status" class="form-select" {{ $disable }}>
                                            <option value="{{ $currentStatus['idStatus'] }}">{{ ucwords($value->pesanan->status->status) }}</option>
                                            <option value="{{ $currentStatus['idStatusChange'] }}">
                                                {{ ucwords($currentStatus["statusChange"]) }}</option>
                                        </select>
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
                                    @else
                                        <input type="number" wire:model="ongkir" class="form-control" {{ $able }} placeholder="{{ ($pesananAll->ongkir) }}">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Kode Pengiriman</td>
                                <td>
                                    @if($pesananAll->pengiriman == "ambil sendiri")
                                        <input type="text" class="form-control" value="" disabled placeholder="-">
                                    @else
                                        <input type="text" wire:model="kodePengiriman" class="form-control" {{ $able }} placeholder="{{ ($pesananAll->kodePengiriman) }}">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Pesan</td>
                                <td>
                                    @if($currentStatus != null)
                                        <textarea wire:model="pesan" class="form-control" {{ $able }} placeholder="{{ $pesananAll->pesan }}">{{ $pesananAll->pesan }}</textarea>
                                    @else
                                        <textarea wire:model="pesan" class="form-control" disabled placeholder="{{ $pesananAll->pesan }}">{{ $pesananAll->pesan }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button wire:click="edit" class="btn btn-add">{{ $btn }}</button>
            </div>
            <!--End col kanan-->
        </div>
    </div>
</div>
