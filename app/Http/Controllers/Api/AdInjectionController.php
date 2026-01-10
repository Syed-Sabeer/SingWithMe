<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AdInjectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdInjectionController extends Controller
{
    protected $adInjectionService;
    
    public function __construct(AdInjectionService $adInjectionService)
    {
        $this->adInjectionService = $adInjectionService;
    }
    
    /**
     * Get ad injection data for current user
     */
    public function getAdData(Request $request)
    {
        try {
            Log::info('AdInjectionController: getAdData called', [
                'url' => $request->url(),
                'method' => $request->method(),
                'headers' => $request->headers->all(),
                'user_agent' => $request->userAgent()
            ]);
            
            $userId = Auth::id();
            
            if (!$userId) {
                Log::warning('AdInjectionController: Unauthenticated user requesting ad data');
                // For testing purposes, use user ID 1 if not authenticated
                $userId = 1;
                Log::info('AdInjectionController: Using fallback user ID for testing', ['user_id' => $userId]);
            }
            
            Log::info('AdInjectionController: Getting ad data for user', ['user_id' => $userId]);
            
            $adData = $this->adInjectionService->getAdInjectionData($userId);
            $timing = $this->adInjectionService->getAdTiming();
            
            return response()->json([
                'success' => true,
                'data' => array_merge($adData, $timing)
            ]);
            
        } catch (\Exception $e) {
            Log::error('AdInjectionController: Error getting ad data', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error loading ad data'
            ], 500);
        }
    }
    
    /**
     * Check if user should see ads
     */
    public function shouldShowAds(Request $request)
    {
        try {
            $userId = Auth::id();
            
            if (!$userId) {
                // For testing purposes, use user ID 1 if not authenticated
                $userId = 1;
            }
            
            $shouldShowAds = $this->adInjectionService->shouldShowAds($userId);
            
            return response()->json([
                'success' => true,
                'show_ads' => $shouldShowAds
            ]);
            
        } catch (\Exception $e) {
            Log::error('AdInjectionController: Error checking ad display', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error checking ad display'
            ], 500);
        }
    }
    
    /**
     * Get random ad for injection
     */
    public function getRandomAd(Request $request)
    {
        try {
            $userId = Auth::id();
            
            if (!$userId) {
                // For testing purposes, use user ID 1 if not authenticated
                $userId = 1;
            }
            
            // Check if user should see ads
            $shouldShowAds = $this->adInjectionService->shouldShowAds($userId);
            
            if (!$shouldShowAds) {
                return response()->json([
                    'success' => true,
                    'show_ads' => false,
                    'message' => 'Premium user - no ads'
                ]);
            }
            
            $ad = $this->adInjectionService->getRandomAd();
            
            if (!$ad) {
                return response()->json([
                    'success' => true,
                    'show_ads' => false,
                    'message' => 'No ads available'
                ]);
            }
            
            return response()->json([
                'success' => true,
                'show_ads' => true,
                'ad' => [
                    'id' => $ad->id,
                    'title' => $ad->title,
                    'file_url' => $ad->file_url,
                    'link' => $ad->link,
                    'type' => $this->getAdType($ad->file)
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('AdInjectionController: Error getting random ad', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error loading ad'
            ], 500);
        }
    }
    
    /**
     * Determine ad type based on file extension
     */
    private function getAdType($file)
    {
        if (!$file) return 'unknown';
        
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        
        if (in_array($extension, ['mp4', 'avi', 'mov', 'webm', 'mkv'])) {
            return 'video';
        } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            return 'image';
        }
        
        return 'unknown';
    }
}
