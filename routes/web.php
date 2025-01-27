<?php
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // List all tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

    // Show form to create a new task
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

    // Store a new task
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Show details of a specific task
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');

    // Show form to edit a specific task
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

    // Update a specific task
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    // Delete a specific task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

});

require __DIR__.'/auth.php';
