@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/mangrove.css') }}">

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
            <h2>Mangrove Shield</h2>

            <p>
                Mangrove Shield acts as nature’s most efficient fortress against climate change. Known as 'Blue Carbon' powerhouses, these coastal forests have the unique ability to trap and store up to four times more carbon dioxide than terrestrial rainforests, locking it deep within their sediment for millennia. By focusing on the restoration of degraded coastal areas, this program ensures that vast amounts of greenhouse gases are absorbed from the atmosphere, making a direct and measurable impact on global temperature regulation.
            </p>

            <p>
                Beyond carbon sequestration, Mangrove Shield is about protecting life. The intricate root systems of these trees serve as a critical nursery for countless fish species and marine life, supporting the livelihoods of local fishermen. Furthermore, they provide a physical barrier that protects coastal communities from devastating erosion, high tides, and storm surges. Supporting this program means you are not just planting trees; you are safeguarding ecosystems and fortifying the shoreline for future generations.
            </p>
        </div>

        {{-- RIGHT IMAGE PANEL --}}
        <div class="mangrove-shield-gallery">
            <div class="gallery-large">
                <img src="/images/mangrove1.jpeg" alt="Mangrove underwater">
            </div>

            <div class="gallery-small">
                <img src="/images/mangrove2.jpeg" alt="Mangrove coast">
                <img src="/images/mangrove3.jpeg" alt="Mangrove roots">
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
    style="background-image: url('{{ asset('images/mangrovebg.png') }}');">
</section>


<section class="content-section">
    <div class="content-wrapper">

        {{-- 1 --}}
        <div class="content-item">
            <div class="text">
                <h3>Satellite Imagery & Remote Sensing</h3>
                <p>
                    We don't just plant trees and leave them. We embed a "digital nervous system" into the ecosystem to monitor the forest's heartbeat in real time. Mangrove forests are highly sensitive to hydrological changes; even small changes in salinity or water circulation can be fatal for young seedlings.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/peta.png') }}" alt="Satellite Monitoring">
            </div>
        </div>

        {{-- 2 --}}
        <div class="content-item reverse">
            <div class="text">
                <h3>Aerial Survey with LiDAR & Multispectral</h3>
                <p>
                    For precise carbon stock calculations, we fly Unmanned Aerial Vehicles (UAVs) equipped with LiDAR sensors and multispectral cameras. This technology scans the 3D structure of mangrove forests, measuring canopy height and biomass density down to the individual tree level, providing highly accurate data that far exceeds conventional manual survey methods.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/drone.png') }}" alt="AI Monitoring">
            </div>
        </div>

        {{-- 3 --}}
        <div class="content-item">
            <div class="text">
                <h3>IoT Environmental Sensors</h3>
                <p>
                   Healthy mangroves require the right environmental conditions. We deploy a network of Internet of Things (IoT) sensors at project sites to monitor critical parameters such as water salinity, soil pH, tides, and temperature. This data is sent directly to our dashboard to ensure the ecosystem remains conducive to maximum carbon sequestration.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/iotmangrove.png') }}" alt="3D Reef">
            </div>
        </div>

        {{-- 4 --}}
        <div class="content-item reverse">
            <div class="text">
                <h3>Artificial Intelligence (AI) Based Analysis</h3>
                <p>
                    Sustainable mangrove forests require proactive management. We utilize AI-driven image recognition and data analysis to continuously scan for signs of stress, disease, or illegal logging across our project sites. This automated monitoring transforms raw data into actionable intelligence, allowing us to intervene precisely when the ecosystem needs it most.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/AI.png') }}" alt="Microfragmentation">
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