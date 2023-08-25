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
        Schema::table('win_boost_orders', function (Blueprint $table) {
            $table->string('username')->nullable()->change();
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('win_boost_orders', function (Blueprint $table) {
            $table->string('username')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
        });
    }
};
