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
            'songsPerMonth'
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

            return view('frontend.artist-profile', compact(
                'artist',
                'profile',
                'songs',
                'artworks',
                'listenerPlans'
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
