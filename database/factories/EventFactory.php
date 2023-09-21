<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'body' => $this->faker->text,
            'place' => $this->faker->address,
            'status' => $this->faker->randomElement(['active', 'closed', 'canceled']),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 day'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 week'),
        ];
    }
}
