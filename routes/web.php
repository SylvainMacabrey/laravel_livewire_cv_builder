<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Profile\ShowController;
use App\Http\Controllers\Profile\Links\ShowController as LinkShowController;
use App\Http\Controllers\Profile\Experience\ShowController as ExperienceShowController;
use App\Http\Controllers\Profile\Links\Template\ShowController as TemplateShowController;

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
    return view('welcome');
});

Route::middleware('auth')->prefix('profile')->as('profile.')->group(function() {
    Route::get('/', ShowController::class)->name('show');
    Route::prefix('experiences')->as('experiences.')->group(function() {
        Route::get('/', ExperienceShowController::class)->name('show');
    });
    Route::prefix('links')->as('links.')->group(function() {
        Route::get('/', LinkShowController::class)->name('show');
        Route::get('/{link:token}', TemplateShowController::class)->name('template');
    });
});

Route::get('/dashboard', DashboardController::class)->name('dashboard')->middleware(['auth']);

require __DIR__.'/auth.php';
