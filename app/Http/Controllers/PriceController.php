<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RankBoost;
use App\Models\PlacementBoost;
use App\Models\WinBoost;
use Illuminate\Validation\Rule;

class PriceController extends Controller
{    
    
    public function calculateplacement(Request $request)
{
    // Validate the submitted data
    $validatedData = $request->validate([
        'selectedRank' => 'required',
        'numberOfGames' => 'required|integer',
    
    ]);

    $selectedRank = $validatedData['selectedRank'];
    $numberOfGames = $validatedData['numberOfGames'];
    


    // Find the placement boost that corresponds to the selected rank
    $boost = PlacementBoost::where('previous_rank', $selectedRank)
    ->where('match_amount', $numberOfGames)
    ->first();

    if ($boost) {
        $totalPrice = $boost->price ;

        // Apply discount percentages
        $discountPercentage = 0;
        $playWithBooster = $request->input('Play_w_booster');
        $priorityBoost = $request->input('is_priority');
        // Check if the "Play With Booster" checkbox is checked
        if ($playWithBooster === '1'){
            // Add 50% to the price
            $totalPrice *= 1.5;
        }

        // Check if the "Priority Boost" checkbox is checked
        if ($priorityBoost === '1') {
            // Add 25% to the price
            $totalPrice *= 1.25;
        }

        // Prepare the response data
        $responseData = [
            'totalPrice' => $totalPrice,
        ];

        // Return the response as JSON
        return response()->json($responseData);
    } else {
        // Invalid rank boost

        // Prepare the error response data
        $responseData = [
            'error' => 'Invalid data',
        ];

        // Return the error response as JSON
        return response()->json($responseData, 400);
    }
}





public function calculatewin(Request $request)
{
    // Validate the submitted data
    $validatedData = $request->validate([
        'selectedRank' => 'required',
        'numberOfGames' => 'required|integer',
    
    ]);

    $selectedRank = $validatedData['selectedRank'];
    $numberOfGames = $validatedData['numberOfGames'];
    


    // Find the placement boost that corresponds to the selected rank
    $boost = WinBoost::where('current_rank', $selectedRank)->first();

    if ($boost) {
        $totalPrice = $boost->price*(1.111**($numberOfGames-1)) ;

        // Apply discount percentages
        $discountPercentage = 0;
        $playWithBooster = $request->input('Play_w_booster');
        $priorityBoost = $request->input('is_priority');
        // Check if the "Play With Booster" checkbox is checked
        if ($playWithBooster === '1'){
            // Add 50% to the price
            $totalPrice *= 1.5;
        }

        // Check if the "Priority Boost" checkbox is checked
        if ($priorityBoost === '1') {
            // Add 25% to the price
            $totalPrice *= 1.25;
        }

        // Prepare the response data
        $responseData = [
            'totalPrice' => $totalPrice,
        ];

        // Return the response as JSON
        return response()->json($responseData);
    } else {
        // Invalid rank boost

        // Prepare the error response data
        $responseData = [
            'error' => 'Invalid data',
        ];

        // Return the error response as JSON
        return response()->json($responseData, 400);
    }
}





    public function calculate(Request $request)
    {
        // Validate the submitted data
        $validatedData = $request->validate([
            'currentTier' => 'required|integer',
            'currentDivision' => 'required|integer',
            'desiredTier' => 'required|integer',
            'desiredDivision' => 'required|integer',
        ]);
    
        // Extract the validated data
        $currentTier = $validatedData['currentTier'];
        $currentDivision = $validatedData['currentDivision'];
        $desiredTier = $validatedData['desiredTier'];
        $desiredDivision = $validatedData['desiredDivision'];
    
        // Get the rank boosts that match the criteria
        $validRankBoosts = RankBoost::where('value', '<', $desiredTier * 10 + $desiredDivision)
            ->where('value', '>=', $currentTier * 10 + $currentDivision)
            ->get();
    
        // Calculate the total price
        $totalPrice = $validRankBoosts->sum('price');
    
        // Calculate the discount based on the selected RR value
        $selectedRR = $request->input('selectedRR');
        $discountPercentage = 0;
    
        if ($selectedRR === '21-40') {
            $discountPercentage = 10;
        } elseif ($selectedRR === '41-60') {
            $discountPercentage = 18;
        } elseif ($selectedRR === '61-80') {
            $discountPercentage = 28;
        } elseif ($selectedRR === '81-100') {
            $discountPercentage = 38;
        }
    
        // Apply the discount to the initial price
        $discountedPrice = $totalPrice * (1 - $discountPercentage / 100);
    
        // Calculate additional price modifications (e.g., checkboxes)
        $playWithBooster = $request->input('Play_w_booster');
        $priorityBoost = $request->input('is_priority');
    
        if ($playWithBooster === '1') {
            // Add 50% to the price if "Play With Booster" is checked
            $discountedPrice *= 1.5;
        }
    
        if ($priorityBoost === '1') {
            // Add 25% to the price if "Priority Boost" is checked
            $discountedPrice *= 1.25;
        }
    
        // Prepare the response data
        $responseData = [
            'totalPrice' => $discountedPrice,
            // Include any other relevant data you need to send back
        ];
    
        // Return the response as JSON
        return response()->json($responseData);
    }
    
}
