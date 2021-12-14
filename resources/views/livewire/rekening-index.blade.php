<div>
    <div class="">
{{--        {{ dd($rekening->no_rekening) }}--}}
        <strong class="mt-2">Data Rekening <hr></strong>
        <table class="table-responsive mb-3">
            <tr>
                <th class="py-2">Nama Bank</th>
                <td class="px-1">:</td>
                <td>
                    @if($rekening != null)
                        <input type="text" wire:model='namaBank' placeholder="{{ $rekening->namaBank }}" class="form-control bg-white" {{ $disable }}>
                    @else
                            <input type="text" wire:model='namaBank' placeholder="" class="form-control bg-white" {{ $disable }}>
                    @endif
                </td>
            </tr>
            <tr>
                <th class="py-2">Nama Pemilik Rekening</th>
                <td class="px-1">:</td>
                <td>
                    @if($rekening != null)
                        <input type="text" wire:model='namaPemilikRekening' placeholder="{{ $rekening->namaAkunBank }}" class="form-control bg-white" {{ $disable }}>
                    @else
                        <input type="text" wire:model='namaPemilikRekening' placeholder="" class="form-control bg-white" {{ $disable }}>
                    @endif
                </td>
            </tr>
            <tr>
                <th class="py-2">No. Rekening</th>
                <td class="px-1">:</td>
                <td>
                    @if($rekening != null)
                        <input type="text" wire:model="noRekening" name="no_rekening" placeholder="{{ $rekening->no_rekening }}" class="form-control bg-white" {{ $disable }}>
                    @else
                        <input type="text" wire:model="noRekening" name="no_rekening" placeholder="" class="form-control bg-white" {{ $disable }}>
                    @endif
                </td>
            </tr>
        </table>
        <button wire:click="edit" class="btn btn-warning" {{ $btnEdit }}>Edit</button>
        <button wire:click="save" class="btn btn-add" {{ $btnSave }}>Save</button>
    </div>
</div>
