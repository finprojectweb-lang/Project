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





@endsection