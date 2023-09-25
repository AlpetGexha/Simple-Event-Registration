<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('event.index');
});

Route::group([
    'controller' => EventController::class,
    'as' => 'event.', 'prefix' => 'event',
], function () {
    Route::get('/', 'index')->name('index');
    Route::get('{event:slug}', 'show')->scopeBindings()->name('single');

    Route::group(['middeleware' => 'auth'], function () {
        Route::get('i/i-am-going-to', 'goingTo')->name('goingto');
        Route::get('i/my-events', 'myEvents')->name('myevents');
        Route::get('i/create', 'create')->name('create');
        Route::get('i/update/{event:id}', 'update')->scopeBindings()->name('update');
    });

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
