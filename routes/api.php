<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Reports\ReportController;
use App\Http\Controllers\Reports\ImportDGEGReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('/user', fn(Request $request) => $request->user())
        ->middleware('auth:sanctum');
    Route::post('login', LoginController::class);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', MeController::class)->middleware('auth:sanctum');
        Route::post('logout', LogoutController::class);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('reports')->group(function () {
        Route::post('dgeg/import', ImportDGEGReportController::class);
        Route::get('statistics/consumption-per-year', [ReportController::class, 'consumptionPerYear']);
        Route::get('statistics/consumption-per-sector', [ReportController::class, 'consumptionPerSector']);
        Route::get('statistics/consumption-per-company', [ReportController::class, 'consumptionPerCompany']);
        Route::get('statistics/current-emission', [ReportController::class, 'currentEmission']);
    });
});



