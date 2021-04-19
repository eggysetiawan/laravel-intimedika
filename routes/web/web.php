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

    // route customers
    Route::post('customers/select', 'SelectCustomerController')->name('customers.select');
    Route::get('customers/create-2', 'CustomerController@create2')->name('customers.create-2');
    Route::resource('customers', 'CustomerController')->parameters([
        'customers' => 'customer:slug',
    ]);

    // route funnels
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
    Route::get('invoices/{offer:slug}/print', 'InvoiceController@print')->name('invoices.print');
    Route::get('invoices/{offer:slug}', 'InvoiceController@show')->name('invoices.order');
    Route::get('invoices/{offer:slug}/order', 'InvoiceController@toOrder')->name('invoices.toOrder');
    Route::post('invoices/{invoice:id}/repeat', 'InvoiceController@repeat')->name('invoices.repeat');
    // modalities
    Route::resource('modalities', 'ModalityController')->parameters([
        'modalities' => 'modality:slug',
    ]);
    //offers
    Route::get('offers/completed', 'OfferCompletedController')->name('offers.complete');
    Route::get('offers/create', 'OfferController@create')->name('offers.create')->middleware('count');
    Route::get('offers/trash', 'OfferController@trash')->name('offers.trash')->middleware(['role:superadmin']);
    Route::resource('offers', 'OfferController')->parameters([
        'offers' => 'offer:slug',
    ])->except(['create', 'show']);

    // progress
    Route::get('progresses/approval', 'ProgressController@approval')->name('progresses.approval');

    Route::get('progresses/{offer:slug}', 'ProgressController@create')->name('progresses.create');
    Route::patch('progresses/{offer:slug}/update', 'ProgressController@update')->name('progresses.update');
    // search
    Route::get('search/visits', 'SearchController@visit')->name('search.visits');
    Route::get('hospitals-filter', 'SearchController@hospital')->name('hospitals.filter');
    Route::get('search/offers', 'SearchController@offer')->name('offers.filter');
    Route::get('search/complete/offers', 'SearchController@offerCompleted')->name('offers.filter-completed');

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
