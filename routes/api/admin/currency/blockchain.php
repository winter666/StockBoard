<?php

use App\Http\Controllers\Api\Admin\BlockchainCurrencyController;
use Illuminate\Support\Facades\Route;

Route::prefix('blockchain')->middleware('role:'.\App\Laravue\Acl::ROLE_ADMIN)->group(function() {
    Route::get('', [BlockchainCurrencyController::class, 'index']);
    Route::post('', [BlockchainCurrencyController::class, 'store']);
    Route::get('graph', [BlockchainCurrencyController::class, 'graph']);
    Route::get('{id}', [BlockchainCurrencyController::class, 'show']);
    Route::put('{id}', [BlockchainCurrencyController::class, 'update']);
    Route::delete('{id}', [BlockchainCurrencyController::class, 'destroy']);
});
