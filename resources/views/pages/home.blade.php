@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

@section('content')

<!-- Notifikasi Success (Login/Logout) -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" 
         style="position: fixed; top: 80px; right: 20px; z-index: 9999; min-width: 350px; max-width: 500px; 
                box-shadow: 0 10px 25px rgba(0,0,0,0.2); border-left: 5px solid #10b981; 
                background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); 
                color: #065f46; border-radius: 12px; padding: 15px 20px; 
                animation: slideInRight 0.4s ease-out;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-check-circle" style="font-size: 24px; color: #10b981;"></i>
            <div style="flex: 1;">
                <strong style="display: block; margin-bottom: 2px;">Berhasil!</strong>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    
    <script>
        setTimeout(function() {
            let alert = document.querySelector('.alert-success');
            if(alert) {
                alert.style.animation = 'slideOutRight 0.4s ease-out';
                setTimeout(() => {
                    let bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 350);
            }
        }, 5000);
    </script>
@endif

<style>
@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideOutRight {
    from {
        opacity: 1;
        transform: translateX(0);
    }
    to {
        opacity: 0;
        transform: translateX(100px);
    }
}
</style>
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
                <!-- Tombol -->
                <!-- Tombol -->
                <div class="hero-buttons d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('calculator.index') }}" class="btn-green">
                        Get Started
                    </a>
                    <a href="{{ route('calculator.index') }}" class="btn-outline-green">
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

    <!-- Carbon Calculator Section -->
    <section class="py-4 py-md-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Column - Content -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="pe-lg-4 px-3 px-md-0">
                        <!-- Badge -->
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mb-3">
                            <i class="bi bi-calculator me-1"></i>
                            Free & Easy to Use
                        </span>
                        
                        <!-- Heading -->
                        <h2 class="display-6 display-md-5 fw-bold mb-3">
                            Carbon Footprint Calculator
                        </h2>
                        
                        <!-- Description -->
                        <p class="lead text-muted mb-4 fs-6 fs-md-5">
                            Calculate the carbon impact of your personal or business activities easily and accurately using our calculator, tailored to international standards.
                        </p>
                        
                        <!-- Features List -->
                        <div class="mb-4">
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-check-circle-fill text-success fs-6"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1 fs-6 fs-md-5">Accurate Measurements</h5>
                                    <p class="text-muted mb-0 small">Using standard GHG Protocol methodology for accurate and accountable results.</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-speedometer2 text-success fs-6"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1 fs-6 fs-md-5">Instant Results</h5>
                                    <p class="text-muted mb-0 small">Get your carbon footprint report in seconds with easy-to-understand visualizations.</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-graph-up-arrow text-success fs-6"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1 fs-6 fs-md-5">Compensation Recommendations</h5>
                                    <p class="text-muted mb-0 small">Receive recommendations for carbon offset projects tailored to neutralize your company's emissions.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- CTA Button -->
                        <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 gap-sm-3">
                            <a href="{{ route('calculator.index') }}" class="btn btn-success btn-lg px-4 w-100 w-sm-auto">
                                <i class="bi bi-calculator me-2"></i>
                                Start Calculating Now
                            </a>
                            <a href="#cara-kerja" class="btn btn-outline-secondary btn-lg px-4 w-100 w-sm-auto">
                                How It Works
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - Visual/Icon -->
                <div class="col-lg-6 px-3 px-md-0">
                    <div class="position-relative">
                        <!-- Background decoration -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-success bg-opacity-10 rounded-4 d-none d-md-block" style="transform: rotate(-3deg);"></div>
                        
                        <!-- Main card -->
                        <div class="card border-0 shadow-lg position-relative">
                            <div class="card-body p-4 p-md-5 text-center">
                                <!-- Icon illustration -->
                                <div class="mb-3 mb-md-4">
                                    <i class="bi bi-cloud-check display-3 display-md-1 text-success"></i>
                                </div>
                                
                                <!-- Stats -->
                                <div class="row g-2 g-md-3 mb-3 mb-md-4">
                                    <div class="col-6">
                                        <div class="bg-light rounded-3 p-2 p-md-3">
                                            <h3 class="fw-bold mb-0 text-success fs-4 fs-md-3">1,500+</h3>
                                            <small class="text-muted d-block" style="font-size: 0.75rem;">Companies Registered</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-light rounded-3 p-2 p-md-3">
                                            <h3 class="fw-bold mb-0 text-success fs-4 fs-md-3">50K+</h3>
                                            <small class="text-muted d-block" style="font-size: 0.75rem;">Ton CO₂ Dioffset</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <p class="text-muted mb-0 small">
                                    <i class="bi bi-shield-check text-success me-2"></i>
                                    Verified & Trusted
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional: How It Works Section -->
    <section id="cara-kerja" class="py-4 py-md-5">
        <div class="container px-3 px-md-0">
            <div class="text-center mb-4 mb-md-5">
                <h2 class="fw-bold mb-3 fs-3 fs-md-2">How the Calculator Works</h2>
                <p class="lead text-muted fs-6 fs-md-5">Three simple steps to calculate your carbon footprint</p>
            </div>
            
            <div class="row g-3 g-md-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-3 p-md-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="display-6 display-md-4 fw-bold text-success">1</span>
                            </div>
                            <h4 class="mb-3 fs-5 fs-md-4">Input Data</h4>
                            <p class="text-muted small">Enter your business activity data such as energy consumption, transportation, and waste.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-3 p-md-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="display-6 display-md-4 fw-bold text-success">2</span>
                            </div>
                            <h4 class="mb-3 fs-5 fs-md-4">Automatic Analysis</h4>
                            <p class="text-muted small">Our system calculates your total carbon emissions based on international standards.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-3 p-md-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="display-6 display-md-4 fw-bold text-success">3</span>
                            </div>
                            <h4 class="mb-3 fs-5 fs-md-4">Get Your Report</h4>
                            <p class="text-muted small">Receive a complete report and precise compensation project recommendations.</p>
                        </div>
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
                            Eco-Friendly vs. Biodegradable: What's the Difference? Why Do the Labels All Look So Similar?
                        </h5>
                        
                        <span class="news-date">
                            <i class="bi bi-calendar3 me-1"></i> 1 Januari 2025
                        </span>

                        <p class="news-desc">
                            While choosing dish soap or shopping bags at the supermarket,
                            you suddenly see two products labeled "eco-friendly" and "biodegradable."
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
                            Don't Just Throw Away! Here's What the 7 Triangle Recycling Symbols on Your Plastic Packaging Mean
                        </h5>

                        <span class="news-date">
                            <i class="bi bi-calendar3 me-1"></i> 5 Januari 2025
                        </span>

                        <p class="news-desc">
                            Ever see the triangle symbol with a number on the bottom of a water bottle? It turns out not all types of plastic can be recycled the same way. Learn the code to avoid missorting!
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
                            Cloth Tote Bags vs. Paper Bags: Turns Out Not All Are 'Pure' from a Carbon Footprint!
                        </h5>

                        <span class="news-date">
                            <i class="bi bi-calendar3 me-1"></i> 7 Januari 2025
                        </span>

                        <p class="news-desc">
                            You think using a cloth tote bag that's been sitting in your closet is definitely better than plastic? Wait a minute. Let's break down the facts based on the latest research on production emissions.
                        </p>

                        <a href="#" class="news-link">Read More →</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="steps-section py-5">
        <div class="container text-center">
            <div class="row justify-content-center align-items-center g-4">
                
                <!-- Gambar Kiri -->
                <div class="col-md-3 col-6 d-flex justify-content-center order-1 order-md-1">
                    <img src="/images/steps/tanambawah.png" class="steps-img-tall" alt="Planting Trees">
                </div>

                <!-- Teks Tengah -->
                <div class="col-md-4 col-12 order-3 order-md-2">
                    <h3 class="fw-bold mb-2">Start Your Small Steps</h3>
                    <p class="steps-desc mb-3">
                        One simple step today for a greener future for the earth.
                        Count your footprint, choose your project, and make your impact.
                    </p>
                    <button class="btn btn-outline-dark steps-btn">Get In Touch</button>

                    <!-- Gambar Tengah Bawah -->
                    <div class="mt-4 d-flex justify-content-center">
                        <img src="/images/steps/daurbawah.jpeg" class="steps-img-mid" alt="Recycling">
                    </div>
                </div>

                <!-- Gambar Kanan -->
                <div class="col-md-3 col-6 d-flex justify-content-center order-2 order-md-3">
                    <img src="/images/steps/selambawah.png" class="steps-img-tall" alt="Coral Planting">
                </div>

            </div>
        </div>
    </section>

    <section class="talk-section text-center py-5">
        <div class="container">

            <!-- Icon -->
            <div class="icon-wrapper mx-auto mb-3">
                <i class="bi bi-chat-dots-fill"></i>
            </div>

            <!-- Title -->
            <h3 class="talk-title mb-3">Talk to Us</h3>

            <!-- Description -->
            <p class="talk-desc mx-auto mb-4">
                Whether you’d like to consult with our team of experts, inquire about carbon offset solutions,
                or explore strategic partnership opportunities, we're ready to hear your needs.
            </p>

            <!-- Button -->
            <a href="/contactus" class="btn btn-talk">Let’s Talk</a>

        </div>
    </section>




@endsection