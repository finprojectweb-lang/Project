@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/aboutus.css') }}">

@section('content')
<section class="hero"
    style="background-image: url('{{ asset('images/tanem.png') }}')">

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
                <img src="{{ asset('images/alik.jpg') }}" alt="Farhan Aldi Nugraha">
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
@endsection