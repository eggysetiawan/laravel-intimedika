<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    // view approval penawaran & po
    Route::middleware(['role:director|superadmin'])->group(function () {
        Route::get('progresses/approval', 'ProgressController@approval')->name('progresses.approval');
        Route::get('offers/approval', 'OfferController@approval')->name('offers.approval');
    });


    // approval
    Route::middleware(['permission:approval'])->group(function () {

        Route::patch('approve/all/offers', 'ApprovalController@allOffer')->name('approval.all-offers');
        Route::patch('approve/all/progress', 'ApprovalController@allPurchase')->name('approval.all-purchase');
        Route::patch('approve/{offer:slug}/offers', 'ApprovalController@offer')->name('approval.offers');
        Route::patch('approve/{offer:slug}/progress', 'ApprovalController@progress')->name('approval.progress');
    });

    // route customers
    Route::get('customers', 'CustomerController@index')->name('customers.index');
    Route::get('customers/create', 'CustomerController@create')->name('customers.create')->middleware(['role:sales|superadmin']);
    Route::get('customers/create-2', 'CustomerController@create2')->name('customers.create-2');
    Route::post('customers/store', 'CustomerController@store')->name('customers.store');
    Route::get('customers/{customer:slug}/edit', 'CustomerController@edit')->name('customers.edit');
    Route::patch('customers/{customer:slug}/edit', 'CustomerController@update')->name('customers.update');
    Route::get('customers/{customer:slug}', 'CustomerController@show')->name('customers.show');


    //  hospitals
    Route::get('hospitals', 'HospitalController@index')->name('hospitals.index');
    Route::get('hospitals/create', 'HospitalController@create')->name('hospitals.create');
    Route::post('hospitals/store', 'HospitalController@store')->name('hospitals.store');
    Route::get('hospitals/{hospital:slug}/edit', 'HospitalController@edit')->name('hospitals.edit');
    Route::patch('hospitals/{hospital:slug}/edit', 'HospitalController@update')->name('hospitals.update');
    Route::delete('hospitals/{hospital:slug}/delete', 'HospitalController@destroy')->name('hospitals.delete');


    // invoices
    Route::get('invoices/{offer:slug}/print', 'InvoiceController@print')->name('invoices.print');
    Route::get('invoices/{offer:slug}', 'InvoiceController@show')->name('invoices.order');
    Route::get('invoices/{offer:slug}/order', 'InvoiceController@toOrder')->name('invoices.toOrder');
    Route::post('invoices/{invoice:id}/repeat', 'InvoiceController@repeat')->name('invoices.repeat')->middleware(['role:sales|superadmin']);


    // modalities
    Route::get('modalities', 'ModalityController@index')->name('modalities.index');
    Route::get('modalities/create', 'ModalityController@create')->name('modalities.create');
    Route::post('modalities/store', 'ModalityController@store')->name('modalities.store');
    Route::get('modalities/{modality:slug}/edit', 'ModalityController@edit')->name('modalities.edit');
    Route::patch('modalities/{modality:slug}/edit', 'ModalityController@update')->name('modalities.update');
    Route::get('modalities/{modality:slug}', 'ModalityController@show')->name('modalities.show');


    //offers
    Route::get('offers', 'OfferController@index')->name('offers.index');
    Route::get('offers/complete', 'OfferController@completed')->name('offers.complete');
    Route::get('offers/trash', 'OfferController@trash')->name('offers.trash')->middleware(['role:superadmin', 'permission:restore']);
    Route::get('offers/create', 'OfferController@create')->name('offers.create');
    Route::post('offers/store', 'OfferController@store')->name('offers.store');
    Route::delete('offers/{offer:slug}/delete', 'OfferController@destroy')->name('offers.delete');


    // progress

    Route::get('progresses/{offer:slug}', 'ProgressController@create')->name('progresses.create');
    Route::patch('progresses/{offer:slug}/update', 'ProgressController@update')->name('progresses.update');




    // search
    Route::get('search/visits', 'SearchController@visit')->name('search.visits');
    Route::get('hospitals-filter', 'SearchController@hospital')->name('hospitals.filter');
    Route::get('offers/filter', 'SearchController@offer')->name('offers.filter');
    Route::get('offers/complete/filter', 'SearchController@offerCompleted')->name('offers.filter-completed');


    // visitplan
    Route::resource('visitplan', 'VisitPlanController')->parameters([
        'visitplan' => 'visit:slug',
    ]);
    Route::get('visitplan/{visit:slug}/visiting', 'VisitPlanController@planEdit')->name('visitplan.visiting');
    Route::patch('visitplan/{visit:slug}/updateVisiting', 'VisitPlanController@planUpdate')->name('visitplan.visitingUpdate');

    // visits restore
    Route::get('visits/trash', 'VisitController@trash')->name('visits.trash')->middleware(['role:superadmin', 'permission:restore']);
    // visits
    Route::get('visits', 'VisitController@index')->name('visits.index');
    Route::get('visits/create', 'VisitController@create')->name('visits.create');
    Route::get('visits/add', 'VisitController@add')->name('visits.add');
    Route::post('visits/store', 'VisitController@store')->name('visits.store');
    Route::post('visits/addStore', 'VisitController@addStore')->name('visits.addStore');
    Route::get('visits/{visit:slug}/edit', 'VisitController@edit')->name('visits.edit');

    Route::patch('visits/{visit:slug}/edit', 'VisitController@update')->name('visits.edit');
    Route::delete('visits/{visit:slug}/delete', 'VisitController@destroy')->name('visits.delete');
    Route::get('visits/{visit:slug}/restore', 'VisitController@restore')->name('visits.restore')->middleware(['role:superadmin']);
    Route::get('visits/{visit:slug}', 'VisitController@show')->name('visits.show');
});
