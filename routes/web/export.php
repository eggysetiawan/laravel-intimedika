<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::prefix('pdf')->group(function () {
    Route::get('{offer:slug}', 'PdfController@offer')->name('pdf.offer');
});
