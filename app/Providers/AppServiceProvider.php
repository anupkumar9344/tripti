<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.footer', function ($view): void {
            $view->with('settings', Setting::getMany([
                'website_name',
                'footer_about',
                'address',
                'phone_1',
                'phone_2',
                'email_1',
                'email_2',
                'whatsapp_number',
                'facebook_url',
                'instagram_url',
                'youtube_url',
            ]));
        });

        View::composer('layouts.app', function ($view): void {
            $view->with('seo', Setting::getMany([
                'website_name',
                'seo_meta_title',
                'seo_meta_description',
                'seo_meta_keywords',
                'seo_meta_author',
                'seo_robots',
                'seo_og_title',
                'seo_og_description',
                'seo_og_image',
                'seo_twitter_card',
                'seo_twitter_site',
                'seo_google_site_verification',
            ]));
        });
    }
}
