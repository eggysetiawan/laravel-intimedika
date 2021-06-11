<?php

use App\Http\Livewire\Guest\Intiwid;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();


Route::prefix('products')->name('products.')->group(function () {
    Route::get('intiwid', [Intiwid::class, 'render'])->name('intiwid');
});
