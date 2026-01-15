<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\ArtworkPhoto;
use App\Models\ArtistMusic;
use App\Models\User;
use App\Models\UserSubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller
{
    public function index(){
      
        $faqs = Faq::all();
        
        // Get artwork photos for the logged-in artist (first 6 for gallery preview)
        $artworkPhotos = [];
        $musics = [];
        $collaborations = [];
        $artistsList = [];
        
        if (Auth::check() && Auth::user()->is_artist) {
            $artworkPhotos = ArtworkPhoto::where('driver_id', Auth::id())
                ->latest('created_at')
                ->take(6)
                ->get();
            
            // Get all music tracks for collaboration management
            $musics = \App\Models\ArtistMusic::where('driver_id', Auth::id())
                ->with('collaboration')
                ->latest('created_at')
                ->get();
            
            // Get collaborations where user is involved
            $collaborations = \App\Models\TrackCollaboration::whereHas('ownershipSplits', function($query) {
                $query->where('artist_id', Auth::id());
            })
            ->orWhere('primary_artist_id', Auth::id())
            ->with(['music', 'primaryArtist', 'ownershipSplits.artist', 'revenueDistributions' => function($query) {
                $query->where('artist_id', Auth::id())->latest('period_date')->take(5);
            }])
            ->latest()
            ->get();
            
            // Get all artists for collaboration dropdown (excluding current user)
            $artistsList = \App\Models\User::where('is_artist', true)
                ->where('id', '!=', Auth::id())
                ->get(['id', 'name', 'email']);
        }
        
        // Get artist subscription plans for display
        $artist_plans = \App\Models\ArtistSubscriptionPlan::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('monthly_fee')
            ->get();
        
        // Get current user's active artist subscription
        $currentArtistSubscription = null;
        $currentArtistPlan = null;
        $hasUnlimitedUploads = false;
        $songsPerMonth = null;
        
        if (Auth::check() && Auth::user()->is_artist) {
            $currentArtistSubscription = Auth::user()->activeArtistSubscription;
            if ($currentArtistSubscription) {
                $currentArtistPlan = $currentArtistSubscription->subscriptionPlan;
                if ($currentArtistPlan) {
                    $hasUnlimitedUploads = (bool) $currentArtistPlan->is_unlimited_uploads;
                    $songsPerMonth = $currentArtistPlan->songs_per_month;
                }
            }
        }
        
        // Get dynamic earnings data for Monthly Earnings section
        $earningsData = [];
        $wallet = null;
        $paymentDetails = null;
        $payoutHistory = [];
        
        if (Auth::check() && Auth::user()->is_artist) {
            $artistId = Auth::id();
            
            // Get wallet
            $wallet = \App\Models\ArtistWallet::getOrCreateForArtist($artistId);
            
            // Get payment details
            $paymentDetails = \App\Models\ArtistPaymentDetail::where('artist_id', $artistId)
                ->where('is_primary', true)
                ->first();
            
            // Get royalty calculations for earnings data
            $royaltyCalculations = \App\Models\RoyaltyCalculation::where('artist_id', $artistId)
                ->orderBy('calculation_period', 'desc')
                ->get();
            
            // Calculate monthly earnings data
            $monthlyEarnings = [];
            foreach ($royaltyCalculations as $calc) {
                $monthKey = $calc->calculation_period->format('Y-m');
                $monthlyEarnings[$monthKey] = [
                    'period' => $calc->calculation_period,
                    'amount' => (float) $calc->artist_royalty_amount,
                    'gross' => (float) $calc->total_gross_revenue,
                    'streams' => (int) $calc->total_streams,
                ];
            }
            
            // Calculate summary statistics
            $totalRevenue = $royaltyCalculations->sum('artist_royalty_amount');
            $averageMonthly = $royaltyCalculations->count() > 0 
                ? $royaltyCalculations->avg('artist_royalty_amount') 
                : 0;
            
            $highestMonth = $royaltyCalculations->sortByDesc('artist_royalty_amount')->first();
            $highestMonthAmount = $highestMonth ? (float) $highestMonth->artist_royalty_amount : 0;
            $highestMonthName = $highestMonth ? $highestMonth->calculation_period->format('F Y') : 'N/A';
            
            // Calculate growth rate (compare last 2 periods - most recent vs previous)
            $growthRate = 0;
            $growthChange = 0;
            if ($royaltyCalculations->count() >= 2) {
                $sorted = $royaltyCalculations->sortByDesc('calculation_period')->values();
                $current = (float) $sorted[0]->artist_royalty_amount;
                $previous = (float) $sorted[1]->artist_royalty_amount;
                if ($previous > 0) {
                    $growthRate = (($current - $previous) / $previous) * 100;
                    $growthChange = $current - $previous;
                }
            }
            
            // Get last 6 months for default view
            $last6Months = collect($monthlyEarnings)->take(6)->reverse();
            
            // Get payout history
            $payoutHistory = \App\Models\PayoutRequest::where('artist_id', $artistId)
                ->whereIn('status', ['completed', 'processing'])
                ->orderBy('requested_at', 'desc')
                ->take(10)
                ->get()
                ->map(function($payout) {
                    return [
                        'date' => $payout->requested_at->format('F j, Y'),
                        'amount' => '$' . number_format($payout->requested_amount, 2),
                        'status' => ucfirst($payout->status),
                    ];
                });
            
            // Get all monthly earnings for chart (not just last 6)
            $allMonthlyEarnings = collect($monthlyEarnings)->sortBy(function($earning) {
                return $earning['period'];
            })->values();
            
            $earningsData = [
                'monthly_earnings' => $monthlyEarnings,
                'last_6_months' => $last6Months,
                'all_months' => $allMonthlyEarnings,
                'total_revenue' => $totalRevenue,
                'average_monthly' => $averageMonthly,
                'highest_month_amount' => $highestMonthAmount,
                'highest_month_name' => $highestMonthName,
                'growth_rate' => $growthRate,
                'growth_change' => $growthChange,
                'chart_data' => $allMonthlyEarnings->map(function($earning) {
                    return [
                        'month' => $earning['period']->format('M Y'),
                        'amount' => $earning['amount'],
                    ];
                })->values(),
            ];
        }
        
        return view("frontend.artist.artisit-portal", compact(
            'faqs', 
            'artworkPhotos', 
            'musics', 
            'collaborations', 
            'artistsList', 
            'artist_plans',
            'currentArtistSubscription',
            'currentArtistPlan',
            'hasUnlimitedUploads',
            'songsPerMonth',
            'earningsData',
            'wallet',
            'paymentDetails',
            'payoutHistory'
        ));
    }

    /**
     * Public artist profile page (for listeners/fans)
     *
     * ?artist={id} is used to decide which artist to show.
     * If no query is provided and the logged-in user is an artist,
     * we show their own public profile.
     */
    public function publicProfile(Request $request)
    {
        try {
            $artistId = $request->query('artist');

            if ($artistId) {
                $artist = User::where('is_artist', true)
                    ->with('profile')
                    ->findOrFail($artistId);
            } elseif (Auth::check() && Auth::user()->is_artist) {
                $artist = Auth::user()->load('profile');
            } else {
                abort(404);
            }

            $profile = $artist->profile;

            // Fetch artist songs and artworks
            $songs = ArtistMusic::where('driver_id', $artist->id)
                ->latest('created_at')
                ->get();

            $artworks = ArtworkPhoto::where('driver_id', $artist->id)
                ->latest('created_at')
                ->get();

            // Listener subscription plans (for "Subscribe" section)
            // Note: older databases may not have an `is_active` column yet, so keep this simple
            $listenerPlans = UserSubscriptionPlan::orderBy('price')->get();

            // Check if current user can tip artists (Super Listener only)
            $canTipArtist = false;
            if (Auth::check()) {
                $canTipArtist = Auth::user()->hasUserFeature('tip_artists');
            }
            
            return view('frontend.artist-profile', compact(
                'artist',
                'profile',
                'songs',
                'artworks',
                'listenerPlans',
                'canTipArtist'
            ));
        } catch (\Exception $e) {
            Log::error('Error loading public artist profile', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            abort(404);
        }
    }


}
