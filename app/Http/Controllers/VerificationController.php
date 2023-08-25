<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NotificationChannels\Discord\Discord;
use NotificationChannels\Discord\DiscordMessage;
use Illuminate\Support\Facades\Http;
use App\Models\Verification;
use Illuminate\Support\Facades\Auth;


class VerificationController extends Controller
{
    
    
    public function sendVerificationNotification(Request $request)
{
    $username = $request->input('username');
    $availableDate = $request->input('available_date');

    // Perform validation on username and available date if needed

    // Store the verification record in the database
    $verification = new Verification();
    $verification->username = $username;
    $verification->date = $availableDate;
    $verification->user_id = Auth::user()->id; // Set the user_id to the authenticated user's ID
    $verification->status = 'pending';
    $verification->save();

    

    // Redirect to success page or show success message
    return redirect()->back()->with('success', 'Verification notification sent successfully to the admin.');
}

public function showVerifications(Request $request)
{
    $verifications = Verification::orderBy('created_at', 'desc')->paginate(10);

    return view('admin.verification', compact('verifications'));
}


    public function showVerificationForm()
    {
        return view('verificationform');
    }


    public function updateVerificationStatus(Request $request)
{
    $verificationId = $request->input('verificationId');

    $verification = Verification::findOrFail($verificationId);


    $status = $request->input('status');

    // Perform validation on the $status if needed

    $verification->status = $status;
    $verification->save();

    // Return a JSON response
    return response()->json(['message' => 'Verification status updated successfully']);
}
public function acceptVerification(Request $request)
{
    $verificationId = $request->input('verificationId');

    $verification = Verification::findOrFail($verificationId);


    $status = $request->input('status');

    // Perform validation on the $status if needed

    $verification->status = $status;
    $verification->save();
    $profile=  $verification->user->profile;
    $profile->is_seller=1;
    $profile->save();
    // Return a JSON response
    return response()->json(['message' => 'Verification status updated successfully']);
}

}
