<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PostType;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->words(3, true);

        return [
            'post_type' => PostType::Service->value,
            'title' => ucwords($title),
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'excerpt' => fake()->paragraph(1),
            'content' => fake()->paragraph(3),
            'category' => 'Technology Services',
            'author' => 'VIP Digital Hub',
            'reading_time' => 3,
            'icon' => fake()->randomElement(['globe', 'code', 'cloud', 'layers', 'device-mobile', 'chart-bar', 'palette']),
            'features' => ['Fast Performance', 'Security Hardening', 'Scalable Architecture', '24/7 Monitoring'],
            'cta' => 'Inquire Now',
            'featured' => fake()->boolean(25),
            'status' => 'published',
            'sort_order' => fake()->numberBetween(0, 10),
            'published_at' => now(),
        ];
    }
}
