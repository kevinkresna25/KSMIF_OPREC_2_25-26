<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('username')->nullable()->after('name');
            $table->string('password')->nullable()->after('username');
            $table->rememberToken()->after('password');
        });

        // Update existing teams with default username from team name
        $teams = \App\Models\Team::all();
        foreach ($teams as $team) {
            $username = strtolower(str_replace(' ', '', $team->name));
            $team->update([
                'username' => $username,
                'password' => bcrypt('password'), // default password
            ]);
        }

        // Now make username unique and not nullable
        Schema::table('teams', function (Blueprint $table) {
            $table->string('username')->unique()->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn(['username', 'password', 'remember_token']);
        });
    }
};
