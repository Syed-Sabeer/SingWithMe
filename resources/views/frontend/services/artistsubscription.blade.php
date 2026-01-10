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

        <section class="subscriptioin py-5">
            
            <div class="container">
                <!-- Hero -->
                <div class="hero">
                    <h2>Artist <span class="un_Span">Subscription</span> Plan</h2>
                    <p>For a small monthly fee, gain access to our full suite of services including royalty collection,
                        music distribution, promotional tools, and more.</p>
                </div>

                <!-- Features -->
                <div class="features-grid">
            @foreach($artistsubscriptions as $artistsubscription)
                    <div class="feature-card">
                        <h3>{{ $artistsubscription->title }}</h3>
                        <p>{!! $artistsubscription->description !!}</p>
                    </div>
                    @endforeach               
                </div>

                <!-- Call to Action -->
                <div class="cta">
               <a href="/artist/artisit-portal">
                    <button>Subscribe Now </button>
                </a>                    
                </div>
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
