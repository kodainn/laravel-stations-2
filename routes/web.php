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


Route::get('/movies', [MovieController::class, 'movie'])->name('movie');
Route::get('/sheets', [MovieController::class, 'sheet'])->name('sheet');

Route::prefix('admin/movies')->name('admin.movies.')->group(function() {
    Route::get('/', [MovieAdminController::class, 'index'])->name('index');
    Route::get('/create', [MovieAdminController::class, 'create'])->name('create');
    Route::post('/store', [MovieAdminController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [MovieAdminController::class, 'edit'])->name('edit');
    Route::patch('/{id}/update', [MovieAdminController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy', [MovieAdminController::class, 'destroy'])->name('destroy');
});
