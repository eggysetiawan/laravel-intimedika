<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('login/email', 'LoginEmailController')->name('login.email');
Route::get('email/success', 'ResendEmailController')->name('login.resend');
