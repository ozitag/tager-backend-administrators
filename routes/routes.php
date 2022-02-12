<?php

use Illuminate\Support\Facades\Route;
use OZiTAG\Tager\Backend\Rbac\Facades\AccessControlMiddleware;
use OZiTAG\Tager\Backend\Administrators\Enums\AdministratorsScope;
use OZiTAG\Tager\Backend\Administrators\Controllers\AdminsController;

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::group(['middleware' => [AccessControlMiddleware::scopes(AdministratorsScope::View->value)]], function () {
        Route::get('/admins', [AdminsController::class, 'index']);
        Route::get('/admins/{id}', [AdminsController::class, 'view']);

        Route::post('/admins', [AdminsController::class, 'store'])->middleware([
            AccessControlMiddleware::scopes(AdministratorsScope::Create->value)
        ]);

        Route::put('/admins/{id}', [AdminsController::class, 'update'])->middleware([
            AccessControlMiddleware::scopes(AdministratorsScope::Edit->value)
        ]);

        Route::delete('/admins/{id}', [AdminsController::class, 'delete'])->middleware([
            AccessControlMiddleware::scopes(AdministratorsScope::Delete->value)
        ]);
    });
});

