<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StandingController;

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
    return view('template.index');
});

Route::get('clubs', [ClubController::class, 'index'])->name('club.index');
Route::post('club', [ClubController::class, 'store'])->name('club.store');
Route::get('club/{id}/edit', [ClubController::class, 'edit'])->name('club.edit');
Route::put('club/{id}/update', [ClubController::class, 'update'])->name('club.update');
Route::delete('club/{id}/delete', [ClubController::class, 'destroy'])->name('club.destroy');

Route::get('scores', [ScoreController::class, 'index'])->name('score.index');
Route::post('score', [ScoreController::class, 'store'])->name('score.store');
Route::delete('score/{id}/delete', [ScoreController::class, 'destroy'])->name('score.destroy');

Route::get('standings', [StandingController::class, 'index'])->name('standing.index');
