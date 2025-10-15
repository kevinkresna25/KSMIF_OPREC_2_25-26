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
                'password' => bcrypt('1234'),
            ],
            [
                'name' => 'Team Matrix',
                'username' => 'matrix',
                'password' => bcrypt('abcd'),
            ],
            [
                'name' => 'Team Cipher',
                'username' => 'cipher',
                'password' => bcrypt('admin123'),
            ],
            [
                'name' => 'Team Pixel',
                'username' => 'pixel',
                'password' => bcrypt('password01'),
            ],
            [
                'name' => 'Team Nova',
                'username' => 'nova',
                'password' => bcrypt('12345'),
            ],
            [
                'name' => 'Team CodeX',
                'username' => 'codex',
                'password' => bcrypt('qwerty'),
            ],
            [
                'name' => 'Team Byte',
                'username' => 'byte',
                'password' => bcrypt('root123'),
            ],
            [
                'name' => 'Team Nexus',
                'username' => 'nexus',
                'password' => bcrypt('letmein'),
            ],
            [
                'name' => 'Team Circuit',
                'username' => 'circuit',
                'password' => bcrypt('123qwe'),
            ],
            [
                'name' => 'Team Hexa',
                'username' => 'hexa',
                'password' => bcrypt('123abc'),
            ],
            [
                'name' => 'Team ByteWave',
                'username' => 'bytewave',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Team AlphaTech',
                'username' => 'alphatech',
                'password' => bcrypt('tech2025'),
            ],
        ];

        foreach ($teams as $team) {
            Team::firstOrCreate(['username' => $team['username']], $team);
        }

        $this->command->info('Teams seeded successfully!');
        $this->command->info('Default password for all teams: password');
    }
}
