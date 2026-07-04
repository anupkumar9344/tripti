<?php

namespace Database\Seeders;

use App\Models\VideoFeedback;
use Illuminate\Database\Seeder;

/**
 * Replaces shorts videos with hotel-related reels (titles + posters).
 *
 * Run on server:
 * php artisan db:seed --class=ShortsVideoSeeder --force
 */
class ShortsVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VideoFeedback::query()->delete();

        $videos = [
            [
                'title' => 'Luxury Suite',
                'video_url' => 'https://www.youtube.com/shorts/Y-x0efG1seA',
                'thumbnail' => 'assets/img/rooms/1.jpg',
                'display_on_home' => true,
                'display_on_services' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Fine Dining',
                'video_url' => 'https://www.youtube.com/watch?v=Scxs7L0vhZ4',
                'thumbnail' => 'assets/img/amenities/1.jpg',
                'display_on_home' => true,
                'display_on_services' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Spa & Wellness',
                'video_url' => 'https://www.youtube.com/watch?v=5qap5aO4i9A',
                'thumbnail' => 'assets/img/spa/1.jpg',
                'display_on_home' => true,
                'display_on_services' => false,
                'sort_order' => 3,
            ],
            [
                'title' => 'Poolside Stay',
                'video_url' => 'https://www.youtube.com/watch?v=DWcJFNfaw9c',
                'thumbnail' => 'assets/img/amenities/4.jpg',
                'display_on_home' => true,
                'display_on_services' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Hotel Lobby',
                'video_url' => 'https://www.youtube.com/watch?v=jNQXAC9IVRw',
                'thumbnail' => 'assets/img/gallery/1.jpg',
                'display_on_home' => true,
                'display_on_services' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Deluxe Room',
                'video_url' => 'https://www.youtube.com/watch?v=aqz-KE-bpKQ',
                'thumbnail' => 'assets/img/rooms/2.jpg',
                'display_on_home' => true,
                'display_on_services' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'Banquet Hall',
                'video_url' => 'https://www.youtube.com/watch?v=LXb3EKWsInQ',
                'thumbnail' => 'assets/img/gallery/3.jpg',
                'display_on_home' => true,
                'display_on_services' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'Guest Experience',
                'video_url' => 'https://www.youtube.com/watch?v=hY7m5jjJ9mM',
                'thumbnail' => 'assets/img/rooms/3.jpg',
                'display_on_home' => true,
                'display_on_services' => false,
                'sort_order' => 8,
            ],
        ];

        foreach ($videos as $video) {
            VideoFeedback::query()->create([
                'title' => $video['title'],
                'video_url' => $video['video_url'],
                'thumbnail' => $video['thumbnail'],
                'display_on_home' => $video['display_on_home'],
                'display_on_services' => $video['display_on_services'],
                'sort_order' => $video['sort_order'],
                'status' => true,
            ]);
        }

        $this->command?->info('Shorts videos updated with hotel posters and titles ('.count($videos).' items).');
    }
}
