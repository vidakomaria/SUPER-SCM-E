<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $data = Checkout::all();
        $checkouts = $data->groupBy('id_supplier');
        // $checkouts->all();
        return view('pemilik.checkout.index',[
            'checkouts' => $checkouts,
        ]);
    }
}
