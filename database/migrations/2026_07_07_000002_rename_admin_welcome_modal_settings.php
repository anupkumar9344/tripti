<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Move welcome modal settings from the admin panel to the public website.
     */
    public function up(): void
    {
        $map = [
            'admin_welcome_modal_enabled' => 'welcome_modal_enabled',
            'admin_welcome_modal_title' => 'welcome_modal_title',
            'admin_welcome_modal_message' => 'welcome_modal_message',
            'admin_welcome_modal_media_type' => 'welcome_modal_media_type',
            'admin_welcome_modal_image' => 'welcome_modal_image',
            'admin_welcome_modal_video_url' => 'welcome_modal_video_url',
            'admin_welcome_modal_button_text' => 'welcome_modal_button_text',
            'admin_welcome_modal_button_url' => 'welcome_modal_button_url',
            'admin_welcome_modal_revision' => 'welcome_modal_revision',
        ];

        foreach ($map as $oldKey => $newKey) {
            $oldValue = Setting::getValue($oldKey);

            if ($oldValue !== null && Setting::getValue($newKey) === null) {
                Setting::setValue($newKey, $oldValue);
            }
        }

        if (Setting::getValue('welcome_modal_button_url') === '/admin/dashboard') {
            Setting::setValue('welcome_modal_button_url', '/rooms');
        }

        if (Setting::getValue('welcome_modal_title') === 'Welcome to Tripti Admin') {
            Setting::setValue('welcome_modal_title', 'Welcome to Tripti Hotel');
        }

        if (Setting::getValue('welcome_modal_message') === 'Manage your hotel website, bookings, inquiries, and content from one professional dashboard.') {
            Setting::setValue('welcome_modal_message', 'Discover luxury rooms, fine dining, and premium hospitality. Book your unforgettable stay with us today.');
        }

        if (Setting::getValue('welcome_modal_button_text') === 'Get Started') {
            Setting::setValue('welcome_modal_button_text', 'Explore Rooms');
        }

        Setting::query()->whereIn('key', array_keys($map))->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
