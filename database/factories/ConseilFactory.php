<?php

namespace Database\Factories;

use App\Models\Conseil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Conseil>
 */
class ConseilFactory extends Factory
{
    protected $model = Conseil::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6),
            'content' => $this->faker->paragraphs(3, true),
            'anecdote' => $this->faker->optional()->paragraph(),
            'author' => $this->faker->name(),
            'location' => $this->faker->optional()->city(),
            'status' => $this->faker->randomElement(Conseil::STATUSES),
            'social_link_1' => $this->faker->optional()->url(),
            'social_link_2' => $this->faker->optional()->url(),
            'social_link_3' => $this->faker->optional()->url(),
        ];
    }

    public function published(): self
    {
        return $this->state(fn (): array => ['status' => Conseil::STATUS_PUBLISHED]);
    }

    public function pending(): self
    {
        return $this->state(fn (): array => ['status' => Conseil::STATUS_PENDING]);
    }

    public function rejected(): self
    {
        return $this->state(fn (): array => ['status' => Conseil::STATUS_REJECTED]);
    }
}

