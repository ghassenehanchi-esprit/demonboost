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
        Schema::table('win_boosts', function (Blueprint $table) {
            $table->dropColumn('match_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('win_boosts', function (Blueprint $table) {
            $table->integer('match_amount')->nullable();
        });
    }
};
