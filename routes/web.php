<?php

use App\Http\Controllers\SportController;
use App\Http\Controllers\SportTeamController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

// Sport route
Route::resource('sports', SportController::class);

// Sport team routes
Route::get('sports/{sport}/teams', [SportTeamController::class, 'index'])->name('sportteams.index');
Route::get('sports/{sport}/teams/create', [SportTeamController::class, 'create'])->name('sportteams.create');
Route::post('sports/{sport}/teams', [SportTeamController::class, 'store'])->name('sportteams.store');
Route::get('sports/{sport}/teams/{team}', [SportTeamController::class, 'show'])->name('sportteams.show');
Route::get('sports/{sport}/teams/{team}/edit', [SportTeamController::class, 'edit'])->name('sportteams.edit');
Route::put('sports/{sport}/teams/{team}', [SportTeamController::class, 'update'])->name('sportteams.update');
Route::delete('sports/{sport}/teams/{team}', [SportTeamController::class, 'destroy'])->name('sportteams.destroy');

// Only for Authorization Testing
Route::get('/dashboard', [TestController::class, 'dashboard'])->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');
