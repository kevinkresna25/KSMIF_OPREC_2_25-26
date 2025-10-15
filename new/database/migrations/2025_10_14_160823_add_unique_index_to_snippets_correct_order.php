<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // bersihkan duplikat (sisa id terkecil per correct_order)
        DB::statement('
            DELETE s1 FROM snippets s1
            INNER JOIN snippets s2
                ON s1.correct_order = s2.correct_order
               AND s1.id > s2.id
        ');

        Schema::table('snippets', function (Blueprint $table) {
            $table->unique('correct_order', 'uq_snippets_correct_order');
        });
    }

    public function down(): void
    {
        Schema::table('snippets', function (Blueprint $table) {
            $table->dropUnique('uq_snippets_correct_order');
        });
    }
};
