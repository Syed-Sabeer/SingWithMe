<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Notifications\ResetPassword;

class User  extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'email_verified_at',
        'password',
        'phone',
        'address',
        'is_active',
        'provider',
        'provider_id',
        'is_artist',
        'usersubscription_id',
        'usersubscription_date',
        'usersubscription_duration',
        'referral_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_artist' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function playlists()
    {
        return $this->hasMany(UserPlaylist::class);
    }

    public function credits()
    {
        return $this->hasOne(UserCredit::class);
    }

    public function creditTransactions()
    {
        return $this->hasMany(CreditTransaction::class);
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    public function giftSubscriptionsSent()
    {
        return $this->hasMany(GiftSubscription::class, 'gifter_id');
    }

    public function giftSubscriptionsReceived()
    {
        return $this->hasMany(GiftSubscription::class, 'recipient_id');
    }

    public function marketplaceItems()
    {
        return $this->hasMany(MarketplaceItem::class, 'artist_id');
    }

    public function marketplacePurchases()
    {
        return $this->hasMany(MarketplacePurchase::class, 'buyer_id');
    }

    public function qaSessions()
    {
        return $this->hasMany(ArtistQaSession::class, 'artist_id');
    }

    public function qaQuestions()
    {
        return $this->hasMany(QaQuestion::class);
    }

    public function exclusivePreviews()
    {
        return $this->hasMany(ExclusivePreview::class, 'artist_id');
    }

    public static function generateUniqueConnectionCode()
    {
        do {
            // Generate a random 6-digit number with leading zeros if needed
            $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('connection_code', $code)->exists());

        return $code;
    }
}
