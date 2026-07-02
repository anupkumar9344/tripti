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
        View::composer('layouts.app', function ($view): void {
            $view->with('seo', [
                'website_name' => 'Tripti Hotel',
                'website_favicon' => null,
                'seo_meta_title' => 'Tripti Hotel | Luxury Stay & Hospitality',
                'seo_meta_description' => 'Tripti Hotel offers luxury rooms, fine dining, spa, and premium hospitality for an unforgettable stay.',
                'seo_meta_keywords' => 'Tripti Hotel, luxury hotel, rooms, booking, restaurant, spa',
                'seo_meta_author' => 'Tripti Hotel',
                'seo_robots' => 'index, follow',
                'seo_og_title' => 'Tripti Hotel | Luxury Stay & Hospitality',
                'seo_og_description' => 'Tripti Hotel offers luxury rooms, fine dining, spa, and premium hospitality for an unforgettable stay.',
                'seo_og_image' => null,
                'seo_twitter_card' => 'summary_large_image',
                'seo_twitter_site' => '',
                'seo_google_site_verification' => '',
            ]);
        });

        View::composer(['admin.layouts.app', 'admin.auth.login'], function ($view): void {
            $view->with('siteFaviconUrl', Setting::faviconUrl());
            $view->with('adminLoginImageUrl', Setting::adminLoginImageUrl());
        });
    }
}
