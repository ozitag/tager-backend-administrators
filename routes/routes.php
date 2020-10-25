<?php

use Illuminate\Support\Facades\Route;
use OZiTAG\Tager\Backend\Administrators\Controllers\AdminsController;

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::apiResource('admins', AdminsController::class);
});

