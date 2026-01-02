@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/garbage.css') }}">

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
            <h2>Waste to Worth</h2>

            <p>
                Waste to Worth transforms the global waste crisis into a sustainable opportunity for carbon reduction. When organic and plastic waste ends up in landfills, it decomposes anaerobically to release massive amounts of methane—a greenhouse gas over 25 times more potent than CO2 at trapping heat. Our program intercepts this waste at the source, diverting it from landfills and preventing these harmful emissions. We champion a circular economy where materials are kept in use, reducing the need for new raw material extraction and lowering the industrial carbon footprint.
            </p>

            <p>
                We collaborate with local communities to establish waste management systems that sort, process, and repurpose refuse into valuable resources. Organic waste is converted into nutrient-rich compost or renewable energy, while plastics are recycled into new products or construction materials. Your contribution to Waste to Worth drives this infrastructure, turning pollution into potential. It is a dual-impact solution: you are significantly offsetting your carbon footprint while simultaneously cleaning up the environment and creating green jobs.
            </p>
        </div>

        {{-- RIGHT IMAGE PANEL --}}
        <div class="mangrove-shield-gallery">
            <div class="gallery-large">
                <img src="/images/garbage1.png" alt="Mangrove underwater">
            </div>

            <div class="gallery-small">
                <img src="/images/garbage2.png" alt="Mangrove coast">
                <img src="/images/garbage3.png" alt="Mangrove roots">
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
    style="background-image: url('{{ asset('images/sampah4.png') }}');">

    <!-- Center Title -->
    <h2 class="tech-title">Technology & Tools</h2>

    <!-- Bottom Overlay Content -->
    <div class="tech-bottom">
        <div class="tech-item">Reducing Waste at the Source</div>
        <div class="tech-item">Sorting and Identifying Valuable Materials</div>
        <div class="tech-item">Recycling and Processing</div>
        <div class="tech-item">Creating New Products</div>
    </div>

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
                <h3>Reducing Waste at the Source</h3>
                <p>
                    Reducing waste at the source is the most effective environmental strategy because it stops trash from being created in the first place, rather than just managing it after the fact. It focuses on "upstream" solutions like designing products with minimal packaging, choosing durable and repairable items over disposable ones, and adopting reuse systems like refillable containers. By preventing waste generation at the design and manufacturing stages, we not only decrease the burden on landfills and recycling centers but also significantly lower the carbon emissions associated with extracting raw materials, producing goods, and transporting waste.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/reduce1.png') }}" alt="Coral AI">
            </div>
        </div>

        <div class="content-item">
            <div class="text">
                <h3>Sorting and Identifying Valuable Materials</h3>
                <p>
                     Sorting and identifying valuable materials is the critical bridge between consumption and the circular economy, transforming what is often viewed as "trash" into high-quality manufacturing resources. This process relies on meticulous categorization—often combining advanced optical sensors with manual selection—to distinguish between specific polymer types, various grades of paper, and different metals, ensuring that contaminants are removed before processing. By accurately recovering these valuable inputs rather than sending them to landfills, we successfully close the production loop, drastically reducing the energy-intensive demand for virgin raw materials and minimizing the destructive environmental impact of new extraction.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/reduce2.png') }}" alt="3D Reef">
            </div>
        </div>

          <div class="content-item reverse">
            <div class="text">
                <h3>Creating New Products</h3>
                <p>
                    Creating new products from recycled content is the vital final step that effectively "closes the loop" in the circular economy, proving that recovered materials are not waste but valuable resources waiting for a second life. This stage involves innovative manufacturing processes that transform processed recyclables—such as plastic pellets, reclaimed glass, or paper pulp—into high-quality goods ranging from sustainable clothing and furniture to new packaging. By prioritizing post-consumer recycled content over virgin resources, manufacturers significantly slash energy consumption and carbon emissions, while simultaneously driving market demand for recycling programs and reducing the strain on natural ecosystems.
                </p>
            </div>
            <div class="image">
                <img src="{{ asset('images/reduce3.png') }}" alt="Microfragmentation">
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