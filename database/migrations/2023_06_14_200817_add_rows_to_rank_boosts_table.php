<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $rankBoosts = [
            ['current_rank' => 'Iron1', 'desired_rank' => 'Iron2', 'value' => 11, 'price' => 3],
            ['current_rank' => 'Iron2', 'desired_rank' => 'Iron3', 'value' => 12, 'price' => 4],
            ['current_rank' => 'Iron3', 'desired_rank' => 'Bronze1', 'value' => 13, 'price' => 5],
            ['current_rank' => 'Bronze1', 'desired_rank' => 'Bronze2', 'value' => 21, 'price' => 7],
            ['current_rank' => 'Bronze2', 'desired_rank' => 'Bronze3', 'value' => 22, 'price' => 9],
            ['current_rank' => 'Bronze3', 'desired_rank' => 'Silver1', 'value' => 23, 'price' => 11],
            ['current_rank' => 'Silver1', 'desired_rank' => 'Silver2', 'value' => 31, 'price' => 13],
            ['current_rank' => 'Silver2', 'desired_rank' => 'Silver3', 'value' => 32, 'price' => 15],
            ['current_rank' => 'Silver3', 'desired_rank' => 'Gold1', 'value' => 33, 'price' => 17],
            ['current_rank' => 'Gold1', 'desired_rank' => 'Gold2', 'value' => 41, 'price' => 19],
            ['current_rank' => 'Gold2', 'desired_rank' => 'Gold3', 'value' => 42, 'price' => 21],
            ['current_rank' => 'Gold3', 'desired_rank' => 'Platinum1', 'value' => 43, 'price' => 23],
            ['current_rank' => 'Platinum1', 'desired_rank' => 'Platinum2', 'value' => 51, 'price' => 25],
            ['current_rank' => 'Platinum2', 'desired_rank' => 'Platinum3', 'value' => 52, 'price' => 27],
            ['current_rank' => 'Platinum3', 'desired_rank' => 'Diamond1', 'value' => 53, 'price' => 29],
            ['current_rank' => 'Diamond1', 'desired_rank' => 'Diamond2', 'value' => 61, 'price' => 31],
            ['current_rank' => 'Diamond2', 'desired_rank' => 'Diamond3', 'value' => 62, 'price' => 33],
            ['current_rank' => 'Diamond3', 'desired_rank' => 'Ascendant1', 'value' => 63, 'price' => 35],
            ['current_rank' => 'Ascendant1', 'desired_rank' => 'Ascendant2', 'value' => 71, 'price' => 40],
            ['current_rank' => 'Ascendant2', 'desired_rank' => 'Ascendant3', 'value' => 72, 'price' => 45],
            ['current_rank' => 'Ascendant3', 'desired_rank' => 'Immortal1', 'value' => 73, 'price' => 50],
            ['current_rank' => 'Immortal1', 'desired_rank' => 'Immortal2', 'value' => 81, 'price' => 55],
            ['current_rank' => 'Immortal2', 'desired_rank' => 'Immortal3', 'value' => 82, 'price' => 60],
            ['current_rank' => 'Immortal3', 'desired_rank' => 'Radiant', 'value' => 83, 'price' => 450],
        ];

        foreach ($rankBoosts as $boost) {
            DB::table('rank_boosts')->insert($boost + ['created_at' => now(), 'updated_at' => now()]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rank_boosts', function (Blueprint $table) {
            //
        });
    }
};
