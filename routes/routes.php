<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::apiResource('admins', \OZiTAG\Tager\Backend\Administrators\Controllers\AdminsController::class);
});

