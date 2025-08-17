<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::redirect('/', '/tasks');

Route::middleware(['auth'])->group(function () {
    Route::get   ('/tasks',           [TaskController::class,'index'])  ->name('tasks.index');
    Route::get   ('/tasks/create',    [TaskController::class,'create']) ->name('tasks.create');
    Route::post  ('/tasks',           [TaskController::class,'store'])  ->name('tasks.store');
    Route::get   ('/tasks/{id}/edit', [TaskController::class,'edit'])   ->name('tasks.edit');
    Route::put   ('/tasks/{id}',      [TaskController::class,'update']) ->name('tasks.update');
    Route::delete('/tasks/{id}',      [TaskController::class,'destroy'])->name('tasks.destroy');
    Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


    /* theme switch (light ↔ dark) */
    Route::post('/theme/toggle', [TaskController::class,'toggleTheme'])->name('theme.toggle');
});

require __DIR__.'/auth.php';
