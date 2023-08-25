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
        Schema::create('smurf_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('username');
            $table->string('password', 255);
            $table->string('email');
            $table->string('email_password', 255);
            $table->boolean('is_sold')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smurf_accounts');
    }
};
