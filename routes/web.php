<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return to_route('event.index');
});

Route::group([
    'controller' => EventController::class,
    'as' => 'event.', 'prefix' => 'event'
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{event:slug}', 'show')->scopeBindings()->name('single');
    Route::get('/i/i-am-going-to', 'goingto')->name('goingto')->middleware('auth');
    Route::get('/i/my-events', 'myevents')->name('myevents')->middleware('auth');
    Route::get('/i/create', 'create')->name('create')->middleware('auth');
    Route::get('/i/update/{event:id}', 'update')->scopeBindings()->name('update')->middleware('auth');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
