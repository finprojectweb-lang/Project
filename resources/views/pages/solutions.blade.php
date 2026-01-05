@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/solutions.css') }}">

@section('content')
<section class="solutions-hero">
    <div class="solutions-hero-overlay"></div>
    <div class="solutions-hero-content">
        <h1>Solutions</h1>
    </div>
</section>
<section class="solutions-intro">
    <div class="solutions-intro-container">
        <h2>Innovative Environmental Solutions</h2>
        <p>
            We deliver impactful solutions that go beyond environmental restoration. Our initiatives combine ecosystem protection, carbon reduction, and sustainable innovation to address today’s climate challenges while empowering local communities. Through responsible technology and nature-based strategies, we work toward a healthier, more resilient planet for future generations.
        </p>
    </div>
</section>
<section class="solutions-cards-section">
    <div class="solutions-cards-container">

        <!-- Title -->
        <div class="solutions-section-header">
            <h2>Our Solutions</h2>
        </div>

        <!-- Cards -->
        <div class="solutions-cards-grid">

            <a href="/mangrove" class="solution-card">
                <img src="/images/mangrove3.jpeg" alt="Mangrove Shield">
                <div class="solution-overlay">
                    <h3>Mangrove Shield</h3>
                    <p>Coastal protection and carbon absorption through mangrove restoration.</p>
                </div>
            </a>

            <a href="/garbage" class="solution-card">
                <img src="/images/garbagesol.jpg" alt="Garbage Recycle">
                <div class="solution-overlay">
                    <h3>Garbage Recycle</h3>
                    <p>Turning waste into valuable resources for a circular economy.</p>
                </div>
            </a>

            <a href="/turbin" class="solution-card">
                <img src="/images/turbinbg.png" alt="Water Turbine">
                <div class="solution-overlay">
                    <h3>Water Turbine</h3>
                    <p>Renewable energy solutions powered by flowing water.</p>
                </div>
            </a>

            <a href="/coralreefs" class="solution-card">
                <img src="/images/coralreefs.jpg" alt="Coral Guardian">
                <div class="solution-overlay">
                    <h3>Coral Guardian</h3>
                    <p>Protecting coral reefs and marine biodiversity.</p>
                </div>
            </a>

        </div>
    </div>
</section>


@endsection