<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\Offer\TwoFactorCode;
use App\Offer;


class TwoFactorController extends Controller
{
    // offer
    public function allOfferApprove()
    {
        $route = route('approval.all-offers');
        return view('verify.approve', compact('route'));
    }

    public function allOfferReject()
    {
        $route = route('approval.all-offers');
        return view('verify.reject', compact('route'));
    }

    public function offerApprove(Offer $offer)
    {
        $route = route('approval.offers', $offer->slug);
        return view('verify.approve', compact('offer', 'route'));
    }

    public function offerReject(Offer $offer)
    {
        $route = route('approval.offers', $offer->slug);
        return view('verify.reject', compact('offer', 'route'));
    }

    // purchase
    public function allPurchaseApprove()
    {
        $route = route('approval.all-purchase');
        return view('verify.approve', compact('route'));
    }

    public function allPurchaseReject()
    {
        $route = route('approval.all-purchase');
        return view('verify.reject', compact('route'));
    }

    public function purchaseApprove(Offer $offer)
    {
        $route = route('approval.progress', $offer->slug);
        return view('verify.approve', compact('offer', 'route'));
    }

    public function purchaseReject(Offer $offer)
    {
        $route = route('approval.progress', $offer->slug);
        return view('verify.reject', compact('offer', 'route'));
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
