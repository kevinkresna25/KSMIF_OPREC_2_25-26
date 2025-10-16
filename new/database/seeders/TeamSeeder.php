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
                'name' => 'Team Quantum',
                'username' => 'quantum',
                'password' => bcrypt('4qe4N12'),
            ],
            [
                'name' => 'Team Matrix',
                'username' => 'matrix',
                'password' => bcrypt('4n5jErS'),
            ],
            [
                'name' => 'Team Cipher',
                'username' => 'cipher',
                'password' => bcrypt('3J25FFu'),
            ],
            [
                'name' => 'Team Pixel',
                'username' => 'pixel',
                'password' => bcrypt('4ofdwOS'),
            ],
            [
                'name' => 'Team Nova',
                'username' => 'nova',
                'password' => bcrypt('3KSad1O'),
            ],
            [
                'name' => 'Team CodeX',
                'username' => 'codex',
                'password' => bcrypt('4hbCaO9'),
            ],
            [
                'name' => 'Team Byte',
                'username' => 'byte',
                'password' => bcrypt('4952Vl2'),
            ],
            [
                'name' => 'Team Nexus',
                'username' => 'nexus',
                'password' => bcrypt('4hdPm53'),
            ],
            [
                'name' => 'Team Circuit',
                'username' => 'circuit',
                'password' => bcrypt('3JegIv9'),
            ],
            [
                'name' => 'Team Hexa',
                'username' => 'hexa',
                'password' => bcrypt('4nbf9vY'),
            ],
            [
                'name' => 'Team ByteWave',
                'username' => 'bytewave',
                'password' => bcrypt('46WUdEk'),
            ],
            [
                'name' => 'Team AlphaTech',
                'username' => 'alphatech',
                'password' => bcrypt('4hdPAsV'),
            ],
        ];

        foreach ($teams as $team) {
            Team::firstOrCreate(['username' => $team['username']], $team);
        }

        $this->command->info('Teams seeded successfully!');
        $this->command->info('Default password for all teams: password');
    }
}
