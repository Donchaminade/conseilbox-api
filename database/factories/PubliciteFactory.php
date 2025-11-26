<?php

namespace Database\Factories;

use App\Models\Publicite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Publicite>
 */
class PubliciteFactory extends Factory
{
    protected $model = Publicite::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraph(),
            'image_url' => $this->faker->optional()->imageUrl(),
            'target_url' => $this->faker->optional()->url(),
            'is_active' => $this->faker->boolean(70),
        ];
    }

    public function active(): self
    {
        return $this->state(fn (): array => ['is_active' => true]);
    }

    public function inactive(): self
    {
        return $this->state(fn (): array => ['is_active' => false]);
    }
}

