<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Building;
use App\Models\Organization;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        $user = User::factory()->create();

        $user->newToken('api:static');

        $buildings = Building::factory()->count(10)->create();

        $data_output = [
            'users_count' => $user->count(),
            'buildings_count' => $buildings->count(),
        ];

        foreach ($buildings as $building) {
            $organizations = Organization::factory()->count(15)->create([
                'building_id' => $building->id
            ]);

            $activities = Activity::factory(12)->create();

            $data_output['organizations_count'] = $organizations->count();
            $data_output['activities_count'] = $activities->count();

            foreach ($organizations as $organization) {
                $organization->activities()->attach($activities->random(1));
            }
        }

        foreach ($data_output as $key => $value) {
            $this->command->info("Created mock ".str_replace('_', ' ', $key) . ": $value");
        }
    }
}
