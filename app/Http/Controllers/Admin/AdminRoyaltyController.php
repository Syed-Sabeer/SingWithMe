<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutRequest;
use App\Models\RoyaltyCalculation;
use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoyaltyController extends Controller
{
    public function index(Request $request)
    {
        $query = RoyaltyCalculation::with('artist');

        // Filter by artist
        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('calculation_period', [$request->start_date, $request->end_date]);
        }

        $calculations = $query->latest('calculation_period')->paginate(20);
        $artists = User::where('is_artist', true)->get();

        // Summary statistics
        $totalRevenue = RoyaltyCalculation::sum('total_gross_revenue');
        $totalPlatformFee = RoyaltyCalculation::sum('platform_fee_amount');
        $totalArtistPayments = RoyaltyCalculation::sum('artist_royalty_amount');
        $pendingPayments = RoyaltyCalculation::where('status', 'pending')->sum('artist_royalty_amount');

        return view('admin.royalty.index', compact(
            'calculations',
            'artists',
            'totalRevenue',
            'totalPlatformFee',
            'totalArtistPayments',
            'pendingPayments'
        ));
    }

    public function payoutRequests(Request $request)
    {
        $query = PayoutRequest::with(['artist', 'approver', 'rejector']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by artist
        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        $requests = $query->latest('requested_at')->paginate(20);
        $artists = User::where('is_artist', true)->get();

        return view('admin.royalty.payout-requests', compact('requests', 'artists'));
    }

    public function approvePayout($id, Request $request)
    {
        $payoutRequest = PayoutRequest::findOrFail($id);

        if ($payoutRequest->status !== 'pending') {
            return back()->with('error', 'Payout request cannot be approved.');
        }

        $payoutRequest->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'admin_notes' => $request->admin_notes,
            'processed_at' => now(),
        ]);

        return back()->with('success', 'Payout request approved successfully.');
    }

    public function rejectPayout($id, Request $request)
    {
        $payoutRequest = PayoutRequest::findOrFail($id);

        $payoutRequest->update([
            'status' => 'rejected',
            'rejected_by' => auth()->id(),
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Payout request rejected.');
    }

    public function generateReport(Request $request)
    {
        $query = RoyaltyCalculation::with('artist');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('calculation_period', [$request->start_date, $request->end_date]);
        }

        $data = $query->get();

        // Generate report (CSV/PDF)
        return response()->json(['message' => 'Report generation to be implemented']);
    }
}
