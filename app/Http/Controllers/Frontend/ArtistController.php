<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\ArtworkPhoto;
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
        
        if (Auth::check() && Auth::user()->is_artist) {
            $artworkPhotos = ArtworkPhoto::where('driver_id', Auth::id())
                ->latest('created_at')
                ->take(6)
                ->get();
            
            // Get all music tracks for collaboration management
            $musics = \App\Models\ArtistMusic::where('driver_id', Auth::id())
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
        }
        
        return view("frontend.artist.artisit-portal", compact('faqs', 'artworkPhotos', 'musics', 'collaborations'));
    }
  

}
