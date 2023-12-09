<?php

use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\MovieAdminController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SheetController;
use App\Models\Sheet;
use Illuminate\Support\Facades\Route;
use Tests\Feature\LaravelStations\Station19\AdminReservationTest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);

Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');

Route::prefix('movies')->name('movies.')->group(function() {
    Route::get('/', [MovieController::class, 'index'])->name('index');
    Route::get('/{id}', [MovieController::class, 'detail'])->name('detail');
    Route::get('{movie_id}/schedules/{schedule_id}/sheets', [SheetController::class, 'index'])->name('sheets.index');
    Route::get('/{movie_id}/schedules/{schedule_id}/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
});


Route::get('/sheets', [SheetController::class, 'sheet'])->name('sheets.index');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::prefix('movies')->name('movies.')->group(function() {
        Route::get('/', [MovieAdminController::class, 'index'])->name('index');
        Route::get('/create', [MovieAdminController::class, 'create'])->name('create');
        Route::post('/store', [MovieAdminController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MovieAdminController::class, 'edit'])->name('edit');
        Route::patch('/{id}/update', [MovieAdminController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [MovieAdminController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
        Route::post('/{id}/schedules/store', [ScheduleController::class, 'store'])->name('schedules.store');
        Route::get('/{id}', [MovieAdminController::class, 'show'])->name('show');
    });

    Route::prefix('schedules')->name('schedules.')->group(function() {
        Route::get('/{id}/edit', [ScheduleController::class, 'edit'])->name('edit');
        Route::patch('/{id}/update', [ScheduleController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [ScheduleController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('reservations')->name('reservations.')->group(function() {
        Route::get('/', [AdminReservationController::class, 'index'])->name('index');
        Route::get('/create', [AdminReservationController::class, 'create'])->name('create');
        Route::post('/', [AdminReservationController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminReservationController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [AdminReservationController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminReservationController::class, 'destroy'])->name('destroy');
    });
});
