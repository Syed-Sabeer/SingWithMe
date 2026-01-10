<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\UserSubscription;
use App\Models\UserSubscriptionPlan;
use Illuminate\Support\Facades\Log;

class AdInjectionService
{
    /**
     * Check if user should see ads based on their subscription
     */
    public function shouldShowAds($userId)
    {
        try {
            // Get user's active subscription
            $activeSubscription = $this->getActiveSubscription($userId);
            
            if (!$activeSubscription) {
                // No active subscription = free user = show ads
                Log::info('AdInjectionService: User has no active subscription, showing ads', ['user_id' => $userId]);
                return true;
            }
            
            // Get subscription plan details
            $plan = UserSubscriptionPlan::find($activeSubscription->usersubscription_id);
            
            if (!$plan) {
                Log::warning('AdInjectionService: Subscription plan not found', [
                    'user_id' => $userId,
                    'subscription_id' => $activeSubscription->usersubscription_id
                ]);
                return true; // Default to showing ads if plan not found
            }
            
            // Check if this is a free plan (price = 0) or if ads are enabled
            $isFreePlan = $plan->price == 0;
            $hasAdsEnabled = $plan->is_ads == 0; // 0 = show ads, 1 = no ads
            
            // Show ads if it's a free plan OR if ads are explicitly enabled
            $showAds = $isFreePlan || $hasAdsEnabled;
            
            Log::info('AdInjectionService: Subscription plan ad setting', [
                'user_id' => $userId,
                'plan_id' => $plan->id,
                'plan_name' => $plan->title,
                'price' => $plan->price,
                'is_free_plan' => $isFreePlan,
                'is_ads' => $plan->is_ads,
                'has_ads_enabled' => $hasAdsEnabled,
                'show_ads' => $showAds
            ]);
            
            return $showAds;
            
        } catch (\Exception $e) {
            Log::error('AdInjectionService: Error checking ad display', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            return true; // Default to showing ads on error
        }
    }
    
    /**
     * Get a random ad for injection
     */
    public function getRandomAd()
    {
        try {
            $ad = Ad::visible()
                ->inRandomOrder()
                ->first();
                
            if (!$ad) {
                Log::warning('AdInjectionService: No visible ads found');
                return null;
            }
            
            Log::info('AdInjectionService: Selected random ad', [
                'ad_id' => $ad->id,
                'title' => $ad->title,
                'file' => $ad->file
            ]);
            
            return $ad;
            
        } catch (\Exception $e) {
            Log::error('AdInjectionService: Error getting random ad', [
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
    
    /**
     * Get user's active subscription
     */
    private function getActiveSubscription($userId)
    {
        try {
            $subscription = UserSubscription::where('user_id', $userId)
                ->where('usersubscription_date', '<=', now())
                ->whereRaw('DATE_ADD(usersubscription_date, INTERVAL usersubscription_duration DAY) >= ?', [now()])
                ->orderBy('created_at', 'desc')
                ->first();
                
            if ($subscription) {
                Log::info('AdInjectionService: Found active subscription', [
                    'user_id' => $userId,
                    'subscription_id' => $subscription->id,
                    'plan_id' => $subscription->usersubscription_id,
                    'start_date' => $subscription->usersubscription_date,
                    'duration' => $subscription->usersubscription_duration
                ]);
            } else {
                Log::info('AdInjectionService: No active subscription found', ['user_id' => $userId]);
            }
            
            return $subscription;
            
        } catch (\Exception $e) {
            Log::error('AdInjectionService: Error getting active subscription', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
    
    /**
     * Get ad injection data for frontend
     */
    public function getAdInjectionData($userId)
    {
        try {
            $shouldShowAds = $this->shouldShowAds($userId);
            
            if (!$shouldShowAds) {
                return [
                    'show_ads' => false,
                    'message' => 'Premium user - no ads'
                ];
            }
            
            $ad = $this->getRandomAd();
            
            if (!$ad) {
                return [
                    'show_ads' => false,
                    'message' => 'No ads available'
                ];
            }
            
            return [
                'show_ads' => true,
                'ad' => [
                    'id' => $ad->id,
                    'title' => $ad->title,
                    'file_url' => $ad->file_url,
                    'link' => $ad->link,
                    'type' => $this->getAdType($ad->file)
                ]
            ];
            
        } catch (\Exception $e) {
            Log::error('AdInjectionService: Error getting ad injection data', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            
            return [
                'show_ads' => false,
                'message' => 'Error loading ads'
            ];
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
    
    /**
     * Calculate ad injection timing (random intervals)
     */
    public function getAdTiming()
    {
        // Random ad intervals between 2-8 minutes (120-480 seconds)
        $minInterval = 120; // 2 minutes
        $maxInterval = 480; // 8 minutes
        
        $nextAdIn = rand($minInterval, $maxInterval);
        
        Log::info('AdInjectionService: Calculated ad timing', [
            'next_ad_in_seconds' => $nextAdIn,
            'next_ad_in_minutes' => round($nextAdIn / 60, 1)
        ]);
        
        return [
            'next_ad_in_seconds' => $nextAdIn,
            'next_ad_in_minutes' => round($nextAdIn / 60, 1),
            'min_interval' => $minInterval,
            'max_interval' => $maxInterval
        ];
    }
}
