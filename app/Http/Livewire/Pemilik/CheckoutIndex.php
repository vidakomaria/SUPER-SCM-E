<?php

namespace App\Http\Livewire\Pemilik;

use App\Models\Checkout;
use App\Models\Pengiriman;
use Livewire\Component;

class CheckoutIndex extends Component
{
    public $pengiriman;

    public function render()
    {
        $data = Checkout::all();
        $pengiriman = Pengiriman::all();
        $checkouts = $data->groupBy('id_supplier');
        return view('livewire.pemilik.checkout-index',[
            'checkouts' => $data,
            'opsiPengiriman'    => $pengiriman,
        ]);

    }
}
