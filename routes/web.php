<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HealthMonitoringController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPhotoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes([
    'register' => false,
]);

Route::post('/login/post', [LoginController::class, 'handleLogin'])->name('login.post');

Route::group(['prefix' => 'master', 'middleware' => ['auth:web,web_student', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Student
    Route::name('student.')->prefix('student')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [StudentController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [StudentController::class, 'destroy'])->name('destroy');
        Route::get('/data', [StudentController::class, 'data'])->name('data');
        Route::post('/import', [StudentController::class, 'import'])->name('import');
        Route::get('/{id}/photo', [StudentPhotoController::class, 'index'])->name('photo.index');
        Route::get('/{id}/photo/create', [StudentPhotoController::class, 'create'])->name('photo.create');
        Route::post('/{id}/photo/store', [StudentPhotoController::class, 'store'])->name('photo.store');
        Route::delete('photo/{id}/destroy', [StudentPhotoController::class, 'destroy'])->name('photo.destroy');
        Route::get('/{id}/photo/data', [StudentPhotoController::class, 'data'])->name('photo.data');
    });

    Route::name('health-monitoring.')->prefix('health-monitoring')->group(function () {
        Route::get('/', [HealthMonitoringController::class, 'index'])->name('index');
        Route::get('/data', [HealthMonitoringController::class, 'data'])->name('data');
        Route::get('/{id}/show', [HealthMonitoringController::class, 'show'])->name('show');
        Route::get('/{id}/data-show', [HealthMonitoringController::class, 'dataShow'])->name('data-show');
    });

    Route::name('attendance.')->prefix('attendance')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('index');
        Route::get('/data', [AttendanceController::class, 'data'])->name('data');
        Route::get('/{id}/show', [AttendanceController::class, 'show'])->name('show');
        Route::get('/{id}/data-show', [AttendanceController::class, 'dataShow'])->name('data-show');
    });
});
