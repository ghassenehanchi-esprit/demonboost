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
    {Schema::table('earnings', function (Blueprint $table) {
        // Remove the processing_start column
        $table->dropColumn('processing_start');

        // Add the status column
        $table->string('status')->default('pending');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('earnings', function (Blueprint $table) {
            // Add the processing_start column
            $table->timestamp('processing_start')->nullable();

            // Remove the status column
            $table->dropColumn('status');
        });
    }
};
