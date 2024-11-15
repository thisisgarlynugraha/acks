<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
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
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'master', 'middleware' => ['auth:web', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Student
    Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');
    Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/update/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/{id}/destroy', [StudentController::class, 'destroy'])->name('student.destroy');
    Route::get('/student/data', [StudentController::class, 'data'])->name('student.data');
});
