<?php

namespace Database\Seeders;

use App\Models\VideoFeedback;
use Illuminate\Database\Seeder;

/**
 * Seeds sample short video feedback reels.
 */
class VideoFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = [
            [
                'video_url' => 'https://www.youtube.com/shorts/Y-x0efG1seA',
                'display_on_home' => true,
                'display_on_services' => true,
                'sort_order' => 1,
            ],
            [
                'video_url' => 'https://www.youtube.com/shorts/Y-x0efG1seA',
                'display_on_home' => true,
                'display_on_services' => false,
                'sort_order' => 2,
            ],
            [
                'video_url' => 'https://www.youtube.com/shorts/Y-x0efG1seA',
                'display_on_home' => true,
                'display_on_services' => true,
                'sort_order' => 3,
            ],
            [
                'video_url' => 'https://www.youtube.com/shorts/Y-x0efG1seA',
                'display_on_home' => true,
                'display_on_services' => false,
                'sort_order' => 4,
            ],
            [
                'video_url' => 'https://www.youtube.com/shorts/Y-x0efG1seA',
                'display_on_home' => true,
                'display_on_services' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($videos as $video) {
            VideoFeedback::query()->updateOrCreate(
                [
                    'video_url' => $video['video_url'],
                    'sort_order' => $video['sort_order'],
                ],
                [
                    'display_on_home' => $video['display_on_home'],
                    'display_on_services' => $video['display_on_services'],
                    'status' => true,
                ]
            );
        }
    }
}
