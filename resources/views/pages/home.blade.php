@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

@section('content')
    <section class="hero-section">
      <div class="hero-content d-flex align-items-center justify-content-center text-center">
            <div class="container hero-inner">

                <!-- Judul -->
                <h1 class="hero-title">
                    Restore <span class="text-highlight">Nature</span>, One Offset at a Time.
                </h1>

                <!-- Subtitle -->
                <p class="hero-subtitle">
                    Heal the earth and breathe easier knowing you are part of the <br> solution.
                </p>

                <!-- Card Kutipan -->
                <div class="hero-quote mx-auto">
                    <p>
                        We are borrowing this planet from our children. Let’s make sure we return it
                        better than we found it. Your contribution today is a promise of a cleaner,
                        brighter tomorrow for the ones you love.
                    </p>
                    <br>
                    <small>
                        #NatureLovers #SustainableFuture #EarthGuardian
                    </small>
                </div>

                <!-- Tombol -->
                <div class="hero-buttons d-flex justify-content-center gap-3 mt-4">
                    <a href="#" class="btn-green">
                        Get Started
                    </a>
                    <a href="#" class="btn-outline-green">
                        Calculate Your Carbon
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="about-nullicarbon py-5"><section class="about-nullicarbon py-5">
        <div class="container">
            <div class="row align-items-center flex-nowrap">

                <!-- Text -->
                <div class="col-8">
                    <h4 class="fw-bold mb-3 about-title">
                        About <span class="text-success">NulliCarbon</span>
                    </h4>

                    <p class="text-muted about-text">
                       Nullicarbon is a sustainability-focused company that delivers practical, measurable climate solutions through carbon offsetting and community-centered initiatives. The company provides comprehensive CSR programs, including large-scale mangrove restoration projects that strengthen coastal ecosystems and boost natural carbon absorption. Nullicarbon also develops clean-energy solutions such as micro water-turbine systems, designed especially for rural communities and villages to provide reliable, renewable electricity where conventional power access is limited. In addition, the company offers biotech waste-management programs that transform organic garbage into useful, eco-friendly by-products. Through these integrated services, Nullicarbon helps organizations achieve their sustainability goals while generating meaningful environmental and social impact.    </p>
                </div>

                <!-- Logo -->
                <div class="col-4 text-end">
                    <img src="{{ asset('images/nullicarbon.png') }}"
                        alt="NulliCarbon Logo"
                        class="img-fluid about-logo">
                </div>

            </div>

            <hr class="mt-5">
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">

            <!-- Title -->
            <h2 class="text-center fw-bold mb-5 section-title">
                Our Strategies to Accelerate Your <span class="text-green">Carbon Neutrality</span>.
            </h2>

            <!-- Cards -->
            <div class="row g-4 justify-content-center">

                <!-- Card 1 -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="strategy-card">
                        <div class="strategy-img">
                            <img src="{{ asset('images/mangr.jpeg') }}" alt="Mangrove">
                        </div>

                        <div class="strategy-icon">
                            <i class="bi bi-tree"></i>
                        </div>

                        <div class="strategy-body">
                            <h5>CSR Mangrove</h5>
                            <p>
                                Drive sustainability through community-based mangrove
                                restoration for CSR and corporate branding.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="strategy-card">
                        <div class="strategy-img">
                            <img src="{{ asset('images/cfarm.jpeg') }}" alt="Coral Reef">
                        </div>

                        <div class="strategy-icon">
                            <i class="bi bi-water"></i>
                        </div>

                        <div class="strategy-body">
                            <h5>Coral Reef Conservation</h5>
                            <p>
                                Restore damaged reefs and sustain coastal livelihoods
                                through community-led conservation.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="strategy-card">
                        <div class="strategy-img">
                            <img src="{{ asset('images/daurulang.jpeg') }}" alt="Recycling">
                        </div>

                        <div class="strategy-icon">
                            <i class="bi bi-recycle"></i>
                        </div>

                        <div class="strategy-body">
                            <h5>Waste Recycling</h5>
                            <p>
                                Prevent pollution and protect ecosystems with advanced
                                waste management initiatives.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 4 (Tambahan) -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="strategy-card">
                        <div class="strategy-img">
                            <img src="{{ asset('images/wwheels.jpeg') }}" alt="Renewable Energy">
                        </div>

                        <div class="strategy-icon">
                            <i class="bi bi-lightning-charge"></i>
                        </div>

                        <div class="strategy-body">
                            <h5>Renewable Energy</h5>
                            <p>
                                Accelerate carbon neutrality through clean and renewable
                                energy solutions.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="impact-section text-center">
        <div class="overlay"></div>
        <div class="container position-relative">

            <h2 class="impact-title mb-5">Our Impact</h2>

            <div class="row justify-content-center">

                <!-- Item 1 -->
                <div class="col-md-2 col-6 mb-4 wave-item">
                    <div class="impact-card">
                        <div class="impact-icon">
                            <img src="/images/impact1nb.png" alt="Seeds">
                        </div>
                        <h4>150K+</h4>
                        <p>Seeds & Fragments Planted</p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="col-md-2 col-6 mb-4 wave-item">
                    <div class="impact-card">
                        <div class="impact-icon">
                            <img src="/images/impact3nb.png" alt="Beneficiary">
                        </div>
                        <h4>250K+</h4>
                        <p>Beneficiary</p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="col-md-2 col-6 mb-4 wave-item">
                    <div class="impact-card">
                        <div class="impact-icon">
                            <img src="/images/impact2nb.png" alt="Conservation">
                        </div>
                        <h4>500Ha+</h4>
                        <p>Conservation & Restoration Area</p>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="col-md-2 col-6 mb-4 wave-item">
                    <div class="impact-card">
                        <div class="impact-icon">
                            <img src="/images/impact4nb.png" alt="Waste">
                        </div>
                        <h4>90K+ Tons</h4>
                        <p>Recyclable Waste</p>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="col-md-2 col-6 mb-4 wave-item">
                    <div class="impact-card">
                        <div class="impact-icon">
                            <img src="/images/impact5nb.png" alt="Carbon Credit">
                        </div>
                        <h4>50M+</h4>
                        <p>tCO2e Potential Carbon Credit</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="partners-section text-center">
        <h3 class="partners-title mb-4">Partners</h3>

        <div class="partners-slider">
            <div class="partners-track">

<!-- Logo list (bebas ditambah) -->
                <div class="partner-item">
                    <img src="/images/partners/amazon.webp">
                </div>

                <div class="partner-item">
                    <img src="/images/partners/astra.png">
                </div>

                <div class="partner-item">
                    <img src="/images/partners/garuda.png">
                </div>

                <!-- Copy ulang untuk loop halus -->
                <div class="partner-item">
                    <img src="/images/partners/google.png">
                </div>

                <div class="partner-item">
                    <img src="/images/partners/goto.png">
                </div>

                <div class="partner-item">
                    <img src="/images/partners/microsoft.png">
                </div>

                <div class="partner-item">
                    <img src="/images/partners/nestle.png">
                </div>

                <div class="partner-item">
                    <img src="/images/partners/netflix.png">
                </div>

                <!-- Copy ulang untuk loop halus -->
                <div class="partner-item">
                    <img src="/images/partners/nike.png">
                </div>

                <div class="partner-item">
                    <img src="/images/partners/pertamina.png">
                </div>

                <div class="partner-item">
                    <img src="/images/partners/spotify.png">
                </div>

            </div>
        </div>
    </section>

    <script>
    document.querySelectorAll(".partners-track").forEach(track => {
        track.innerHTML += track.innerHTML; // clone isi untuk loop halus
    });
    </script>

    <section class="news-section py-5">
        <div class="container">

            <div class="text-center mb-4">
                <h3 class="news-title">Environmental News Updates & Carbon Footprint</h3>
                <p class="news-subtitle">
                    Learn about the latest climate issues and find practical guides to understanding the world of sustainability.
                </p>
            </div>

            <div class="news-list">

                <!-- === NEWS ITEM 1 === -->
                <div class="news-card">
                    <div class="news-img">
                        <img src="/images/news/berita1.png">
                    </div>

                    <div class="news-content">
                        
                        <h5 class="news-title-item">
                            Eco-Friendly vs Biodegradable: Apa Sih Bedanya? Kok Labelnya Mirip Semua
                        </h5>
                        
                        <span class="news-date">
                            <i class="bi bi-calendar3 me-1"></i> 1 Januari 2025
                        </span>

                        <p class="news-desc">
                            Lagi pilih sabun cuci piring atau kantong belanjaan di supermarket, 
                            tiba-tiba lihat dua produk dengan label “eco-friendly” dan “biodegradable”.
                        </p>

                        <a href="#" class="news-link">Read More →</a>
                    </div>
                </div>

                <!-- === NEWS ITEM 2 === -->
                <div class="news-card">
                    <div class="news-img">
                        <img src="/images/news/daurulang.jpg">
                    </div>

                    <div class="news-content">
                        
                        <h5 class="news-title-item">
                            Jangan Asal Buang! Ini Arti 7 Simbol Segitiga Daur Ulang di Kemasan Plastik Kamu
                        </h5>

                        <span class="news-date">
                            <i class="bi bi-calendar3 me-1"></i> 5 Januari 2025
                        </span>

                        <p class="news-desc">
                            Sering lihat simbol segitiga dengan angka di bawah botol minum? Ternyata gak semua jenis plastik bisa didaur ulang dengan cara yang sama. Yuk, kenali kodenya biar gak salah pilah!
                        </p>

                        <a href="#" class="news-link">Read More →</a>
                    </div>
                </div>

                <!-- === NEWS ITEM 3 === -->
                <div class="news-card">
                    <div class="news-img">
                        <img src="/images/news/bag.jpg">
                    </div>

                    <div class="news-content">
                        
                        <h5 class="news-title-item">
                            Totebag Kain vs Kantong Kertas: Ternyata Gak Semuanya 'Suci' dari Jejak Karbon!
                        </h5>

                        <span class="news-date">
                            <i class="bi bi-calendar3 me-1"></i> 7 Januari 2025
                        </span>

                        <p class="news-desc">
                            Kamu pikir pakai totebag kain yang numpuk di lemari itu pasti lebih baik dari plastik? Tunggu dulu. Kita bedah faktanya berdasarkan riset terbaru soal emisi produksi tas belanja.
                        </p>

                        <a href="#" class="news-link">Read More →</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="steps-section py-5">
    <div class="container steps-wrapper">

        <!-- Left Image -->
        <div class="step-img">
        <img src="/images/steps/tanambawah.png" alt="Plant Tree">
        </div>

        <!-- Center Content -->
        <div class="step-content text-center">
        <h3 class="step-title">Start Your Small Steps</h3>
        <p class="step-text">
            One simple step today for a greener future for the earth. 
            Count your footprint, choose your project, and make your impact.
        </p>

        <a href="#" class="btn-step">Get In Touch</a>

        <div class="step-center-img">
            <img src="/images/steps/daurbawah.jpeg" alt="Recycle">
        </div>
        </div>

        <!-- Right Image -->
        <div class="step-img">
        <img src="/images/steps/selambawah.png" alt="Coral Reef">
        </div>

    </div>
    </section>


@endsection