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
            GeneralSettingsSeeder::class,
            LegalPagesSeeder::class,
            AboutSettingsSeeder::class,
            ExpertSeeder::class,
            HotelManagementSeeder::class,
            WhyChooseItemSeeder::class,
            TreatmentSeeder::class,
            ServiceSeeder::class,
            PatientReviewSeeder::class,
            FaqSeeder::class,
            GalleryItemSeeder::class,
            BlogPostSeeder::class,
            HealthProgramSeeder::class,
            HeroBannerSeeder::class,
            TrustStripItemSeeder::class,
            VideoFeedbackSeeder::class,
        ]);
    }
}
