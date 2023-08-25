<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RankBoost;
use App\Models\RankBoostOrder;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RankBoostOrderPaidNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RankBoostOrderInProgressNotification;
use App\Notifications\RankBoostOrderCompleteNotification;


class RankBoostController extends Controller
{
    public function index()
    {
        $rankboosts = RankBoost::all();
        return view('admin.rankboost', compact('rankboosts'));
    }

    public function orders(Request $request)
    {
        $status = $request->input('status');
        
        $rankboostorders = RankBoostOrder::where('payment_status', 1);
    
        if ($status) {
            $rankboostorders->where('status', $status);
        }
    
        $rankboostorders = $rankboostorders->orderByRaw("CASE
                            WHEN status = 'new' THEN 1
                            WHEN status = 'in progress' THEN 2
                            ELSE 3
                        END")
                        ->orderByDesc('is_priority')
                        ->paginate(10);
    
        return view('admin.rankboostorder', compact('rankboostorders'));
    }

    public function filter(Request $request)
{
    $status = $request->input('status');
    $username = $request->input('username');
    
    $rankboostorders = RankBoostOrder::where('payment_status', 1);
    
    if ($status && $status !== 'all') {
        $rankboostorders->where('status', $status);
    }
    
    if ($username) {
        $rankboostorders->where('username', 'like', '%' . $username . '%');
    }
    
    $rankboostorders = $rankboostorders->orderByRaw("CASE
                            WHEN status = 'new' THEN 1
                            WHEN status = 'inprogress' THEN 2
                            ELSE 3
                        END")
                        ->orderByDesc('is_priority')
                        ->get();
    
    $html = '';
    
    foreach ($rankboostorders as $rankboostorder) {
        $html .= '<tr class="rank-boost-row" data-status="' . $rankboostorder->status . '">';
        $html .= '<td>' . $rankboostorder->user->first_name . ' ' . $rankboostorder->user->last_name . '</td>';
        $html .= '<td>' . $rankboostorder->total_price . '</td>';
        $html .= '<td>' . $rankboostorder->special_agent . '</td>';
        $html .= '<td>' . $rankboostorder->p_with_booster . '</td>';
        $html .= '<td>' . $rankboostorder->is_priority . '</td>';
        $html .= '<td>' . $rankboostorder->current_rank . '</td>';
        $html .= '<td>' . $rankboostorder->desired_rank . '</td>';
        $html .= '<td>' . $rankboostorder->server . '</td>';
        $html .= '<td>' . $rankboostorder->current_rr . '</td>';
        $html .= '<td>' . $rankboostorder->username . '</td>';
        $html .= '<td>' . $rankboostorder->password . '</td>';
        $html .= '<td>
            <select class="form-control status-select" name="status" id="status_' . $rankboostorder->id . '" onchange="updateRankBoostOrderStatus(' . $rankboostorder->id . ')">
                <option value="new" ' . ($rankboostorder->status === 'new' ? 'selected' : '') . '>New</option>
                <option value="in progress" ' . ($rankboostorder->status === 'in progress' ? 'selected' : '') . '>In Progress</option>
                <option value="complete" ' . ($rankboostorder->status === 'complete' ? 'selected' : '') . '>Complete</option>
            </select>
        </td>';
        $html .= '</tr>';
    }
    
    return response()->json(['html' => $html]);
}
    
    public function RankBoostShow(){
        $rankboosts = RankBoost::all();
        return view('rankboost.rankboost', compact('rankboosts'));
    }
    public function updatePrice(Request $request)
    {
        $rankBoostId = $request->input('rankBoostId');
        $newPrice = $request->input('newPrice');

        // Find the rank boost by its ID
        $rankBoost = RankBoost::findOrFail($rankBoostId);

        // Update the price
        $rankBoost->price = $newPrice;
        $rankBoost->save();

        // Return a response indicating the success of the update
        return response()->json(['success' => true, 'message' => 'Price updated successfully']);
    }

    public function createRankBoostOrder(Request $request)
    {
        // Retrieve the values from the request
        $totalPrice = floatval($request->input('total_price'));
        $pWithBooster = $request->input('p_with_booster');
        $isPriority = $request->input('is_priority');
        $spAgent = $request->input('sp_agent');
        $currentRank = $request->input('current_rank');
        $desiredRank = $request->input('desired_rank');
        $userId = Auth::id(); // Get the ID of the authenticated user
        $server = $request->input('Server');
        $currentRR = $request->input('current_rr1');
    
        // Perform any necessary validation on the input values
    
        // Create a new RankBoost order
        $rankBoostOrder = new RankBoostOrder();
        $rankBoostOrder->total_price = $totalPrice;
        $rankBoostOrder->p_with_booster = $pWithBooster;
        $rankBoostOrder->is_priority = $isPriority;
        $rankBoostOrder->special_agent = $spAgent;
        $rankBoostOrder->current_rank = $currentRank;
        $rankBoostOrder->desired_rank = $desiredRank;
        $rankBoostOrder->user_id = $userId;
        $rankBoostOrder->server = $server;
        $rankBoostOrder->current_rr = $currentRR;
    
        // Save the RankBoost order
        $rankBoostOrder->save();
    
        // Redirect or return a response as needed
        return redirect()->route('rank-boost-order.show', ['id' => $rankBoostOrder->id]);
    }
    
    
    public function showRankBoostOrder($id)
    {
        // Retrieve the RankBoost order with the given ID
        $rankBoostOrder = RankBoostOrder::find($id);
    
        // Check if the RankBoost order exists
        if (!$rankBoostOrder) {
            abort(404); // Or handle the case when the order is not found
        }
    
        return view('rankboost.rankboostorder', compact('rankBoostOrder'));
    }
    public function update(Request $request, $id)
{
    // Retrieve the rank boost order based on the provided ID
    $rankBoostOrder = RankBoostOrder::findOrFail($id);

    // Update the account details
    $rankBoostOrder->username = $request->input('username');
    $rankBoostOrder->password = $request->input('password');

    // Save the changes
    $rankBoostOrder->save();
    $adminUsers = User::where('is_admin', 1)->get();
    Notification::send($adminUsers, new RankBoostOrderPaidNotification($rankBoostOrder));
    

    // Redirect or return a response as needed
    return redirect()->route('profile.show');
}

public function updateRankStatus(Request $request)
{
    $rankBoostId = $request->input('rankBoostId');
    $rankBoostOrder = RankBoostOrder::findOrFail($rankBoostId);

    $oldStatus = $rankBoostOrder->status;
    $newStatus = $request->input('status');
    
    $rankBoostOrder->update(['status' => $newStatus]);
    $rankBoostOrder->save();

    // Check if the status is changed to "In Progress"
    if ($newStatus === 'in progress' && $oldStatus == 'new') {
        // Send notification to the user via email
        $user = $rankBoostOrder->user;
        $user->notify(new RankBoostOrderInProgressNotification($rankBoostOrder));
    }
    if ($newStatus === 'complete' && $oldStatus == 'in progress') {
        // Send notification to the user via email
        $user = $rankBoostOrder->user;
        $user->notify(new RankBoostOrderCompleteNotification($rankBoostOrder));
    }

    return response()->json(['success' => true]);
}
}
