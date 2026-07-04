<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeds short video reels (delegates to ShortsVideoSeeder).
 */
class VideoFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(ShortsVideoSeeder::class);
    }
}
