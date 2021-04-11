<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware('auth')->group(function () {

    // view approval penawaran & po
    Route::middleware(['role:director|superadmin'])->group(function () {
        Route::get('progresses/approval', 'ProgressController@approval')->name('progresses.approval');
        Route::get('offers/approval', 'ApprovalController@index')->name('offers.approval');
    });


    // approval
    Route::group(['middleware' => ['twofactor', 'permission:approval|openworld']], function () {
        Route::patch('approve/all/offers', 'ApprovalController@allOffer')->name('approval.all-offers');
        Route::patch('approve/all/progress', 'ApprovalController@allPurchase')->name('approval.all-purchase');
        Route::middleware('twofactor')->patch('approve/{offer:slug}/offers', 'ApprovalController@offer')->name('approval.offers');
        Route::patch('approve/{offer:slug}/progress', 'ApprovalController@progress')->name('approval.progress');
    });

    // pin setup
    // Route::resource('pins', 'RegisterPinController');
    Route::get('pins/create', 'RegisterPinController@create')->name('pins.create');
    Route::patch('pins/update', 'RegisterPinController@update')->name('pins.update');

    // revision
    Route::get('revisions/{offer:slug}/edit', 'RevisionController@edit')
        ->middleware(['role:director|superadmin'])
        ->name('revisions.edit');
    Route::patch('revisions/{offer:slug}', 'RevisionController@update')
        ->middleware(['role:director|superadmin'])
        ->name('revisions.update');



    // register
    Route::post('registers', 'RegisterController')->name('registers.store')->middleware('register');

    // verify
    Route::get('verify/{offer:slug}/send', 'Auth\TwoFactorController@send')->name('verify.send');
    Route::get('verify/{offer:slug}/resend', 'Auth\TwoFactorController@resend')->name('verify.resend');

    Route::middleware('permission:approval|openworld')->prefix('verify')->group(function () {

        Route::prefix('{offer:slug}')->group(function () {
            Route::get('approve-offer', 'Auth\TwoFactorController@offerApprove')->name('verify.offer.approve');
            Route::get('reject-offer', 'Auth\TwoFactorController@offerReject')->name('verify.offer.reject');

            Route::get('approve-purchase', 'Auth\TwoFactorController@purchaseApprove')->name('verify.purchase.approve');
            Route::get('reject-purchase', 'Auth\TwoFactorController@purchaseReject')->name('verify.purchase.approve');
        });

        Route::get('approve-alloffer', 'Auth\TwoFactorController@allOfferApprove')->name('verify.alloffer.approve');
        Route::get('reject-alloffer', 'Auth\TwoFactorController@allOfferReject')->name('verify.alloffer.reject');

        Route::get('approve-allpurchase', 'Auth\TwoFactorController@allPurchaseApprove')->name('verify.allpurchase.approve');
        Route::get('reject-allpurchase', 'Auth\TwoFactorController@allPurchaseReject')->name('verify.allpurchase.reject');
    });
});
