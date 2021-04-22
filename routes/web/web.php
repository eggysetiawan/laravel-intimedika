<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();



Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    // advances
    Route::resource('advances', 'AdvanceController');

    // arrived
    Route::resource('arrival', 'ArrivalController')->parameters([
        'arrival' => 'visit:slug',
    ]);

    // customers
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::post('select', 'SelectCustomerController')->name('select');
        Route::get('create-2', 'CustomerController@create2')->name('create-2');
    });

    // customers resource
    Route::resource('customers', 'CustomerController')->parameters([
        'customers' => 'customer:slug',
    ]);

    // funnels
    Route::get('funnels/create', 'FunnelController@create')->name('funnels.create')->middleware('count');
    Route::resource('funnels', 'FunnelController')->parameters([
        'funnels' => 'funnel:slug',
    ])->except(['create']);

    //  hospitals
    Route::post('hospitals/select', 'SelectHospitalController')->name('hospitals.select');
    Route::resource('hospitals', 'HospitalController')->parameters([
        'hospitals' => 'hospital:slug',
    ]);

    // invoices
    Route::prefix('invoices')->name('invoices.')->group(function () {
        Route::get('{offer:slug}/print', 'InvoiceController@print')->name('print');
        Route::get('{offer:slug}', 'InvoiceController@show')->name('order');
        Route::get('{offer:slug}/order', 'InvoiceController@toOrder')->name('toOrder');
        Route::post('{invoice:id}/repeat', 'InvoiceController@repeat')->name('repeat');
    });

    // modalities
    Route::resource('modalities', 'ModalityController')->parameters([
        'modalities' => 'modality:slug',
    ]);

    //offers
    Route::prefix('offers')->name('offers.')->group(function () {
        Route::get('completed', 'OfferCompletedController')->name('complete');
        Route::middleware('count')->get('create', 'OfferController@create')->name('create');
        Route::middleware(['role:superadmin'])->get('trash', 'OfferController@trash')->name('trash');
    });

    // offers resource
    Route::resource('offers', 'OfferController')->parameters([
        'offers' => 'offer:slug',
    ])->except(['create', 'show']);

    // offerfunnel
    Route::prefix('offerfunnel')->name('offerfunnel.')->group(function () {
        Route::get('{funnel:slug}/edit', 'OfferFunnelController@edit')->name('edit');
        Route::patch('{funnel:slug}', 'OfferFunnelController@edit')->name('update');
    });

    // progresses
    Route::prefix('progresses')->name('progresses.')->group(function () {
        Route::get('approval', 'ProgressController@approval')->name('approval');
        Route::get('{offer:slug}', 'ProgressController@create')->name('create');
        Route::patch('{offer:slug}/update', 'ProgressController@update')->name('update');
    });

    // search
    Route::prefix('search')->group(function () {
        Route::get('visits', 'SearchController@visit')->name('search.visits');
        Route::get('hospitals', 'SearchController@hospital')->name('hospitals.filter');
        Route::get('offers', 'SearchController@offer')->name('offers.filter');
        Route::get('complete/offers', 'SearchController@offerCompleted')->name('offers.filter-completed');
    });


    // targets
    Route::resource('targets', 'TargetController');

    // visit trash
    Route::get('visits/trash', 'VisitController@trash')->name('visits.trash')->middleware(['role:superadmin']);

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
