<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlacementBoost;
use App\Models\PlacementBoostOrder;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PlacementBoostOrderPaidNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PlacementBoostOrderInProgressNotification;
use App\Notifications\PlacementBoostOrderCompleteNotification;



class PlacementBoostController extends Controller
{
    public function index(){
        $placementboosts = PlacementBoost::all();
        return view('admin.placementboost', compact('placementboosts'));
    }
    public function PlacementBoostShow(){
        $placementboosts = PlacementBoost::all();
        return view('placementboost.placementboost', compact('placementboosts'));
    }

    
    



    public function filter(Request $request)
{
    $status = $request->input('status');
    $username = $request->input('username');
    
    $placementboostorders = PlacementBoostOrder::where('payment_status', 1);
    
    if ($status && $status !== 'all') {
        $placementboostorders->where('status', $status);
    }
    
    if ($username) {
        $placementboostorders->where('username', 'like', '%' . $username . '%');
    }
    
    $placementboostorders = $placementboostorders->orderByRaw("CASE
                            WHEN status = 'new' THEN 1
                            WHEN status = 'inprogress' THEN 2
                            ELSE 3
                        END")
                        ->orderByDesc('is_priority')
                        ->get();
    
    $html = '';
    
    foreach ($placementboostorders as $placementboostorder) {
        $html .= '<tr class="rank-boost-row" data-status="' . $placementboostorder->status . '">';
        $html .= '<td>' . $placementboostorder->user->first_name . ' ' . $placementboostorder->user->last_name . '</td>';
        $html .= '<td>' . $placementboostorder->total_price . '</td>';
        $html .= '<td>' . $placementboostorder->special_agent . '</td>';
        $html .= '<td>' . $placementboostorder->p_with_booster . '</td>';
        $html .= '<td>' . $placementboostorder->is_priority . '</td>';
        $html .= '<td>' . $placementboostorder->previous_rank . '</td>';
        $html .= '<td>' . $placementboostorder->wins_number . '</td>';
        $html .= '<td>' . $placementboostorder->server . '</td>';
        $html .= '<td>' . $placementboostorder->username . '</td>';
        $html .= '<td>' . $placementboostorder->password . '</td>';
        $html .= '<td>
            <select class="form-control status-select" name="status" id="status_' . $placementboostorder->id . '" onchange="updatePlacementBoostOrderStatus(' . $placementboostorder->id . ')">
                <option value="new" ' . ($placementboostorder->status === 'new' ? 'selected' : '') . '>New</option>
                <option value="in progress" ' . ($placementboostorder->status === 'in progress' ? 'selected' : '') . '>In Progress</option>
                <option value="complete" ' . ($placementboostorder->status === 'complete' ? 'selected' : '') . '>Complete</option>
            </select>
        </td>';
        $html .= '</tr>';
    }
    
    return response()->json(['html' => $html]);
}

public function orders(Request $request)
{
    $status = $request->input('status');
    
    $placementboostorders = PlacementBoostOrder::where('payment_status', 1);

    if ($status) {
        $placementboostorders->where('status', $status);
    }

    $placementboostorders = $placementboostorders->orderByRaw("CASE
                        WHEN status = 'new' THEN 1
                        WHEN status = 'in progress' THEN 2
                        ELSE 3
                    END")
                    ->orderByDesc('is_priority')
                    ->paginate(5);

    return view('admin.placementboostorder', compact('placementboostorders'));
}






    public function updatePrice(Request $request)
    {
        $placementBoostId = $request->input('placementBoostId');
        $newPrice = $request->input('newPrice');

        // Find the rank boost by its ID
        $placementBoost = PlacementBoost::findOrFail($placementBoostId);

        // Update the price
        $placementBoost->price = $newPrice;
        $placementBoost->save();

        // Return a response indicating the success of the update
        return response()->json(['success' => true, 'message' => 'Price updated successfully']);
    }

    public function createPlacementBoostOrder(Request $request)
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
        $placementBoostOrder = new PlacementBoostOrder();
        $placementBoostOrder->total_price = $totalPrice;
        $placementBoostOrder->p_with_booster = $pWithBooster;
        $placementBoostOrder->is_priority = $isPriority;
        $placementBoostOrder->special_agent = $spAgent;
        $placementBoostOrder->previous_rank = $selectedRank;
        $placementBoostOrder->user_id = $userId;
        $placementBoostOrder->server = $server;
        $placementBoostOrder->wins_number = $match_number;

        // Save the RankBoost order
        $placementBoostOrder->save();

        // Redirect or return a response as needed
        return redirect()->route('placement-boost-order.show', ['id' => $placementBoostOrder->id]);


    }

    public function showPlacementBoostOrder($id)
    {
        // Retrieve the RankBoost order with the given ID
        $placementBoostOrder = PlacementBoostOrder::find($id);
    
        // Check if the RankBoost order exists
        if (!$placementBoostOrder) {
            abort(404); // Or handle the case when the order is not found
        }
    
        return view('placementboost.placementboostorder', compact('placementBoostOrder'));
    }
    public function update(Request $request, $id)
{
    // Retrieve the rank boost order based on the provided ID
    $placementBoostOrder = PlacementBoostOrder::find($id);

    // Update the account details
    $placementBoostOrder->username = $request->input('username');
    $placementBoostOrder->password = $request->input('password');

    // Save the changes
    $placementBoostOrder->save();
    $adminUsers = User::where('is_admin', 1)->get();
    Notification::send($adminUsers, new PlacementBoostOrderPaidNotification($placementBoostOrder));
    // Redirect or return a response as needed
    return redirect()->route('profile.show');
}
public function updatePlacementStatus(Request $request)
{
    $placementBoostId = $request->input('placementBoostId');
    $placementBoostOrder = PlacementBoostOrder::findOrFail($placementBoostId);
    
    $oldStatus = $placementBoostOrder->status;
    $newStatus = $request->input('status');


    $placementBoostOrder->update(['status' => $newStatus]);
    $placementBoostOrder->save();
    // You can also dispatch a notification here if needed
    if ($newStatus === 'in progress' && $oldStatus == 'new') {
        // Send notification to the user via email
        $user = $placementBoostOrder->user;
        $user->notify(new PlacementBoostOrderInProgressNotification($placementBoostOrder));
    }
    if ($newStatus === 'complete' && $oldStatus == 'in progress') {
        // Send notification to the user via email
        $user = $placementBoostOrder->user;
        $user->notify(new PlacementBoostOrderCompleteNotification($placementBoostOrder));
    }

    return response()->json(['success' => true]);
}

}
