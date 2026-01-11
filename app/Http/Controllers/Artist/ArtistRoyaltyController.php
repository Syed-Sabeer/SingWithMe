<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\ArtistEarning;
use App\Models\PayoutRequest;
use App\Models\RoyaltyCalculation;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArtistRoyaltyController extends Controller
{
    public function index()
    {
        $artistId = Auth::id();

        // Get earnings summary
        $totalEarnings = ArtistEarning::where('artist_id', $artistId)
            ->where('status', 'processed')
            ->sum('net_amount');

        $pendingEarnings = ArtistEarning::where('artist_id', $artistId)
            ->where('status', 'pending')
            ->sum('net_amount');

        $availableBalance = $totalEarnings;

        // Get recent earnings
        $recentEarnings = ArtistEarning::where('artist_id', $artistId)
            ->latest('created_at')
            ->take(10)
            ->get();

        // Get royalty calculations
        $royaltyCalculations = RoyaltyCalculation::where('artist_id', $artistId)
            ->latest('calculation_period')
            ->take(12)
            ->get();

        // Get transaction history
        $transactions = TransactionHistory::where('artist_id', $artistId)
            ->latest('transaction_date')
            ->take(20)
            ->get();

        return view('artist.royalty.index', compact(
            'totalEarnings',
            'pendingEarnings',
            'availableBalance',
            'recentEarnings',
            'royaltyCalculations',
            'transactions'
        ));
    }

    public function earnings(Request $request)
    {
        $artistId = Auth::id();

        $query = ArtistEarning::where('artist_id', $artistId);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('period_date', [$request->start_date, $request->end_date]);
        }

        $earnings = $query->latest('period_date')->paginate(20);

        return view('artist.royalty.earnings', compact('earnings'));
    }

    public function payoutRequests()
    {
        $artistId = Auth::id();

        $requests = PayoutRequest::where('artist_id', $artistId)
            ->latest('requested_at')
            ->paginate(20);

        $availableBalance = ArtistEarning::where('artist_id', $artistId)
            ->where('status', 'processed')
            ->sum('net_amount');

        return view('artist.royalty.payout-requests', compact('requests', 'availableBalance'));
    }

    public function requestPayout(Request $request)
    {
        $artistId = Auth::id();

        $availableBalance = ArtistEarning::where('artist_id', $artistId)
            ->where('status', 'processed')
            ->sum('net_amount');

        $requestedAmount = $request->amount;

        if ($requestedAmount > $availableBalance) {
            return back()->with('error', 'Requested amount exceeds available balance.');
        }

        if ($requestedAmount < 10) {
            return back()->with('error', 'Minimum payout amount is $10.');
        }

        PayoutRequest::create([
            'artist_id' => $artistId,
            'requested_amount' => $requestedAmount,
            'available_balance' => $availableBalance,
            'currency' => $request->currency ?? 'USD',
            'payout_method' => $request->payout_method,
            'account_details' => $request->account_details,
            'artist_notes' => $request->notes,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Payout request submitted successfully.');
    }

    public function transactionHistory(Request $request)
    {
        $artistId = Auth::id();

        $query = TransactionHistory::where('artist_id', $artistId);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('transaction_date', [$request->start_date, $request->end_date]);
        }

        $transactions = $query->latest('transaction_date')->paginate(20);

        return view('artist.royalty.transactions', compact('transactions'));
    }
}
