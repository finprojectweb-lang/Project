@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

@section('content')
    <section class="hero-section">
      <div class="hero-content d-flex align-items-center justify-content-center text-center">
            <div class="container hero-inner">

                <!-- Judul -->
                <h1 class="hero-title">
                    Restore <span class="text-highlight">Nature</span>, One Offset at a Time.
                </h1>

                <!-- Subtitle -->
                <p class="hero-subtitle">
                    Heal the earth and breathe easier knowing you are part of the <br> solution.
                </p>

                <!-- Card Kutipan -->
                <div class="hero-quote mx-auto">
                    <p>
                        We are borrowing this planet from our children. Let’s make sure we return it
                        better than we found it. Your contribution today is a promise of a cleaner,
                        brighter tomorrow for the ones you love.
                    </p>
                    <br>
                    <small>
                        #NatureLovers #SustainableFuture #EarthGuardian
                    </small>
                </div>

                <!-- Tombol -->
                <div class="hero-buttons d-flex justify-content-center gap-3 mt-4">
                    <a href="#" class="btn-green">
                        Get Started
                    </a>
                    <a href="#" class="btn-outline-green">
                        Calculate Your Carbon
                    </a>
                </div>

            </div>
        </div>
    </section>
@endsection