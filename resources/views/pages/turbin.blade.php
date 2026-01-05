@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/turbin.css') }}">

@section('content')
<section class="mangrove-hero">
    <div class="mangrove-content">
        <div class="mangrove-panel">
            <h1 class="mangrove-title">
                Restore the Coast, Reduce Your Carbon Footprint
            </h1>

            <p class="mangrove-subtitle">
                A transparent carbon offset platform focused on<br>
                mangrove forest rehabilitation in Indonesia.
            </p>
        </div>
    </div>
</section>

<section class="mangrove-shield-section">
    <div class="mangrove-shield-container">

        {{-- LEFT CONTENT --}}
        <div class="mangrove-shield-text">
            <h2>Water Turbine</h2>

            <p>
                A water turbine is a rotary machine that converts the kinetic and potential energy of moving water into mechanical work, serving as the critical heart of hydroelectric power generation. As water flows from a reservoir or river through the turbine’s blades, the force of the fluid pushes against them, causing the central rotor to spin at high speeds. This rotational motion is then transferred via a shaft to an electrical generator, where the mechanical energy is instantly transformed into clean, renewable electricity ready for distribution to the power grid.
            </p>

            <p>
                The design of these turbines varies significantly to maximize efficiency across different water conditions, with common types including the Pelton wheel for high-pressure, low-volume flows and the Francis or Kaplan turbines for lower-pressure environments. Because water turbines operate with exceptional efficiency—often capturing over 90% of the available energy—they represent one of the most reliable and cost-effective sources of renewable energy. By harnessing the natural power of the water cycle without burning fossil fuels, they play an indispensable role in reducing global carbon emissions and stabilizing energy grids.
            </p>
        </div>

        {{-- RIGHT IMAGE PANEL --}}
        <div class="mangrove-shield-gallery">
            <div class="gallery-large">
                <img src="/images/turbin1.webp" alt="Mangrove underwater">
            </div>

            <div class="gallery-small">
                <img src="/images/turbin2.webp" alt="Mangrove coast">
                <img src="/images/turbin3.webp" alt="Mangrove roots">
            </div>
        </div>

    </div>
</section>

<section class="why-mangrove-section">
    <div class="why-mangrove-container">

        <h2 class="why-title">
            Why did we choose Mangroves as the main weapon against the climate crisis?
        </h2>

        <div class="why-mangrove-grid">

            {{-- LEFT COLUMN --}}
            <div class="why-cards">

                <div class="why-card">
                    <h3>The Blue Carbon Giant</h3>
                    <p>
                        Ordinary forests store carbon in their trunks and leaves. If the trees die
                        or burn, that carbon returns to the air. But mangroves are different. They
                        store the majority of their carbon (up to 80%) in the mud beneath the water.
                    </p>
                </div>

                <div class="why-card">
                    <h3>The Blue Carbon Giant</h3>
                    <p>
                        Ordinary forests store carbon in their trunks and leaves. If the trees die
                        or burn, that carbon returns to the air. But mangroves are different. They
                        store the majority of their carbon (up to 80%) in the mud beneath the water.
                    </p>
                </div>

                <div class="why-card">
                    <h3>The Blue Carbon Giant</h3>
                    <p>
                        Ordinary forests store carbon in their trunks and leaves. If the trees die
                        or burn, that carbon returns to the air. But mangroves are different. They
                        store the majority of their carbon (up to 80%) in the mud beneath the water.
                    </p>
                </div>

            </div>

            {{-- RIGHT COLUMN --}}
            <aside class="fun-fact-card">
                <h3>Fun Fact!</h3>

                <h4>Mangroves Have Their Own<br>"Snorkeling Equipment"</h4>

                <p>
                    Because the mud is poor in oxygen, mangroves have breathing roots
                    (pneumatophores) that stick out above the water surface like straws
                    to take in air.
                </p>
            </aside>

        </div>
    </div>
</section>

<section class="technology-tools"
    style="background-image: url('{{ asset('images/turbinsolution.png') }}');">
</section>

<section class="content-section">
    <div class="content-wrapper">

        <div class="content-item">
            <div class="text">
                <h3>Satellite Imagery & Remote Sensing</h3>
                <p>
                    We don't just plant trees and leave them. We embed a "digital nervous system" into the ecosystem to monitor the forest's heartbeat in real time. Mangrove forests are highly sensitive to hydrological changes; even small changes in salinity or water circulation can be fatal for young seedlings.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/peta.png') }}" alt="Map">
            </div>
        </div>

        <div class="content-item reverse">
            <div class="text">
                <h3>High-Resolution Hydro Map</h3>
                <p>
                    A High-Resolution Hydro Map is a detailed digital representation of river topography and the surrounding landscape, generated from advanced aerial surveys. In hydro turbine projects, these maps are vital for identifying precise elevation differences (head) and optimal water flow paths, ensuring turbines are placed at coordinates that maximize electricity generation while minimizing construction impacts on the river ecosystem.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/bin1.png') }}" alt="Coral AI">
            </div>
        </div>

        <div class="content-item">
            <div class="text">
                <h3>LiDAR Sensor (Light Detection and Ranging)</h3>
                <p>
                     This laser-based sensor technology, often mounted on drones, can penetrate dense forest canopies to scan the ground surface and river contours with millimeter accuracy. LiDAR data allows designers to create accurate 3D terrain models to engineer the most efficient penstock routes, avoid landslide-prone areas, and calculate energy potential without the need for tree removal for manual surveys.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/bin2.png') }}" alt="3D Reef">
            </div>
        </div>

          <div class="content-item reverse">
            <div class="text">
                <h3>Machine Learning & AI Analytics</h3>
                <p>
                    This serves as the digital "brain" of the system, utilizing intelligent algorithms to analyze historical rainfall data and river flow patterns in real-time. This AI predicts water discharge fluctuations to automate turbine valve adjustments for consistent energy efficiency, and is capable of detecting early vibration or temperature anomalies as a preventative maintenance warning before failures occur.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/bin3.png') }}" alt="Microfragmentation">
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
            <a href="#contact" class="btn btn-talk">Let’s Talk</a>

        </div>
    </section>

@endsection