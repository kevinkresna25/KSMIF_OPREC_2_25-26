<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create operator user for KSMIF OPREC
        User::firstOrCreate(
            ['email' => 'operator@ksmif.test'],
            [
                'name' => 'KSMIF Operator',
                'email' => 'operator@ksmif.test',
                'password' => Hash::make('Password321'),
                'is_operator' => true,
            ]
        );

        // Create regular test user
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'is_operator' => false,
            ]
        );

        // Call other seeders
        $this->call([
            TeamSeeder::class,
            SnippetSeeder::class,
        ]);
    }
}
