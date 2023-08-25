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
        Schema::table('rank_boosts', function (Blueprint $table) {
            Schema::table('rank_boosts', function (Blueprint $table) {
                $table->integer('value')->after('desired_rank');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rank_boosts', function (Blueprint $table) {
            //
        });
    }
};
