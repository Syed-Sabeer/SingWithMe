<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscriptionPlan;


class UserPortalController extends Controller
{

    public function index(){
        // Get all active user subscription plans, ordered by price
        $user_subscription_plans = UserSubscriptionPlan::orderByRaw('CAST(price AS DECIMAL(10,2)) ASC')->get();
        
        // Get current user's subscription if logged in
        $currentSubscription = null;
        if (auth()->check()) {
            $currentSubscription = \App\Models\UserSubscription::where('user_id', auth()->id())
                ->latest('usersubscription_date')
                ->first();
        }

        return view('frontend.user.user-portal', compact('user_subscription_plans', 'currentSubscription'));
    }

}