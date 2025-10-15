<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Tambah kolom kalau belum ada
        if (!Schema::hasColumn('team_submissions', 'content_hash')) {
            Schema::table('team_submissions', function (Blueprint $table) {
                $table->string('content_hash', 64)->nullable()->after('content');
            });

            // Index biasa (opsional). UNIQUE akan ditambahkan belakangan.
            Schema::table('team_submissions', function (Blueprint $table) {
                $table->index('content_hash', 'team_submissions_content_hash_index');
            });
        }

        // 2) Backfill hash untuk baris yang belum punya
        DB::table('team_submissions')->whereNull('content_hash')->orWhere('content_hash', '')
            ->orderBy('id')->chunkById(200, function ($rows) {
                foreach ($rows as $r) {
                    $normalized = preg_replace("/\r\n?/", "\n", trim((string)$r->content));
                    $hash = hash('sha256', $normalized);
                    DB::table('team_submissions')->where('id', $r->id)->update(['content_hash' => $hash]);
                }
            });

        // 3) Dedup (keep id terkecil untuk setiap hash)
        DB::statement('
            DELETE t1 FROM team_submissions t1
            INNER JOIN team_submissions t2
                ON t1.content_hash = t2.content_hash
               AND t1.id > t2.id
        ');

        // 4) Drop index lama (jika ada) lalu tambahkan UNIQUE
        try {
            DB::statement('ALTER TABLE `team_submissions` DROP INDEX `team_submissions_content_hash_index`');
        } catch (\Throwable $e) { /* abaikan jika tidak ada */ }

        DB::statement('ALTER TABLE `team_submissions` ADD UNIQUE `uq_team_submissions_content_hash` (`content_hash`)');
    }

    public function down(): void
    {
        // Hapus UNIQUE jika ada
        try {
            DB::statement('ALTER TABLE `team_submissions` DROP INDEX `uq_team_submissions_content_hash`');
        } catch (\Throwable $e) { /* abaikan */ }

        // Hapus kolom jika ada
        if (Schema::hasColumn('team_submissions', 'content_hash')) {
            Schema::table('team_submissions', function (Blueprint $table) {
                $table->dropColumn('content_hash');
            });
        }
    }
};
