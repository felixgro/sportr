<?php

use App\Http\Controllers\Ajax\RecentEventController;
use App\Http\Controllers\Ajax\UpcommingEventController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteSportController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Main App Routes
|--------------------------------------------------------------------------
*/

Route::get('/', HomeController::class)->name('home');
Route::get('/dashboard', DashboardController::class)->name('dashboard');

/*
|--------------------------------------------------------------------------
| Sport Routes
|--------------------------------------------------------------------------
*/

Route::resource('sports', SportController::class);

Route::prefix('favsports')->middleware('auth:sanctum')->name('favsports.')->group(function () {
    Route::get('/', [FavoriteSportController::class, 'index'])->name('index');
    Route::post('/', [FavoriteSportController::class, 'store'])->name('store');
    Route::put('/', [FavoriteSportController::class, 'update'])->name('update');
});

/*
|--------------------------------------------------------------------------
| Event Routes
|--------------------------------------------------------------------------
*/

Route::prefix('sports/{sport}/events')->name('sportevents.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('create', [EventController::class, 'create'])->name('create');
    Route::get('{event}', [EventController::class, 'show'])->name('show');
    Route::get('{event}/edit', [EventController::class, 'edit'])->name('edit');
    Route::post('/', [EventController::class, 'store'])->name('store');
    Route::put('{event}', [EventController::class, 'update'])->name('update');
    Route::delete('{event}', [EventController::class, 'destroy'])->name('destroy');
});

Route::get('recentevents', RecentEventController::class)->name('recentevents');
Route::get('upcommingevents', UpcommingEventController::class)->name('upcommingevents');

/*
|--------------------------------------------------------------------------
| Team Routes
|--------------------------------------------------------------------------
*/

Route::prefix('sports/{sport}/teams')->name('sportteams.')->group(function () {
    Route::get('/', [TeamController::class, 'index'])->name('index');
    Route::get('create', [TeamController::class, 'create'])->name('create');
    Route::get('{team}', [TeamController::class, 'show'])->name('show');
    Route::get('{team}/edit', [TeamController::class, 'edit'])->name('edit');
    Route::post('/', [TeamController::class, 'store'])->name('store');
    Route::put('{team}', [TeamController::class, 'update'])->name('update');
    Route::delete('{team}', [TeamController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Location Routes
|--------------------------------------------------------------------------
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
