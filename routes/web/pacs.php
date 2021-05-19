<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::post('pacs_installations/select', 'SelectInstallationController')->name('pacs_installations.select');
    Route::resource('pacs_installations', 'PacsInstallationController')->parameters([
        'pacs_installations' => 'pacs_installation:slug',
    ]);
    Route::resource('pacs_supports', 'PacsSupportController')->parameters([
        'pacs_supports' => 'pacs_support:slug',
    ]);
});
