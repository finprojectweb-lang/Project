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
    from { opacity: 0; transform: translateX(100px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes slideOutRight {
    from { opacity: 1; transform: translateX(0); }
    to { opacity: 0; transform: translateX(100px); }
}
</style>

<!-- ============ HERO ============ -->
<section class="hero-section">
    <div class="hero-content d-flex align-items-center justify-content-center text-center">
        <div class="container hero-inner">

            <h1 class="hero-title">
                Turn Your Company's Emissions into <span class="text-highlight">Real Impact</span>.
            </h1>

            <p class="hero-subtitle">
                Measure your organization's carbon footprint, offset what you can't cut yet, <br> and back restoration work you can actually report on.
            </p>

            <div class="hero-quote mx-auto">
                <p>
                    Every company leaves a footprint — what matters is what you do about it. From your
                    first calculation to your first verified offset, we help businesses turn sustainability
                    commitments into results, not just promises.
                </p>
                <br>
                <small>
                    #CorporateSustainability #NetZero
                </small>
            </div>

            <div class="hero-buttons d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('calc.corporate.create') }}" class="btn-green">
                    Get Started
                </a>
                <a href="{{ route('calc.corporate.create') }}" class="btn-outline-green">
                    Calculate Your Carbon
                </a>
            </div>

        </div>
    </div>
</section>

<!-- ============ ABOUT ============ -->
<section class="about-nullicarbon py-5">
    <div class="container">
        <div class="row align-items-center flex-nowrap">

            <!-- Text -->
            <div class="col-8">
                <h4 class="fw-bold mb-3 about-title">
                    Sustainability, Built for <span class="text-success">Business</span>
                </h4>

                <p class="text-muted about-text">
                    NulliCarbon works with organizations of every size to turn climate commitments into
                    measurable action. Beyond carbon calculation, we run large-scale mangrove restoration
                    programs your company can sponsor for CSR reporting, develop clean-energy solutions like
                    micro water-turbine systems for underserved communities, and manage biotech waste programs
                    that convert organic waste into useful by-products. Whatever your sustainability goals look
                    like on paper, we help you get there with data you can stand behind.
                </p>
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

<!-- ============ CORPORATE PROGRAMS ============ -->
<section class="py-5 bg-light">
    <div class="container">

        <h2 class="text-center fw-bold mb-5 section-title">
            Corporate Programs Built Around Your <span class="text-green">Sustainability Goals</span>.
        </h2>

        <div class="row g-4 justify-content-center">

            <!-- Card 1 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="strategy-card">
                    <div class="strategy-img">
                        <img src="{{ asset('images/corporate/mangrove.jpg') }}" alt="CSR Mangrove">
                    </div>
                    <div class="strategy-icon">
                        <i class="bi bi-tree"></i>
                    </div>
                    <div class="strategy-body">
                        <h5>CSR Mangrove Partnership</h5>
                        <p>
                            Strengthen your CSR portfolio through community-based mangrove restoration,
                            branded and reportable.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="strategy-card">
                    <div class="strategy-img">
                        <img src="{{ asset('images/corporate/coral-reef.jpg') }}" alt="Coral Reef">
                    </div>
                    <div class="strategy-icon">
                        <i class="bi bi-water"></i>
                    </div>
                    <div class="strategy-body">
                        <h5>Coral Reef Conservation</h5>
                        <p>
                            Fund reef restoration that ties directly into your sustainability reporting
                            and coastal community impact.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="strategy-card">
                    <div class="strategy-img">
                        <img src="{{ asset('images/corporate/waste-recycling.jpg') }}" alt="Waste Recycling">
                    </div>
                    <div class="strategy-icon">
                        <i class="bi bi-recycle"></i>
                    </div>
                    <div class="strategy-body">
                        <h5>Waste Recycling Programs</h5>
                        <p>
                            Cut landfill impact and generate ESG-ready waste metrics through our
                            recycling initiatives.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="strategy-card">
                    <div class="strategy-img">
                        <img src="{{ asset('images/corporate/renewable-energy.jpg') }}" alt="Renewable Energy">
                    </div>
                    <div class="strategy-icon">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <div class="strategy-body">
                        <h5>Renewable Energy</h5>
                        <p>
                            Cut emissions at the source with clean energy solutions built for
                            commercial and industrial operations.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============ IMPACT ============ -->
<section class="impact-section text-center">
    <div class="overlay"></div>
    <div class="container position-relative">

        <h2 class="impact-title mb-5">Our Impact</h2>

        <div class="row justify-content-center">

            <div class="col-md-2 col-6 mb-4 wave-item">
                <div class="impact-card">
                    <div class="impact-icon">
                        <img src="/images/impact1nb.png" alt="Seeds">
                    </div>
                    <h4>150K+</h4>
                    <p>Seeds & Fragments Planted</p>
                </div>
            </div>

            <div class="col-md-2 col-6 mb-4 wave-item">
                <div class="impact-card">
                    <div class="impact-icon">
                        <img src="/images/impact3nb.png" alt="Beneficiary">
                    </div>
                    <h4>250K+</h4>
                    <p>Beneficiary</p>
                </div>
            </div>

            <div class="col-md-2 col-6 mb-4 wave-item">
                <div class="impact-card">
                    <div class="impact-icon">
                        <img src="/images/impact2nb.png" alt="Conservation">
                    </div>
                    <h4>500Ha+</h4>
                    <p>Conservation & Restoration Area</p>
                </div>
            </div>

            <div class="col-md-2 col-6 mb-4 wave-item">
                <div class="impact-card">
                    <div class="impact-icon">
                        <img src="/images/impact4nb.png" alt="Waste">
                    </div>
                    <h4>90K+ Tons</h4>
                    <p>Recyclable Waste</p>
                </div>
            </div>

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

<!-- ============ CORPORATE CARBON CALCULATOR ============ -->
<section class="py-4 py-md-5 bg-light">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left Column - Content -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="pe-lg-4 px-3 px-md-0">
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mb-3">
                        <i class="bi bi-calculator me-1"></i>
                        Built for Business
                    </span>

                    <h2 class="display-6 display-md-5 fw-bold mb-3">
                        Corporate Carbon Calculator
                    </h2>

                    <p class="lead text-muted mb-4 fs-6 fs-md-5">
                        Calculate emissions across offices, warehouses, and fleets in one place, using a
                        methodology built to hold up under audit.
                    </p>

                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-check-circle-fill text-success fs-6"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 fs-6 fs-md-5">GHG Protocol Compliance</h5>
                                <p class="text-muted mb-0 small">Every calculation follows standard GHG Protocol methodology, so your numbers hold up with auditors and regulators.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-diagram-3 text-success fs-6"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 fs-6 fs-md-5">Multi-Site & Department Tracking</h5>
                                <p class="text-muted mb-0 small">Track each office, warehouse, or fleet separately, then roll everything up into one company-wide report.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-graph-up-arrow text-success fs-6"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 fs-6 fs-md-5">Tailored Offset Recommendations</h5>
                                <p class="text-muted mb-0 small">Once your numbers are in, we'll recommend offset projects sized and matched to your company's footprint.</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 gap-sm-3">
                        <a href="{{ route('calc.corporate.create') }}" class="btn btn-success btn-lg px-4 w-100 w-sm-auto">
                            <i class="bi bi-calculator me-2"></i>
                            Start Calculating Now
                        </a>
                        <a href="#cara-kerja" class="btn btn-outline-secondary btn-lg px-4 w-100 w-sm-auto">
                            How It Works
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column - Visual -->
            <div class="col-lg-6 px-3 px-md-0">
                <div class="position-relative">
                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-success bg-opacity-10 rounded-4 d-none d-md-block" style="transform: rotate(-3deg);"></div>

                    <div class="card border-0 shadow-lg position-relative">
                        <div class="card-body p-4 p-md-5 text-center">
                            <div class="mb-3 mb-md-4">
                                <i class="bi bi-cloud-check display-3 display-md-1 text-success"></i>
                            </div>

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
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Ton CO₂ Offset</small>
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

<!-- ============ HOW IT WORKS ============ -->
<section id="cara-kerja" class="py-4 py-md-5">
    <div class="container px-3 px-md-0">
        <div class="text-center mb-4 mb-md-5">
            <h2 class="fw-bold mb-3 fs-3 fs-md-2">How the Calculator Works</h2>
            <p class="lead text-muted fs-6 fs-md-5">Three steps from raw data to a report you can act on</p>
        </div>

        <div class="row g-3 g-md-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-3 p-md-4">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <span class="display-6 display-md-4 fw-bold text-success">1</span>
                        </div>
                        <h4 class="mb-3 fs-5 fs-md-4">Input Company Data</h4>
                        <p class="text-muted small">Enter your organization's energy consumption, transportation, and waste data, site by site.</p>
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
                        <p class="text-muted small">Our system calculates your total emissions based on international GHG Protocol standards.</p>
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
                        <p class="text-muted small">Receive a complete report and offset project recommendations sized to your company.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ PARTNERS ============ -->
<section class="partners-section text-center">
    <h3 class="partners-title mb-4">Partners</h3>

    <div class="partners-slider">
        <div class="partners-track">

            <div class="partner-item">
                <img src="/images/partners/amazon.webp">
            </div>

            <div class="partner-item">
                <img src="/images/partners/astra.png">
            </div>

            <div class="partner-item">
                <img src="/images/partners/garuda.png">
            </div>

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

<!-- ============ NEWS ============ -->
<section class="news-section py-5">
    <div class="container">

        <div class="text-center mb-4">
            <h3 class="news-title">Corporate Sustainability News & Updates</h3>
            <p class="news-subtitle">
                What sustainability and ESG teams are reading about this month.
            </p>
        </div>

        <div class="news-list">

            <div class="news-card">
                <div class="news-img">
                    <img src="{{ asset('images/corporate/news-scope.jpg') }}">
                </div>
                <div class="news-content">
                    <h5 class="news-title-item">
                        Scope 1, 2, and 3: What These Emission Categories Actually Mean for Your Business
                    </h5>
                    <span class="news-date"><i class="bi bi-calendar3 me-1"></i> 3 Januari 2025</span>
                    <p class="news-desc">
                        Most companies know they need to report emissions, fewer know which category
                        their biggest sources actually fall under. Here's a plain-language breakdown.
                    </p>
                    <a href="#" class="news-link">Read More →</a>
                </div>
            </div>

            <div class="news-card">
                <div class="news-img">
                    <img src="{{ asset('images/corporate/news-esg.jpg') }}">
                </div>
                <div class="news-content">
                    <h5 class="news-title-item">
                        ESG Reporting Is Changing — Here's What Regulators Now Expect from Companies
                    </h5>
                    <span class="news-date"><i class="bi bi-calendar3 me-1"></i> 6 Januari 2025</span>
                    <p class="news-desc">
                        Disclosure requirements have tightened across the region. We break down what's
                        new and what it means for your next reporting cycle.
                    </p>
                    <a href="#" class="news-link">Read More →</a>
                </div>
            </div>

            <div class="news-card">
                <div class="news-img">
                    <img src="{{ asset('images/corporate/news-credits.jpg') }}">
                </div>
                <div class="news-content">
                    <h5 class="news-title-item">
                        Carbon Credits vs. Carbon Offsets: A Quick Guide for Sustainability Teams
                    </h5>
                    <span class="news-date"><i class="bi bi-calendar3 me-1"></i> 9 Januari 2025</span>
                    <p class="news-desc">
                        The two terms get used interchangeably, but they're not the same thing. Knowing
                        the difference changes how you should talk about your program.
                    </p>
                    <a href="#" class="news-link">Read More →</a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============ SMALL STEPS ============ -->
<section class="steps-section py-5">
    <div class="container text-center">
        <div class="row justify-content-center align-items-center g-4">

            <!-- Gambar Kiri -->
            <div class="col-md-3 col-6 d-flex justify-content-center order-1 order-md-1">
                <img src="{{ asset('images/corporate/steps-left.png') }}" class="steps-img-tall" alt="Corporate Sustainability">
            </div>

            <!-- Teks Tengah -->
            <div class="col-md-4 col-12 order-3 order-md-2">
                <h3 class="fw-bold mb-2">Start Your Company's Carbon Journey</h3>
                <p class="steps-desc mb-3">
                    One calculation today can shape your organization's sustainability roadmap.
                    Measure your footprint, choose your projects, and make your impact.
                </p>
                <button class="btn btn-outline-dark steps-btn">
                    <a href="{{ route('calc.corporate.create') }}" style="text-decoration: none; color: inherit;">Get In Touch</a>
                </button>

                <!-- Gambar Tengah Bawah -->
                <div class="mt-4 d-flex justify-content-center">
                    <img src="{{ asset('images/corporate/steps-mid.jpg') }}" class="steps-img-mid" alt="Restoration Project">
                </div>
            </div>

            <!-- Gambar Kanan -->
            <div class="col-md-3 col-6 d-flex justify-content-center order-2 order-md-3">
                <img src="{{ asset('images/corporate/steps-right.png') }}" class="steps-img-tall" alt="Verified Offset">
            </div>

        </div>
    </div>
</section>

<!-- ============ TALK TO US ============ -->
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
            Whether you'd like to consult with our team, inquire about corporate carbon offset solutions,
            or explore CSR partnership opportunities, we're ready to hear your needs.
        </p>

        <!-- Button -->
        <a href="/contactus" class="btn btn-talk">Let's Talk</a>

    </div>
</section>

@endsection