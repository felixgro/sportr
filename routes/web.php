<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\SportEventController;
use App\Http\Controllers\SportTeamController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\HomeController;
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


Route::get('/', HomeController::class)->name('home');
Route::get('/dashboard', DashboardController::class)->name('dashboard');

// Sport routes
Route::resource('sports', SportController::class);

// Sport team routes
Route::get('sports/{sport}/teams', [SportTeamController::class, 'index'])->name('sportteams.index');
Route::get('sports/{sport}/teams/create', [SportTeamController::class, 'create'])->name('sportteams.create');
Route::post('sports/{sport}/teams', [SportTeamController::class, 'store'])->name('sportteams.store');
Route::get('sports/{sport}/teams/{team}', [SportTeamController::class, 'show'])->name('sportteams.show');
Route::get('sports/{sport}/teams/{team}/edit', [SportTeamController::class, 'edit'])->name('sportteams.edit');
Route::put('sports/{sport}/teams/{team}', [SportTeamController::class, 'update'])->name('sportteams.update');
Route::delete('sports/{sport}/teams/{team}', [SportTeamController::class, 'destroy'])->name('sportteams.destroy');

// Location routes
Route::get('locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('locations/create', [LocationController::class, 'create'])->name('locations.create');
Route::post('locations', [LocationController::class, 'store'])->name('locations.store');
Route::get('locations/{location}', [LocationController::class, 'show'])->name('locations.show');
Route::get('locations/{location}/edit', [LocationController::class, 'edit'])->name('locations.edit');
Route::put('locations/{location}', [LocationController::class, 'update'])->name('locations.update');
Route::delete('locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');

// Sport event routes
Route::get('sports/{sport}/events', [SportEventController::class, 'index'])->name('sportevents.index');
Route::get('sports/{sport}/events/create', [SportEventController::class, 'create'])->name('sportevents.create');
Route::post('sports/{sport}/events', [SportEventController::class, 'store'])->name('sportevents.store');
Route::get('sports/{sport}/events/{event}', [SportEventController::class, 'show'])->name('sportevents.show');
Route::get('sports/{sport}/events/{event}/edit', [SportEventController::class, 'edit'])->name('sportevents.edit');
Route::put('sports/{sport}/events/{event}', [SportEventController::class, 'update'])->name('sportevents.update');
Route::delete('sports/{sport}/events/{event}', [SportEventController::class, 'destroy'])->name('sportevents.destroy');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');
