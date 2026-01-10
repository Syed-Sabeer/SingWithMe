<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\Frontend\EventCalendarController;
use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Frontend\UserRelationshipController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\PlaylistController;
use App\Http\Controllers\SellerPackageController;
use App\Http\Controllers\Api\AdInjectionController;
use App\Http\Controllers\Api\MonthlyPlayController;
use App\Events\BpmBroadcasted;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Broadcast;
// Remove non-existent PusherController
// use App\Http\Controllers\PusherController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes that your application supports.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Remove conflicting route - Laravel handles broadcasting auth automatically
// Route::post('/pusher/auth', [PusherController::class, 'pusherAuth'])
//     ->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->post('/save-fcm-token', function (Request $request) {
    $request->validate([
        'token' => 'required|string',
    ]);

    $user = $request->user();

    \App\Models\FcmToken::updateOrCreate(
        ['user_id' => $user->id],
        ['token' => $request->token]
    );

    return response()->json(['message' => 'Token saved']);
});


Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/profile/update', [AuthController::class, 'editProfile']);
    Route::get('/profile', [AuthController::class, 'getProfile']);
Route::post('/notify', [NotificationController::class, 'sendNotification']);
    
    // Playlist API routes - all require authentication
    Route::get('/playlists', [PlaylistController::class, 'getUserPlaylists']);
    Route::post('/playlist/create', [PlaylistController::class, 'createPlaylist']);
    Route::get('/playlist/{playlistName}', [PlaylistController::class, 'getPlaylistDetails']);
    Route::get('/songs', [PlaylistController::class, 'getAllSongs']);
    Route::post('/playlist/add-song', [PlaylistController::class, 'addSongToPlaylist']);
    Route::post('/playlist/remove-song', [PlaylistController::class, 'removeSongFromPlaylist']);
    Route::get('/playlist-names', [PlaylistController::class, 'getUserPlaylistNames']);
    
    // Favorites API routes
    Route::post('/favorites/toggle', [PlaylistController::class, 'toggleFavorite']);
    Route::post('/favorites/add', [PlaylistController::class, 'addToFavorites']);
    Route::post('/favorites/remove', [PlaylistController::class, 'removeFromFavorites']);
    Route::post('/favorites/check', [PlaylistController::class, 'checkFavorites']);
    Route::get('/favorites', [PlaylistController::class, 'getUserFavorites']);
    Route::get('/favorites/latest', [PlaylistController::class, 'getLatestFavorites']);
});

// Public API routes (no authentication required)
Route::get('/music/search', [PlaylistController::class, 'searchMusic']);
Route::get('/music/all', [PlaylistController::class, 'getAllSongs']);
Route::post('/subscription/purchase', [PlaylistController::class, 'purchaseSubscription']);
Route::get('/subscription/current', [PlaylistController::class, 'getUserSubscription']);

// Test routes
Route::get('/test', function () {
    return response()->json(['message' => 'API is working', 'timestamp' => now()]);
});

Route::get('/test-music', function () {
    try {
        $count = \App\Models\ArtistMusic::count();
        return response()->json([
            'success' => true,
            'message' => 'Database connection working',
            'music_count' => $count
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ], 500);
    }
});

// Auth API Routes
Route::post('/register', [RegisterController::class, 'registerAttempt']);
Route::post('/login', [LoginController::class, 'loginAttempt']);

Route::post('/password/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/password/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/password/reset', [AuthController::class, 'resetPasswordWithOtp']);

// Seller Package API Routes
Route::prefix('appV1')->group(function () {
    Route::get('seller-packages', [SellerPackageController::class, 'seller_packages_list_api']);
    Route::get('seller-package-payments', [SellerPackageController::class, 'packages_payment_list_api'])->middleware('auth:sanctum');
    Route::post('purchase-seller-package', [SellerPackageController::class, 'seller_purchase_package_by_stripe_api'])->middleware('auth:sanctum');
});

// Ad Injection API Routes
Route::get('ad-injection/data', [AdInjectionController::class, 'getAdData']);
Route::get('ad-injection/should-show-ads', [AdInjectionController::class, 'shouldShowAds']);
Route::get('ad-injection/random-ad', [AdInjectionController::class, 'getRandomAd']);

// Monthly Play Tracking API Routes
Route::post('monthly-plays/track', [MonthlyPlayController::class, 'trackPlay']);
Route::get('monthly-plays/user-stats', [MonthlyPlayController::class, 'getUserMonthlyStats']);
Route::get('monthly-plays/music-stats/{musicId}', [MonthlyPlayController::class, 'getMusicMonthlyStats']);
Route::get('monthly-plays/top-songs', [MonthlyPlayController::class, 'getTopSongs']);
Route::get('monthly-plays/analytics', [MonthlyPlayController::class, 'getMonthlyAnalytics']);


// Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::options('{any}', function () {
    return response()->json(['status' => 'OK'], 200);
})->where('any', '.*');