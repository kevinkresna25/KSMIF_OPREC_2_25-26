<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => 'Team Alpha',
                'username' => 'alpha',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Team Beta',
                'username' => 'beta',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Team Gamma',
                'username' => 'gamma',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Team Delta',
                'username' => 'delta',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Team Epsilon',
                'username' => 'epsilon',
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($teams as $team) {
            Team::firstOrCreate(['username' => $team['username']], $team);
        }

        $this->command->info('Teams seeded successfully!');
        $this->command->info('Default password for all teams: password');
    }
}
