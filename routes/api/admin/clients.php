<?php

use \Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Admin\ClientController;

Route::prefix('client')->middleware('role:'.\App\Laravue\Acl::ROLE_ADMIN)->group(function() {
    Route::get('', [ClientController::class, 'index']);
    Route::post('', [ClientController::class, 'store']);
    Route::get('{id}', [ClientController::class, 'show']);
    Route::put('{id}', [ClientController::class, 'update']);
    Route::delete('{id}', [ClientController::class, 'destroy']);
});
