<?php

use App\Http\Controllers\Api\ConseilController;
use App\Http\Controllers\Api\PubliciteController;
use Illuminate\Support\Facades\Route;

Route::prefix('conseils')->name('api.conseils.')->group(function (): void {
    Route::get('/', [ConseilController::class, 'index'])->name('index');
    Route::post('/', [ConseilController::class, 'store'])->name('store');
    Route::get('/{conseil}', [ConseilController::class, 'show'])->name('show');
});

Route::get('publicites', [PubliciteController::class, 'index'])->name('api.publicites.index');

