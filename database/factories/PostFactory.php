<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PostType;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'post_type' => PostType::Post->value,
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'excerpt' => fake()->paragraph(2),
            'content' => '<h2>'.fake()->sentence().'</h2><p>'.implode('</p><p>', fake()->paragraphs(3)).'</p>',
            'featured_image' => null,
            'category' => fake()->randomElement(['Architecture', 'Laravel', 'SaaS', 'Marketing', 'DevOps']),
            'author' => 'VIP Digital Hub',
            'reading_time' => fake()->numberBetween(3, 10),
            'status' => 'published',
            'meta_title' => null,
            'meta_description' => null,
            'published_at' => now(),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }

    public function project(): static
    {
        return $this->state(fn (array $attributes) => [
            'post_type' => PostType::Project->value,
            'technologies' => ['Laravel', 'Tailwind CSS', 'MySQL'],
            'client' => fake()->company(),
            'year' => (string) fake()->numberBetween(2023, 2026),
            'project_url' => fake()->url(),
            'featured' => fake()->boolean(25),
            'sort_order' => fake()->numberBetween(0, 10),
        ]);
    }

    public function service(): static
    {
        return $this->state(fn (array $attributes) => [
            'post_type' => PostType::Service->value,
            'icon' => fake()->randomElement(['globe', 'code', 'cloud', 'layers', 'device-mobile', 'chart-bar', 'palette']),
            'features' => ['Fast Performance', 'Security', 'Scalable Architecture', '24/7 Support'],
            'cta' => 'Inquire Now',
            'sort_order' => fake()->numberBetween(0, 10),
        ]);
    }
}
