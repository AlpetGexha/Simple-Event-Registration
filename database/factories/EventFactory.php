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
        $title = $this->faker->sentence(3);

        return [
            'title' => $title,
            'slug' => str()->slug($title),
            'body' => $this->faker->text,
            'place' => $this->faker->address,
            'price' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['active', 'closed', 'canceled']),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 day'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 week'),
        ];
    }

    public function withTags(): Factory
    {
        return $this->afterCreating(function (Event $event) {
            $event->attachTags($this->faker->randomElements(['php', 'laravel', 'symfony', 'alpinejs', 'livewire', 'volt', 'folt', 'chill'], rand(1, 4)));
        });
    }
}
