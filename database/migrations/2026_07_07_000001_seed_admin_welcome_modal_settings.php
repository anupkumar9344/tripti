<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Seed default website welcome modal settings when missing.
     */
    public function up(): void
    {
        $defaults = [
            'welcome_modal_enabled' => '1',
            'welcome_modal_title' => 'Welcome to Tripti Hotel',
            'welcome_modal_message' => 'Discover luxury rooms, fine dining, and premium hospitality. Book your unforgettable stay with us today.',
            'welcome_modal_media_type' => 'image',
            'welcome_modal_image' => 'gallery-4.jpg',
            'welcome_modal_video_url' => null,
            'welcome_modal_button_text' => 'Explore Rooms',
            'welcome_modal_button_url' => '/rooms',
            'welcome_modal_revision' => '1',
        ];

        foreach ($defaults as $key => $value) {
            if (Setting::getValue($key) === null) {
                Setting::setValue($key, $value);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
