<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PostType;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'post_type' => PostType::Project->value,
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'short_description' => fake()->paragraph(1),
            'description' => fake()->paragraph(4),
            'featured_image' => null,
            'gallery' => [],
            'technologies' => ['Laravel', 'Tailwind CSS', 'MySQL'],
            'category' => fake()->randomElement(['SaaS Platforms', 'Custom Software', 'Mobile Applications']),
            'project_url' => fake()->url(),
            'client' => fake()->company(),
            'year' => (string) fake()->numberBetween(2023, 2026),
            'featured' => fake()->boolean(25),
            'status' => 'published',
            'sort_order' => fake()->numberBetween(0, 10),
            'published_at' => now(),
        ];
    }
}
