<?php

namespace App\Http\Controllers;

use App\Tax;

class PaymentController extends Controller
{
    public function update(Tax $tax)
    {
        $tax->update([
            'is_paid' => 1
        ]);

        session()->flash('success', 'Status pembayaran telah diperbarui!');
        return back();
    }
}
