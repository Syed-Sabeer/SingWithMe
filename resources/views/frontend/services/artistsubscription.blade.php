@extends('layouts.frontend.master')


@section('css')
@endsection

@section('content')



       <!-- Start of InnerBanner -->
       <section class="inner-banner contact-banner">
            <div class="contact_child">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="h1-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                Artist Pro Membership
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of InnerBanner -->

        <section class="subscriptioin py-5" style="background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);">
            <div class="container">
                <!-- Hero -->
                <div class="hero text-center mb-5">
                    <h2 style="color: #fbfbfb; font-size: 2.5rem; margin-bottom: 15px;">Artist <span class="un_Span" style="color: #b794f6;">Subscription</span> Plans</h2>
                    <p style="color: #b8a8d0; font-size: 1.1rem; max-width: 800px; margin: 0 auto;">Choose the perfect plan to grow your music career. Upgrade anytime to unlock more features and reach a wider audience.</p>
                </div>

                <!-- Subscription Plans Grid -->
                <div class="row justify-content-center mb-5">
                    @foreach($artist_plans as $index => $plan)
                        @php
                            $isPopular = $plan->plan_slug == 'pro-artist';
                        @endphp
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="plan-card-artist" style="background: rgba(45, 27, 78, 0.6); border: 1px solid rgba(183, 148, 246, 0.3); border-radius: 15px; padding: 30px; height: 100%; position: relative; transition: transform 0.3s ease, box-shadow 0.3s ease; {{ $isPopular ? 'border: 2px solid #b794f6; transform: scale(1.05);' : '' }}">
                                @if($isPopular)
                                    <div style="position: absolute; top: -15px; right: 20px; background: linear-gradient(135deg, #b794f6, #9d50bb); color: white; padding: 8px 20px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Most Popular</div>
                                @endif
                                
                                <div class="text-center mb-4">
                                    <h3 style="color: #fbfbfb; font-size: 1.8rem; margin-bottom: 10px;">{{ $plan->plan_name }}</h3>
                                    <div style="color: #b8a8d0; font-size: 0.95rem; margin-bottom: 15px;">{{ $plan->ideal_for }}</div>
                                    <div style="color: #b794f6; font-size: 2.5rem; font-weight: bold; margin-bottom: 5px;">
                                        @if($plan->monthly_fee > 0)
                                            {{ $plan->currency }} {{ number_format($plan->monthly_fee, 2) }}
                                        @else
                                            Free
                                        @endif
                                    </div>
                                    <div style="color: #b8a8d0; font-size: 0.9rem;">per month</div>
                                </div>

                                <ul style="list-style: none; padding: 0; margin: 25px 0;">
                                    @if($plan->songs_per_month)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Upload up to {{ $plan->songs_per_month }} songs per month
                                        </li>
                                    @elseif($plan->is_unlimited_uploads)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Unlimited song uploads
                                        </li>
                                    @endif
                                    
                                    <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                        <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                        Access to community feed & comments
                                    </li>
                                    
                                    <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                        <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                        Basic analytics (plays, likes, shares)
                                    </li>
                                    
                                    <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                        <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                        Profile customization tools
                                    </li>
                                    
                                    @if($plan->is_featured_rotation)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Featured on front page rotation ({{ $plan->featured_rotation_weeks }} week{{ $plan->featured_rotation_weeks > 1 ? 's' : '' }} per month)
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_priority_search)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Priority placement in search results
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_custom_banner)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Custom banner/profile cover
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_isrc_codes)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            ISRC codes assigned to each release
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_early_access_insights)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Early access to platform insights & music trends
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_certified_badge)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            "Certified Creator" badge on profile
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_showcase_placement)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Placement in Certified Creators Showcase
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_royalty_tracking)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Official royalty tracking with ISRC integration
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_playlist_highlighted)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Highlighted inclusion in curated playlists
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_advanced_analytics)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Advanced analytics (listener demographics, regional data)
                                        </li>
                                    @endif
                                    
                                    @if($plan->is_showcase_invitations)
                                        <li style="color: #fbfbfb; padding: 10px 0; border-bottom: 1px solid rgba(183, 148, 246, 0.1);">
                                            <i class="fas fa-check-circle" style="color: #b794f6; margin-right: 10px;"></i>
                                            Invitations to online showcases, collaborations & promo campaigns
                                        </li>
                                    @endif
                                </ul>

                                <div class="text-center mt-4">
                                    <a href="/artist/artisit-portal" class="btn" style="background: {{ $isPopular ? 'linear-gradient(135deg, #b794f6, #9d50bb)' : 'rgba(183, 148, 246, 0.3)' }}; color: white; border: 1px solid rgba(183, 148, 246, 0.5); padding: 12px 30px; border-radius: 8px; text-decoration: none; display: inline-block; font-weight: 600; width: 100%;">
                                        {{ $plan->monthly_fee > 0 ? 'Subscribe Now' : 'Get Started' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Service Features Info -->
                @if($artistsubscriptions->count() > 0)
                <div class="mt-5">
                    <h3 style="color: #fbfbfb; text-align: center; margin-bottom: 30px; font-size: 2rem;">What's Included in All Plans</h3>
                    <div class="features-grid">
                        @foreach($artistsubscriptions as $artistsubscription)
                            <div class="feature-card" style="background: rgba(45, 27, 78, 0.6); border: 1px solid rgba(183, 148, 246, 0.3); border-radius: 15px; padding: 25px;">
                                <h3 style="color: #b794f6; margin-bottom: 15px;">{{ $artistsubscription->title }}</h3>
                                <p style="color: #b8a8d0; line-height: 1.8;">{!! $artistsubscription->description !!}</p>
                            </div>
                        @endforeach               
                    </div>
                </div>
                @endif
            </div>
        </section>


       <!-- Start of Artist Section -->
        

        <section class="secnewArtist">
            <div class="container">
            <div class="row pt-5">
                        <div class="col-lg-12">
                            <div class="title">
                                <div class="mobile-vectors">
                                    <img src="{{asset('FrontendAssets/images/singWithMe/mobile-vector.png')}}" alt="">
                                </div>
                                <h2 class="h2-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                    <div class='main'>
                                    <h2 class="first"> Artist</h2>
                                    <h2 class="second">Artist</h2>
                                    </div>
                                    </h2>
                                <h4 class="h4-title wow fadeup-animation mt-4" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                    Fresh Sounds, New Vibes – Meet Our Latest Artist</h4>
                            </div>
                            <div class="parent-loader">
                                <div class="loader">
                                    <div class="box1"></div>
                                    <div class="box2"></div>
                                    <div class="box3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="artists-grid">

                    <!-- Artist 1 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/musician-recording-song-home-studio_919955-56272.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Jay Nova</div>
                            <div class="artist-genre">Electronic, Hip-Hop</div>
                            <div class="artist-stats">
                                <span>2.4M Followers</span>
                                <span>5.8M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">Trending</span>
                        </div>
                    </div>
                    </a>

                    <!-- Artist 2 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/person-with-headphones-guitar-their-hands_1276913-11243.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Sarah Chen</div>
                            <div class="artist-genre">Alternative Rock</div>
                            <div class="artist-stats">
                                <span>1.8M Followers</span>
                                <span>4.2M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">Rising</span>
                        </div>
                    </div>
                    </a>
                    <!-- Artist 3 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/young-musician-making-sound-new-song_73070-3466.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Marcus Steel</div>
                            <div class="artist-genre">Rock, Metal</div>
                            <div class="artist-stats">
                                <span>3.2M Followers</span>
                                <span>7.1M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">Top Artist</span>
                        </div>
                    </div>
                    </a>
                    <!-- Artist 4 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/drums-lights-all-energy-studio-rehearsal_1092689-79439.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Austin Rivers</div>
                            <div class="artist-genre">IN Pop</div>
                            <div class="artist-stats">
                                <span>1.5M Followers</span>
                                <span>3.6M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">New</span>
                        </div>
                    </div>
                    </a>
                    <!-- Artist 5 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/man-wearing-goggles-microphone-is-playing-music_1276913-10156.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Alex Jordan</div>
                            <div class="artist-genre">R&B, Soul</div>
                            <div class="artist-stats">
                                <span>2.1M Followers</span>
                                <span>4.9M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">Featured</span>
                        </div>
                    </div>
                    </a>
                    <!-- Artist 6 -->
                    <a href="/allartist">
                    <div class="artist-card">
                        <div class="artist-image-wrapper">
                            <img class="artist-image" src="https://img.freepik.com/premium-photo/recording-studio-bathed-moody_1036891-2233.jpg" alt="">
                            <div class="play-button"></div>
                        </div>
                        <div class="artist-info">
                            <div class="artist-name">Echo Martinez</div>
                            <div class="artist-genre">Electronic, Ambient</div>
                            <div class="artist-stats">
                                <span>989K Followers</span>
                                <span>2.3M Monthly Listeners</span>
                            </div>
                            <span class="genre-tag">Discovery</span>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-12">
                                <div class="btn-part wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.6s">
                                    <a href="/allartist" class="sec-btn" title="view more">view more</a>
                                </div>
                            </div>
            </div>
        </section>
        <!-- End of Artist Section -->


        @include('partials.frontend.newsletter')





@endsection
