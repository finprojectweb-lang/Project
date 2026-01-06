@extends('layouts.app')

@section('title', 'Our Values - Carbon Compensation Company')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap');

    :root {
        --nature-green: #26e0a6;
        --dark-forest: #0a4f3c;
        --soft-green: #8ff3d4;
        --neon-green: #00e676;
        --cream: #f0fdf8;
        --warm-white: #fafffe;
        --sage: #b3ffe5;
        --earth: #2d6b57;
        --medium-forest: #186b53;
        --light-gray: #e8f5f0;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Outfit', sans-serif;
        background: var(--cream);
        color: var(--dark-forest);
    }

    /* Smooth Hero with Image */
    .hero-wrapper {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
        position: relative;
        overflow: hidden;
    }

    .hero-left {
        display: flex;
        align-items: center;
        padding: 80px 60px 80px 100px;
        background: linear-gradient(135deg, var(--warm-white) 0%, var(--cream) 100%);
        position: relative;
    }

    /* Decorative blob shapes */
    .hero-left::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(38, 224, 166, 0.1) 0%, transparent 70%);
        border-radius: 60% 40% 70% 30% / 60% 30% 70% 40%;
        top: -100px;
        left: -150px;
        animation: morph 20s ease-in-out infinite;
        z-index: 1;
    }

    .hero-left::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(0, 230, 118, 0.12) 0%, transparent 70%);
        border-radius: 40% 60% 50% 50% / 60% 40% 60% 40%;
        bottom: -80px;
        right: -80px;
        animation: morph 15s ease-in-out infinite reverse;
        z-index: 1;
    }

    @keyframes morph {
        0%, 100% { 
            border-radius: 60% 40% 70% 30% / 60% 30% 70% 40%;
            transform: rotate(0deg) scale(1);
        }
        25% { 
            border-radius: 40% 60% 50% 50% / 40% 50% 60% 50%;
            transform: rotate(90deg) scale(1.1);
        }
        50% { 
            border-radius: 50% 50% 40% 60% / 50% 60% 40% 60%;
            transform: rotate(180deg) scale(0.9);
        }
        75% { 
            border-radius: 60% 40% 60% 40% / 50% 50% 50% 50%;
            transform: rotate(270deg) scale(1.05);
        }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        background: white;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--nature-green);
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(38, 224, 166, 0.15);
    }

    .hero-badge::before {
        content: '🌱';
        font-size: 1.2rem;
    }

    .hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(3.5rem, 7vw, 6rem);
        font-weight: 700;
        color: var(--dark-forest);
        line-height: 1.1;
        margin-bottom: 30px;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: var(--earth);
        line-height: 1.8;
        max-width: 550px;
        margin-bottom: 40px;
        font-weight: 400;
    }

    .hero-stats {
        display: flex;
        gap: 40px;
        flex-wrap: wrap;
    }

    .hero-stat-item {
        display: flex;
        flex-direction: column;
    }

    .hero-stat-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem;
        font-weight: 700;
        color: var(--nature-green);
        line-height: 1;
    }

    .hero-stat-label {
        font-size: 0.9rem;
        color: var(--earth);
        margin-top: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 500;
    }

    /* Hero Right with Image */
    .hero-right {
        position: relative;
        overflow: hidden;
        background: var(--dark-forest);
    }

    .hero-image-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .hero-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(22, 163, 74, 0.3) 0%, rgba(20, 83, 45, 0.5) 100%);
        mix-blend-mode: multiply;
    }

    /* Values Section */
    .values-section {
        padding: 120px 0;
        background: white;
        position: relative;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 60px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 80px;
    }

    .section-tag {
        display: inline-block;
        padding: 10px 20px;
        background: var(--sage);
        color: var(--dark-forest);
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        border-radius: 20px;
        margin-bottom: 20px;
    }

    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 700;
        color: var(--dark-forest);
        margin-bottom: 24px;
        line-height: 1.2;
    }

    .section-description {
        font-size: 1.2rem;
        color: var(--earth);
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.8;
    }

    /* Curved Cards Grid */
    .values-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        margin-bottom: 60px;
    }

    .value-card {
        background: white;
        border-radius: 40px;
        position: relative;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .value-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(38, 224, 166, 0.05) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.5s ease;
        border-radius: 40px;
        z-index: 1;
    }

    .value-card:hover::before {
        opacity: 1;
    }

    .value-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(38, 224, 166, 0.2);
        border-color: var(--soft-green);
    }

    .value-card-image-wrapper {
        position: relative;
        width: 100%;
        height: 240px;
        overflow: hidden;
        border-radius: 40px 40px 0 0;
    }

    .value-card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .value-card:hover .value-card-image {
        transform: scale(1.08);
    }

    .value-card-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.4) 100%);
    }

    .value-card-content {
        padding: 40px 40px 45px;
        position: relative;
        z-index: 2;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .value-card-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-forest);
        margin-bottom: 16px;
        line-height: 1.3;
    }

    .value-card-text {
        font-size: 1.05rem;
        color: var(--earth);
        line-height: 1.8;
        font-weight: 400;
    }

    /* Large featured card */
    .value-card-large {
        grid-column: span 2;
    }

    .value-card-large .value-card-image-wrapper {
        height: 300px;
    }

    .value-card-large .value-card-content {
        background: var(--dark-forest);
    }

    .value-card-large .value-card-title {
        color: white;
    }

    .value-card-large .value-card-text {
        color: rgba(255, 255, 255, 0.85);
    }

    /* Impact Section */
    .impact-section {
        padding: 100px 0;
        background: linear-gradient(135deg, var(--sage) 0%, var(--soft-green) 100%);
        border-radius: 60px;
        margin: 0 60px 120px;
        position: relative;
        overflow: hidden;
    }

    .impact-section::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }

    .impact-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 40px;
        position: relative;
        z-index: 2;
    }

    .impact-card {
        background: white;
        padding: 40px 30px;
        border-radius: 30px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .impact-card:hover {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 0 20px 40px rgba(38, 224, 166, 0.25);
    }

    .impact-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 4rem;
        font-weight: 700;
        color: var(--nature-green);
        line-height: 1;
        margin-bottom: 12px;
    }

    .impact-label {
        font-size: 1rem;
        color: var(--earth);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* CTA Section */
    .cta-section {
        padding: 0 0 0 0;
        background: white;
        margin: 0 0 0 0;
    }

    .cta-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 70vh;
        position: relative;
        overflow: hidden;
    }

    .cta-left {
        display: flex;
        align-items: center;
        padding: 80px 60px 80px 100px;
        background: linear-gradient(135deg, var(--dark-forest) 0%, var(--nature-green) 100%);
        position: relative;
        overflow: hidden;
    }

    /* Decorative elements for cta left */
    .cta-left::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(143, 243, 212, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        top: -100px;
        left: -100px;
        animation: morph 15s ease-in-out infinite;
    }

    .cta-left::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(0, 230, 118, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        bottom: -80px;
        right: -80px;
        animation: morph 18s ease-in-out infinite reverse;
    }

    .cta-content-wrapper {
        position: relative;
        z-index: 2;
        max-width: 600px;
    }

    .cta-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        color: white;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 24px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .cta-badge::before {
        content: '🤝';
        font-size: 1rem;
    }

    .cta-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 700;
        color: white;
        margin-bottom: 24px;
        line-height: 1.2;
    }

    .cta-text {
        font-size: 1.15rem;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.8;
        margin-bottom: 36px;
    }

    .cta-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 28px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 50px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-block;
    }

    .btn-primary {
        background: white;
        color: var(--dark-forest);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
        background: var(--sage);
        color: var(--dark-forest);
    }

    .btn-secondary {
        background: transparent;
        color: white;
        border: 2px solid white;
    }

    .btn-secondary:hover {
        background: white;
        color: var(--dark-forest);
        transform: translateY(-3px);
    }

    /* CTA Right - Image Side */
    .cta-right {
        position: relative;
        overflow: hidden;
    }

    .cta-image-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .cta-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .cta-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, 
            rgba(22, 163, 74, 0.3) 0%, 
            rgba(20, 83, 45, 0.1) 50%,
            transparent 100%);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .hero-wrapper {
            grid-template-columns: 1fr;
        }

        .hero-left {
            padding: 60px 40px;
        }

        .hero-right {
            min-height: 60vh;
        }

        .cta-wrapper {
            grid-template-columns: 1fr;
        }

        .cta-left {
            padding: 60px 40px;
        }

        .cta-right {
            min-height: 50vh;
        }

        .values-grid {
            grid-template-columns: 1fr;
        }

        .value-card-large {
            grid-column: span 1;
        }

        .impact-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .container {
            padding: 0 40px;
        }
    }

    @media (max-width: 768px) {
        .hero-left::before,
        .hero-left::after {
            width: 250px;
            height: 250px;
        }

        .cta-left::before,
        .cta-left::after {
            width: 200px;
            height: 200px;
        }

        .hero-stats {
            gap: 30px;
        }

        .hero-stat-number {
            font-size: 2.5rem;
        }

        .values-grid {
            gap: 24px;
        }

        .value-card-image-wrapper {
            height: 200px;
        }

        .value-card-large .value-card-image-wrapper {
            height: 240px;
        }

        .value-card-content {
            padding: 30px 30px 35px;
        }

        .impact-section {
            margin: 0 20px 80px;
            border-radius: 40px;
            padding: 60px 0;
        }

        .impact-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .btn {
            padding: 11px 24px;
            font-size: 0.8rem;
        }
    }

    /* Scroll animations */
    .fade-up {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .stagger-1 { transition-delay: 0.1s; }
    .stagger-2 { transition-delay: 0.2s; }
    .stagger-3 { transition-delay: 0.3s; }
    .stagger-4 { transition-delay: 0.4s; }
    .stagger-5 { transition-delay: 0.5s; }
    .stagger-6 { transition-delay: 0.6s; }
</style>

<!-- Hero Section -->
<section class="hero-wrapper">
    <div class="hero-left">
        <div class="hero-content">
            <div class="hero-badge">Our Core Values</div>
            <h1 class="hero-title">Values ​​That Shape Us</h1>
            <p class="hero-subtitle">
                Six fundamental principles guide every step we take in creating a sustainable future and a positive impact on the planet.
            </p>
            <div class="hero-stats">
                <div class="hero-stat-item">
                    <span class="hero-stat-number">500+</span>
                    <span class="hero-stat-label">Projects</span>
                </div>
                <div class="hero-stat-item">
                    <span class="hero-stat-number">50+</span>
                    <span class="hero-stat-label">Countries</span>
                </div>
                <div class="hero-stat-item">
                    <span class="hero-stat-number">1M+</span>
                    <span class="hero-stat-label">Ton CO₂</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="hero-right">
        <div class="hero-image-wrapper">
            <!-- Ganti URL dengan gambar Anda -->
            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=2013&auto=format&fit=crop" 
                 alt="Green Forest" 
                 class="hero-image">
            <div class="hero-image-overlay"></div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section">
    <div class="container">
        <div class="section-header fade-up">
            <span class="section-tag">What Drives Us</span>
            <h2 class="section-title">Principles We Hold Firmly</h2>
            <p class="section-description">
                Every value is a commitment we prove through real action 
                in every project and interaction with our stakeholders.
            </p>
        </div>

        <div class="values-grid">
            <div class="value-card fade-up stagger-1">
                <div class="value-card-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=2013&auto=format&fit=crop" 
                         alt="Sustainability" 
                         class="value-card-image">
                    <div class="value-card-image-overlay"></div>
                </div>
                <div class="value-card-content">
                    <h3 class="value-card-title">Sustainability</h3>
                    <p class="value-card-text">
                        We are committed to creating long-term solutions that not only reduce carbon footprint, 
                        but also build a healthy ecosystem for future generations.
                    </p>
                </div>
            </div>

            <div class="value-card fade-up stagger-2">
                <div class="value-card-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop" 
                         alt="Innovation" 
                         class="value-card-image">
                    <div class="value-card-image-overlay"></div>
                </div>
                <div class="value-card-content">
                    <h3 class="value-card-title">Innovation</h3>
                    <p class="value-card-text">
                        Continuously innovate in carbon compensation technology and environmental impact measurement methods 
                        to provide the most effective and efficient solutions.
                    </p>
                </div>
            </div>

            <div class="value-card fade-up stagger-3">
                <div class="value-card-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=2069&auto=format&fit=crop" 
                         alt="Integrity" 
                         class="value-card-image">
                    <div class="value-card-image-overlay"></div>
                </div>
                <div class="value-card-content">
                    <h3 class="value-card-title">Integrity</h3>
                    <p class="value-card-text">
                        Running business with the highest ethical standards, ensuring every carbon credit we offer 
                        is verified and has a real impact on the environment.
                    </p>
                </div>
            </div>

            <div class="value-card fade-up stagger-4">
                <div class="value-card-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?q=80&w=2073&auto=format&fit=crop" 
                         alt="Collaboration" 
                         class="value-card-image">
                    <div class="value-card-image-overlay"></div>
                </div>
                <div class="value-card-content">
                    <h3 class="value-card-title">Collaboration</h3>
                    <p class="value-card-text">
                        Working together with local communities, international organizations, and stakeholders 
                        to create a greater positive impact on our planet.
                    </p>
                </div>
            </div>

            <div class="value-card fade-up stagger-5">
                <div class="value-card-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=2070&auto=format&fit=crop" 
                         alt="Transparency" 
                         class="value-card-image">
                    <div class="value-card-image-overlay"></div>
                </div>
                <div class="value-card-content">
                    <h3 class="value-card-title">Transparency</h3>
                    <p class="value-card-text">
                        Providing clear data and reports about our projects, ensuring clients can track their contributions 
                        and the real impact created with independent verification.
                    </p>
                </div>
            </div>

            <div class="value-card value-card-large fade-up stagger-6">
                <div class="value-card-image-wrapper">
                    <img src="/images/tropical.jpeg" 
                         alt="Real Impact" 
                         class="value-card-image">
                    <div class="value-card-image-overlay"></div>
                </div>
                <div class="value-card-content">
                    <h3 class="value-card-title">Real Impact</h3>
                    <p class="value-card-text">
                        Focusing on measurable and sustainable outcomes, ensuring every action we take contributes significantly 
                        to combating global climate change. We measure impact not just in numbers, but in real changes on the ground 
                        that can be felt by local communities and the environment.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Impact Numbers -->
<section class="impact-section fade-up">
    <div class="container">
        <div class="impact-grid">
            <div class="impact-card">
                <div class="impact-number" data-target="500">0</div>
                <div class="impact-label">Active Projects</div>
            </div>
            <div class="impact-card">
                <div class="impact-number" data-target="1">0</div>
                <div class="impact-label">Million Ton CO₂</div>
            </div>
            <div class="impact-card">
                <div class="impact-number" data-target="50">0</div>
                <div class="impact-label">Partner Countries</div>
            </div>
            <div class="impact-card">
                <div class="impact-number" data-target="10">0</div>
                <div class="impact-label">Thousand Hectares</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-wrapper">
        <!-- Left Content -->
        <div class="cta-left">
            <div class="cta-content-wrapper">
                <div class="cta-badge">Join Our Mission</div>
                <h2 class="cta-title">Let's Create Impact Together</h2>
                <p class="cta-text">
                    Our values are not just words. They are a commitment we prove every day through real projects. 
                    Join us on the journey to create a greener and more sustainable future.
                </p>
                <div class="cta-buttons">
                    <a href="/contact" class="btn btn-primary">Contact us</a>
                    <a href="/projects" class="btn btn-secondary">View Projects</a>
                </div>
            </div>
        </div>
        
        <!-- Right Image -->
        <div class="cta-right">
            <div class="cta-image-wrapper">
                <!-- Ganti dengan gambar Anda -->
                <img src="/images/dnyata.jpeg" 
                     alt="Hands planting seedling" 
                     class="cta-image">
                <div class="cta-image-overlay"></div>
            </div>
        </div>
    </div>
</section>

<script>
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -80px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Counter Animation
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                element.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target;
                // Add suffixes
                if (target === 1) {
                    element.textContent = '1M+';
                } else if (target === 10) {
                    element.textContent = '10K+';
                } else if (target === 500) {
                    element.textContent = '500+';
                } else if (target === 50) {
                    element.textContent = '50+';
                }
            }
        };

        updateCounter();
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        // Observe fade elements
        document.querySelectorAll('.fade-up').forEach(el => {
            observer.observe(el);
        });

        // Animate counters when visible
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    entry.target.classList.add('counted');
                    animateCounter(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.impact-number').forEach(el => {
            counterObserver.observe(el);
        });
    });
</script>

@endsection