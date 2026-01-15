<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtistMusic;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\ISRCService;

class ArtistMusicController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'music_file' => 'required|file|max:500000',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv|max:100000',
            'thumbnail_image' => 'required|file|mimes:jpeg,jpg,png,gif|max:10240',
            'isrc_code' => 'nullable|string|max:20',
        ]);

        $data = [
            'name' => $request->input('name'),
            'driver_id' => Auth::id(),
            'listeners' => 0,
        ];

        // Handle ISRC code - simple manual entry (optional field)
        if ($request->filled('isrc_code')) {
            $isrcCode = strtoupper(trim($request->input('isrc_code')));
            // Remove any extra spaces or special characters except hyphens
            $isrcCode = preg_replace('/[^A-Z0-9\-]/', '', $isrcCode);
            
            if (!empty($isrcCode)) {
                // Optional: Check if ISRC already exists
                $existing = ArtistMusic::where('isrc_code', $isrcCode)->first();
                if ($existing && $existing->id !== null) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'This ISRC code is already assigned to another track.'
                        ], 422);
                    }
                    return redirect()->back()->withErrors(['isrc_code' => 'This ISRC code is already assigned to another track.']);
                }
                $data['isrc_code'] = $isrcCode;
            }
        }


        if ($request->hasFile('music_file')) {
            $musicFile = $request->file('music_file');
            $musicFileName = 'music_' . time() . '_' . Str::random(10) . '.' . $musicFile->getClientOriginalExtension();
            $musicPath = $musicFile->storeAs('artist_music', $musicFileName, 'public');
            $data['music_file'] = $musicPath;
        }


        if ($request->hasFile('video_file')) {
            $videoFile = $request->file('video_file');
            $videoFileName = 'video_' . time() . '_' . Str::random(10) . '.' . $videoFile->getClientOriginalExtension();
            $videoPath = $videoFile->storeAs('artist_videos', $videoFileName, 'public');
            $data['video_file'] = $videoPath;
        }


        if ($request->hasFile('thumbnail_image')) {
            $thumbnailFile = $request->file('thumbnail_image');
            $thumbnailFileName = 'thumb_' . time() . '_' . Str::random(10) . '.' . $thumbnailFile->getClientOriginalExtension();
            $thumbnailPath = $thumbnailFile->storeAs('artist_thumbnails', $thumbnailFileName, 'public');
            $data['thumbnail_image'] = $thumbnailPath;
        }


        $artistMusic = ArtistMusic::create($data);

        // Notify subscribers that this artist uploaded a new song
        try {
            $artist = Auth::user();
            if ($artist && method_exists($artist, 'followerUsers')) {
                $subscribers = $artist->followerUsers()->get();
                if ($subscribers->isNotEmpty()) {
                    $message = ($artist->name ?? $artist->username ?? 'An artist') .
                        ' uploaded a new song: ' . $artistMusic->name;
                    app('notificationService')->notifyUsers($subscribers, $message, 'New Song Uploaded', 'system');
                }
            }
        } catch (\Throwable $e) {
            // Do not break upload flow if notifications fail
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Music uploaded successfully!',
                'data' => $artistMusic
            ]);
        }

        return redirect()->back()->with('success', 'Music uploaded successfully!');
    }

    public function index()
    {
        $userMusics = ArtistMusic::where('driver_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.artist.my-music', compact('userMusics'));
    }

    public function destroy($id)
    {
        $artistMusic = ArtistMusic::where('driver_id', Auth::id())->findOrFail($id);


        if ($artistMusic->music_file && Storage::disk('public')->exists($artistMusic->music_file)) {
            Storage::disk('public')->delete($artistMusic->music_file);
        }
        if ($artistMusic->video_file && Storage::disk('public')->exists($artistMusic->video_file)) {
            Storage::disk('public')->delete($artistMusic->video_file);
        }
        if ($artistMusic->thumbnail_image && Storage::disk('public')->exists($artistMusic->thumbnail_image)) {
            Storage::disk('public')->delete($artistMusic->thumbnail_image);
        }

        $artistMusic->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Music deleted successfully!'
            ]);
        }

        return redirect()->back()->with('success', 'Music deleted successfully!');
    }
}
