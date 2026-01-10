<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscriptionPlan;


class UserPortalController extends Controller
{

    public function index(){
        $user_subscription_plans = UserSubscriptionPlan::all();

        return view('frontend.user.user-portal', compact('user_subscription_plans'));
    }

}