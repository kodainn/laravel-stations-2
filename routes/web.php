<?php

use App\Http\Controllers\MovieAdminController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PracticeController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('movies')->name('movies.')->group(function() {
    Route::get('/', [MovieController::class, 'movie'])->name('movies');
    Route::get('/{id}', [MovieController::class, 'schedule'])->name('schedules');
    Route::get('{movie_id}/schedules/{schedule_id}/sheets', [MovieController::class, 'reservationIndex'])->name('reservationIndex');
    Route::get('/{movie_id}/schedules/{schedule_id}/reservations/create', [MovieController::class, 'reservationCreate'])->name('reservationCreate');
});
Route::post('/reservations/store', [MovieController::class, 'reservationStore'])->name('reservationStore');


Route::get('/sheets', [MovieController::class, 'sheet'])->name('sheets');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::prefix('movies')->name('movies.')->group(function() {
        Route::get('/', [MovieAdminController::class, 'index'])->name('index');
        Route::get('/create', [MovieAdminController::class, 'create'])->name('create');
        Route::post('/store', [MovieAdminController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MovieAdminController::class, 'edit'])->name('edit');
        Route::patch('/{id}/update', [MovieAdminController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [MovieAdminController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/schedules/create', [MovieAdminController::class, 'scheduleCreate'])->name('scheduleCreate');
        Route::post('/{id}/schedules/store', [MovieAdminController::class, 'scheduleStore'])->name('scheduleStore');
        Route::get('/{id}', [MovieAdminController::class, 'show'])->name('show');
    });

    Route::prefix('schedules')->name('schedules.')->group(function() {
        Route::get('/{id}/edit', [MovieAdminController::class, 'scheduleEdit'])->name('edit');
        Route::patch('/{id}/update', [MovieAdminController::class, 'scheduleUpdate'])->name('update');
        Route::delete('{id}/destroy', [MovieAdminController::class, 'scheduleDestroy'])->name('destroy');
    });
});
