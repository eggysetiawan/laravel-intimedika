<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::prefix('pdf')->name('pdf.')->group(function () {
    Route::get('{advance:slug}/advance', 'PdfController@advance')->name('advance');
    Route::get('{offer:slug}/offer', 'PdfController@offer')->name('offer');
    Route::get('{pacs_installation:slug}/pacs', 'PdfController@pacsinstallation')->name('pacs_installation');
});

Route::prefix('excel')->middleware('auth')->name('excel.')->group(function () {
    Route::get('offers', 'ExcelController@offer')->name('offer');
    Route::get('visits', 'ExcelController@visit')->name('visit');
    Route::get('hospitals', 'ExcelController@hospital')->name('hospital');
    Route::get('customers', 'ExcelController@customer')->name('customer');
    Route::get('funnels', 'ExcelController@funnel')->name('funnel');
    Route::get('modalities', 'ExcelController@modality')->name('modality');
});
