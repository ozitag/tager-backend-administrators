<?php

use Illuminate\Support\Facades\Route;
use OZiTAG\Tager\Backend\Rbac\Facades\AccessControlMiddleware;
use OZiTAG\Tager\Backend\Administrators\Enums\AdministratorsScope;
use OZiTAG\Tager\Backend\Administrators\Controllers\AdminsController;

Route::group(['prefix' => 'admin/admins', 'middleware' => ['passport:administrators', 'auth:api']], function () {

    Route::group(['middleware' => [AccessControlMiddleware::scopes(AdministratorsScope::View->value)]], function () {
        Route::get('/', [AdminsController::class, 'index']);
        Route::get('/count', [AdminsController::class, 'count']);
        Route::get('/fields', [AdminsController::class, 'fields']);
        Route::get('/{id}', [AdminsController::class, 'view']);
    });

    Route::post('/', [AdminsController::class, 'store'])->middleware([
        AccessControlMiddleware::scopes(AdministratorsScope::Create->value)
    ]);

    Route::put('/{id}', [AdminsController::class, 'update'])->middleware([
        AccessControlMiddleware::scopes(AdministratorsScope::Edit->value)
    ]);

    Route::delete('/{id}', [AdminsController::class, 'delete'])->middleware([
        AccessControlMiddleware::scopes(AdministratorsScope::Delete->value)
    ]);
});

