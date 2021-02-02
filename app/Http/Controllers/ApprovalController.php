<?php

namespace App\Http\Controllers;

use App\Offer;

class ApprovalController extends Controller
{
    public function offer(Offer $offer)
    {

        if (request('approval') == 1) :
            $approval = 1;
            $message = 'Penawaran berhasil di approve!';
        else :
            $approval = 2;
            $message = 'Penawaran berhasil di reject!';
        endif;
        $approved_by = auth()->id();

        $offer->update([
            'approve' => $approval,
            'approved_by' => $approved_by,
            'approved_at' => now()
        ]);

        session()->flash('success', $message);

        return redirect('offers');
    }
}
