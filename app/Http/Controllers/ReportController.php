<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ValorantAccountOrder;
use App\Models\Report;

class ReportController extends Controller
{
    public function report(Request $request, $orderId)
    {
        $request->validate([
            'reason' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // Adjust the allowed file types and size as needed
        ]);

        // Find the order by its ID
        $order = ValorantAccountOrder::findOrFail($orderId);

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('report', 'public');
        }
        

        // Create a new report for the order
        $report = Report::create([
            'valorant_account_order_id' => $order->id,
            'reason' => $request->input('reason'),
            'attachment' => $attachmentPath ?? null, // Save the attachment path or null if no attachment is uploaded
        ]);

        // Optionally, you can add additional logic here
        // For example, sending notifications or taking specific actions based on the report.

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Order reported successfully.');
    }
    public function index()
    {
        // Retrieve all reports from the database
        $reports = Report::all();

        // Pass the reports data to the view
        return view('admin.reports', compact('reports'));
    }
}
