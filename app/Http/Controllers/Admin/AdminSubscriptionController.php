<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserSubscriptionPlan;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminSubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = UserSubscriptionPlan::all();
        return view('admin.subscriptions.customers.index', compact('subscriptions'));
    }

    public function add()
    {
        return view('admin.subscriptions.customers.add');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'duration' => 'required|string|max:255',
                'duration_months' => 'required|integer|min:1',
                'is_unlimitedstreaming' => 'nullable|boolean',
                'is_ads' => 'nullable|boolean',
                'is_offline' => 'nullable|boolean',
                'is_highquality' => 'nullable|boolean',
                'is_unlimitedplaylist' => 'nullable|boolean',
                'is_exclusivecontent' => 'nullable|boolean',
                'is_prioritysupport' => 'nullable|boolean',
                'is_family' => 'nullable|boolean',
                'family_limit' => 'nullable|integer|min:1',
                'is_parentalcontrol' => 'nullable|boolean',
            ]);

            $validatedData = $request->only([
                'title', 'price', 'duration', 'duration_months', 'is_unlimitedstreaming', 'is_ads', 
                'is_offline', 'is_highquality', 'is_unlimitedplaylist', 
                'is_exclusivecontent', 'is_prioritysupport', 'is_family', 
                'family_limit', 'is_parentalcontrol'
            ]);

            // Convert checkbox values to boolean
            $booleanFields = [
                'is_unlimitedstreaming', 'is_ads', 'is_offline', 'is_highquality',
                'is_unlimitedplaylist', 'is_exclusivecontent', 'is_prioritysupport',
                'is_family', 'is_parentalcontrol'
            ];

            foreach ($booleanFields as $field) {
                $validatedData[$field] = $request->has($field) ? 1 : 0;
            }

            // Set family_limit to null if is_family is 0
            if ($validatedData['is_family'] == 0) {
                $validatedData['family_limit'] = null;
            }

            Log::info('Validated Subscription data:', $validatedData);

            $subscription = UserSubscriptionPlan::create($validatedData);

            Log::info('Subscription created successfully:', ['id' => $subscription->id]);

            return redirect()->route('admin.subscription.index')->with('success', 'Subscription plan added successfully.');
        } catch (\Exception $e) {
            Log::error('Error while creating subscription:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $subscription = UserSubscriptionPlan::findOrFail($id);
        return view('admin.subscriptions.customers.edit', compact('subscription'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'duration' => 'required|string|max:255',
                'duration_months' => 'required|integer|min:1',
                'is_unlimitedstreaming' => 'nullable|boolean',
                'is_ads' => 'nullable|boolean',
                'is_offline' => 'nullable|boolean',
                'is_highquality' => 'nullable|boolean',
                'is_unlimitedplaylist' => 'nullable|boolean',
                'is_exclusivecontent' => 'nullable|boolean',
                'is_prioritysupport' => 'nullable|boolean',
                'is_family' => 'nullable|boolean',
                'family_limit' => 'nullable|integer|min:1',
                'is_parentalcontrol' => 'nullable|boolean',
            ]);

            $subscription = UserSubscriptionPlan::findOrFail($id);
            
            $updateData = [
                'title' => $request->title,
                'price' => $request->price,
                'duration' => $request->duration,
                'duration_months' => $request->duration_months,
            ];

            // Convert checkbox values to boolean
            $booleanFields = [
                'is_unlimitedstreaming', 'is_ads', 'is_offline', 'is_highquality',
                'is_unlimitedplaylist', 'is_exclusivecontent', 'is_prioritysupport',
                'is_family', 'is_parentalcontrol'
            ];

            foreach ($booleanFields as $field) {
                $updateData[$field] = $request->has($field) ? 1 : 0;
            }

            // Set family_limit to null if is_family is 0
            if ($updateData['is_family'] == 0) {
                $updateData['family_limit'] = null;
            } else {
                $updateData['family_limit'] = $request->family_limit;
            }

            $subscription->update($updateData);

            return redirect()->route('admin.subscription.index')->with('success', 'Subscription plan updated successfully.');
        } catch (\Exception $e) {
            Log::error('Subscription update error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $subscription = UserSubscriptionPlan::findOrFail($id);
            $subscription->delete();
            return redirect()->route('admin.subscription.index')->with('success', 'Subscription plan deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Subscription delete error:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('Could not delete subscription plan.');
        }
    }
}
