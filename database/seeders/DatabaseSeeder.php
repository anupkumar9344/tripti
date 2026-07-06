<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            RolePermissionSeeder::class,
            GeneralSettingsSeeder::class,
            LegalPagesSeeder::class,
            AboutSettingsSeeder::class,
            ExpertSeeder::class,
            HotelManagementSeeder::class,
            WhyChooseItemSeeder::class,
            PatientReviewSeeder::class,
            FaqSeeder::class,
            GalleryItemSeeder::class,
            BlogPostSeeder::class,
            HeroBannerSeeder::class,
            VideoFeedbackSeeder::class,
        ]);
    }
}
