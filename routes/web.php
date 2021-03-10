<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    // view approval penawaran & po
    Route::middleware(['role:director|superadmin'])->group(function () {
        Route::get('progresses/approval', 'ProgressController@approval')->name('progresses.approval');
        Route::get('offers/approval', 'ApprovalController@index')->name('offers.approval');
    });


    // approval
    Route::middleware(['permission:approval'])->group(function () {
        Route::patch('approve/all/offers', 'ApprovalController@allOffer')->name('approval.all-offers');
        Route::patch('approve/all/progress', 'ApprovalController@allPurchase')->name('approval.all-purchase');
        Route::patch('approve/{offer:slug}/offers', 'ApprovalController@offer')->name('approval.offers');
        Route::patch('approve/{offer:slug}/progress', 'ApprovalController@progress')->name('approval.progress');
    });
    // arrived
    Route::resource('arrival', 'ArrivalController')->parameters([
        'arrival' => 'visit:slug',
    ]);
    // route customers
    Route::get('customers/create-2', 'CustomerController@create2')->name('customers.create-2');
    Route::resource('customers', 'CustomerController')->parameters([
        'customers' => 'customer:slug',
    ]);

    // route funnels
    Route::resource('funnels', 'FunnelController')->parameters([
        'funnels' => 'funnel:slug',
    ]);

    //  hospitals
    Route::resource('hospitals', 'HospitalController')->parameters([
        'hospitals' => 'hospital:slug',
    ]);
    // invoices
    Route::get('invoices/{offer:slug}/print', 'InvoiceController@print')->name('invoices.print');
    Route::get('invoices/{offer:slug}', 'InvoiceController@show')->name('invoices.order');
    Route::get('invoices/{offer:slug}/order', 'InvoiceController@toOrder')->name('invoices.toOrder');
    Route::post('invoices/{invoice:id}/repeat', 'InvoiceController@repeat')->name('invoices.repeat')->middleware(['role:sales|superadmin']);
    // modalities
    Route::resource('modalities', 'ModalityController')->parameters([
        'modalities' => 'modality:slug',
    ]);
    //offers
    Route::resource('offers', 'OfferController')->parameters([
        'offers' => 'offer:slug',
    ]);
    Route::get('offers/completed', 'OfferCompletedController')->name('offers.complete');
    Route::get('offers/trash', 'OfferController@trash')->name('offers.trash')->middleware(['role:superadmin', 'permission:restore']);


    // progress
    Route::get('progresses/{offer:slug}', 'ProgressController@create')->name('progresses.create');
    Route::patch('progresses/{offer:slug}/update', 'ProgressController@update')->name('progresses.update');
    // search
    Route::get('search/visits', 'SearchController@visit')->name('search.visits');
    Route::get('hospitals-filter', 'SearchController@hospital')->name('hospitals.filter');
    Route::get('offers/filter', 'SearchController@offer')->name('offers.filter');
    Route::get('offers/complete/filter', 'SearchController@offerCompleted')->name('offers.filter-completed');

    // revision
    Route::get('revisions/{offer:slug}/edit', 'RevisionController@edit')
        ->middleware(['role:director|superadmin'])
        ->name('revisions.edit');
    Route::patch('revisions/{offer:slug}', 'RevisionController@update')
        ->middleware(['role:director|superadmin'])
        ->name('revisions.update');

    // visit trash
    Route::get('visits/trash', 'VisitController@trash')->name('visits.trash')->middleware(['role:superadmin', 'permission:restore']);

    Route::get('visits/restore/{visit:slug}', 'VisitController@restore')->name('visits.restore')->middleware(['role:superadmin']);
    // visitplan
    Route::resource('visitplan', 'VisitPlanController')->parameters([
        'visitplan' => 'visit:slug',
    ]);
    // visit add
    Route::resource('visitadd', 'VisitAddController')->parameters([
        'visitadd' => 'visit:slug',
    ]);
    // visits
    Route::resource('visits', 'VisitController')->parameters([
        'visits' => 'visit:slug',
    ]);
});
