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
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_price', 8, 2);
            $table->text('special_agent')->nullable();
            $table->boolean('p_with_booster')->default(false);
            $table->boolean('is_priority')->default(false);
            $table->string('current_rank');
            $table->string('desired_rank');
            $table->string('server');
            $table->string('current_rr');
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->boolean('payment_status')->default(false);
            $table->string('status')->default('in progress');
            $table->timestamps();

            // Define foreign key constraint
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
