<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SmurfAccount;
use App\Models\SmurfAccountOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;



class SmurfAccountController extends Controller
{

    public function show()
    {
        $smurfaccounts = SmurfAccount::all();

        return view('admin.smurfAccounts', compact('smurfaccounts'));
    }


    public function showOrders()
    {
        $smurforders = SmurfAccountOrder::where('payment_status', 1) ->paginate(10);

        return view('admin.smurfOrders', compact('smurforders'));
    }

    public function destroy($id)
    {
        $smurfaccount = SmurfAccount::findOrFail($id);
        $smurfaccount->delete();
    
        return redirect()->route('smurf-accounts.show')->with('success', 'Smurf Account deleted successfully');
    }

    public function showShop()
    {
        $smurfaccounts = SmurfAccount::all();
        $basicAccounts = SmurfAccount::where('type', 'Basic')->where('is_sold', 0)->get();
        $starterAccounts = SmurfAccount::where('type', 'Starter')->where('is_sold', 0)->get();
        $primeAccounts = SmurfAccount::where('type', 'Prime')->where('is_sold', 0)->get();
        $supremeAccounts = SmurfAccount::where('type', 'Supreme')->where('is_sold', 0)->get();
        $ultimateAccounts = SmurfAccount::where('type', 'Ultimate')->where('is_sold', 0)->get();


        return view('smurfaccount.smurfaccounts', compact('smurfaccounts','basicAccounts','starterAccounts', 'primeAccounts', 'supremeAccounts','ultimateAccounts'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'server' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'email_password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $smurfAccount = new SmurfAccount();
        $smurfAccount->type = $request->input('type');
        $smurfAccount->server = $request->input('server');
        $smurfAccount->username = $request->input('username');
        $smurfAccount->password = encrypt($request->input('password'));
        $smurfAccount->email = $request->input('email');
        $smurfAccount->email_password =encrypt ($request->input('email_password'));
        $smurfAccount->is_sold = false; // By default, set the account as not sold
        $smurfAccount->account_token = Str::random(10);

        $smurfAccount->save();
    
    
        return redirect()->back()->with('success', 'Smurf account added successfully.');
    }
    public function create()
{
    return view('admin.addSmurfAccount');
}


public function createSmurfOrder(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

    // Retrieve the selected server, account type, and price from the request
    $server = $request->input('server');
    $accountType = $request->input('account_type');
    $price = $request->input('price');

    // Create a new SmurfOrder instance and fill in the details
    $smurfOrder = new SmurfAccountOrder();
    $smurfOrder->server = $server;
    $smurfOrder->smurf_account_type = $accountType;
    $smurfOrder->price = $price;

    // Associate the order with the authenticated user
    $smurfOrder->user()->associate($user);

    // Save the order to the database
    $smurfOrder->save();

    // Redirect or perform any other desired action

    // For example, redirect the user to a thank you page
    return redirect()->route('smurf-account-order.show', ['id' => $smurfOrder->id]);
}
public function showSmurfAccountOrder($id)
{
    // Retrieve the RankBoost order with the given ID
    $smurfOrder = SmurfAccountOrder::find($id);

    // Check if the RankBoost order exists
    if (!$smurfOrder) {
        abort(404); // Or handle the case when the order is not found
    }

    return view('smurfaccount.smurfaccountorder', compact('smurfOrder'));
}
public function getAccountCredentials(Request $request, $id)
{
    // Validate the entered account token
    $request->validate([
        'token' => 'required|string',
    ]);

    $smurfAccount = SmurfAccount::where('account_token', $request->input('token'))
        ->first();

    if (!$smurfAccount) {
        return redirect()->back()->withErrors(['token' => 'Invalid account token.'])->withInput();
    }

    $accountCredentials = [
        'Username' => $smurfAccount->username,
        'Password' => decrypt($smurfAccount->password),
        'Email' => $smurfAccount->email,
        'Email Password' => decrypt($smurfAccount->email_password),
    ];

    return view('smurfaccount.smurfCredentials', compact('accountCredentials'));
}
public function showForm($id)
{
    $smurfOrder = SmurfAccountOrder::findOrFail($id);

    // Check if the Smurf order is paid
    if ($smurfOrder->payment_status) {
        // Check if the authenticated user ID matches the order's user ID
        if (Auth::id() === $smurfOrder->user_id) {
            // The user is authorized to access the form
            return view('smurfaccount.smurfsuccess', compact('smurfOrder'));
        }
    }

    // Redirect the user or show an error message
    return redirect()->back()->withErrors(['message' => 'You are not authorized to access this page.']);
}

}
