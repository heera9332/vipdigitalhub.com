<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filename = 'media/test-'.fake()->uuid().'.jpg';

        return [
            'name' => fake()->words(2, true),
            'file_name' => $filename,
            'disk' => 'public',
            'mime_type' => 'image/jpeg',
            'size' => fake()->numberBetween(20000, 2000000),
            'width' => 1200,
            'height' => 800,
            'alt_text' => fake()->sentence(4),
        ];
    }
}
