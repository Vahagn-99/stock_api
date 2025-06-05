<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.token'])->group(function () {
    Route::get('/buildings', [BuildingController::class, 'list']);
    Route::get('/buildings/{building}/organizations', [BuildingController::class, 'organizations']);

    Route::get('/activities/{activity}/organizations', [ActivityController::class, 'organizations']);

    Route::get('/organizations/search', [OrganizationController::class, 'search']);
    Route::get('/organizations/{organization}', [OrganizationController::class, 'item']);
});
