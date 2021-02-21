<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprovalRequest;
use App\Offer;
use App\OfferProgress;

class ApprovalController extends Controller
{

    public function allPurchase(ApprovalRequest $request)
    {
        $request->all();
        if ($request->approval == 1) :
            // get approved
            $approval = 1;
            $message = 'Pruchase Order berhasil di approve!';
        else :
            // get rejected
            $approval = 2;
            $message = 'Purchase Order berhasil di reject!';
        endif;
        $approved_by = auth()->id();
        OfferProgress::whereNull('is_approved')
            ->update([
                'is_approved' => $approval,
                'approved_by' => $approved_by,
                'approved_at' => now(),
                'progress' => 100
            ]);

        session()->flash('success', $message);
        return redirect('offers');
    }
    public function allOffer(ApprovalRequest $request)
    {
        $request->all();
        if ($request->approval == 1) :
            // get approved
            $approval = 1;
            $message = 'Penawaran berhasil di approve!';
        else :
            // get rejected
            $approval = 2;
            $message = 'Penawaran berhasil di reject!';
        endif;
        $approved_by = auth()->id();
        Offer::whereNull('is_approved')
            ->update([
                'is_approved' => $approval,
                'approved_by' => $approved_by,
                'approved_at' => now()
            ]);

        session()->flash('success', $message);
        return redirect('offers');
    }

    public function progress(ApprovalRequest $request, Offer $offer)
    {
        $request->all();
        if ($request->approval == 1) :
            // get approved
            $approval = 1;
            $message = 'Purchase Order berhasil di approve!';
        else :
            // get rejected
            $approval = 2;
            $message = 'Purchse Order berhasil di reject!';
        endif;
        $approved_by = auth()->id();


        $offer->progress->update([
            'progress' => 100,
            'is_approved' => $approval,
            'approved_by' => $approved_by,
            'approved_at' => now()
        ]);

        session()->flash('success', $message);

        return back();
    }

    public function offer(ApprovalRequest $request, Offer $offer)
    {
        $request->all();
        if ($request->approval == 1) :
            $approval = 1;
            $message = 'Penawaran berhasil di approve!';
        else :
            $approval = 2;
            $message = 'Penawaran berhasil di reject!';
        endif;
        $approved_by = auth()->id();

        $offer->update([
            'is_approved' => $approval,
            'approved_by' => $approved_by,
            'approved_at' => now()
        ]);

        session()->flash('success', $message);

        return back();
    }
}
