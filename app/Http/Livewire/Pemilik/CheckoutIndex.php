<?php

namespace App\Http\Livewire\Pemilik;

use App\Models\Checkout;
use Livewire\Component;

class CheckoutIndex extends Component
{
    public $pengiriman;
    public function render()
    {
        $data = Checkout::all();
        $checkouts = $data->groupBy('id_supplier');
        return view('livewire.pemilik.checkout-index',[
            'checkouts' => $checkouts,
        ]);

    }
}
