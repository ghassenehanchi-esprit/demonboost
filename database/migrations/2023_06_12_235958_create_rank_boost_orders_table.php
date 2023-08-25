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
        Schema::create('rank_boost_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rank_boost_id');
            $table->unsignedBigInteger('user_id');
            $table->float('total_price');
            $table->string('special_agent')->nullable();
            $table->boolean('p_with_booster')->default(false);
            $table->boolean('priority')->default(false);
            $table->string('status');
            $table->timestamps();

            $table->foreign('rank_boost_id')->references('id')->on('rank_boosts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rank_boost_orders');
    }
};
