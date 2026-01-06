@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/terumbu.css') }}">

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
            <h2>Coral Guardian</h2>

            <p>
                The Coral Guardians program is dedicated to saving the 'rainforests of the sea' before they are lost forever. Coral reefs are vital to the ocean's health, supporting 25% of all marine biodiversity and playing a key role in the oceanic carbon cycle. However, rising sea temperatures and pollution threaten their survival. This initiative focuses on active reef restoration, utilizing resilient coral species to rebuild damaged structures and restore the vibrant underwater cities that are essential for oxygen production and marine food webs.
            </p>

            <p>
                Our approach combines scientific research with direct action. We deploy teams of divers to cultivate coral nurseries and transplant healthy fragments onto degraded reefs, effectively accelerating the natural recovery process. By joining Coral Guardians, you help create marine protected areas that allow biodiversity to flourish once again. A healthy reef means a healthy ocean, and a healthy ocean is crucial for stabilizing the Earth's climate and providing resources for millions of people worldwide.
            </p>
        </div>

        {{-- RIGHT IMAGE PANEL --}}
        <div class="mangrove-shield-gallery">
            <div class="gallery-large">
                <img src="/images/laut1.png" alt="Mangrove underwater">
            </div>

            <div class="gallery-small">
                <img src="/images/laut2.png" alt="Mangrove coast">
                <img src="/images/laut3.png" alt="Mangrove roots">
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

                <h4>Coral Reefs Are The<br>"Ocean's Invisible Shield"</h4>

                <p>
                    Because a healthy coral reef system acts as a massive natural breakwater that absorbs up to 97% of wave energy, protecting coastal communities from storms and erosion more effectively than man-made concrete sea walls.
                </p>
            </aside>

        </div>
    </div>
</section>

<section class="technology-tools"
    style="background-image: url('{{ asset('images/4karang.png') }}');">
</section>

<section class="content-section">
    <div class="content-wrapper">

        <div class="content-item">
            <div class="text">
                <h3>biorock/mineral accretion technology</h3>
                <p>
                    Biorock technology, formally known as Mineral Accretion Technology, revolutionizes marine conservation by applying a safe, low-voltage electrical current to submerged steel structures. This electrochemical process causes dissolved minerals in seawater to precipitate onto the metal frame, forming a hard layer of calcium carbonate that mimics natural reef substrate. This "electrified" foundation creates an ideal environment for corals, accelerating their growth rates by up to five times and significantly boosting their resilience against environmental stressors like rising ocean temperatures and acidification.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/biorock.png') }}" alt="Map">
            </div>
        </div>

        <div class="content-item reverse">
            <div class="text">
                <h3>AI-Based Monitoring & MRV Systems</h3>
                <p>
                    Coral planting is a restoration method where small coral fragments are attached to artificial bases, such as concrete plugs, and then placed back onto the ocean floor. Divers collect healthy fragments, secure them to the substrate, and position them in suitable areas with good light and stable water flow to support growth.
Over time, these fragments grow into larger colonies and help restore damaged reef ecosystems. This method increases biodiversity, provides habitat for marine life, and supports long-term reef recovery in conservation and carbon-offset projects.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/coral1.png') }}" alt="Coral AI">
            </div>
        </div>

        <div class="content-item">
            <div class="text">
                <h3>3D-Printed Reef Structures</h3>
                <p>
                     represent a cutting-edge approach to marine conservation, utilizing additive manufacturing to create highly intricate, customized artificial habitats that effectively mimic the complexity and porosity of natural coral reefs. These structures, often fabricated from sustainable materials like ceramic or limestone, are designed using digital models to provide an optimized, stable substrate for transplanted coral fragments. By offering textures and complexities superior to traditional artificial reefs, this technology significantly accelerates coral settlement, growth, and the recovery of damaged marine ecosystems, offering a scalable and precise solution to bolster biodiversity and coastal resilience against environmental threats.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/coral2.png') }}" alt="3D Reef">
            </div>
        </div>

          <div class="content-item reverse">
            <div class="text">
                <h3>Coral Microfragmentation</h3>
                <p>
                    Coral microfragmentation is a restoration technique where large coral colonies are cut into many small pieces to accelerate growth. These tiny fragments are placed on substrates or nursery grids, allowing each piece to grow rapidly and eventually merge into a larger, healthy colony.
This method is especially effective for slow-growing massive corals, helping restoration projects rebuild reef structure faster and support biodiversity.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/coral4.png') }}" alt="Microfragmentation">
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