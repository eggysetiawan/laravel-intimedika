<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\Offer\TwoFactorCode;
use App\Offer;
use App\User;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    // offer
    public function allOfferApprove()
    {
        return view('verify.all-offer');
    }
    public function allOfferReject()
    {
        return view('verify.rejectall-offer');
    }
    public function offerApprove(Offer $offer)
    {
        return view('verify.offer-approve', compact('offer'));
    }
    public function offerReject(Offer $offer)
    {
        return view('verify.offer-reject', compact('offer'));
    }

    // purchase
    public function allPurchaseApprove()
    {
        return view('verify.all-purchase');
    }
    public function allPurchaseReject()
    {
        return view('verify.rejectall-purchase');
    }
    public function purchaseApprove(Offer $offer)
    {
        return view('verify.purchase-approve', compact('offer'));
    }
    public function purchaseReject(Offer $offer)
    {
        return view('verify.purchase-reject', compact('offer'));
    }

    public function send()
    {
        $user = auth()->user();
        $otp = $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode($otp));
        session()->flash('success', 'The two factor code has been sent to your email.');
        return back();
    }

    public function resend()
    {
        $user = auth()->user();
        $otp = $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode($otp));

        session()->flash('success', 'The two factor code has been sent again to your email.');
        return back();
    }
}
