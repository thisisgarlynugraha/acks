<?php

use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\HealthMonitoringController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('health-monitoring', HealthMonitoringController::class)->only(['store']);
Route::apiResource('attendance', AttendanceController::class)->only(['store']);
