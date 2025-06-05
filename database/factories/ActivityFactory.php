<?php

namespace Database\Factories;

use App\Models\Activity;
use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $exists_activities = array_filter(Activity::all()->pluck('id')->toArray(), fn($item) => $item !== 0);

        return [
            'name' => $this->faker->name(),
            'parent_id' => Arr::random(array_merge([null], $exists_activities)),
        ];
    }
}
