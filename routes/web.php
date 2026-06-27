<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AboutSettingController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\ExpertController;
use App\Http\Controllers\Admin\ExpertProfileCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExpertTeamController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HealthProgramController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicePageController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServicePageController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServicePageController::class, 'show'])->name('services.show');
Route::get('/treatment', [TreatmentController::class, 'index'])->name('treatment');
Route::get('/treatment/{slug}', [TreatmentController::class, 'show'])->name('treatment.show');
Route::get('/our-expert-team', [ExpertTeamController::class, 'index'])->name('experts');
Route::get('/our-expert-team/{slug}', [ExpertTeamController::class, 'show'])->name('experts.show');
Route::get('/health-programs', [HealthProgramController::class, 'index'])->name('health-programs');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('about', [AboutSettingController::class, 'edit'])->name('about.edit');
        Route::put('about', [AboutSettingController::class, 'update'])->name('about.update');
        Route::get('settings/general', [GeneralSettingController::class, 'edit'])->name('settings.general');
        Route::put('settings/general', [GeneralSettingController::class, 'update'])->name('settings.general.update');
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('expert-profile-categories', ExpertProfileCategoryController::class)->except(['show']);
        Route::resource('experts', ExpertController::class)->except(['show']);
        Route::get('contacts/data', [AdminContactController::class, 'data'])->name('contacts.data');
        Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
