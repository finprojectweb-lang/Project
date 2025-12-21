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


@endsection