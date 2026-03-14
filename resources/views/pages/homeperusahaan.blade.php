@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/homeperusahaan.css') }}">

@section('content')

<section class="dashboard">

<div class="container">

    <h2 class="dashboard-title">
        Welcome back, {{ Auth::user()->name ?? 'User' }} 🌿
    </h2>

    <p class="dashboard-subtitle">
        Monitor your environmental impact and manage your sustainability projects.
    </p>


    <!-- QUICK ACTION -->
    <div class="quick-actions">

        <a href="#" class="action-btn">Start New Project</a>
        <a href="#" class="action-btn">Calculate Carbon</a>
        <a href="#" class="action-btn">View Reports</a>

    </div>


    <!-- STATISTIC CARDS -->
    <div class="stats-grid">

        <div class="stat-card">
            <h3>Total Carbon Offset</h3>
            <p class="stat-number">12,450 kg</p>
        </div>

        <div class="stat-card">
            <h3>Active Projects</h3>
            <p class="stat-number">8</p>
        </div>

        <div class="stat-card">
            <h3>Trees Planted</h3>
            <p class="stat-number">3,200</p>
        </div>

        <div class="stat-card">
            <h3>Total Contribution</h3>
            <p class="stat-number">$4,500</p>
        </div>

    </div>


    <!-- IMPACT PROGRESS -->
    <div class="impact-section">

        <h3>Your Carbon Neutral Goal</h3>

        <div class="progress-bar">
            <div class="progress-fill" style="width:65%"></div>
        </div>

        <p class="progress-text">
            65% of your annual carbon neutral target achieved.
        </p>

    </div>


    <!-- PROJECT SECTION -->
    <div class="project-section">

        <h3>Your Recent Projects</h3>

        <div class="project-grid">

            <div class="project-card">
                <h4>Rainforest Restoration</h4>
                <p>Indonesia</p>
                <button class="btn-primary">View Details</button>
            </div>

            <div class="project-card">
                <h4>Ocean Coral Recovery</h4>
                <p>Philippines</p>
                <button class="btn-primary">View Details</button>
            </div>

            <div class="project-card">
                <h4>Mangrove Protection</h4>
                <p>Malaysia</p>
                <button class="btn-primary">View Details</button>
            </div>

        </div>

    </div>


    <!-- RECENT ACTIVITY -->
    <div class="activity-section">

        <h3>Recent Activity</h3>

        <ul class="activity-list">

            <li>🌳 150 Trees planted in Mangrove Protection Project</li>
            <li>🌍 Carbon calculation completed for March report</li>
            <li>🌱 New sustainability project created</li>

        </ul>

    </div>


    <!-- UPCOMING EVENTS -->
    <div class="event-section">

        <h3>Upcoming Environmental Events</h3>

        <div class="event-grid">

            <div class="event-card">
                <h4>Earth Day Campaign</h4>
                <p>22 April 2026</p>
            </div>

            <div class="event-card">
                <h4>Global Coral Restoration</h4>
                <p>10 May 2026</p>
            </div>

            <div class="event-card">
                <h4>Tree Planting Week</h4>
                <p>1 June 2026</p>
            </div>

        </div>

    </div>


</div>
</section>

@endsection