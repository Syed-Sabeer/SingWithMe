
<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminPartnerController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminTetherWorkController;
// use App\Http\Controllers\Admin\AdminSocialShareMusicController;
// use App\Http\Controllers\Admin\AdminWellnessController;
use App\Http\Controllers\Admin\AdminLiveVideoController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminNewsletterController;
use App\Http\Controllers\Admin\AdminNewsbarController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminWebsiteController;
use App\Http\Controllers\Admin\AdminRingController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminNewsletterSubmissionController;
use App\Http\Controllers\Admin\AdminShareYourMusicController;
use App\Http\Controllers\Admin\AdminContactPageController;
use App\Http\Controllers\Admin\AdminSubscriptionPlanController;
use App\Http\Controllers\Admin\AdminSubscriptionController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminGiftController;
use App\Http\Controllers\Admin\AdminServiceMusicVideoController;
use App\Http\Controllers\Admin\AdminServiceRoyaltyCollectionController;
use App\Http\Controllers\Admin\AdminServiceSupportNetworkingController;
use App\Http\Controllers\Admin\AdminServiceArtworkPhotoController;
use App\Http\Controllers\Admin\AdminServiceArtistSubscriptionController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminRoyaltyCollectionController;
use App\Http\Controllers\Admin\AdminAdController;
use App\Http\Controllers\Common\DashboardController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FeatureController;
use App\Http\Controllers\Frontend\PricingController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ArtistController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\UserPortalController;
use App\Http\Controllers\ArtistMusicController;
use App\Http\Controllers\ArtworkPhotoController;
// use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use App\Http\Controllers\PusherController;
use App\Events\BpmBroadcasted;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Broadcast;

use Pusher\Pusher;




Route::get('/storage-link', function () {
    try {
        $link = public_path('storage');

        // Remove the existing link if it exists
        if (File::exists($link)) {
            File::delete($link);
        }

        // Create the symbolic link again
        Artisan::call('storage:link');

        return '✅ Storage link has been refreshed successfully!';
    } catch (\Exception $e) {
        return '❌ Failed to refresh storage link: ' . $e->getMessage();
    }
});


Route::group(['middleware' => ['guest']], function () {

    //User Login Authentication Routes
    Route::get('admin/login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('login-attempt', [LoginController::class, 'loginAttempt'])->name('login.attempt');
    Route::get('login', [LoginController::class, 'userlogin'])->name('user.login');

    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::post('registration-attempt', [RegisterController::class, 'registerAttempt'])->name('register.attempt');
Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


    Route::get('/artist/login', [LoginController::class, 'artistLogin'])->name('artist.login');
    Route::get('/artist/register', [RegisterController::class, 'artistRegister'])->name('artist.register');

});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/about-major-powel', [AboutController::class, 'aboutmajorpowel'])->name('about.majorpowel');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'detail'])->name('blog.detail');
Route::post('/blog/comment', [BlogController::class, 'commentStore'])->name('comment.store');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::post('/newsletter/subscribe', [WebsiteController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');


Route::get('/user-portal', [UserPortalController::class, 'index'])->name('user.portal');


Route::get('/service/musicvideo', [ServiceController::class, 'musicvideo'])->name('service.musicvideo');
Route::get('/service/royalty-collection', [ServiceController::class, 'royaltycollection'])->name('service.royaltycollection');
Route::get('/service/artisit-subscription', [ServiceController::class, 'artisitsubscription'])->name('service.artisitsubscription');
Route::get('/service/artwork-photo', [ServiceController::class, 'artworkphoto'])->name('service.artworkphoto');
Route::get('/service/support-networking', [ServiceController::class, 'supportnetworking'])->name('service.supportnetworking');


// Artist Routes - Protected by authentication and artist privileges
Route::middleware(['artist'])->group(function () {
    Route::get('artist/artisit-portal', [ArtistController::class, 'index'])->name('artist.portal');
    Route::post('artist/music/upload', [ArtistMusicController::class, 'store'])->name('artist.music.upload');
    Route::get('artist/my-music', [ArtistMusicController::class, 'index'])->name('artist.my-music');
    Route::delete('artist/music/{id}', [ArtistMusicController::class, 'destroy'])->name('artist.music.delete');

    Route::post('artist/artwork/upload', [ArtworkPhotoController::class, 'store'])->name('artist.artwork.upload');
    Route::get('artist/my-artwork', [ArtworkPhotoController::class, 'index'])->name('artist.my-artwork');
    Route::delete('artist/artwork/{id}', [ArtworkPhotoController::class, 'destroy'])->name('artist.artwork.delete');
});

// Location Form Route
// Route::get('location', [LocationController::class, 'index'])->name('location.index');

// Test API route via web
Route::get('api-test', function () {
    return response()->json(['message' => 'Web API test working', 'timestamp' => now()]);
});

// Music search via web route (for testing)
Route::get('music-search', function (Request $request) {
    try {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json([
                'success' => false,
                'message' => 'Search query is required',
                'data' => []
            ], 400);
        }

        $musics = \App\Models\ArtistMusic::with('user')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->limit(20)
            ->get()
            ->map(function ($music) {
                return [
                    'id' => $music->id,
                    'name' => $music->name,
                    'artist' => $music->user->name ?? 'Unknown Artist',
                    'thumbnail' => $music->thumbnail_image_url,
                    'music_file' => $music->music_file_url,
                    'listeners' => $music->listeners,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Music search completed',
            'data' => $musics
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error searching music: ' . $e->getMessage(),
            'data' => []
        ], 500);
    }
});

// Playlist detail page
Route::get('playlist-detail', function () {
    return view('frontend.playlist-detail');
})->name('playlist.detail');

// featured-artist page
Route::get('featured-artist', function () {
    return view('frontend.featured-artist');
})->name('featured-artist');

// profile-setup
Route::get('profile-setup', function () {
    return view('frontend.profile-setup');
})->name('profile-setup');

// privacy-policy page
Route::get('privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy-policy');

// payout-history page
Route::get('payout-history', function () {
    return view('frontend.payout-history');
})->name('payout-history');

// all-artwork page
Route::get('all-artwork', function () {
    return view('frontend.all-artwork');
})->name('all-artwork');

// Digital Artist Agreement page
Route::get('artist-agreement', function () {
    return view('frontend.artist-agreement');
})->name('artist-agreement');

// Playlist detail page
Route::get('tip-artist', function () {
    return view('frontend.tip-artist');
})->name('tip-artist');

// Analytics & Insights Dashboard page
Route::get('dashboard-analytics-insights', function () {
    return view('frontend.dashboard-analytics-insights');
})->name('dashboard-analytics-insights');

// Admin-Panel-dashboard page
Route::get('admin-panel-dashboard', function () {
    return view('frontend.admin-panel-dashboard');
})->name('admin-aanel-dashboard');

// Favorites detail page
Route::get('allblogs', function () {
    return view('frontend.allblogs');
})->name('allblogs');

// artist profile page
Route::get('artist-profile', function () {
    return view('frontend.artist-profile');
})->name('artist-profile');

// allartist detail page
Route::get('allartist', function () {
    return view('frontend.allartist');
})->name('allartist');

// allartist detail page
Route::get('songs-details', function () {
    return view('frontend.songs-details');
})->name('songs-details');


Route::get('favorites-detail', function () {
    return view('frontend.favorites-detail');
})->name('favorites.detail');

Route::get('songs-library', function () {
    return view('frontend.songs-library');
})->name('songs.library');

Route::get('test-songs-api', function () {
    $songs = \App\Models\ArtistMusic::with('user')->take(5)->get();
    return response()->json([
        'success' => true,
        'count' => $songs->count(),
        'songs' => $songs->map(function($song) {
            return [
                'id' => $song->id,
                'name' => $song->name,
                'artist' => $song->user ? $song->user->name : 'Unknown',
                'thumbnail' => $song->thumbnail_image_url,
            ];
        })
    ]);
});

// Driver Tracking Route
Route::get('driver-tracking', function () {
    return view('frontend.driver-tracking');
})->name('driver.tracking');
Route::get('share-music', [WebsiteController::class, 'shareMusic'])->name('share.music');

Route::group(['middleware' => ['auth']], function () {
    Route::get('login-verification', [AuthController::class, 'login_verification'])->name('login.verification');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('verify-account', [AuthController::class, 'verify_account'])->name('verify.account');
    Route::post('resend-code', [AuthController::class, 'resend_code'])->name('resend.code');


    Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verification_verify'])->middleware(['signed'])->name('verification.verify');
    Route::get('email/verify', [AuthController::class, 'verification_notice'])->name('verification.notice');
    Route::post('email/verification-notification', [AuthController::class, 'verification_send'])->middleware(['throttle:2,1'])->name('verification.send');

});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // FAQ Routes
    Route::get('faq', [AdminFaqController::class, 'index'])->name('faq.index');
    Route::get('faq/add', [AdminFaqController::class, 'add'])->name('faq.add');
    Route::post('faq/store', [AdminFaqController::class, 'store'])->name('faq.store');
    Route::get('faq/{id}/edit', [AdminFaqController::class, 'edit'])->name('faq.edit');
    Route::put('faq/{id}', [AdminFaqController::class, 'update'])->name('faq.update');
    Route::delete('faq/{id}', [AdminFaqController::class, 'destroy'])->name('faq.destroy');
    Route::post('faq/{id}/toggle-visibility', [AdminFaqController::class, 'toggleVisibility'])->name('faq.toggleVisibility');

    // Partner Routes
    Route::get('partner', [AdminPartnerController::class, 'index'])->name('partner.index');
    Route::get('partner/add', [AdminPartnerController::class, 'add'])->name('partner.add');
    Route::post('partner/store', [AdminPartnerController::class, 'store'])->name('partner.store');
    Route::get('partner/{id}/edit', [AdminPartnerController::class, 'edit'])->name('partner.edit');
    Route::put('partner/{id}', [AdminPartnerController::class, 'update'])->name('partner.update');
    Route::delete('partner/{id}', [AdminPartnerController::class, 'destroy'])->name('partner.destroy');
    Route::post('partner/{id}/toggle-visibility', [AdminPartnerController::class, 'toggleVisibility'])->name('partner.toggleVisibility');

    // Social Share Music Routes
    // Route::get('cms/social-share-music', [AdminSocialShareMusicController::class, 'index'])->name('cms-social-share-music.index');
    // Route::get('cms/royaltycollection', [AdminRoyaltyCollectionController::class, 'index'])->name('cms-royaltycollection.index');
    // Route::get('social-share-music', [AdminSocialShareMusicController::class, 'index'])->name('social-share-music.index');
    // Route::get('social-share-music/add', [AdminSocialShareMusicController::class, 'add'])->name('social-share-music.add');
    // Route::post('social-share-music/store', [AdminSocialShareMusicController::class, 'store'])->name('social-share-music.store');
    // Route::get('social-share-music/{id}/edit', [AdminSocialShareMusicController::class, 'edit'])->name('social-share-music.edit');
    // Route::put('social-share-music/{id}', [AdminSocialShareMusicController::class, 'update'])->name('social-share-music.update');
    // Route::delete('social-share-music/{id}', [AdminSocialShareMusicController::class, 'destroy'])->name('social-share-music.destroy');
    // Route::post('social-share-music/{id}/toggle-visibility', [AdminSocialShareMusicController::class, 'toggleVisibility'])->name('social-share-music.toggleVisibility');

    // Live Video Routes
    Route::get('live-video', [AdminLiveVideoController::class, 'index'])->name('live-video.index');
    Route::get('live-video/add', [AdminLiveVideoController::class, 'add'])->name('live-video.add');
    Route::post('live-video/store', [AdminLiveVideoController::class, 'store'])->name('live-video.store');
    Route::get('live-video/{id}/edit', [AdminLiveVideoController::class, 'edit'])->name('live-video.edit');
    Route::put('live-video/{id}', [AdminLiveVideoController::class, 'update'])->name('live-video.update');
    Route::delete('live-video/{id}', [AdminLiveVideoController::class, 'destroy'])->name('live-video.destroy');
    Route::post('live-video/{id}/toggle-visibility', [AdminLiveVideoController::class, 'toggleVisibility'])->name('live-video.toggleVisibility');



    // Blog Routes
    Route::get('blog', [AdminBlogController::class, 'index'])->name('blog.index');
    Route::get('blog/add', [AdminBlogController::class, 'add'])->name('blog.add');
    Route::post('blog/store', [AdminBlogController::class, 'store'])->name('blog.store');
    Route::get('blog/{id}/edit', [AdminBlogController::class, 'edit'])->name('blog.edit');
    Route::put('blog/{id}', [AdminBlogController::class, 'update'])->name('blog.update');
    Route::delete('blog/{id}', [AdminBlogController::class, 'destroy'])->name('blog.destroy');
    Route::post('blog/{id}/toggle-visibility', [AdminBlogController::class, 'toggleVisibility'])->name('blog.toggleVisibility');

    // Tether Work Routes
    Route::get('tether-work', [AdminTetherWorkController::class, 'index'])->name('tether-work.index');
    Route::get('tether-work/add', [AdminTetherWorkController::class, 'add'])->name('tether-work.add');
    Route::post('tether-work/store', [AdminTetherWorkController::class, 'store'])->name('tether-work.store');
    Route::get('tether-work/{id}/edit', [AdminTetherWorkController::class, 'edit'])->name('tether-work.edit');
    Route::put('tether-work/{id}', [AdminTetherWorkController::class, 'update'])->name('tether-work.update');
    Route::delete('tether-work/{id}', [AdminTetherWorkController::class, 'destroy'])->name('tether-work.destroy');

    // Wellness Routes
    // Route::get('wellness', [AdminWellnessController::class, 'index'])->name('wellness.index');
    // Route::get('wellness/add', [AdminWellnessController::class, 'add'])->name('wellness.add');
    // Route::post('wellness/store', [AdminWellnessController::class, 'store'])->name('wellness.store');
    // Route::get('wellness/{id}/edit', [AdminWellnessController::class, 'edit'])->name('wellness.edit');
    // Route::put('wellness/{id}', [AdminWellnessController::class, 'update'])->name('wellness.update');
    // Route::delete('wellness/{id}', [AdminWellnessController::class, 'destroy'])->name('wellness.destroy');
    // Route::post('wellness/{id}/toggle-visibility', [AdminWellnessController::class, 'toggleVisibility'])->name('wellness.toggleVisibility');

    // Service Music Video Routes
    Route::get('service/musicvideo', [AdminServiceMusicVideoController::class, 'index'])->name('service.musicvideo.index');
    Route::get('service/musicvideo/add', [AdminServiceMusicVideoController::class, 'add'])->name('service.musicvideo.add');
    Route::post('service/musicvideo/store', [AdminServiceMusicVideoController::class, 'store'])->name('service.musicvideo.store');
    Route::get('service/musicvideo/{id}/edit', [AdminServiceMusicVideoController::class, 'edit'])->name('service.musicvideo.edit');
    Route::put('service/musicvideo/{id}', [AdminServiceMusicVideoController::class, 'update'])->name('service.musicvideo.update');
    Route::delete('service/musicvideo/{id}', [AdminServiceMusicVideoController::class, 'destroy'])->name('service.musicvideo.destroy');

    // Service Royalty Collection Routes
    Route::get('service/royaltycollection', [AdminServiceRoyaltyCollectionController::class, 'index'])->name('service.royaltycollection.index');
    Route::get('service/royaltycollection/add', [AdminServiceRoyaltyCollectionController::class, 'add'])->name('service.royaltycollection.add');
    Route::post('service/royaltycollection/store', [AdminServiceRoyaltyCollectionController::class, 'store'])->name('service.royaltycollection.store');
    Route::get('service/royaltycollection/{id}/edit', [AdminServiceRoyaltyCollectionController::class, 'edit'])->name('service.royaltycollection.edit');
    Route::put('service/royaltycollection/{id}', [AdminServiceRoyaltyCollectionController::class, 'update'])->name('service.royaltycollection.update');
    Route::delete('service/royaltycollection/{id}', [AdminServiceRoyaltyCollectionController::class, 'destroy'])->name('service.royaltycollection.destroy');

// Support Networking Services
Route::get('service/supportnetworking', [AdminServiceSupportNetworkingController::class, 'index'])->name('service.supportnetworking.index');
Route::get('service/supportnetworking/add', [AdminServiceSupportNetworkingController::class, 'add'])->name('service.supportnetworking.add');
Route::post('service/supportnetworking/store', [AdminServiceSupportNetworkingController::class, 'store'])->name('service.supportnetworking.store');
Route::get('service/supportnetworking/{id}/edit', [AdminServiceSupportNetworkingController::class, 'edit'])->name('service.supportnetworking.edit');
Route::put('service/supportnetworking/{id}', [AdminServiceSupportNetworkingController::class, 'update'])->name('service.supportnetworking.update');
Route::delete('service/supportnetworking/{id}', [AdminServiceSupportNetworkingController::class, 'destroy'])->name('service.supportnetworking.destroy');

// Artwork Photo Services
Route::get('service/artworkphoto', [AdminServiceArtworkPhotoController::class, 'index'])->name('service.artworkphoto.index');
Route::get('service/artworkphoto/add', [AdminServiceArtworkPhotoController::class, 'add'])->name('service.artworkphoto.add');
Route::post('service/artworkphoto/store', [AdminServiceArtworkPhotoController::class, 'store'])->name('service.artworkphoto.store');
Route::get('service/artworkphoto/{id}/edit', [AdminServiceArtworkPhotoController::class, 'edit'])->name('service.artworkphoto.edit');
Route::put('service/artworkphoto/{id}', [AdminServiceArtworkPhotoController::class, 'update'])->name('service.artworkphoto.update');
Route::delete('service/artworkphoto/{id}', [AdminServiceArtworkPhotoController::class, 'destroy'])->name('service.artworkphoto.destroy');

// Artist Subscription Services
Route::get('service/artistsubscription', [AdminServiceArtistSubscriptionController::class, 'index'])->name('service.artistsubscription.index');
Route::get('service/artistsubscription/add', [AdminServiceArtistSubscriptionController::class, 'add'])->name('service.artistsubscription.add');
Route::post('service/artistsubscription/store', [AdminServiceArtistSubscriptionController::class, 'store'])->name('service.artistsubscription.store');
Route::get('service/artistsubscription/{id}/edit', [AdminServiceArtistSubscriptionController::class, 'edit'])->name('service.artistsubscription.edit');
Route::put('service/artistsubscription/{id}', [AdminServiceArtistSubscriptionController::class, 'update'])->name('service.artistsubscription.update');
Route::delete('service/artistsubscription/{id}', [AdminServiceArtistSubscriptionController::class, 'destroy'])->name('service.artistsubscription.destroy');

        Route::get('subplan', [AdminSubscriptionPlanController::class, 'index'])->name('subplan.index');
    Route::get('subplan/add', [AdminSubscriptionPlanController::class, 'add'])->name('subplan.add');
    Route::post('subplan/store', [AdminSubscriptionPlanController::class, 'store'])->name('subplan.store');
    Route::get('subplan/{id}/edit', [AdminSubscriptionPlanController::class, 'edit'])->name('subplan.edit');
    Route::put('subplan/{id}', [AdminSubscriptionPlanController::class, 'update'])->name('subplan.update');
    Route::delete('subplan/{id}', [AdminSubscriptionPlanController::class, 'destroy'])->name('subplan.destroy');

    // Subscription Plans Routes
    Route::get('subscription', [AdminSubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('subscription/add', [AdminSubscriptionController::class, 'add'])->name('subscription.add');
    Route::post('subscription/store', [AdminSubscriptionController::class, 'store'])->name('subscription.store');
    Route::get('subscription/{id}/edit', [AdminSubscriptionController::class, 'edit'])->name('subscription.edit');
    Route::put('subscription/{id}', [AdminSubscriptionController::class, 'update'])->name('subscription.update');
    Route::delete('subscription/{id}', [AdminSubscriptionController::class, 'destroy'])->name('subscription.destroy');

    // Customer Routes
    Route::get('customer', [AdminCustomerController::class, 'index'])->name('customer.index');
    Route::get('customer/add', [AdminCustomerController::class, 'add'])->name('customer.add');
    Route::post('customer/store', [AdminCustomerController::class, 'store'])->name('customer.store');
    Route::get('customer/{id}/edit', [AdminCustomerController::class, 'edit'])->name('customer.edit');
    Route::put('customer/{id}', [AdminCustomerController::class, 'update'])->name('customer.update');
    Route::delete('customer/{id}', [AdminCustomerController::class, 'destroy'])->name('customer.destroy');
    Route::post('customer/{id}/toggle-status', [AdminCustomerController::class, 'toggleStatus'])->name('customer.toggleStatus');


    // About Section Routes

        Route::get('newsbar', [AdminNewsbarController::class, 'index'])->name('newsbar.index');
    Route::get('newsbar/add', [AdminNewsbarController::class, 'add'])->name('newsbar.add');
    Route::post('newsbar/store', [AdminNewsbarController::class, 'store'])->name('newsbar.store');
    Route::get('newsbar/{id}/edit', [AdminNewsbarController::class, 'edit'])->name('newsbar.edit');
    Route::put('newsbar/{id}', [AdminNewsbarController::class, 'update'])->name('newsbar.update');
    Route::delete('newsbar/{id}', [AdminNewsbarController::class, 'destroy'])->name('newsbar.destroy');

    // Newsletter Routes
    Route::get('newsletter', [AdminNewsletterController::class, 'index'])->name('newsletter.index');
    Route::get('newsletter/add', [AdminNewsletterController::class, 'add'])->name('newsletter.add');
    Route::post('newsletter/store', [AdminNewsletterController::class, 'store'])->name('newsletter.store');
    Route::get('newsletter/{id}/edit', [AdminNewsletterController::class, 'edit'])->name('newsletter.edit');
    Route::put('newsletter/{id}', [AdminNewsletterController::class, 'update'])->name('newsletter.update');
    Route::delete('newsletter/{id}', [AdminNewsletterController::class, 'destroy'])->name('newsletter.destroy');
    Route::post('newsletter/{id}/toggle-visibility', [AdminNewsletterController::class, 'toggleVisibility'])->name('newsletter.toggleVisibility');

    // Company Settings
    Route::get('company-settings', [AdminSettingController::class, 'index'])->name('company.settings');

    // Website CMS sections
    Route::get('website', [AdminWebsiteController::class, 'index'])->name('website.index');
    Route::get('royalty-cms', [AdminWebsiteController::class, 'royaltycms'])->name('royalty.cms');
    Route::get('contact', [AdminContactPageController::class, 'index'])->name('contact.index');
    Route::get('shareyourmusic', [AdminShareYourMusicController::class, 'cmsindex'])->name('cms.shareyourmusic.index');
    Route::put('shareyourmusic/update', [AdminShareYourMusicController::class, 'cmsupdate'])->name('cms.shareyourmusic.update');
    Route::get('about', [AdminAboutController::class, 'index'])->name('about.index');
    Route::put('about/update', [AdminAboutController::class, 'update'])->name('about.update');
    Route::put('website/sections/update', [AdminWebsiteController::class, 'updateAllSections'])->name('website.sections.update');
    Route::put('contact/sections/update', [AdminContactPageController::class, 'updateContact'])->name('contact.update');

    Route::put('royalty/update', [AdminWebsiteController::class, 'updateRoyaltyCms'])->name('royalty.update');

    Route::get('contacts', [AdminContactPageController::class, 'index'])->name('contactsubmission.index');
    Route::get('contactlist', [AdminContactController::class, 'index'])->name('contactlist');
    Route::get('newsletterlist', [AdminNewsletterSubmissionController::class, 'index'])->name('newsletterlist');
    Route::delete('newsletterlist/{id}', [AdminNewsletterSubmissionController::class, 'destroy'])->name('newsletterlist.destroy');
Route::delete('contacts/{id}', [AdminContactController::class, 'destroy'])->name('contact.destroy');


    Route::get('orders/gift', [AdminOrderController::class, 'giftIndex'])->name('gift.orders');
    Route::delete('orders/gift/{id}', [AdminOrderController::class, 'giftDestroy'])->name('gift.orders.destroy');

        Route::get('orders/ring', [AdminOrderController::class, 'ringIndex'])->name('ring.orders');
    Route::delete('orders/ring/{id}', [AdminOrderController::class, 'ringDestroy'])->name('ring.orders.destroy');

    // Ads Routes
    Route::get('ads', [AdminAdController::class, 'index'])->name('ads.index');
    Route::get('ads/create', [AdminAdController::class, 'create'])->name('ads.create');
    Route::post('ads', [AdminAdController::class, 'store'])->name('ads.store');
    Route::get('ads/{id}/edit', [AdminAdController::class, 'edit'])->name('ads.edit');
    Route::put('ads/{id}', [AdminAdController::class, 'update'])->name('ads.update');
    Route::delete('ads/{id}', [AdminAdController::class, 'destroy'])->name('ads.destroy');
    Route::post('ads/{id}/toggle-visibility', [AdminAdController::class, 'toggleVisibility'])->name('ads.toggleVisibility');

});

// TEMPORARY: Test logging route for debugging
Route::get('logtest', function() {
    \Log::info('Log test route hit!');
    return 'Logged!';
});




