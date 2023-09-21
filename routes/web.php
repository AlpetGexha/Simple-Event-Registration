<?php

use App\Http\Controllers\ProfileController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

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
    $events = App\Models\Event::query()
        ->with('user')
        ->published()
        ->get();

    return view('event.index', compact('events'));
});

Route::get('event/{event:slug}', function () {

    $event = App\Models\Event::query()
        ->with('user')
        ->published()
        ->withPeopopleWhoIsGoing()
        ->checkIfIsAttendeed()
        ->first();
    // abort_if(!$event->isPublished(), 404);

    return view('event.single', compact('event'));
})->scopeBindings()->name('event.single');

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
