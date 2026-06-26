<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ExpertController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('settings/general', [GeneralSettingController::class, 'edit'])->name('settings.general');
        Route::put('settings/general', [GeneralSettingController::class, 'update'])->name('settings.general.update');
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('experts', ExpertController::class)->except(['show']);
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
