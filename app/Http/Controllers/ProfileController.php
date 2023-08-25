<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PlacementBoostOrder;
use App\Models\RankBoostOrder;
use App\Models\SmurfAccountOrder;
use App\Models\ValorantAccountOrder;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $profile = Auth::user()->profile;
        
        // Calculate the pending amount
        $pendingAmount = $profile->earnings()
            ->whereNull('withdrawal_date')
            ->where('status', 'pending')
            ->sum('amount');
            
        // Calculate the available withdrawal amount
        $withdrawalAmount = $profile->earnings()
            ->where('withdrawal_date', '<=', now())
            ->where('status', 'pending')
            ->sum('amount');
            
        return view('profile', compact('profile', 'pendingAmount', 'withdrawalAmount'));
    }
    


    public function edit()
    {
        $profile = Auth::user()->profile;
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $profile = Auth::user()->profile;

        // Update avatar
        if ($request->hasFile('avatar')) {
            // Delete the previous avatar
            Storage::delete($profile->avatar);

            // Store the new avatar
            $avatarPath = $request->file('avatar')->store('avatars');
            $profile->avatar = $avatarPath;
        }

        // Update bio
        $profile->bio = $request->input('bio');

        // Update password
        if ($request->filled('password')) {
            $user = Auth::user();
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }

        // Update is_seller
        $profile->is_seller = $request->input('is_seller', false);

        // Save the changes
        $profile->save();

    }

    public function showOrders()
{
    $userId = auth()->id();

    $placementOrders = PlacementBoostOrder::where('user_id', $userId)->where('payment_status', 1)->get();
    $rankOrders = RankBoostOrder::where('user_id', $userId)->where('payment_status', 1)->get();
    $smurfOrders = SmurfAccountOrder::where('user_id', $userId)->where('payment_status', 1)->get();
    $valorantOrders = ValorantAccountOrder::where('user_id', $userId)->get();

    return view('orders', compact('placementOrders', 'rankOrders', 'smurfOrders', 'valorantOrders'));
}
}
