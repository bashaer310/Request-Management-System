<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
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

Route::middleware('auth')->group(function () {
    Route::get('/requests', [RequestController::class, 'index'])
        ->name('requests.index');

    Route::get('/requests/create', [RequestController::class, 'create'])
        ->name('requests.create');

    Route::post('/requests', [RequestController::class, 'store'])
        ->name('requests.store');

    Route::get('/requests/{request}', [RequestController::class, 'show'])
        ->name('requests.show');

    Route::post('/requests/{request}/approve', [RequestController::class, 'approve'])
        ->name('requests.approve');

    Route::post('/requests/{request}/reject', [RequestController::class, 'reject'])
        ->name('requests.reject');
});

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::get('/notifications/{notification}', [NotificationController::class, 'show'])
        ->name('notifications.show');
});

require __DIR__ . '/auth.php';
