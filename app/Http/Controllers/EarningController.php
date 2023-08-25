<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Earning;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Api\Currency;
use Srmklive\PayPal\Services\ExpressCheckout;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Account;
use Stripe\Transfer;
use Stripe\Token;



class EarningController extends Controller
{
    public function withdrawForm()
    {
        $profile = Auth::user()->profile;
        $earnings = $profile->earnings()->where('status', 'pending')->get();
        return view('withdrawForm', compact('earnings'));
    }
    public function withdraw(Request $request)
    {
        $request->validate([
            'earnings' => 'required|array',
            'withdrawal_method' => 'required|in:paypal,credit_card',
        ]);
    
        if ($request->input('withdrawal_method') === 'paypal') {
            // PayPal withdrawal
            $earnings = Earning::whereIn('id', $request->input('earnings'))->get();
            $paypalEmail = $request->input('paypal_email');
    
            try {
                // Set up the PayPal API credentials
                $clientId = env('PAYPAL_CLIENT_ID');
                $clientSecret = env('PAYPAL_SECRET');
    
                // Set up the PayPal API context
                $apiContext = new ApiContext(
                    new OAuthTokenCredential($clientId, $clientSecret)
                );
    
                // Set the mode to 'sandbox' or 'live'
                $apiContext->setConfig([
                    'mode' => 'sandbox',
                ]);
    
                foreach ($earnings as $earning) {
                    $amount = $earning->amount;
                    $profileId = $earning->profile_id;
    
                    // Create a new payout
                    $payout = new \PayPal\Api\Payout();
    
                    // Set the sender batch header
                    $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
                    $senderBatchHeader->setSenderBatchId(uniqid())
                        ->setEmailSubject('You have a payout!');
    
                    // Create the payout item
                    $payoutItem = new \PayPal\Api\PayoutItem();
                    $payoutItem->setAmount(new \PayPal\Api\Currency([
                        'value' => $amount,
                        'currency' => 'EUR',
                    ]))
                        ->setRecipientType('EMAIL')
                        ->setReceiver($paypalEmail)
                        ->setNote('Thanks for your patronage!')
                        ->setSenderItemId(uniqid());
    
                    // Add the payout item to the payout
                    $payout->setSenderBatchHeader($senderBatchHeader);
                    $payout->addItem($payoutItem);
    
                    // Send the payout request
                    $payout->create([], $apiContext);
    
                    // Update the earnings status to 'withdrawn'
                    $earning->status = 'withdrawn';
                    $earning->save();
                }
    
                // Implement additional logic as needed
    
                return redirect()->route('earning.withdrawForm')->with('success', 'Withdrawal processed successfully.');
            } catch (\Exception $e) {
                // Handle any errors that occurred during the payout process
                return redirect()->back()->withErrors(['withdrawal_error' => $e->getMessage()]);
            }
        }elseif ($request->input('withdrawal_method') === 'credit_card') {
            $request->validate([
                'earnings' => 'required|array',
                'withdrawal_method' => 'required|in:paypal,credit_card',
            ]);
        
            // Credit card withdrawal
            $earnings = Earning::whereIn('id', $request->input('earnings'))->get();
        
            // Retrieve the authenticated user
            $user = Auth::user();

    // Set the Stripe API key
    Stripe::setApiKey(env('STRIPE_SECRET'));

    // Create the connected account for the authenticated user
    $connectedAccount = \Stripe\Account::create([
        'type' => 'express',
        'capabilities' => [
            'transfers' => ['requested' => true], // Enable transfers capability
        ],
        'business_type' => 'individual', // Set the business type to individual
    ]);

    // Associate the connected account with the authenticated user
    $user->connected_account_id = $connectedAccount->id;
    $user->save();

    // Generate the account link for the user to complete the onboarding
    $accountLink = \Stripe\AccountLink::create([
        'account' => $connectedAccount->id,
        'refresh_url' => 'https://example.com/reauth', // Replace with your refresh URL
        'return_url' => route('earning.returnURL', ['earnings' => implode(',', $request->input('earnings'))]),
        'type' => 'account_onboarding',
    ]);
    
    // Redirect the user to the account onboarding page
    return redirect()->away($accountLink->url);
}
  
}
public function returnURL(Request $request, $earnings)
{
    try {
        // Retrieve the authenticated user's connected account ID
        $connectedAccountId = Auth::user()->connected_account_id;

        // Convert $earnings to an array if it's a string
        if (!is_array($earnings)) {
            $earnings = [$earnings];
        }

        // Retrieve the complete array of earnings using the IDs
        $earnings = Earning::whereIn('id', $earnings)->get();
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Perform the bank transfer for total earnings
        $transfer = \Stripe\Transfer::create([
            'amount' => $this->calculateTotalEarnings($earnings) * 100, // Convert to cents
            'currency' => 'EUR',
            'destination' => $connectedAccountId,
        ]);
        
        if ($transfer->reversed === false) {
            // Update the status of each earning to 'withdrawn'
            foreach ($earnings as $earning) {
                $earning->status = 'withdrawn';
                $earning->save();
            }
        
            // Implement additional logic as needed
        
            return redirect()->route('earning.withdrawForm')->with('success', 'Withdrawal processed successfully.');
        } else {
            // Handle the transfer failure case
            // You can log the error message or take other actions as needed
            return redirect()->back()->withErrors(['withdrawal_error' => 'Bank transfer failed.']);
        }
    } catch (\Exception $e) {
        // Handle any errors that occurred during the bank transfer process
        return redirect()->back()->withErrors(['withdrawal_error' => $e->getMessage()]);
    }
}



private function calculateTotalEarnings($earnings)
{
    $total = 0;

    foreach ($earnings as $earning) {
        $total += $earning->amount;
    }

    return $total;
}
}