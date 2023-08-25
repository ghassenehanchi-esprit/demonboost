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
        Schema::table('reports', function (Blueprint $table) {
            // Modify the existing foreign key constraint to cascade on delete and update
            $table->dropForeign(['valorant_account_order_id']);
            $table->foreign('valorant_account_order_id')
                ->references('id')
                ->on('valorant_account_orders')
                ->onDelete('cascade') // Cascade on delete
                ->onUpdate('cascade'); // Cascade on update
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Revert the foreign key constraint to its original state if needed
            $table->dropForeign(['valorant_account_order_id']);
            $table->foreign('valorant_account_order_id')
                ->references('id')
                ->on('valorant_account_orders');
        });
    }
};
