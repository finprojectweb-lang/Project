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
    style="background-image: url('{{ asset('images/mangrovetech.png') }}');">

    <!-- Center Title -->
    <h2 class="tech-title">Technology & Tools</h2>

    <!-- Bottom Overlay Content -->
    <div class="tech-bottom">
        <div class="tech-item">High Resolution</div>
        <div class="tech-item">Lidar Sensor</div>
        <div class="tech-item">Environmental Park</div>
        <div class="tech-item">Machine Learning & AI Analytics</div>
        <div class="tech-item">Ground-Truthing</div>
    </div>

</section>

<section class="tech-details-section">
    <div class="tech-details-container">

        {{-- Satellite Imagery --}}
        <div class="tech-row">
            <div class="tech-image boxed">
                <img src="{{ asset('images/alik.jpg') }}" alt="Satellite Imagery">
            </div>
            <div class="tech-text">
                <h3>Satellite Imagery & Remote Sensing</h3>
                <p>
                    We don't just plant trees and leave them. We embed a
                    "digital nervous system" into the ecosystem to monitor the
                    forest's heartbeat in real time. Mangrove forests are
                    highly sensitive to hydrological changes; even small
                    changes in salinity or water circulation can be fatal for
                    young seedlings.
                </p>
            </div>
        </div>

        {{-- LiDAR --}}
        <div class="tech-row reverse">
            <div class="tech-text">
                <h3>Aerial Survey with LiDAR & Multispectral</h3>
                <p>
                    For precise carbon stock calculations, we fly Unmanned
                    Aerial Vehicles (UAVs) equipped with LiDAR sensors and
                    multispectral cameras. This technology scans the 3D
                    structure of mangrove forests, measuring canopy height and
                    biomass density down to the individual tree level.
                </p>
            </div>
            <div class="tech-image boxed">
                <img src="{{ asset('images/alik.jpg') }}" alt="LiDAR Drone">
            </div>
        </div>

        {{-- IoT --}}
        <div class="tech-row">
            <div class="tech-image boxed">
                <img src="{{ asset('images/alik.jpg') }}" alt="IoT Sensors">
            </div>
            <div class="tech-text">
                <h3>IoT Environmental Sensors</h3>
                <p>
                    Healthy mangroves require the right environmental
                    conditions. We deploy a network of Internet of Things (IoT)
                    sensors to monitor water salinity, soil pH, tides, and
                    temperature. This data is streamed directly to our
                    dashboard for continuous monitoring.
                </p>
            </div>
        </div>

        {{-- AI --}}
        <div class="tech-row reverse">
            <div class="tech-text">
                <h3>Artificial Intelligence (AI) Based Analysis</h3>
                <p>
                    Sustainable mangrove forests require proactive management.
                    We utilize AI-driven image recognition and data analysis to
                    detect early signs of stress, disease, or illegal logging,
                    enabling rapid intervention when the ecosystem needs it
                    most.
                </p>
            </div>
            <div class="tech-image boxed">
                <img src="{{ asset('images/alik.jpg') }}" alt="AI Analysis">
            </div>
        </div>

    </div>
</section>


@endsection