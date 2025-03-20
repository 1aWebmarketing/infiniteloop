<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GitHubController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CreativeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('dashboard');

    Route::get('/changelog', [PagesController::class, 'changelog'])->name('pages.changelog');

    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects/create/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}/edit', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/projects/{project}/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/projects/{project}/items/create', [ItemController::class, 'store'])->name('items.store');
    Route::get('/projects/{project}/items/{item:uuid}', [ItemController::class, 'show'])->name('items.show');
    Route::get('/projects/{project}/items/{item:uuid}/form', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/projects/{project}/items/{item:uuid}/form', [ItemController::class, 'update'])->name('items.update');
    Route::post('/items/{item:uuid}/upvote', [ItemController::class, 'upvote'])->name('items.upvote');
    Route::delete('/projects/{project}/items/{item:uuid}', [ItemController::class, 'destroy'])->name('items.destroy');

    Route::post('/creatives/{item:uuid}/upload', [CreativeController::class, 'upload'])->name('creatives.upload');

    Route::post('/items/{item:uuid}/comment', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::get('/admin/github', [GitHubController::class, 'index'])->name('github.index');
    Route::get('/admin/github/callback', [GitHubController::class, 'store'])->name('github.store');
});

require __DIR__.'/auth.php';
