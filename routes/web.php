<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatGptIndexController;
use App\Http\Controllers\ChatGptStoreController;
use App\Http\Controllers\ChatGptDestroyController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/chat/{id?}', ChatGptIndexController::class)->name('chat.show');
    Route::post('/chat/{id?}', ChatGptStoreController::class)->name('chat.store');
    Route::delete('/chat/{chat}', ChatGptDestroyController::class)->name('chat.destroy');

    Route::inertia('/pages/playground', 'Playground')->name('pages.playground');
});
