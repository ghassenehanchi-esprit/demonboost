<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\RankBoostOrder;
use App\Models\WinBoostOrder;
use App\Models\PlacementBoostOrder;
use App\Models\SmurfAccountOrder;
use App\Models\SmurfAccount;
use App\Models\ValorantAccount;
use App\Models\User;
use Stripe\Checkout\Session;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use App\Notifications\SmurfAccountTokenNotification;
use App\Notifications\AccountTokenNotification;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use App\Notifications\SmurfAccountPaidNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\ValorantAccountOrder;
use Illuminate\Support\Str;
use Stripe\Refund;
use PayPal\v2\Payments\CapturesRefundRequest;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentIntent;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;








class PaymentController extends Controller
{
  

    public function processPayment(Request $request)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $token = $request->stripeToken;

    try {
        // Retrieve the RankBoost order details
        $rankBoostOrder = RankBoostOrder::find($id);

        // Create a charge with the order details
        $charge = Charge::create([
            'amount' => $rankBoostOrder->total_price * 100, // Amount in cents
            'currency' => 'eur',
            'source' => $token,
            'description' => 'Server: ' . $rankBoostOrder->server . ', Current Rank: ' . $rankBoostOrder->current_rank . ', Desired Rank: ' . $rankBoostOrder->desired_rank,
        ]);

        // Update the status of the RankBoost order or perform any other necessary actions

        return redirect()->route('payment.success');
    } catch (\Exception $e) {
        return redirect()->route('home')->with('error', $e->getMessage());
    }
}

public function showPayment($id)
{
    // Retrieve the RankBoostOrder based on the provided ID
    $rankBoostOrder = RankBoostOrder::findOrFail($id);

    // Set your Stripe API key
    Stripe::setApiKey(env('STRIPE_SECRET'));

    // Create a new Checkout Session
    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $rankBoostOrder->total_price * 100, // Convert to cents
                    'product_data' => [
                        'name' => 'Rank Boost Order',
                        'description' => 'Server: ' . $rankBoostOrder->server . ', Current Rank: ' . $rankBoostOrder->current_rank . ', Desired Rank: ' . $rankBoostOrder->desired_rank,
                    ],
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => route('update.Rankpaymentstatus', ['id' => $rankBoostOrder->id]), // Update with your success URL
        'cancel_url' => route('rank-boost-order.show', ['id' => $rankBoostOrder->id]),
    ]);

    // Retrieve the session ID
    $sessionId = $session->id;

    // Redirect the user to the Checkout page
    return redirect()->away($session->url);
}

public function showRankPaypalPayment($id)
{
    // Retrieve the RankBoostOrder based on the provided ID
    $rankBoostOrder = RankBoostOrder::findOrFail($id);

    // Set your PayPal API credentials
    $clientId = env('PAYPAL_CLIENT_ID');
    $clientSecret = env('PAYPAL_SECRET');

    // Set up the PayPal API environment
    $environment = new SandboxEnvironment($clientId, $clientSecret);
    $client = new PayPalHttpClient($environment);

    // Create a new PayPal order request
    $request = new OrdersCreateRequest();
    $request->prefer('return=representation');
    $request->body = [
        'intent' => 'CAPTURE',
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => $rankBoostOrder->total_price,
                ],
                'description' => 'Rank Boost Order',
            ],
        ],
        'application_context' => [
            'return_url' => route('update.Rankpaymentstatus', ['id' => $rankBoostOrder->id]),  // Update with your success URL
            'cancel_url' => route('rank-boost-order.show', ['id' => $rankBoostOrder->id]),
        ],
    ];

    try {
        // Create the PayPal order
        $response = $client->execute($request);

        // Retrieve the approval URL from the response
        $approvalUrl = null;
        foreach ($response->result->links as $link) {
            if ($link->rel === 'approve') {
                $approvalUrl = $link->href;
                break;
            }
        }

        if ($approvalUrl) {
            // Redirect the user to the PayPal approval URL
            return redirect()->away($approvalUrl);
        } else {
            return response()->json(['error' => 'Failed to retrieve PayPal approval URL.'], 500);
        }
    } catch (\Exception $e) {
        // Handle any errors that occurred during the order creation
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function showPlacementPaypalPayment($id)
{
    $placementBoostOrder = PlacementBoostOrder::findOrFail($id);

    // Set your PayPal API credentials
    $clientId = env('PAYPAL_CLIENT_ID');
    $clientSecret = env('PAYPAL_SECRET');

    // Set up the PayPal API environment
    $environment = new SandboxEnvironment($clientId, $clientSecret);
    $client = new PayPalHttpClient($environment);

    // Create a new PayPal order request
    $request = new OrdersCreateRequest();
    $request->prefer('return=representation');
    $request->body = [
        'intent' => 'CAPTURE',
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => $placementBoostOrder->total_price,
                ],
                'description' => 'Rank Boost Order',
            ],
        ],
        'application_context' => [
            'return_url' => route('update.Placementpaymentstatus', ['id' => $placementBoostOrder->id]), // Update with your success URL
            'cancel_url' => route('placement-boost-order.show', ['id' => $placementBoostOrder->id]),
        ],
    ];

    try {
        // Create the PayPal order
        $response = $client->execute($request);

        // Retrieve the approval URL from the response
        $approvalUrl = null;
        foreach ($response->result->links as $link) {
            if ($link->rel === 'approve') {
                $approvalUrl = $link->href;
                break;
            }
        }

        if ($approvalUrl) {
            // Redirect the user to the PayPal approval URL
            return redirect()->away($approvalUrl);
        } else {
            return response()->json(['error' => 'Failed to retrieve PayPal approval URL.'], 500);
        }
    } catch (\Exception $e) {
        // Handle any errors that occurred during the order creation
        return response()->json(['error' => $e->getMessage()], 500);
    }
}




public function showPlacementPayment($id)
{
    // Retrieve the RankBoostOrder based on the provided ID
    $placementBoostOrder = PlacementBoostOrder::findOrFail($id);

    // Set your Stripe API key
    Stripe::setApiKey(env('STRIPE_SECRET'));

    // Create a new Checkout Session
    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $placementBoostOrder->total_price * 100, // Convert to cents
                    'product_data' => [
                        'name' => 'Placement Boost Order',
                        'description' => 'Server: ' . $placementBoostOrder->server . ', Previous Rank: ' . $placementBoostOrder->previous_rank . ', Wins: ' . $placementBoostOrder->wins_number,
                    ],
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => route('update.Placementpaymentstatus', ['id' => $placementBoostOrder->id]), // Update with your success URL
        'cancel_url' => route('placement-boost-order.show', ['id' => $placementBoostOrder->id]),
    ]);

    // Retrieve the session ID
    $sessionId = $session->id;

    // Redirect the user to the Checkout page
    return redirect()->away($session->url);
}




public function showWinPayment($id)
{
    // Retrieve the RankBoostOrder based on the provided ID
    $winBoostOrder = WinBoostOrder::findOrFail($id);

    // Set your Stripe API key
    Stripe::setApiKey(env('STRIPE_SECRET'));

    // Create a new Checkout Session
    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $winBoostOrder->total_price * 100, // Convert to cents
                    'product_data' => [
                        'name' => 'Win Boost Order',
                        'description' => 'Server: ' . $winBoostOrder->server . ', Current Rank: ' . $winBoostOrder->current_rank . ', Wins: ' . $winBoostOrder->wins_number,
                    ],
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => route('update.paymentstatus', ['id' => $winBoostOrder->id]), // Update with your success URL
        'cancel_url' => route('placement-boost-order.show', ['id' => $winBoostOrder->id]),
    ]);

    // Retrieve the session ID
    $sessionId = $session->id;

    // Redirect the user to the Checkout page
    return redirect()->away($session->url);
}
public function showSmurfPayment($id)
{
    // Retrieve the RankBoostOrder based on the provided ID
    $smurfOrder = SmurfAccountOrder::findOrFail($id);

    // Set your Stripe API key
    Stripe::setApiKey(env('STRIPE_SECRET'));

    // Create a new Checkout Session
    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $smurfOrder->price * 100, // Convert to cents
                    'product_data' => [
                        'name' => 'Win Boost Order',
                        'description' => 'Server: ' . $smurfOrder->server . ', Account type: ' . $smurfOrder->smurf_account_type ,
                    ],
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => route('update.Smurfpaymentstatus', ['id' => $smurfOrder->id]), // Update with your success URL
        'cancel_url' => route('placement-boost-order.show', ['id' => $smurfOrder->id]),
    ]);

    // Retrieve the session ID
    $sessionId = $session->id;

    // Redirect the user to the Checkout page
    return redirect()->away($session->url);
}

public function showAccountPayment($id)
{
    // Retrieve the ValorantAccount based on the provided ID
    $account = ValorantAccount::findOrFail($id);

    // Set your Stripe API key
    Stripe::setApiKey(env('STRIPE_SECRET'));

    // Create a new Checkout Session
    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $account->price * 100, // Convert to cents
                    'product_data' => [
                        'name' => 'Win Boost Order',
                        'description' => 'Server: ' . $account->server . ', Rank: ' . $account->rank,
                    ],
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => route('payment.account.success', ['id' => $account->id]), // Update with your success URL
        'cancel_url' => route('placement-boost-order.show', ['id' => $account->id]),
    ]);

    // Retrieve the payment intent ID from the Checkout Session
    $paymentIntentId = $session->id;
    
    // Store the payment intent ID in the session
    session(['payment_token' => $paymentIntentId]);
    session(['payment_method' => 'Stripe']);

    // Redirect the user to the Checkout page
    return redirect()->away($session->url);
}




public function showWinPaypalPayment($id)
{
    $winBoostOrder = WinBoostOrder::findOrFail($id);

    // Set your PayPal API credentials
    $clientId = env('PAYPAL_CLIENT_ID');
    $clientSecret = env('PAYPAL_SECRET');

    // Set up the PayPal API environment
    $environment = new SandboxEnvironment($clientId, $clientSecret);
    $client = new PayPalHttpClient($environment);

    // Create a new PayPal order request
    $request = new OrdersCreateRequest();
    $request->prefer('return=representation');
    $request->body = [
        'intent' => 'CAPTURE',
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => $winBoostOrder->total_price,
                ],
                'description' => 'Rank Boost Order',
            ],
        ],
        'application_context' => [
            'return_url' => route('update.paymentstatus', ['id' => $winBoostOrder->id]), // Update with your success URL
            'cancel_url' => route('win-boost-order.show', ['id' => $winBoostOrder->id]),
        ],
    ];

    try {
        // Create the PayPal order
        $response = $client->execute($request);

        // Retrieve the approval URL from the response
        $approvalUrl = null;
        foreach ($response->result->links as $link) {
            if ($link->rel === 'approve') {
                $approvalUrl = $link->href;
                break;
            }
        }

        if ($approvalUrl) {
            // Redirect the user to the PayPal approval URL
            return redirect()->away($approvalUrl);
        } else {
            return response()->json(['error' => 'Failed to retrieve PayPal approval URL.'], 500);
        }
    } catch (\Exception $e) {
        // Handle any errors that occurred during the order creation
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function showAccountPaypalPayment($id)
{
    $account = ValorantAccount::findOrFail($id);

    // Set your PayPal API credentials
    $clientId = env('PAYPAL_CLIENT_ID');
    $clientSecret = env('PAYPAL_SECRET');
    $paymentMethod='Paypal';
    // Set up the PayPal API environment
    $environment = new SandboxEnvironment($clientId, $clientSecret);
    $client = new PayPalHttpClient($environment);

    // Create a new PayPal order request
    $request = new OrdersCreateRequest();
    $request->prefer('return=representation');
    $request->body = [
        'intent' => 'CAPTURE',
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => $account->price,
                ],
                'description' => 'Rank Boost Order',
            ],
        ],
        'application_context' => [
            'return_url' => route('payment.account.success', ['id' => $account->id]), // Update with your success URL
            'cancel_url' => route('win-boost-order.show', ['id' => $account->id]),
        ],
    ];

    try {
        // Create the PayPal order
        $response = $client->execute($request);

        // Retrieve the approval URL from the response
        $approvalUrl = null;
        foreach ($response->result->links as $link) {
            if ($link->rel === 'approve') {
                $approvalUrl = $link->href;
                break;
            }
        }

        if ($approvalUrl) {
            session(['payment_token' => $response->result->id]);
            session(['payment_method' =>   $paymentMethod]);

            // Redirect the user to the PayPal approval URL
            return redirect()->away($approvalUrl);
        } else {
            return response()->json(['error' => 'Failed to retrieve PayPal approval URL.'], 500);
        }
    } catch (\Exception $e) {
        // Handle any errors that occurred during the order creation
        return response()->json(['error' => $e->getMessage()], 500);
    }
}








public function showSmurfPaypalPayment($id)
{
    $smurfOrder = SmurfAccountOrder::findOrFail($id);

    // Set your PayPal API credentials
    $clientId = env('PAYPAL_CLIENT_ID');
    $clientSecret = env('PAYPAL_SECRET');

    // Set up the PayPal API environment
    $environment = new SandboxEnvironment($clientId, $clientSecret);
    $client = new PayPalHttpClient($environment);

    // Create a new PayPal order request
    $request = new OrdersCreateRequest();
    $request->prefer('return=representation');
    $request->body = [
        'intent' => 'CAPTURE',
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => $smurfOrder->price,
                ],
                'description' => 'Rank Boost Order',
            ],
        ],
        'application_context' => [
            'return_url' => route('update.Smurfpaymentstatus', ['id' => $smurfOrder->id]), // Update with your success URL
            'cancel_url' => route('win-boost-order.show', ['id' => $smurfOrder->id]),
        ],
    ];

    try {
        // Create the PayPal order
        $response = $client->execute($request);

        // Retrieve the approval URL from the response
        $approvalUrl = null;
        foreach ($response->result->links as $link) {
            if ($link->rel === 'approve') {
                $approvalUrl = $link->href;
                break;
            }
        }

        if ($approvalUrl) {
            // Redirect the user to the PayPal approval URL
            return redirect()->away($approvalUrl);
        } else {
            return response()->json(['error' => 'Failed to retrieve PayPal approval URL.'], 500);
        }
    } catch (\Exception $e) {
        // Handle any errors that occurred during the order creation
        return response()->json(['error' => $e->getMessage()], 500);
    }
}




    public function paymentSuccess($id)
    {   
        $rankBoostOrder = RankBoostOrder::findOrFail($id);
        
        return view('rankboost.rankboostsuccess', ['rankBoostOrder' => $rankBoostOrder]);
    }
    
    public function paymentPlacementSuccess($id)
    {   
        $placementBoostOrder = PlacementBoostOrder::findOrFail($id);
       
        return view('placementboost.placementboostsuccess', ['placementBoostOrder' => $placementBoostOrder]);
    }


    public function paymentCancel()
    {
        return view('payment-cancel');
    }
    public function updateWinBoostPaymentStatus($id)
    {
        $winBoostOrder = WinBoostOrder::findOrFail($id);
        $winBoostOrder->payment_status = true;
        $winBoostOrder->save();
        
        return redirect()->route('process.winpayment',['id' => $winBoostOrder->id]);
    }
    public function updatePlacementBoostPaymentStatus($id)
    {
        $placementBoostOrder = PlacementBoostOrder::findOrFail($id);
        $placementBoostOrder->payment_status = true;
        $placementBoostOrder->save();
        
        return redirect()->route('process.placementpayment',['id' => $placementBoostOrder->id]);
    }
    public function updateRankBoostPaymentStatus($id)
    {
        $rankBoostOrder = RankBoostOrder::findOrFail($id);
        $rankBoostOrder->payment_status = true;
        $rankBoostOrder->save();
     
        
        return redirect()->route('process.payment',['id' => $rankBoostOrder->id]);
    }
    public function updateSmurfPaymentStatus($id)
    {
        $smurfOrder = SmurfAccountOrder::findOrFail($id);
        $smurfOrder->payment_status = true;
        $smurfOrder->save();
    
        // Find a matching SmurfAccount based on server, account_type, and is_sold status
        $smurfAccount = SmurfAccount::where('server', $smurfOrder->server)
            ->where('type', $smurfOrder->smurf_account_type)
            ->where('is_sold', 0)
            ->first();
    
        if ($smurfAccount) {
            // Store the account_token of the found SmurfAccount in the SmurfOrder
            $smurfOrder->smurf_account_token = $smurfAccount->account_token;
            $smurfOrder->save();
            $smurfAccount->is_sold=true;
            $smurfAccount->save();
           
        }
        $user = $smurfOrder->user;
        $user->notify(new SmurfAccountTokenNotification($smurfOrder));
        $adminUsers = User::where('is_admin', 1)->get();
    Notification::send($adminUsers, new SmurfAccountPaidNotification($smurfOrder));
        return redirect()->route('smurfOrder.Account', ['id' => $smurfOrder->id]);
    }
    
    public function paymentWinSuccess($id)
    {
        $winBoostOrder = WinBoostOrder::findOrFail($id);
        return view('winboost.winboostsuccess', ['winBoostOrder' => $winBoostOrder]);
    }
    public function paymentAccountSuccess($id)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Find the ValorantAccount based on the provided ID
        $account = ValorantAccount::findOrFail($id);

        $paymentMethod =session('payment_method');
if ($paymentMethod === 'Stripe') {
        $session_id=session('payment_token');
        $session = Session::retrieve($session_id);

        // Get the payment intent ID from the Checkout Session
        $paymentToken = $session->payment_intent;
}
else{
    $paymentToken = session('payment_token');
}
        
        // Generate a random token for the account
        $accountToken = Str::random(16); // Adjust the length of the token as needed
    
        // Create a new ValorantAccountOrder
        $order = ValorantAccountOrder::create([
            'user_id' => auth()->id(),
            'valorant_account_id' => $account->id,
            'account_token' => $accountToken,
            'payment_token' => $paymentToken, // Store the payment token in your order
            'payment_method'=> $paymentMethod,
        ]);
    
        // Send notification email to the user with the account token
    
        // Update the is_sold column of the ValorantAccount to mark it as sold
        $account->is_sold = true;
        $account->save();
        $user = $order->user;
        $user->notify(new AccountTokenNotification($order));
        session()->forget('payment_token');
        session()->forget('payment_method');

        return redirect()->route('account-form.show', ['id' => $account->id]);

        // Redirect the user to the success view with the account ID
    }
    public function showForm($id){
        $account = ValorantAccount::findOrFail($id);

        return view('accountshop.accountsuccess', ['account' => $account]);
    }



    public function refundOrder($orderId)
    {
        // Find the ValorantAccountOrder based on the provided order ID
        $order = ValorantAccountOrder::findOrFail($orderId);
        $account = $order->valorantAccount;
        if ($account) {
           // $account->delete();
        }
          //  $order->delete();
        // Check the payment method (assuming you have a 'payment_method' column)
        $paymentMethod = $order->payment_method;

        if ($paymentMethod === 'Paypal') {
            // Handle PayPal refund
            $captureId = $order->payment_token; // Assuming 'payment_token' stores the capture ID
            $refundStatus = $this->refundPayPalPayment($captureId);
        } elseif ($paymentMethod === 'Stripe') {
            // Handle Stripe refund
            $paymentIntentId = $order->payment_token; // Assuming 'payment_token' stores the payment intent ID
            $refundStatus = $this->refundStripePayment($paymentIntentId);
        } else {
            // Handle other payment methods or display an error
            return response()->json(['error' => 'Unsupported payment method'], 400);
        }

        
    }








    public function refundPayPalPayment($orderId)
    {
        try {
            // Set up your PayPal API credentials
            $clientId = env('PAYPAL_CLIENT_ID');
            $clientSecret = env('PAYPAL_SECRET');
    
            // Set up the PayPal API environment
            $environment = new SandboxEnvironment($clientId, $clientSecret);
            $client = new PayPalHttpClient($environment);
    
            // Create a capture request
          //  $captureRequest = new OrdersCaptureRequest($orderId);
            //$captureRequest->prefer('return=representation');
    
            // Capture the payment
           // $captureResponse = $client->execute($captureRequest);
    
            // Check if the capture was successful
           // if ($captureResponse->statusCode == 201) {
                // Payment was successfully captured
              //  $captureId = $captureResponse->result->id;
    
                // Create a refund request using the capture ID
                $refundRequest = new CapturesRefundRequest('5DE02071459724327');
                $refundRequest->prefer('return=representation');
    
                // Perform the refund
                $refundResponse = $client->execute($refundRequest);
    
                // Check if the refund was successful
                if ($refundResponse->statusCode == 201) {
                    return response()->json(['message' => 'Capture and refund successful', 'capture_id' => $captureId]);
                } else {
                    // Handle refund failure
                    return response()->json(['error' => 'Refund failed.'], 500);
                }
           // } else {
                // Handle capture failure
              //  return response()->json(['error' => 'Payment capture failed.'], 500);
           // }
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    

    public function refundStripePayment($paymentIntentId)
    {
        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        try {
            // Retrieve the charge ID associated with the payment intent
           // $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
           // $stripeChargeId = $paymentIntent->charges->data[0]->id;
    
            // Create a refund for the charge
            $refund = Refund::create([
                'payment_intent' => $paymentIntentId,
               
               
            ]);
    
           // $balanceTransaction = \Stripe\BalanceTransaction::retrieve($refund->balance_transaction);
    
            // Handle successful refund
            return response()->json(['message' => 'Refund successful']);
        } catch (\Exception $e) {
            Log::error('Refund error: ' . $e->getMessage());
        
            // Handle refund error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

}
