<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::middleware('auth')->group(function () {

    // view approval penawaran & po
    Route::middleware(['permission:approval|openworld'])->group(function () {
        Route::get('offers/approval', 'ApprovalController@index')->name('offers.approval');
    });

    // approval
    Route::prefix('approve')->name('approval.')->middleware(['twofactor', 'permission:approval|openworld'])->group(function () {
        Route::patch('all/offers', 'ApprovalController@allOffer')->name('all-offers');
        Route::patch('all/progress', 'ApprovalController@allPurchase')->name('all-purchase');
        Route::patch('{offer:slug}/offers', 'ApprovalController@offer')->name('offers');
        Route::patch('{offer:slug}/progress', 'ApprovalController@progress')->name('progress');
    });

    // pin setup
    Route::prefix('pins')->name('pins.')->group(function () {
        Route::get('create', 'RegisterPinController@create')->name('create');
        Route::patch('update', 'RegisterPinController@update')->name('update');
    });

    // revision
    Route::prefix('revisions')->name('revisions.')->middleware(['role:director|superadmin'])->group(function () {
        Route::get('{offer:slug}/edit', 'RevisionController@edit')->name('edit');
        Route::patch('{offer:slug}', 'RevisionController@update')->name('update');
    });

    // register
    Route::post('registers', 'RegisterController')->name('registers.store')->middleware('register');

    // verify
    Route::prefix('verify')->name('verify.')->group(function () {
        Route::get('send', 'Auth\TwoFactorController@send')->name('send');
        Route::get('resend', 'Auth\TwoFactorController@resend')->name('resend');
    });

    Route::prefix('verify')->name('verify.')->middleware('permission:approval|openworld')->group(function () {

        Route::prefix('{offer:slug}')->group(function () {
            Route::get('approve-offer', 'Auth\TwoFactorController@offerApprove')->name('offer.approve');
            Route::get('reject-offer', 'Auth\TwoFactorController@offerReject')->name('offer.reject');

            Route::get('approve-purchase', 'Auth\TwoFactorController@purchaseApprove')->name('purchase.approve');
            Route::get('reject-purchase', 'Auth\TwoFactorController@purchaseReject')->name('purchase.reject');
        });

        Route::get('approve-alloffer', 'Auth\TwoFactorController@allOfferApprove')->name('alloffer.approve');
        Route::get('reject-alloffer', 'Auth\TwoFactorController@allOfferReject')->name('alloffer.reject');

        Route::get('approve-allpurchase', 'Auth\TwoFactorController@allPurchaseApprove')->name('allpurchase.approve');
        Route::get('reject-allpurchase', 'Auth\TwoFactorController@allPurchaseReject')->name('allpurchase.reject');
    });
});
