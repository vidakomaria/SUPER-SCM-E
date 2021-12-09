<div>
    <div class="container-fluid mt-3 pt-2 ms-0 px-0">
        <!--Input Produk-->
        <div class="border rounded-3 p-2 mx-0">
            <div class="row">
                <div class="d-flex bd-highlight">
                    <div class="bd-highlight col-2">
                        <label for="id_produk">ID Produk</label>
                    </div>
                    <div class="bd-highlight col-3 ps-1 pe-3">
                        <input type="text" name="id_produk" list="produk"  wire:model="id_produk" class="form-control @error('id_produk') is-invalid @enderror">
                        <datalist id="produk">
                            @foreach($produk as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                            @endforeach
                        </datalist>
                        @error('id_produk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="ms-auto p-2 bd-highlight">
                        {{ $tgl }}
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-2"><label for="qty">Quantity</label></div>
                <div class="col-3">
                    <input type="number" name="qty"  wire:model="qty" class="form-control @error('qty') is-invalid @enderror">
                    @error('qty')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col"><button wire:click="add" class="btn btn-add">Tambah</button></div>
            </div>
        </div>

        <!--Tabel-->
        <div class="border rounded-3 p-2 mx-0 my-2">
            <table class="table table-striped table-green table-sm table-borderless align-middle">
                <thead class="table table-striped table-borderless text-centertext-center">
                <tr class="text-center">
                    <th scope="col">ID Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody class="text-center">
                @foreach ( $transactions as $transaksi )
                    <tr>
                        <td>{{ $transaksi->id_produk }}</td>
                        <td>{{ ucwords($transaksi->produk->nama_produk) }}</td>
                        <td>Rp. {{ number_format($transaksi->produk->harga) }}</td>
                        <td>{{ $transaksi->qty }}</td>
                        <td>Rp. {{ number_format($transaksi->sub_total) }}</td>
                        <td >
                            <button type="submit" wire:click="deleteTransaction({{ $transaksi->id }})" class="btn text-danger"><i class="bi bi-x-lg"></i>  Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--Pembayaran-->
            <div class="d-flex flex-row-reverse bd-highlight pe-3">
                <div class="p-2 bd-highlight col-6">
                    <table>
                        <tr>
                            <td class="p-2">Total</td>
                            <td class="ps-5">: Rp. </td>
                            <td>{{ number_format($transactions->sum('sub_total')) }}</td>
                        </tr>
                        <tr>
                            <td class="p-2">Bayar</td>
                            <td class="ps-5 pe-2"> : Rp. </td>
                            <td><input type="number" wire:model="bayar"
                                             class="form-control width-auto @error ('bayar') is-invalid @enderror" id="bayar"
                                             style="height: 34px; width:80%; margin-left: 3px">

                                @error('bayar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr class="bg-light">
                            <td class="p-2">Kembali</td>
                            <td class="ps-5">: Rp. </td>
                            <td>{{ number_format($bayar - ($transactions->sum('sub_total'))) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--Button-->
            <div class="d-flex flex-row-reverse bd-highlight">
                <div class="row p-2 bd-highlight col-2 mx-2">
                    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#saveModal">Simpan</button>
{{--                    <button class="btn btn-add" wire:click="save">Simpan</button>--}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="saveModal" data-bs-backdrop="static" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5>Apakah anda ingin mencetak?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="nota" class="btn btn-orange">IYA</button>
                    <button type="button" wire:click="noNota" class="btn btn-green" data-bs-dismiss="modal">TIDAK</button>
                </div>
            </div>
        </div>
    </div>
</div>
