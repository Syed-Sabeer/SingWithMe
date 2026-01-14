@extends('layouts.frontend.master')

@section('css')
<style>
    .profile-settings-wrapper {
        padding: 60px 0;
        background: radial-gradient(circle at top, #302b63 0, #0f0c29 45%, #000 100%);
        min-height: 100vh;
    }
    .profile-card {
        max-width: 900px;
        margin: 0 auto;
        background: rgba(15, 12, 41, 0.9);
        border-radius: 20px;
        border: 1px solid rgba(183, 148, 246, 0.3);
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        overflow: visible; /* ensure inner form is not clipped */
    }
    .profile-banner-preview {
        height: 200px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    .profile-avatar-preview {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 3px solid #fff;
        object-fit: cover;
        position: absolute;
        bottom: -55px;
        left: 40px;
        background: #111;
    }
    .profile-header-content {
        padding: 70px 40px 20px 40px;
        color: #fff;
    }
    .profile-header-content h2 {
        margin-bottom: 5px;
    }
    .profile-header-content p {
        color: #b8a8d0;
        margin-bottom: 0;
        font-size: 0.95rem;
    }
    .profile-form {
        padding: 0 40px 30px 40px;
        color: #fff;
    }
    .profile-form .form-label {
        color: #b8a8d0;
        font-weight: 500;
    }
    .profile-form .form-control,
    .profile-form .form-control:focus {
        background: rgba(15, 12, 41, 0.9);
        border-color: rgba(183, 148, 246, 0.4);
        color: #fff;
        box-shadow: none;
    }
    .profile-form textarea {
        min-height: 120px;
    }
    .btn-save {
        background: linear-gradient(135deg, #b794f6, #9d50bb);
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 10px 28px;
        font-weight: 600;
    }
    .btn-save:hover {
        opacity: 0.95;
    }
</style>
@endsection

@section('content')
<div class="profile-settings-wrapper">
    <div class="container">
        <div class="mb-4 text-center">
            <h1 style="color:#fff;">Artist Profile Settings</h1>
            <p style="color:#b8a8d0;">Update your account details, profile photo, banner and artist bio.</p>
        </div>

        <div class="profile-card">
            @php
                $profile = $profile ?? null;
                $banner = $profile && !empty($profile->banner_image ?? null)
                    ? asset($profile->banner_image)
                    : 'https://via.placeholder.com/1200x300?text=Artist+Banner';
                $avatar = $profile && !empty($profile->picture ?? null)
                    ? asset($profile->picture)
                    : 'https://via.placeholder.com/200x200?text=Artist';
                $displayName = $profile && ($profile->first_name || $profile->last_name)
                    ? trim($profile->first_name . ' ' . $profile->last_name)
                    : ($user->name ?? $user->username ?? 'Artist');
            @endphp

            <div class="profile-banner-preview" id="bannerPreview" style="background-image:url('{{ $banner }}');">
                <img src="{{ $avatar }}" alt="Artist avatar" id="avatarPreview" class="profile-avatar-preview">
            </div>

            <div class="profile-header-content">
                <h2>{{ $displayName }}</h2>
                <p>{{ $profile && $profile->about ? \Illuminate\Support\Str::limit($profile->about, 120) : 'Tell listeners who you are and what your music is about.' }}</p>
            </div>

            <form class="profile-form" method="POST" action="{{ route('artist.profile.update') }}" enctype="multipart/form-data">
                @csrf

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- Account details --}}
                <div class="mb-3">
                    <h5 style="color:#fff;">Account Details</h5>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Display Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $user->name ?? '') }}">
                        @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $user->email ?? '') }}">
                        @error('email')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" autocomplete="new-password">
                        <small class="text-muted">Leave blank to keep your current password.</small>
                        @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                    </div>
                </div>

                <hr style="border-color: rgba(255,255,255,0.1);">

                <div class="mb-3">
                    <h5 style="color:#fff;">Public Artist Profile</h5>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $profile->first_name ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $profile->last_name ?? '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Artist Bio</label>
                    <textarea name="about" class="form-control" maxlength="1000" placeholder="Share your story, style, and what listeners can expect from your music.">{{ old('about', $profile->about ?? '') }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Profile Photo</label>
                        <input type="file" name="picture" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp,image/avif" onchange="previewImage(event, 'avatarPreview')">
                        <small class="text-muted">Recommended: square image, at least 400x400px.</small>
                        @error('picture')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="banner_image" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp,image/avif" onchange="previewBanner(event, 'bannerPreview')">
                        <small class="text-muted">Recommended: wide image, at least 1200x300px.</small>
                        @error('banner_image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn-save">Save Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event, targetId) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = document.getElementById(targetId);
        if (img) {
            img.src = e.target.result;
        }
    };
    reader.readAsDataURL(file);
}

function previewBanner(event, targetId) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const banner = document.getElementById(targetId);
        if (banner) {
            banner.style.backgroundImage = 'url(' + e.target.result + ')';
        }
    };
    reader.readAsDataURL(file);
}
</script>
@endsection
