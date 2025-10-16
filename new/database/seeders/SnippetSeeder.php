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
                'content' => '<head><meta charset="UTF-8"><title>KSMIF - OPREC Game Besar</title></head>',
                'correct_order' => 3,
            ],
            [
                'content' => '<body style="font-family: monospace; background: #1a0f30; color: #00f6ff; padding: 40px;">',
                'correct_order' => 4,
            ],
            [
                'content' => '<h1>🎮 SELAMAT! KAMU BERHASIL! 🎮</h1>',
                'correct_order' => 5,
            ],
            [
                'content' => '<p>Kamu telah berhasil menyusun semua fragmen kode dengan urutan yang tepat!</p>',
                'correct_order' => 6,
            ],
            [
                'content' => '<p style="margin-top: 20px;"><strong>KSMIF (Kelompok Studi Mahasiswa Informatika)</strong> mengucapkan selamat atas pencapaianmu dalam Open Recruitment Game Besar ini.</p>',
                'correct_order' => 7,
            ],
            [
                'content' => '<p style="margin-top: 20px; font-style: italic; color: #28a745;">"Challenge Yourself, Prove Your Worth"</p>',
                'correct_order' => 8,
            ],
            [
                'content' => '</body>',
                'correct_order' => 9,
            ],
            [
                'content' => '</html>',
                'correct_order' => 10,
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
