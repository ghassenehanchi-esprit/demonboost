<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WinBoost;
use App\Models\WinBoostOrder;
use Illuminate\Support\Facades\Auth;
use App\Notifications\WinBoostOrderPaidNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WinBoostOrderInProgressNotification;
use App\Notifications\WinBoostOrderCompleteNotification;

class WinBoostController extends Controller
{


    public function index()
    {
        $winboosts = WinBoost::all();
        return view('admin.winboost', compact('winboosts'));
    }
    public function WinBoostShow(){
        $winboosts = WinBoost::all();
        return view('winboost.winboost', compact('winboosts'));
    }

    public function createWinBoostOrder(Request $request)
    {
        // Retrieve the values from the form inputs
        $totalPrice = floatval($request->input('total_price'));
        $pWithBooster = $request->input('p_with_booster');
        $isPriority = $request->input('is_priority');
        $spAgent = $request->input('sp_agent');
        $selectedRank = $request->input('selected_rank');
        $userId = Auth::id(); // Get the ID of the authenticated user
        $server = $request->input('Server');
        $match_number = $request->input('match_number');

        // Perform any necessary validation on the input values

        // Create a new RankBoost order
        $winBoostOrder = new WinBoostOrder();
        $winBoostOrder->total_price = $totalPrice;
        $winBoostOrder->p_with_booster = $pWithBooster;
        $winBoostOrder->is_priority = $isPriority;
        $winBoostOrder->special_agent = $spAgent;
        $winBoostOrder->current_rank = $selectedRank;
        $winBoostOrder->user_id = $userId;
        $winBoostOrder->server = $server;
        $winBoostOrder->wins_number = $match_number;

        // Save the RankBoost order
        $winBoostOrder->save();

        // Redirect or return a response as needed
        return redirect()->route('win-boost-order.show', ['id' => $winBoostOrder->id]);


    }


    public function showWinBoostOrder($id)
    {
        // Retrieve the RankBoost order with the given ID
        $winBoostOrder = WinBoostOrder::find($id);
    
        // Check if the RankBoost order exists
        if (!$winBoostOrder) {
            abort(404); // Or handle the case when the order is not found
        }
    
        return view('winboost.winboostorder', compact('winBoostOrder'));
    }
    public function updatePrice(Request $request)
    {
        $winBoostId = $request->input('winBoostId');
        $newPrice = $request->input('newPrice');

        // Find the rank boost by its ID
        $winBoost = WinBoost::findOrFail($winBoostId);

        // Update the price
        $winBoost->price = $newPrice;
        $winBoost->save();

        // Return a response indicating the success of the update
        return response()->json(['success' => true, 'message' => 'Price updated successfully']);
    }


    public function update(Request $request, $id)
    {
        // Retrieve the rank boost order based on the provided ID
        $winBoostOrder = WinBoostOrder::find($id);
    
        // Update the account details
        $winBoostOrder->username = $request->input('username');
        $winBoostOrder->password = $request->input('password');
    
        // Save the changes
        $winBoostOrder->save();
    $adminUsers = User::where('is_admin', 1)->get();
    Notification::send($adminUsers, new WinBoostOrderPaidNotification($winBoostOrder));
        // Redirect or return a response as needed
        return redirect()->route('profile.show');
    }
    public function updateWinStatus(Request $request)
{
    $winBoostId = $request->input('winBoostId');
    $winBoostOrder = RankBoostOrder::findOrFail($winBoostId);

    $oldStatus = $winBoostOrder->status;
    $newStatus = $request->input('status');
    
    $winBoostOrder->update(['status' => $newStatus]);
    $winBoostOrder->save();

    // Check if the status is changed to "In Progress"
    if ($newStatus === 'in progress' && $oldStatus == 'new') {
        // Send notification to the user via email
        $user = $winBoostOrder->user;
        $user->notify(new WinBoostOrderInProgressNotification($winBoostOrder));
    }
    if ($newStatus === 'complete' && $oldStatus == 'in progress') {
        // Send notification to the user via email
        $user = $winBoostOrder->user;
        $user->notify(new WinBoostOrderCompleteNotification($winBoostOrder));
    }

    return response()->json(['success' => true]);
}
public function orders(Request $request)
{
    $status = $request->input('status');
    
    $winboostorders = WinBoostOrder::where('payment_status', 1);

    if ($status) {
        $winboostorders->where('status', $status);
    }

    $winboostorders = $winboostorders->orderByRaw("CASE
                        WHEN status = 'new' THEN 1
                        WHEN status = 'in progress' THEN 2
                        ELSE 3
                    END")
                    ->orderByDesc('is_priority')
                    ->paginate(10);

    return view('admin.winboostorder', compact('winboostorders'));
}



public function filter(Request $request)
{
    $status = $request->input('status');
    $username = $request->input('username');
    
    $winboostorders = WinBoostOrder::where('payment_status', 1);
    
    if ($status && $status !== 'all') {
        $winboostorders->where('status', $status);
    }
    
    if ($username) {
        $winboostorders->where('username', 'like', '%' . $username . '%');
    }
    
    $winboostorders = $winboostorders->orderByRaw("CASE
                            WHEN status = 'new' THEN 1
                            WHEN status = 'inprogress' THEN 2
                            ELSE 3
                        END")
                        ->orderByDesc('is_priority')
                        ->get();
    
    $html = '';
    
    foreach ($winboostorders as $winboostorder) {
        $html .= '<tr class="win-boost-row" data-status="' . $winboostorder->status . '">';
        $html .= '<td>' . $winboostorder->user->first_name . ' ' . $winboostorder->user->last_name . '</td>';
        $html .= '<td>' . $winboostorder->total_price . '</td>';
        $html .= '<td>' . $winboostorder->special_agent . '</td>';
        $html .= '<td>' . $winboostorder->p_with_booster . '</td>';
        $html .= '<td>' . $winboostorder->is_priority . '</td>';
        $html .= '<td>' . $winboostorder->current_rank . '</td>';
        $html .= '<td>' . $winboostorder->wins_number . '</td>';
        $html .= '<td>' . $winboostorder->server . '</td>';
        $html .= '<td>' . $winboostorder->username . '</td>';
        $html .= '<td>' . $winboostorder->password . '</td>';
        $html .= '<td>
            <select class="form-control status-select" name="status" id="status_' . $winboostorder->id . '" onchange="updateWinBoostOrderStatus(' . $winboostorder->id . ')">
                <option value="new" ' . ($winboostorder->status === 'new' ? 'selected' : '') . '>New</option>
                <option value="in progress" ' . ($winboostorder->status === 'in progress' ? 'selected' : '') . '>In Progress</option>
                <option value="complete" ' . ($winboostorder->status === 'complete' ? 'selected' : '') . '>Complete</option>
            </select>
        </td>';
        $html .= '</tr>';
    }
}

}
