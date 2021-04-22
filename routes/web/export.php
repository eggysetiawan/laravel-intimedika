<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::prefix('pdf')->group(function () {
    Route::get('{offer:slug}', 'PdfController@offer')->name('pdf.offer');
});

Route::prefix('excel')->middleware('auth')->name('excel.')->group(function () {
    Route::get('offers', 'ExcelController@offer')->name('offer');
    Route::get('visits', 'ExcelController@visit')->name('visit');
    Route::get('hospitals', 'ExcelController@hospital')->name('hospital');
    Route::get('customers', 'ExcelController@customer')->name('customer');
    Route::get('funnels', 'ExcelController@funnel')->name('funnel');
    Route::get('modalities', 'ExcelController@modality')->name('modality');
});
