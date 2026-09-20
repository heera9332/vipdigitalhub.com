<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\PostType;
use App\Models\Post;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds for the service post type.
     */
    public function run(): void
    {
        $offerings = config('services.offerings', []);

        $sortOrder = 1;
        foreach ($offerings as $key => $service) {
            Post::updateOrCreate(
                [
                    'slug' => $service['slug'],
                    'post_type' => PostType::Service->value,
                ],
                [
                    'title' => $service['title'],
                    'excerpt' => $service['short_description'],
                    'content' => $service['full_description'],
                    'category' => 'Technology Services',
                    'author' => 'VIP Digital Hub',
                    'reading_time' => 3,
                    'status' => 'published',
                    'published_at' => now(),
                    'icon' => $service['icon'] ?? 'globe',
                    'features' => $service['features'] ?? [],
                    'cta' => $service['cta'] ?? 'Inquire Now',
                    'sort_order' => $sortOrder++,
                ]
            );
        }
    }
}
