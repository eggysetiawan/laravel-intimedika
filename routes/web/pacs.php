<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::prefix('pacs_installations')->name('pacs_installations.')->group(function () {
        Route::get('{pacs_installation:slug}/browse', 'PacsUploadController@browse')->name('browse');
        Route::patch('{pacs_installation:slug}/upload', 'PacsUploadController@upload')->name('upload');
        Route::post('select', 'SelectInstallationController')->name('pacs_installations.select');
    });


    Route::resource('pacs_installations', 'PacsInstallationController')->parameters([
        'pacs_installations' => 'pacs_installation:slug',
    ]);
    Route::resource('pacs_supports', 'PacsSupportController')->parameters([
        'pacs_supports' => 'pacs_support:slug',
    ]);
});
