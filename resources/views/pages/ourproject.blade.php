@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/projects.css') }}">

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="project-hero">
    <!-- BACKGROUND IMAGE -->
    <img
        src="{{ asset('images/mangroveaja.png') }}"
        alt="Mangrove Restoration"
        class="hero-bg"
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
                    species. This initiative strengthens coastal resilience, enhances
                    biodiversity, and contributes to long-term carbon sequestration.
                </p>
            </div>

            {{-- 🔹 OVERVIEW IMAGE --}}
            <div class="col-lg-6">
                <img
                    src="{{ asset('images/overview.png') }}"
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
            {{-- 🔹 APPROACH IMAGE --}}
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img
                    src="{{ asset('images/impact.png') }}"
                    class="img-fluid rounded-4 shadow"
                    alt="Mangrove Planting Process"
                >
            </div>

            <div class="col-lg-6">
                <ul class="approach-list">
                    <li>Comprehensive site assessment and baseline environmental study</li>
                    <li>Selection and planting of site-specific native mangrove species</li>
                    <li>Active involvement of local communities and stakeholders</li>
                    <li>Ongoing monitoring through satellite imagery and field surveys</li>
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
                    Community participation is central to our restoration strategy.
                    We collaborate with local residents through training programs,
                    employment opportunities, and environmental education initiatives,
                    ensuring long-term ecological and social sustainability.
                </p>
            </div>

            {{-- 🔹 COMMUNITY IMAGE --}}
            <div class="col-lg-6 mt-4 mt-lg-0">
                <img
                    src="{{ asset('images/community.png') }}"
                    class="img-fluid rounded-4 shadow"
                    alt="Community Mangrove Engagement"
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
                src="{{ asset('images/3project.png') }}"
                alt="Mangrove Case Study"
            >

            <div class="case-text">
                <h4>North Java Coastal Rehabilitation</h4>
                <p>
                    This project transformed a severely degraded coastline into a
                    resilient mangrove ecosystem. Within two years, biodiversity
                    increased significantly while nearby communities benefited from
                    reduced coastal erosion and improved flood protection.
                </p>
            </div>
        </div>
    </div>
</section>


{{-- ================= FUTURE PLANS ================= --}}
<section class="project-section">
    <div class="container">
        <h2 class="section-title">Future Development</h2>

        <div class="row align-items-center mt-4">
            <div class="col-lg-6">
                <p class="section-desc">
                    Building on this success, we plan to expand mangrove restoration
                    initiatives across additional coastal regions, integrate blue carbon
                    credit certification, and strengthen partnerships with corporate and
                    institutional climate stakeholders.
                </p>
            </div>

            {{-- 🔹 FUTURE IMAGE --}}
            <div class="col-lg-6 mt-4 mt-lg-0">
                <img
                    src="{{ asset('images/future.png') }}"
                    class="img-fluid rounded-4 shadow"
                    alt="Future Mangrove Development"
                >
            </div>
        </div>
    </div>
</section>


{{-- ================= CTA ================= --}}
<section class="talk-section text-center">
    <div class="container">

        <div class="icon-wrapper mx-auto mb-3">
            <i class="bi bi-chat-dots-fill"></i>
        </div>

        <h3 class="talk-title mb-3">Talk to Us</h3>

        <p class="talk-desc mx-auto mb-4">
            Interested in supporting our mangrove restoration initiatives or exploring
            carbon offset partnerships? Our team is ready to collaborate with you.
        </p>

        <a href="#contact" class="btn btn-talk">Let’s Talk</a>

    </div>
</section>

@endsection
