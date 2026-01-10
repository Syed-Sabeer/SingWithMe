<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistMusic extends Model
{
    use HasFactory;

    protected $table = 'artist_musics';
    protected $fillable = [
        'name',
        'driver_id',
        'music_file',
        'video_file',
        'thumbnail_image',
        'listeners',
    ];

    protected $casts = [
        'listeners' => 'integer',
    ];

    // Relationship with User (driver_id refers to user_id)
    public function user()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    // Accessor for music file URL
    public function getMusicFileUrlAttribute()
    {
        if ($this->music_file) {
            // Use relative URL to avoid domain issues
            return '/storage/' . $this->music_file;
        }
        return null;
    }

    // Accessor for video file URL
    public function getVideoFileUrlAttribute()
    {
        if ($this->video_file) {
            // Use relative URL to avoid domain issues
            return '/storage/' . $this->video_file; 
        }
        return null;
    }

    // Accessor for thumbnail image URL
    public function getThumbnailImageUrlAttribute()
    {
        if ($this->thumbnail_image) {
            // Use relative URL to avoid domain issues
            return '/storage/' . $this->thumbnail_image;
        }
        return null;
    }
}
