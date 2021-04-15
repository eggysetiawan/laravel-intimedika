<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::prefix('pdf')->group(function () {
    Route::get('{offer:slug}', 'PdfController@offer')->name('pdf.offer');
});

Route::prefix('excel')->middleware('auth')->group(function () {
    Route::get('offers', 'ExcelController@offer')->name('excel.offer');
    Route::get('visits', 'ExcelController@visit')->name('excel.visit');
    Route::get('hospitals', 'ExcelController@hospital')->name('excel.hospital');
    Route::get('customers', 'ExcelController@customer')->name('excel.customer');
    Route::get('funnels', 'ExcelController@funnel')->name('excel.funnel');
    Route::get('modalities', 'ExcelController@modality')->name('excel.modality');
});
