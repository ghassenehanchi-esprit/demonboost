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
        Schema::create('placement_boost_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->float('total_price');
            $table->text('special_agent')->nullable();
            $table->boolean('p_with_booster')->default(false);
            $table->boolean('is_priority')->default(false);
            $table->string('previous_rank');
            $table->integer('wins_number');
            $table->string('server');
            $table->string('username');
            $table->string('password');
            $table->boolean('payment_status')->default(false);
            $table->string('status')->default('new');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placement_boost_orders');
    }
};
