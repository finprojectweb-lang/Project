@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/aboutus.css') }}">

@section('content')
<section class="hero" style="background-image: url('{{ asset("images/tanem.png") }}');">
 <div class="hero-text-wrapper">
        <div class="hero-text-bg">
            <h1>
                <span class="green-text">Restore the Coast, Reduce Your Carbon Footprint</span>
            </h1>

            <p>
                A transparent carbon offset platform focused on
                mangrove forest rehabilitation in Indonesia.
            </p>
        </div>
    </div>
</section>

<section class="vision-mission">
    <div class="vm-container">

        <!-- LEFT IMAGE -->
        <div class="vm-image">
            <img src="{{ asset('images/nulli.png') }}" alt="Vision Image">
        </div>

        <!-- RIGHT TEXT -->
        <div class="vm-text">
            <h3>Vision</h3>
            <p>
                Realizing a future where economic growth and ecosystem sustainability
                go hand in hand for a more resilient planet.
            </p>

            <h3>Mission</h3>
            <p>
                Empowering every individual and institution with easy access to
                measurable climate action, from carbon emission reduction to
                active participation in global environmental restoration projects.
            </p>
        </div>

    </div>
</section>

<section class="founding-team">
    <div class="ft-container">

        <h2>Founding Team</h2>
        <p class="ft-desc">
            NulliCarbon is powered by a dedicated collective of innovators, tech experts,
            and sustainability advocates committed to a single purpose: securing a greener
            tomorrow. Guided by the foresight of our founders, we stand united in our mission
            to accelerate measurable climate action.
        </p>

        <div class="ft-cards">

            <div class="ft-card">
                <img src="{{ asset('images/aan.jpg') }}" alt="Farhan Aldi Nugraha">
                <p>Farhan Aldi Nugraha</p>
            </div>

            <div class="ft-card">
                <img src="{{ asset('images/alik.jpg') }}" alt="Muhammad Fadhil Malikul Sholeh">
                <p>Muhammad Fadhil<br>Malikul Sholeh</p>
            </div>

            <div class="ft-card">
                <img src="{{ asset('images/alik.jpg') }}" alt="Luthfi Ardhika Akbar">
                <p>Luthfi Ardhika Akbar</p>
            </div>

            <div class="ft-card">
                <img src="{{ asset('images/alik.jpg') }}" alt="Dr. Ariela Raditya Fadlur Rahman">
                <p>
                    Dr. Ariela Raditya Fadlur Rahman<br>
                    <span>S.Kom, M.Kom</span>
                </p>
            </div>

        </div>

    </div>
</section>

<section class="future-section">
    <div class="future-container">
        <h2>NulliCarbon: Paving the Future, Transforming Indonesia's Climate</h2>

        <div class="future-grid">
            <div class="future-card">
                <h4>Founded on Accessible Climate Action</h4>
                <p>
                    NulliCarbon was established with the core purpose of empowering every
                    individual and institution by providing easy access to climate
                    mitigation solutions, fulfilling our Mission.
                </p>
            </div>

            <div class="future-card">
                <h4>Driving Resilient Economic Growth</h4>
                <p>
                    Our solutions are designed to ensure that economic growth goes hand
                    in hand with ecosystem sustainability, creating a pathway toward a
                    more resilient planet (Vision).
                </p>
            </div>

            <div class="future-card">
                <h4>Integrating Reduction and Restoration</h4>
                <p>
                    We offer a comprehensive toolkit that enables clients not only to
                    achieve carbon emission reduction but also to engage in active
                    participation in global environmental restoration projects (Mission).
                </p>
            </div>

            <div class="future-card">
                <h4>Strategic Partnerships for Planetary Resilience</h4>
                <p>
                    Collaborating with key industry players to build climate-resilient
                    business practices, directly supporting the Vision of a more
                    resilient planet.
                </p>
            </div>

            <div class="future-card">
                <h4>Technology for Measurable Impact</h4>
                <p>
                    Utilizing advanced AI and data analytics to provide transparent and
                    accurate measurement of carbon impact, ensuring every climate action
                    is measurable as defined in our Mission.
                </p>
            </div>

            <div class="future-card">
                <h4>Empowering Every Individual and Institution</h4>
                <p>
                    Providing intuitive and powerful dashboards that put decision-making
                    power in the hands of every individual and institution to drive
                    meaningful change (Mission).
                </p>
            </div>
        </div>
    </div>
</section>

<section class="image-slider-section">
    <div class="image-slider" id="slider">
        <img src="{{ asset('images/tanemkarang.png') }}" alt="">
        <img src="{{ asset('images/OIP (1).webp') }}" alt="">
        <img src="{{ asset('images/mangroveijo.webp') }}" alt="">
        <img src="{{ asset('images/terumbu.jpg') }}" alt="">
        <img src="{{ asset('images/download (1).webp') }}" alt="">
        <img src="{{ asset('images/terumbu.jpg') }}" alt="">
    </div>
</section>
<section class="info-section">

    <!-- ATAS: 2 CARD -->
    <div class="info-top">
        <div class="info-card text-card">
            <h3>Mission Focused on Education and Engagement</h3>
            <p>
                Advocating environmental literacy and active participation
                through hands-on education, empowering individuals and institutions
                to take measurable climate action.
            </p>
        </div>

        <div class="info-card image-card">
            <img src="{{ asset('images/indonesia.png') }}" alt="Indonesia">
        </div>
    </div>

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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById("slider");
    let scrollAmount = 0;

    function autoSlide() {
        scrollAmount += 1; // kecepatan (besar = lebih cepat)
        slider.scrollLeft = scrollAmount;

        if (scrollAmount >= slider.scrollWidth - slider.clientWidth) {
            scrollAmount = 0;
        }
    }

    setInterval(autoSlide, 25); // smooth
});
</script>
@endsection