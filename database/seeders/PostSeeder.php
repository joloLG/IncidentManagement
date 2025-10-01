<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'System Launch Reminder',
                'content' => 'Remember to verify all incident reports before end of day.',
            ],
            [
                'title' => 'Scheduled Maintenance',
                'content' => 'The Incident Management API will be down for maintenance on Saturday at 10 PM.',
            ],
            [
                'title' => 'New Incident Type Added',
                'content' => 'Security breach category has been added for more precise reporting.',
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(
                ['title' => $post['title']],
                $post
            );
        }
    }
}
