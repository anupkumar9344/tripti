<?php

use App\Http\Controllers\Admin\AboutSettingController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CacheController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BedTypeController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\CareerApplicationController;
use App\Http\Controllers\Admin\CareerOpeningController;
use App\Http\Controllers\Admin\HotelAmenityController;
use App\Http\Controllers\Admin\HotelFacilityController;
use App\Http\Controllers\Admin\HotelInquiryController;
use App\Http\Controllers\Admin\PremiumServiceController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\HeroBannerController;
use App\Http\Controllers\Admin\IconReferenceController;
use App\Http\Controllers\Admin\LegalPageSettingController;
use App\Http\Controllers\Admin\PatientReviewController;
use App\Http\Controllers\Admin\VideoFeedbackController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\WhyChooseItemController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FaqPageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/clear-cache/{token}', function (string $token) {
    $expected = (string) config('app.cache_clear_token', '');

    if ($expected === '') {
        $expected = substr(hash('sha256', (string) config('app.key')), 0, 32);
    }

    if (! hash_equals($expected, $token)) {
        abort(403, 'Invalid cache clear token.');
    }

    Artisan::call('optimize:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');

    return response('Cache cleared successfully.', 200)
        ->header('Content-Type', 'text/plain');
})->name('cache.clear');

Route::get('/', [HomeController::class, 'index']);
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');
Route::redirect('/room-details', '/rooms');
Route::get('/rooms/{roomType}', [RoomController::class, 'show'])->name('rooms.show');
Route::redirect('/team', '/careers');
Route::redirect('/experts', '/careers');
Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::post('/careers', [CareerController::class, 'store'])->name('careers.store');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::redirect('/blog-details', '/blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/faq', [FaqPageController::class, 'index'])->name('faq');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('terms-and-conditions');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::get('/booking/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{bookingNumber}', [BookingController::class, 'success'])->name('booking.success');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');

    Route::middleware(['admin.auth', 'admin.permission'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('clear-cache', [CacheController::class, 'clear'])->name('cache.clear');
        Route::get('about', [AboutSettingController::class, 'edit'])->name('about.edit');
        Route::put('about', [AboutSettingController::class, 'update'])->name('about.update');
        Route::get('settings/general', [GeneralSettingController::class, 'edit'])->name('settings.general');
        Route::put('settings/general', [GeneralSettingController::class, 'update'])->name('settings.general.update');
        Route::get('legal-pages', [LegalPageSettingController::class, 'edit'])->name('legal-pages.edit');
        Route::put('legal-pages', [LegalPageSettingController::class, 'update'])->name('legal-pages.update');
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
        Route::resource('why-choose-items', WhyChooseItemController::class)->except(['show']);
        Route::resource('hotel-amenities', HotelAmenityController::class)->except(['show']);
        Route::patch('hotel-amenities/{hotel_amenity}/toggle-status', [HotelAmenityController::class, 'toggleStatus'])->name('hotel-amenities.toggle-status');
        Route::resource('hotel-facilities', HotelFacilityController::class)->except(['show']);
        Route::patch('hotel-facilities/{hotel_facility}/toggle-status', [HotelFacilityController::class, 'toggleStatus'])->name('hotel-facilities.toggle-status');
        Route::resource('bed-types', BedTypeController::class)->except(['show']);
        Route::resource('room-types', RoomTypeController::class)->except(['show']);
        Route::patch('room-types/{room_type}/toggle-status', [RoomTypeController::class, 'toggleStatus'])->name('room-types.toggle-status');
        Route::resource('room-types.rooms', AdminRoomController::class)->except(['show']);
        Route::patch('room-types/{room_type}/rooms/{room}/toggle-status', [AdminRoomController::class, 'toggleStatus'])->name('room-types.rooms.toggle-status');
        Route::resource('promo-codes', PromoCodeController::class)->except(['show']);
        Route::resource('premium-services', PremiumServiceController::class)->except(['show']);
        Route::patch('premium-services/{premium_service}/toggle-status', [PremiumServiceController::class, 'toggleStatus'])->name('premium-services.toggle-status');
        Route::resource('hotel-inquiries', HotelInquiryController::class);
        Route::patch('hotel-inquiries/{hotel_inquiry}/status', [HotelInquiryController::class, 'updateStatus'])->name('hotel-inquiries.update-status');
        Route::put('patient-reviews/settings', [PatientReviewController::class, 'updateSettings'])->name('patient-reviews.settings.update');
        Route::resource('patient-reviews', PatientReviewController::class)->except(['show']);
        Route::resource('video-feedbacks', VideoFeedbackController::class)->except(['show']);
        Route::put('faqs/settings', [FaqController::class, 'updateSettings'])->name('faqs.settings.update');
        Route::put('faqs/page-settings', [FaqController::class, 'updatePageSettings'])->name('faqs.page-settings.update');
        Route::resource('faqs', FaqController::class)->except(['show']);
        Route::resource('gallery-items', GalleryItemController::class)->except(['show']);
        Route::resource('hero-banners', HeroBannerController::class)->except(['show']);
        Route::resource('blog-posts', BlogPostController::class)->except(['show']);
        Route::resource('career-openings', CareerOpeningController::class)->except(['show']);
        Route::get('career-applications', [CareerApplicationController::class, 'index'])->name('career-applications.index');
        Route::get('career-applications/{career_application}', [CareerApplicationController::class, 'show'])->name('career-applications.show');
        Route::patch('career-applications/{career_application}/status', [CareerApplicationController::class, 'updateStatus'])->name('career-applications.update-status');
        Route::delete('career-applications/{career_application}', [CareerApplicationController::class, 'destroy'])->name('career-applications.destroy');
        Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
        Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
        Route::patch('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.update-status');
        Route::delete('bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');
        Route::get('icons/data', [IconReferenceController::class, 'icons'])->name('icons.data');
        Route::get('icons', [IconReferenceController::class, 'index'])->name('icons.index');
        Route::get('media/browse', [MediaController::class, 'browse'])->name('media.browse');
        Route::post('media', [MediaController::class, 'store'])->name('media.store');
        Route::get('media', [MediaController::class, 'index'])->name('media.index');
        Route::put('media/{mediaFile}', [MediaController::class, 'update'])->name('media.update');
        Route::delete('media/{mediaFile}', [MediaController::class, 'destroy'])->name('media.destroy');
        Route::get('media/{mediaFile}/download', [MediaController::class, 'download'])->name('media.download');
        Route::resource('staff', StaffController::class)->except(['show']);
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
