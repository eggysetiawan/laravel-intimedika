<?php

use App\Http\Controllers\Api\v1\{ApiCustomerController, ApiHospitalController, ApiVisitController, SelectHospitalController};
use Illuminate\Support\Facades\Route;

Route::get('hospitals', ([ApiHospitalController::class, 'index']));
Route::get('customers', ([ApiCustomerController::class, 'index']));
Route::prefix('visits')->group(function () {
    Route::get('', [ApiVisitController::class, 'index']);
    Route::post('store', [ApiVisitController::class, 'store']);
    Route::get('{visit:slug}', [ApiVisitController::class, 'show']);
    Route::patch('{visit:slug}/edit', [ApiVisitController::class, 'update']);
    Route::delete('{visit:slug}/delete', [ApiVisitController::class, 'destroy']);
});
