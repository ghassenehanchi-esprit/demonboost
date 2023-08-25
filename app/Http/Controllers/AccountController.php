<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ValorantAccount;
use Illuminate\Support\Facades\Auth;
use App\Models\ValorantAccountOrder;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DiscordInviteNotification;
use App\Models\Earning;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class AccountController extends Controller
{
    public function index()
    {
        $accounts = ValorantAccount::where('user_id', auth()->id())->get();
        
        return view('accounts', compact('accounts'));
    }
    public function delete($id)
    {
        $account = ValorantAccount::findOrFail($id);
        
        // Check if the authenticated user owns the account
    if ($account->user_id !== auth()->user()->id) {
        return redirect()->back()->withErrors(['error' => 'You do not have permission to delete this account.']);
    }

    // Check if the account is already sold
    if ($account->is_sold) {
        return redirect()->back()->withErrors(['error' => 'This account has already been sold and cannot be deleted.']);
    }

    // Delete the account
    $account->delete();
        return redirect()->route('account.index')->with('success', 'Account deleted successfully');
    }
    
   
   
    public function create()
    {
        return view('accountshop.addaccount');
    }
    public function save(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'server' => 'required',
        'rank' => 'required',
        'level' => 'required|numeric',
        'level_method' => 'required',
        'skins' => 'required|numeric',
        'description' => 'required',
        'price' => 'required|numeric',
        'username' => 'required',
        'password' => 'required',
        'email' => 'nullable|email',
        'email_password' => 'nullable',
        'gallery' => 'nullable|array',
        'gallery.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image types and size as needed
    ]);


    $userId = Auth::id();

    // Create a new account instance
    $account = new ValorantAccount();
    $account->user_id = $userId;
    $account->server = $request->input('server');
    $account->rank = $request->input('rank');
    $account->level = $request->input('level');
    $account->level_method = $request->input('level_method');
    $account->number_of_skins = $request->input('skins');
    $account->description = $request->input('description');
    $account->price = $request->input('price');
    $account->username = $request->input('username');
    $account->password =  encrypt($request->input('password'));
    $account->email = $request->input('email');
    $account->email_password = encrypt ($request->input('email_password'));
    $account->is_sold = 0; // Default value

    // Set the account_rank_image based on the selected rank
    $rank = $request->input('rank');
    $rankToImageMap = [
        'Iron 1' => '11.png',
        'Iron 2' => '12.png',
        'Iron 3' => '13.png',
        'Bronze 1' => '21.png',
        'Bronze 2' => '22.png',
        'Bronze 3' => '23.png',
        'Silver 1' => '31.png',
        'Silver 2' => '32.png',
        'Silver 3' => '33.png',
        'Gold 1' => '41.png',
        'Gold 2' => '42.png',
        'Gold 3' => '43.png',
        'Platinum 1' => '51.png',
        'Platinum 2' => '52.png',
        'Platinum 3' => '53.png',
        'Diamond 1' => '61.png',
        'Diamond 2' => '62.png',
        'Diamond 3' => '63.png',
        'Ascendant 1' => '71.png',
        'Ascendant 2' => '72.png',
        'Ascendant 3' => '73.png',
        'Immortal 1' => '81.png',
        'Immortal 2' => '82.png',
        'Immortal 3' => '83.png',
        'Radiant' => '90.png',
    ];
    $account->account_rank_image = $rankToImageMap[$rank] ?? null;
    if ($request->hasFile('gallery')) {
        $galleryPaths = [];
        foreach ($request->file('gallery') as $photo) {
            $galleryPaths[] = $photo->store('gallery', 'public'); // Store the gallery photos in the 'storage/app/public/gallery' directory
        }
        $account->gallery = json_encode($galleryPaths);

    }
    // Save the account
    $account->save();
    // Redirect or perform additional actions as needed
    // For example, you can redirect to a success page
    return redirect()->route('account.details', ['id' => $account->id])->with('success', 'Account added successfully');
}
public function showAllAccounts()
{
    $accounts = ValorantAccount::where('is_sold', 0)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('accountshop.accountshop', compact('accounts'));
}

public function showAccountDetails($id)
{
    $account = ValorantAccount::findOrFail($id);

    return view('accountshop.accountpage', compact('account'));
}

public function showAccountPayment($id)
{
    // Retrieve the RankBoost order with the given ID
    $account = ValorantAccount::find($id);

    // Check if the RankBoost order exists
    if (!$account) {
        abort(404); // Or handle the case when the order is not found
    }

    return view('accountshop.accountpayment', compact('account'));
}

public function verifyTokenAndShowCredentials(Request $request, $id)
{
    // Validate the entered account token
    $request->validate([
        'token' => 'required|string',
    ]);

    $accountOrder = ValorantAccountOrder::find($id);

    if (!$accountOrder || $accountOrder->account_token !== $request->input('token')) {
        return redirect()->back()->withErrors(['token' => 'Invalid account token.'])->withInput();
    }

    // Update the account's is_sold column to mark it as sold
    $accountOrder->valorantAccount->update(['is_sold' => 1]);
    $account = $accountOrder->valorantAccount;

    // Check if an earning instance already exists for the order
    $existingEarning = Earning::where('valorant_account_order_id', $accountOrder->id)->first();
    if ($existingEarning) {
        // An earning instance already exists, no need to create a new one
        $earning = $existingEarning;
    } else {
        // Create a new earning record
        $earning = new Earning();
        $earning->valorant_account_order_id = $accountOrder->id;
        $earning->profile_id = $accountOrder->user->profile->id;
        $earning->amount = $accountOrder->valorantAccount->price*0.8;
        $earning->status = 'pending'; // Set the initial status as 'pending'
        $earning->withdrawal_date = Carbon::now()->addDays(7); // Set the withdrawal date 7 days from now
        $earning->save();
    }

    // Send a notification with the token to the user's email
    $userEmail = $accountOrder->user->email;
    $token = $accountOrder->account_token;
    // Use your preferred method to send the notification (e.g., email notification)

    if ($accountOrder->valorantAccount->full_access) {
        // Account is full access
        $accountCredentials = [
            'Username' => $accountOrder->valorantAccount->username,
            'Password' => decrypt($accountOrder->valorantAccount->password),
            'Email' => $accountOrder->valorantAccount->email,
            'Email Password' => decrypt($accountOrder->valorantAccount->email_password),
            'Full Access' => true,
        ];
    } else {
        // Account is not full access
        $accountCredentials = [
            'Username' => $accountOrder->valorantAccount->username,
            'Password' => decrypt($accountOrder->valorantAccount->password),
            'Full Access' => false,
        ];
    }

    return view('accountshop.accountcredentials', compact('accountCredentials', 'token', 'account'));
}

public function submitDiscordUsername(Request $request, $accountId)
{
    // Validate the submitted form data
    $validatedData = $request->validate([
        'discord_username' => 'required|string',
    ]);

    // Retrieve the account based on the ID
    $account = ValorantAccount::find($accountId);

    // Update the account with the discord username
    

    // Send a notification to the user
    $user = $account->user;
    $notification = new DiscordInviteNotification($account, $validatedData['discord_username']);
    Notification::send($user, $notification);

    // Redirect the user to the desired page
    return redirect()->route('profile.show');
}


}
