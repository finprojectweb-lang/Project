@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/aboutus.css') }}">

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section
    class="project-hero"
    style="background-image: url('{{ asset('images/projects/mangrove/mangroveaja.png') }}');"
>
    <div class="project-hero-overlay">
        <div class="container text-center">
            <h1 class="project-title">Mangrove Restoration Project</h1>
            <p class="project-tagline">
                Restoring coastal ecosystems while delivering measurable climate impact
            </p>
        </div>
    </div>
</section>


{{-- ================= PROJECT OVERVIEW ================= --}}
<section class="project-section">
    <div class="container">
        <h2 class="section-title">Project Overview</h2>

        <div class="row align-items-center mt-4">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <p class="section-desc">
                    Our Mangrove Restoration Project focuses on rehabilitating degraded
                    coastal ecosystems through large-scale planting of native mangrove
                    species. The initiative enhances biodiversity, strengthens coastal
                    resilience, and contributes to long-term carbon sequestration.
                </p>
            </div>

            <div class="col-lg-6">
                <img
                    src="{{ asset('images/projects/mangrove/mangrove-overview.jpg') }}"
                    class="img-fluid rounded-4 shadow"
                    alt="Mangrove Restoration Overview"
                >
            </div>
        </div>
    </div>
</section>


{{-- ================= PROJECT OBJECTIVES ================= --}}
<section class="project-section bg-light">
    <div class="container">
        <h2 class="section-title">Project Objectives</h2>

        <ul class="approach-list">
            <li>Restore degraded coastal and estuarine ecosystems</li>
            <li>Increase long-term carbon absorption capacity</li>
            <li>Protect shorelines from erosion and extreme weather</li>
            <li>Support sustainable livelihoods for coastal communities</li>
        </ul>
    </div>
</section>


{{-- ================= OUR APPROACH ================= --}}
<section class="project-section">
    <div class="container">
        <h2 class="section-title">Our Approach</h2>

        <div class="row align-items-center mt-4">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img
                    src="{{ asset('images/projects/mangrove/mangrove-approach.jpg') }}"
                    class="img-fluid rounded-4 shadow"
                    alt="Mangrove Planting Process"
                >
            </div>

            <div class="col-lg-6">
                <ul class="approach-list">
                    <li>Environmental baseline assessment and site evaluation</li>
                    <li>Planting native mangrove species adapted to local conditions</li>
                    <li>Community-driven implementation and stewardship</li>
                    <li>Continuous monitoring and impact verification</li>
                </ul>
            </div>
        </div>
    </div>
</section>


{{-- ================= COMMUNITY ENGAGEMENT ================= --}}
<section class="project-section bg-light">
    <div class="container">
        <h2 class="section-title">Community Engagement</h2>

        <div class="row align-items-center mt-4">
            <div class="col-lg-6">
                <p class="section-desc">
                    Community engagement ensures long-term sustainability. Local
                    residents are actively involved through training, employment,
                    and environmental education programs, creating shared ecological
                    and economic benefits.
                </p>
            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                <img
                    src="{{ asset('images/projects/mangrove/mangrove-community.jpg') }}"
                    class="img-fluid rounded-4 shadow"
                    alt="Community Engagement"
                >
            </div>
        </div>
    </div>
</section>


{{-- ================= IMPACT REPORT ================= --}}
<section class="project-section">
    <div class="container">
        <h2 class="section-title">Impact Report</h2>

        <div class="impact-grid">
            <div class="impact-card">
                <h3>12,000+</h3>
                <p>Mangrove Trees Planted</p>
            </div>

            <div class="impact-card">
                <h3>25 Hectares</h3>
                <p>Coastal Area Restored</p>
            </div>

            <div class="impact-card">
                <h3>1,500+ Tons</h3>
                <p>CO₂ Sequestered</p>
            </div>
        </div>
    </div>
</section>


{{-- ================= CASE STUDY ================= --}}
<section class="project-section bg-light">
    <div class="container">
        <h2 class="section-title">Case Study</h2>

        <div class="case-study">
            <img
                src="{{ asset('images/projects/mangrove/mangrove-case.jpg') }}"
                alt="Mangrove Case Study"
            >

            <div class="case-text">
                <h4>North Java Coastal Rehabilitation</h4>
                <p>
                    A degraded coastline was transformed into a thriving mangrove
                    ecosystem. Within two years, biodiversity increased while nearby
                    villages experienced reduced erosion and improved flood protection.
                </p>
            </div>
        </div>
    </div>
</section>


{{-- ================= FUTURE DEVELOPMENT ================= --}}
<section class="project-section">
    <div class="container">
        <h2 class="section-title">Future Development</h2>

        <div class="row align-items-center mt-4">
            <div class="col-lg-6">
                <p class="section-desc">
                    We aim to scale mangrove restoration to additional coastal regions,
                    integrate blue carbon certification, and strengthen partnerships
                    with climate-conscious institutions and corporations.
                </p>
            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                <img
                    src="{{ asset('images/projects/mangrove/mangrove-future.jpg') }}"
                    class="img-fluid rounded-4 shadow"
                    alt="Future Mangrove Development"
                >
            </div>
        </div>
    </div>
</section>


{{-- ================= CTA ================= --}}
<section class="talk-section text-center py-5">
    <div class="container">

        <div class="icon-wrapper mx-auto mb-3">
            <i class="bi bi-chat-dots-fill"></i>
        </div>

        <h3 class="talk-title mb-3">Talk to Us</h3>

        <p class="talk-desc mx-auto mb-4">
            Interested in supporting our mangrove restoration initiatives or exploring
            carbon offset partnerships? We’re ready to collaborate.
        </p>

        <a href="#contact" class="btn btn-talk">Let’s Talk</a>

    </div>
</section>

@endsection
