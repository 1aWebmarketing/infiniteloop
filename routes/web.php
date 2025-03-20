<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemUpvoteController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('projects', ProjectController::class);

    Route::resource('items', ItemController::class);
    Route::post('/upvote/{item}', [ItemUpvoteController::class, 'update'])->name('items.upvote');

    Route::resource('/comments', CommentController::class)->names('comments');

    Route::get('/changelog', [PagesController::class, 'changelog'])->name('pages.changelog');
});
