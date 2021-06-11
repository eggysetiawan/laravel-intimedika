<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('login/email', 'LoginEmailController')->name('login.email');
Route::get('email/success', 'ResendEmailController')->name('login.resend');

// Route::get('products/intwid', 'ProductController@test');
Route::resource('products', 'ProductController')->parameters([
    'products' => 'product:slug',
]);
Route::resource('/', 'CompanyProfileController')->parameters([
    'company_profiles' => 'company_profiles:slug',
]);
