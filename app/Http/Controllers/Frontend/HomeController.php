<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\AboutSection;
use App\Models\HomeHeroSection;
use App\Models\Blog;
use App\Models\LiveVideo;
use App\Models\User;
use App\Models\ArtworkPhoto;

class HomeController extends Controller
{




public function index()
{

        $about_details = AboutSection::first();
        $hero_details = HomeHeroSection::first();
        $live_videos = LiveVideo::where('visibility', 1)->latest()->take(10)->get();
        $blogs = Blog::where('visibility', 1)->latest()->get();
        $recent_artists = User::where('is_artist', true)
            ->latest()
            ->with('profile')
            ->take(8)
            ->get();
        $featured_artists = User::where('is_artist', true)
            ->where('is_featured', true)
            ->with('profile')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();
        $featured_tracks = \App\Models\ArtistMusic::with('user')
            ->where('is_featured', true)
            ->orderByDesc('created_at')
            ->take(6)
            ->get();
        $latest_artworks = ArtworkPhoto::with('user')
            ->latest('created_at')
            ->take(3)
            ->get();

        return view('frontend.index',compact(
            'about_details',
            'hero_details',
            'blogs',
            'live_videos',
            'recent_artists',
            'featured_artists',
            'featured_tracks',
            'latest_artworks'
        ));
}

    public function contactStore(Request $request){

    try {
            $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'phone' => 'nullable|string|max:255',
                'message' => 'required|string',

            ]);

            $validatedData = $request->only(['firstname', 'lastname', 'email','phone','message']);

            Log::info('Validated Contact data:', $validatedData);

            $contact = Contact::create([
                'firstname' => $validatedData['firstname'],
                'lastname' => $validatedData['lastname'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'message' => $validatedData['message'],
            ]);

            Log::info('Contact created successfully:', ['id' => $contact->id]);

            return redirect()->route('home')->with('success', 'Contact Details Successfully');
        } catch (\Exception $e) {
            Log::error('Error while creating Contact:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }


}
