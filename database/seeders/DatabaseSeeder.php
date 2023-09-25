<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\User;
use Closure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Helper\ProgressBar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->command->warn(PHP_EOL . 'Creating user...');
        $user = $this->withProgressBar(300, fn () => User::factory(1)->create());
        $this->command->info('User created.');

        $this->command->warn(PHP_EOL . 'Creating event...');
        $event = $this->withProgressBar(10, fn () => Event::factory(1)
            ->sequence(fn () => ['user_id' => $user->random()->id])
            ->withTags()
            ->create()
        );
        $this->command->info('Event created.');

        $this->command->warn(PHP_EOL . 'Creating attendee...');
        $attendee = $this->withProgressBar(200, fn () => Attendee::factory(1)
            ->sequence(fn () => [
                'event_id' => $event->random(1)->first()->id,
                'user_id' => $user->random(1)->first()->id,
            ])
            ->create()
        );
        $this->command->info('Attendee created.');

        $this->command->info('All done!');
    }

    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);

        $progressBar->start();

        $items = new Collection;

        foreach (range(1, $amount) as $i) {
            $items = $items->merge(
                $createCollectionOfOne()
            );
            $progressBar->advance();
        }

        $progressBar->finish();

        $this->command->getOutput()->writeln('');

        return $items;
    }
}
