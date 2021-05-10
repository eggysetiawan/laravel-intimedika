<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

// search
Route::prefix('search')->group(function () {
    Route::get('visits', 'SearchController@visit')->name('search.visits');
    Route::get('hospitals', 'SearchController@hospital')->name('hospitals.filter');
    Route::get('offers', 'SearchController@offer')->name('offers.filter');
    Route::get('complete/offers', 'SearchController@offerCompleted')->name('offers.filter-completed');
    Route::get('pacs_installation', 'SearchController@pacsInstallation')->name('search.pacs_installations');
});
