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
        Schema::create('valorants_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('server');
            $table->string('rank');
            $table->string('level');
            $table->string('level_method');
            $table->integer('number_of_skins');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('username');
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('email_password')->nullable();
            $table->boolean('full_access')->default(false);
            $table->boolean('is_sold')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valorants_accounts');
    }
};
