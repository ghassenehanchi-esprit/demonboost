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
        Schema::table('valorant_accounts', function (Blueprint $table) {
            $table->string('account_rank_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('valorant_accounts', function (Blueprint $table) {
            $table->dropColumn('account_rank_image');
        });
    }
};
