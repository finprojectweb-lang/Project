@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/news.css') }}">

@section('content')

<div class="discover-page-bg"> 
    {{-- ================= HERO / FEATURED NEWS ================= --}}
    <section class="discover-hero">
        
            <div class="discover-hero-card">

                <img 
                    src="https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?w=1200" 
                    class="discover-hero-bg" 
                    alt="Featured News"
                    >

                <div class="discover-hero-overlay">

                    <h1 class="discover-hero-title">
                        Carbon Article
                    </h1>

                    <p class="discover-hero-desc">
                        Get to know the nature around you more closely.
                    </p>

                    
                </div>

            </div>

    </section>


    {{-- ================= HOT NEWS ================= --}}
    <section class="discover-hot">
        <div class="container">
            <h5 class="hot-news-title animate-on-scroll">Hot News</h5>

            <div class="discover-hot-grid">
                <div class="hot-news-card animate-on-scroll animate-delay-1">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800" alt="Sumatra News">
                    <p>The Sumatra disaster is the worst ecological tragedy</p>
                    <small>09 Dec 2025</small>
                </div>

                <div class="hot-news-card animate-on-scroll animate-delay-2">
                    <img src="/images/defor.jpeg" alt="Deforestation News">
                    <p>Deforestation rates increase across Southeast Asia</p>
                    <small>10 Dec 2025</small>
                </div>

                <div class="hot-news-card animate-on-scroll animate-delay-3">
                    <img src="/images/carof.jpeg" alt="Carbon Offset News">
                    <p>Carbon offset initiatives gain global attention</p>
                    <small>11 Dec 2025</small>
                </div>

                {{-- RECOMMENDATION --}}
                <aside class="discover-recommendation animate-on-scroll animate-delay-4">
                    <h5>Recommendation</h5>

                    <div class="recommend-item">
                        <img src="/images/mang.jpeg" alt="Mangrove Restoration">
                        <div>
                            <p>Why mangrove restoration matters</p>
                            <small>08 Dec 2025</small>
                        </div>
                    </div>

                    <div class="recommend-item">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400" alt="Carbon Markets">
                        <div>
                            <p>How carbon markets help climate action</p>
                            <small>07 Dec 2025</small>
                        </div>
                    </div>

                    <div class="recommend-item">
                        <img src="https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=400" alt="Climate Warning">
                        <div>
                            <p>Climate adviser warns as 2025 to break heat records</p>
                            <small>07 Dec 2025</small>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>


    {{-- ================= BERITA TERKINI + TRENDING ================= --}}
    <section class="discover-main">
        <div class="container discover-layout">

            {{-- LEFT : BERITA TERKINI --}}
            <div class="discover-news">
                <h4 class="animate-on-scroll">Happening Now</h4>

                <div class="discover-news-item animate-on-scroll animate-delay-1">
                    <img src="https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?w=600" alt="Sumatra Tragedy">
                    <div>
                        <h6>The Sumatra disaster is the worst ecological tragedy in the last 35 years.</h6>
                        <small>09 Dec 2025 · 16:32 WIB</small>
                    </div>
                </div>

                <div class="discover-news-item animate-on-scroll animate-delay-2">
                    <img src="https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=600" alt="Illegal Logging">
                    <div>
                        <h6>Illegal logging threatens biodiversity in Kalimantan.</h6>
                        <small>10 Dec 2025 · 09:20 WIB</small>
                    </div>
                </div>

                <div class="discover-news-item animate-on-scroll animate-delay-3">
                    <img src="images/shanghai.jpg" alt="Shanghai Business">
                    <div>
                        <h6>Shanghai Issues Ninth Annual Action Plan to Build First-Class Business Environment.</h6>
                        <small>10 Dec 2025 · 09:20 WIB</small>
                    </div>
                </div>
            </div>

        

            {{-- RIGHT : TRENDING --}}
            <aside class="discover-sidebar">
                <div class="discover-trending animate-on-scroll">
                    <h5>Trending</h5>
                    <ol>
                        <li>The Sumatra disaster is the worst ecological tragedy</li>
                        <li>Deforestation crisis escalates in Southeast Asia</li>
                        <li>Carbon markets surge in 2025</li>
                        <li>Renewable energy outpaces fossil fuels</li>
                        <li>Ocean conservation gains global momentum</li>
                        <li>Green finance and ESG investments gain investor confidence</li>
                        <li>Urban heat islands worsen due to rapid city expansion</li>
                    </ol>
                </div>
            </aside>

            {{-- ================= RIGHT : SIDEBAR ================= --}}
            <aside class="discover-sidebar">

    
                {{-- SIDEBAR LIST --}}
                <div class="discover-sidebar-list">

                    <div class="sidebar-item animate-on-scroll animate-delay-1">
                        <img src="https://images.unsplash.com/photo-1583212292454-1fe6229603b7?w=400" alt="Coral Reefs">
                        <p>How coral reefs help fight climate change</p>
                    </div>

                    <div class="sidebar-item animate-on-scroll animate-delay-2">
                        <img src="https://images.unsplash.com/photo-1574943320219-553eb213f72d?w=400" alt="Sustainable Agriculture">
                        <p>The future of sustainable agriculture</p>
                    </div>

                    <div class="sidebar-item animate-on-scroll animate-delay-3">
                        <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=400" alt="Waste Management">
                        <p>Why waste management matters more than ever</p>
                    </div>

                    <div class="sidebar-item animate-on-scroll animate-delay-4">
                        <img src="https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=400" alt="Green Startups">
                        <p>Green startups to watch this year</p>
                    </div>

                </div>

            </aside>

        </div>
    </section>


    {{-- ================= CTA ================= --}}
    <section class="talk-section text-center animate-on-scroll">
        <div class="container">

            <div class="icon-wrapper mx-auto mb-3">
                <i class="bi bi-chat-dots-fill"></i>
            </div>

            <h3 class="talk-title">Talk to Us</h3>

            <p class="talk-desc mx-auto mb-4">
                Whether you'd like to consult with our team of experts or explore strategic partnerships,
                we're ready to hear your needs.
            </p>

            <a href="#contact" class="btn btn-talk">Let's Talk</a>

        </div>
    </section>
</div>

@endsection