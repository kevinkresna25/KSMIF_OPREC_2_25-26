<?php

namespace Database\Seeders;

use App\Models\Snippet;
use Illuminate\Database\Seeder;

class SnippetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $snippets = [
            [
                'content' => '<!DOCTYPE html>',
                'correct_order' => 1,
            ],
            [
                'content' => '<html lang="id">',
                'correct_order' => 2,
            ],
            [
                'content' => '<head><meta charset="UTF-8"><title>Puzzle Game</title></head>',
                'correct_order' => 3,
            ],
            [
                'content' => '<body>',
                'correct_order' => 4,
            ],
            [
                'content' => '<h1>Selamat! Anda berhasil menyusun puzzle!</h1>',
                'correct_order' => 5,
            ],
            [
                'content' => '<p>Ini adalah hasil dari penyusunan yang benar.</p>',
                'correct_order' => 6,
            ],
            [
                'content' => '</body>',
                'correct_order' => 7,
            ],
            [
                'content' => '</html>',
                'correct_order' => 8,
            ],
        ];

        foreach ($snippets as $snippet) {
            Snippet::firstOrCreate(
                ['correct_order' => $snippet['correct_order']],
                $snippet
            );
        }

        $this->command->info('Snippets seeded successfully!');
    }
}
