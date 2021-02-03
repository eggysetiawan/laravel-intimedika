<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('visits', 'VisitController@index')->name('visits.index');
    Route::get('visits/create', 'VisitController@create')->name('visits.create');
    Route::get('visits/add', 'VisitController@add')->name('visits.add');
    Route::post('visits/store', 'VisitController@store')->name('visits.store');
    Route::post('visits/addStore', 'VisitController@addStore')->name('visits.addStore');
    Route::get('visits/{visit:slug}/edit', 'VisitController@edit')->name('visits.edit');
    Route::patch('visits/{visit:slug}/edit', 'VisitController@update')->name('visits.edit');
    Route::delete('visits/{visit:slug}/delete', 'VisitController@destroy')->name('visits.delete');
    Route::get('visits/{visit:slug}', 'VisitController@show')->name('visits.show');

    // route customers
    Route::get('customers', 'CustomerController@index')->name('customers.index');
    Route::get('customers/create', 'CustomerController@create')->name('customers.create');
    Route::get('customers/create-2', 'CustomerController@create2')->name('customers.create-2');
    Route::post('customers/store', 'CustomerController@store')->name('customers.store');
    Route::get('customers/{customer:slug}/edit', 'CustomerController@edit')->name('customers.edit');
    Route::patch('customers/{customer:slug}/edit', 'CustomerController@update')->name('customers.update');
    Route::get('customers/{customer:slug}', 'CustomerController@show')->name('customers.show');

    // route modalities
    Route::get('modalities', 'ModalityController@index')->name('modalities.index');
    Route::get('modalities/create', 'ModalityController@create')->name('modalities.create');
    Route::post('modalities/store', 'ModalityController@store')->name('modalities.store');
    Route::get('modalities/{modality:slug}/edit', 'ModalityController@edit')->name('modalities.edit');
    Route::patch('modalities/{modality:slug}/edit', 'ModalityController@update')->name('modalities.update');
    Route::get('modalities/{modality:slug}', 'ModalityController@show')->name('modalities.show');

    // route hospitals
    Route::get('hospitals', 'HospitalController@index')->name('hospitals.index');
    Route::get('hospitals/create', 'HospitalController@create')->name('hospitals.create');
    Route::post('hospitals/store', 'HospitalController@store')->name('hospitals.store');
    Route::get('hospitals/{hospital:slug}/edit', 'HospitalController@edit')->name('hospitals.edit');
    Route::patch('hospitals/{hospital:slug}/edit', 'HospitalController@update')->name('hospitals.update');
    Route::delete('hospitals/{hospital:slug}/delete', 'HospitalController@destroy')->name('hospitals.delete');


    //hospitals
    Route::get('offers', 'OfferController@index')->name('offers.index');
    Route::get('offers/create', 'OfferController@create')->name('offers.create');
    Route::post('offers/store', 'OfferController@store')->name('offers.store');

    // invoices
    Route::get('invoices/{offer:slug}', 'InvoiceController@show')->name('invoices.order');
    Route::get('invoices/{offer:slug}/print', 'InvoiceController@print')->name('invoices.print');

    // search
    Route::get('search/visits', 'SearchController@visit')->name('search.visits');
    Route::get('hospitals-filter', 'SearchController@hospital')->name('hospitals.filter');
    Route::get('offers-filter', 'SearchController@offer')->name('offers.filter');

    // approval
    Route::get('approve/{offer:slug}/offers', 'ApprovalController@offer')->name('approval.offers');
});
