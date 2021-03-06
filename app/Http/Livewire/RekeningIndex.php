<?php

namespace App\Http\Livewire;

use App\Models\Rekening;
use Livewire\Component;
use function Livewire\str;

class RekeningIndex extends Component
{
    // public $btn = 'Edit';
    public $disable = 'disabled';
    public $btnEdit = null;
    public $btnSave = 'disabled';

    public $namaBank;
    public $namaPemilikRekening;
    public $noRekening;

    public function edit(){
        $this->btnEdit = 'disabled';
        $this->disable = null;
        $this->btnSave = null;
        
        $rekening = Rekening::where('id_user',auth()->user()->id)->first();

        if($rekening){
            $this->namaBank             = $rekening->namaBank;
            $this->namaPemilikRekening  = $rekening->namaAkunBank;
            $this->noRekening           = $rekening->no_rekening;
        }
    }

    public function save()
    {


        $dataRekening = Rekening::where('id_user',auth()->user()->id)->first();

        // if ($this->btn == 'Edit'){
        //     $this->btn = 'Save';
        //     $this->disable = null;
        // }
        // elseif ($this->btn == 'Save'){
            // if ($this->noRekening == null AND $dataRekening->no_rekening != null){
            //     $this->noRekening = $dataRekening->no_rekening;
            // }
            // if ($this->namaBank == null AND $dataRekening->namaBank != null){
            //     $this->namaBank = $dataRekening->namaBank;
            // }
            // if ($this->namaPemilikRekening == null AND $dataRekening->namaAkunBank != null){
            //     $this->namaPemilikRekening = $dataRekening->namaAkunBank;
            // }

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
                Rekening::create($newData);
            }
            // $this->btn = 'Edit';
            $this->disable = 'disabled';
            return $this->redirect('/supplier/akun/'.auth()->user()->id);
        // }
    }

    public function render()
    {
//        $this->dataRekening();
        $rekening = Rekening::where('id_user', auth()->user()->id)->first();
        if ($rekening){
            $dataRekening = $rekening;
        } else{
            $dataRekening = null;
        }

        return view('livewire.rekening-index',[
            'rekening'  => $dataRekening,
        ]);
    }
}
