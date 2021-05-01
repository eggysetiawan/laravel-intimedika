<?php

namespace App\Http\Controllers;

use App\DataTables\OfferDataTable;
use App\Http\Requests\ApprovalRequest;
use App\Offer;
use App\OfferProgress;

class ApprovalController extends Controller
{

    public function index(OfferDataTable $dataTable)
    {
        return $dataTable
            ->with([
                'approval' => true,
            ])
            ->render('offers.index', [
                'tableHeader' => 'Ready to Approve',
                'approval' => Offer::readyToApproveCount(),
            ]);
    }

    public function allPurchase(ApprovalRequest $request)
    {
        abort_unless(auth()->user()->two_factor_code, 403); //abort jika  belum request otp
        $request->all();

        // approved
        if ($request->approval == 1) {
            $approval = 1;
            $message = 'Pruchase Order telah berhasil di approve!';
            $progress = 100;
        }

        // rejected
        if ($request->approval == 2) {
            $approval = 2;
            $message = 'Purchase Order telah berhasil di reject!';
            $progress = 0;
        }

        OfferProgress::whereNull('is_approved')
            ->where('progress', 99)
            ->update([
                'is_approved' => $approval,
                'approved_by' => auth()->id(),
                'approved_at' => now(),
                'progress' => $progress,
            ]);

        auth()->user()->resetTwoFactorCode();
        session()->flash('success', $message);
        return redirect('offers');
    }
    public function allOffer(ApprovalRequest $request)
    {
        abort_unless(auth()->user()->two_factor_code, 403); //abort jika  belum request otp
        $request->all();

        //  approved
        if ($request->approval == 1) {
            $approval = 1;
            $progress = 30;
            $message = 'Semua Penawaran telah berhasil di approve!';
        }

        // rejected
        if ($request->approval == 2) {
            $approval = 2;
            $progress = 0;
            $message = 'Semua Penawaran telah berhasil di reject!';
        }

        $offer = Offer::whereNull('is_approved');
        $offer->update([
            'is_approved' => $approval,
            'approved_by' => auth()->id(),
            'approved_at' => now()
        ]);

        // $offerId = $offer->pluck('id')->all();
        // foreach ($offerId as $id) {
        //     $offer_progress = OfferProgress::findOrFail($id);
        //     $offer_progress->update([
        //         'progress' => $progress
        //     ]);
        // }


        auth()->user()->resetTwoFactorCode();
        session()->flash('success', $message);
        return redirect('offers');
    }

    public function progress(ApprovalRequest $request, Offer $offer)
    {
        abort_unless(auth()->user()->two_factor_code, 403); //abort jika  belum request otp
        $request->all();

        // approved
        if ($request->approval == 1) {
            $approval = 1;
            $message = 'Purchase Order telah berhasil di approve!';
            $progress = 100;
        }

        // rejected
        if ($request->approval == 2) {
            $approval = 2;
            $message = 'Purchse Order telah berhasil di reject!';
            $progress = 0;
        }

        $offer->progress->update([
            'progress' => $progress,
            'is_approved' => $approval,
            'approved_by' => auth()->id(),
            'approved_at' => now()
        ]);

        auth()->user()->resetTwoFactorCode();
        session()->flash('success', $message);
        return redirect('offers');
    }

    public function offer(ApprovalRequest $request, Offer $offer)
    {
        abort_unless(auth()->user()->two_factor_code, 403); //abort jika  belum request otp
        $request->all();

        // get approved
        if ($request->approval == 1) {
            $approval = 1;
            $message = 'Penawaran telah berhasil di approve!';
        }

        // get rejected
        if ($request->approval == 2) {
            $approval = 2;
            $message = 'Penawaran telah berhasil di reject!';
        }

        $offer->update([
            'is_approved' => $approval,
            'approved_by' => auth()->id(),
            'approved_at' => now()
        ]);

        auth()->user()->resetTwoFactorCode();
        session()->flash('success', $message);
        return redirect('offers');
    }
}
