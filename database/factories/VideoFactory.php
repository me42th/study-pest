<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    Video,
    Course
};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'course_id' => Course::factory(),
            'description' => $this->faker->name(),
            'duration_in_minutes' => random_int(2,10),
            'vimeo_id' => $this->faker->uuid()
        ];
    }

    public function vimeoId($vimeoId): static
    {
        return $this->state(fn (array $attributes) => [
                'vimeo_id' => $vimeoId,
            ]
        );
    }
}
