<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug,
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(10),
            'tagline' => $this->faker->word,
            'image' => 'image.png',
            'learnings' => explode(' ',$this->faker->sentence)
        ];
    }

    public function released(?Carbon $carbon = null): self
    {
        return $this->state(fn ($attributes) => [
            'released_at' => $carbon ?? Carbon::now(),
        ]);
    }
}
