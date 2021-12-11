<?php

namespace App\Http\Livewire;

use App\Models\DaftarRekening;
use Livewire\Component;
use function Livewire\str;

class AkunIndex extends Component
{
    public $btn = 'Edit';
    public $disable = 'disabled';

    public $namaBank;
    public $namaPemilikRekening;
    public $noRekening;

    public function edit()
    {
        $dataRekening = DaftarRekening::where('id_user',auth()->user()->id)->first();

        if ($this->btn == 'Edit'){
            $this->btn = 'Save';
            $this->disable = null;
        }
        elseif ($this->btn == 'Save'){
            if ($this->noRekening == null AND $dataRekening->no_rekening != null){
                $this->noRekening = $dataRekening->no_rekening;
            }
            if ($this->namaBank == null AND $dataRekening->namaBank != null){
                $this->namaBank = $dataRekening->namaBank;
            }
            if ($this->namaPemilikRekening == null AND $dataRekening->namaAkunBank != null){
                $this->namaPemilikRekening = $dataRekening->namaAkunBank;
            }
//            $rules = [
//                'noRekening'    => 'required',
//                'namaBank'      => 'required',
//                'namaPemilikRekening' => 'numeric|min:0',
//            ];
//
//            $this->validate($rules);

            $newData = [
                'no_rekening'   => $this->noRekening,
                'namaBank'      => $this->namaBank,
                'namaAkunBank'  => $this->namaPemilikRekening,
            ];

            if ($dataRekening){
                $dataRekening->update($newData);
            }
            else{
                $newData['id_user'] = auth()->user()->id;
                DaftarRekening::create($newData);
            }
            $this->btn = 'Edit';
            $this->disable = 'disabled';
            return $this->redirect('/supplier/akun/'.auth()->user()->id);
        }
    }

    public function render()
    {
//        $this->dataRekening();
        $rekening = DaftarRekening::where('id_user', auth()->user()->id)->first();
        if ($rekening){
            $dataRekening = $rekening;
        } else{
            $dataRekening = null;
        }

        return view('livewire.akun-index',[
            'rekening'  => $dataRekening,
        ]);
    }
}
