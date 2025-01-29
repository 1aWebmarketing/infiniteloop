<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('dashboard');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    Route::get('/projects/{project}/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/projects/{project}/items/create/save', [ItemController::class, 'store'])->name('items.store');
    Route::get('/projects/{project}/items/{item}', [ItemController::class, 'show'])->name('items.show');
    Route::post('/items/{item}/upvote', [ItemController::class, 'upvote'])->name('items.upvote');

    Route::post('/items/{item}/comment', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
