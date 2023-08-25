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
        DB::table('win_boosts')->insert([
            ['current_rank' => 'Iron1', 'price' => 2.4],
            ['current_rank' => 'Iron2', 'price' => 3.2],
            ['current_rank' => 'Iron3', 'price' => 4],
            ['current_rank' => 'Bronze1', 'price' => 5.6],
            ['current_rank' => 'Bronze2', 'price' => 7.2],
            ['current_rank' => 'Bronze3', 'price' => 8.8],
            ['current_rank' => 'Silver1', 'price' => 10.4],
            ['current_rank' => 'Silver2', 'price' => 12],
            ['current_rank' => 'Silver3', 'price' => 13.6],
            ['current_rank' => 'Gold1', 'price' => 15.2],
            ['current_rank' => 'Gold2', 'price' => 16.8],
            ['current_rank' => 'Gold3', 'price' => 18.4],
            ['current_rank' => 'Platinum1', 'price' => 20],
            ['current_rank' => 'Platinum2', 'price' => 21.6],
            ['current_rank' => 'Platinum3', 'price' => 23.2],
            ['current_rank' => 'Diamond1', 'price' => 24.8],
            ['current_rank' => 'Diamond2', 'price' => 26.4],
            ['current_rank' => 'Diamond3', 'price' => 28],
            ['current_rank' => 'Ascendant1', 'price' => 32],
            ['current_rank' => 'Ascendant2', 'price' => 36],
            ['current_rank' => 'Ascendant3', 'price' => 40],
            ['current_rank' => 'Immortal1', 'price' => 44],
            ['current_rank' => 'Immortal2', 'price' => 48],
            ['current_rank' => 'Immortal3', 'price' => 360],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
