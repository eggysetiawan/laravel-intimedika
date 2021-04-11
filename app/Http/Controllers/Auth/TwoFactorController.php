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
    public function allOfferApprove(Offer $offer)
    {
        return view('verify.all-offer', compact('offer'));
    }
    public function allOfferReject(Offer $offer)
    {
        return view('verify.rejectall-offer', compact('offer'));
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
    public function allPurchaseApprove(Offer $offer)
    {
        return view('verify.all-purchase', compact('offer'));
    }
    public function allPurchaseReject(Offer $offer)
    {
        return view('verify.rejectall-purchase', compact('offer'));
    }
    public function purchaseApprove(Offer $offer)
    {
        return view('verify.purchase-approve', compact('offer'));
    }
    public function purchaseReject(Offer $offer)
    {
        return view('verify.purchase-reject', compact('offer'));
    }

    public function send(Offer $offer)
    {
        $user = auth()->user();
        $otp = $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode($offer, $otp));
        session()->flash('success', 'The two factor code has been sent to your email.');
        return back();
    }

    public function resend(Offer $offer)
    {
        $user = auth()->user();
        $otp = $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode($offer, $otp));

        session()->flash('success', 'The two factor code has been sent again to your email.');
        return back();
    }
}
