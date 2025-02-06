<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('dashboard');

    Route::get('/changelog', [PagesController::class, 'changelog'])->name('pages.changelog');

    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects/create/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}/edit', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/projects/{project}/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/projects/{project}/items/create/save', [ItemController::class, 'store'])->name('items.store');
    Route::get('/projects/{project}/items/{item}', [ItemController::class, 'show'])->name('items.show');
    Route::get('/projects/{project}/items/{item}/form', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/projects/{project}/items/{item}/form', [ItemController::class, 'update'])->name('items.update');
    Route::post('/items/{item}/upvote', [ItemController::class, 'upvote'])->name('items.upvote');
    Route::delete('/projects/{project}/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

    Route::post('/items/{item}/comment', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:admin')->group(function(){
        Route::get('/admin', function(){
            return "admin";
        });
    });
});

require __DIR__.'/auth.php';
