<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Settings;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/', '/login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');

    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('users', UserController::class)->middleware('role:admin');

    Route::get('terms', [TermsController::class, 'index'])->name('terms.index');
    Route::post('terms', [TermsController::class, 'store'])->name('terms.store');

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::put('notifications/{notification}', [NotificationController::class, 'update'])->name('notifications.update');
    Route::delete('notifications', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
        Route::post('{model}/{id}/upload', [MediaController::class, 'store'])->name('upload');
        Route::get('{mediaItem}/download', [MediaController::class, 'download'])->name('download');
        Route::delete('{model}/{id}/{mediaItem}/delete', [MediaController::class, 'destroy'])->name('delete');
    });

    Route::get('token', function () {
        return auth()->user()->createToken('crm')->plainTextToken;
    });
});

require __DIR__ . '/auth.php';
