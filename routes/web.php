<?php

use App\Http\Controllers\ProfileController;
<<<<<<< HEAD
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

=======
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;           // Request type-hint করার জন্য
use Illuminate\Support\Facades\Route;

/* ---------- Public ---------- */
Route::get('/', fn () => view('welcome'));

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/* ---------- Auth-protected ---------- */
Route::middleware('auth')->group(function () {

    /* --- Breeze Profile --- */
    Route::get   ('/profile',  [ProfileController::class, 'edit' ])->name('profile.edit');
    Route::patch ('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',  [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* --- To-Do Tasks (CRUD) --- */
    Route::resource('tasks', TaskController::class)   // index, create, store, edit, update, destroy
         ->except('show');                            // show রুট দরকার নেই

    /* --- Theme Toggle (Cookie) --- */
    Route::post('/theme/toggle', function (Request $request) {
        $new = $request->cookie('theme', 'light') === 'light' ? 'dark' : 'light';
        return back()->withCookie(cookie('theme', $new, 60 * 24 * 365));
    })->name('theme.toggle');
});

/* --- Breeze Auth Routes --- */
>>>>>>> b003ea31e7bc326646efdec4665b8c8836014d36
require __DIR__.'/auth.php';
