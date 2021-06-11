<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', 'LandingPageController')->name('landingpage.home');
Route::get('contact-us', 'ContactUsController@index')->name('contact');
Route::get('login/email', 'LoginEmailController')->name('login.email');
Route::get('email/success', 'ResendEmailController')->name('login.resend');

// Route::get('products/intwid', 'ProductController@test');
Route::resource('products', 'ProductController')->parameters([
    'products' => 'product:slug',
]);
