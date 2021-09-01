<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();



Route::middleware('auth')->group(function () {
    Route::get('dashboard', 'HomeController@index')->name('home');

    // advances
    Route::middleware(['role:superadmin'])->resource('advances', 'AdvanceController')->parameters([
        'advances' => 'advance:slug',
    ]);

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

    // dailyjobs
    Route::get('daily_jobs/timeline', 'DailyJobController@timeline')->name('daily_jobs.timeline');
    Route::resource('daily_jobs', 'DailyJobController')->parameters([
        'daily_jobs' => 'daily_job:slug',
    ]);

    // funnels
    Route::get('funnels/create', 'FunnelController@create')->name('funnels.create')->middleware('count');
    Route::resource('funnels', 'FunnelController')->parameters([
        'funnels' => 'funnel:slug',
    ])->except(['create']);

    //  hospitals

    Route::middleware(['role:superadmin|sales|admin'])->group(function () {
        Route::post('hospitals/select', 'SelectHospitalController')->name('hospitals.select');
        Route::post('hospitals/district', 'HospitalController@district')->name('hospitals.select.district');
        Route::resource('hospitals', 'HospitalController')->parameters([
            'hospitals' => 'hospital:slug',
        ]);
    });


    // inventories
    Route::prefix('inventories')->name('inventories.')->middleware(['role:superadmin|admin'])->group(function () {
        Route::get('{inventory:slug}/edit', 'InventoryController@edit')->name('edit');
        Route::patch('{inventory:slug}/update', 'InventoryController@update')->name('update');
        Route::delete('{inventory:slug}', 'InventoryTypeController@destroy')->name('destroy');
    });
    Route::resource('inventories', 'InventoryController')->parameters([
        'inventories' => 'inventory:slug',
    ])->except(['edit', 'update', 'delete']);

    // invoices
    Route::prefix('invoices')->name('invoices.')->group(function () {
        Route::get('{offer:slug}/print', 'InvoiceController@print')->name('print');
        Route::get('{offer:slug}', 'InvoiceController@show')->name('order');
        Route::get('{offer:slug}/order', 'InvoiceController@toOrder')->name('toOrder');
        Route::post('{invoice:id}/repeat', 'InvoiceController@repeat')->name('repeat');
    });

    // managements users
    Route::middleware('role:superadmin')->group(function () {
        Route::patch('managements/{user:username}/remove-role', 'ManagementController@removeRole')->name('managements.removeRole');
        Route::resource('managements', 'ManagementController')->parameters([
            'managements' => 'user:username',
        ]);
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
        Route::patch('{offer:slug}/note_edit', 'OfferNoteController')->name('note_edit');
    });

    // offers resource
    Route::resource('offers', 'OfferController')->parameters([
        'offers' => 'offer:slug',
    ])->except(['create', 'show']);

    // offerfunnel
    Route::prefix('offerfunnel')->name('offerfunnel.')->group(function () {
        Route::get('{funnel:slug}/edit', 'OfferFunnelController@edit')->name('edit');
        Route::patch('{funnel:slug}', 'OfferFunnelController@update')->name('update');
    });

    // payments
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::patch('{tax}/update', 'PaymentController@update')->name('update');
    });

    // PROFILES
    Route::prefix('profiles')->name('profiles.')->group(function () {
        Route::patch('{user:username}/password', 'ProfileController@changePassword')->name('password');
        Route::patch('{user:username}/picture', 'ProfileController@updatePicture')->name('picture');
    });

    Route::resource('profiles', 'ProfileController')->parameters([
        'profiles' => 'user:username',
    ]);

    // progresses
    Route::prefix('progresses')->name('progresses.')->group(function () {
        Route::get('approval', 'ProgressController@approval')->name('approval');
        Route::get('{offer:slug}', 'ProgressController@create')->name('create');
        Route::patch('{offer:slug}/update', 'ProgressController@update')->name('update');
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
