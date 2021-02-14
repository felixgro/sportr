<?php

use App\Http\Controllers\Ajax\RecentEventController;
use App\Http\Controllers\Ajax\UpcommingEventController;
use App\Http\Controllers\FavoriteSportController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\SportEventController;
use App\Http\Controllers\SportTeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Main Page Routes
|--------------------------------------------------------------------------
|
| Main Routes for home & dashboard view.
|
*/

Route::get('/', HomeController::class)->name('home');
Route::get('/dashboard', DashboardController::class)->name('dashboard');

/*
|--------------------------------------------------------------------------
| Sport Routes
|--------------------------------------------------------------------------
|
| CRUD routes for sports and all it's related
| models such as favorite sports, events and teams.
|
*/

Route::resource('sports', SportController::class);

Route::prefix('favsports')->middleware('auth:sanctum')->name('favsports.')->group(function () {
    Route::get('/', [FavoriteSportController::class, 'index'])->name('index');
    Route::post('/', [FavoriteSportController::class, 'store'])->name('store');
    Route::put('/', [FavoriteSportController::class, 'update'])->name('update');
});

Route::prefix('sports/{sport}/teams')->name('sportteams.')->group(function () {
    Route::get('/', [SportTeamController::class, 'index'])->name('index');
    Route::get('create', [SportTeamController::class, 'create'])->name('create');
    Route::get('{team}', [SportTeamController::class, 'show'])->name('show');
    Route::get('{team}/edit', [SportTeamController::class, 'edit'])->name('edit');
    Route::post('/', [SportTeamController::class, 'store'])->name('store');
    Route::put('{team}', [SportTeamController::class, 'update'])->name('update');
    Route::delete('{team}', [SportTeamController::class, 'destroy'])->name('destroy');
});

Route::prefix('sports/{sport}/events')->name('sportevents.')->group(function () {
    Route::get('/', [SportEventController::class, 'index'])->name('index');
    Route::get('create', [SportEventController::class, 'create'])->name('create');
    Route::get('{event}', [SportEventController::class, 'show'])->name('show');
    Route::get('{event}/edit', [SportEventController::class, 'edit'])->name('edit');
    Route::post('/', [SportEventController::class, 'store'])->name('store');
    Route::put('{event}', [SportEventController::class, 'update'])->name('update');
    Route::delete('{event}', [SportEventController::class, 'destroy'])->name('destroy');
});

Route::get('recentevents', RecentEventController::class)->name('recentevents');
Route::get('upcommingevents', UpcommingEventController::class)->name('upcommingevents');

/*
|--------------------------------------------------------------------------
| Location Routes
|--------------------------------------------------------------------------
|
| CRUD routes for event locations.
|
*/

Route::prefix('locations')->name('locations.')->group(function () {
    Route::get('/', [LocationController::class, 'index'])->name('index');
    Route::get('create', [LocationController::class, 'create'])->name('create');
    Route::post('/', [LocationController::class, 'store'])->name('store');
    Route::get('{location}', [LocationController::class, 'show'])->name('show');
    Route::get('{location}/edit', [LocationController::class, 'edit'])->name('edit');
    Route::put('{location}', [LocationController::class, 'update'])->name('update');
    Route::delete('{location}', [LocationController::class, 'destroy'])->name('destroy');
});
