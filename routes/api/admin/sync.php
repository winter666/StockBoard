<?php
use \Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Admin\SyncronizationController;

Route::prefix('sync')->middleware('role:'.\App\Laravue\Acl::ROLE_ADMIN)->group(function() {
   Route::get('', [SyncronizationController::class, 'index']);
});
