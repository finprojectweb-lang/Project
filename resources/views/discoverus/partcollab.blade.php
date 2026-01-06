@extends('layouts.app')

@section('title', 'Partners & Collaborations - Carbon Compensation Company')

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

    /* Hero Section */
    .partners-hero {
        min-height: 80vh;
        display: flex;
        align-items: center;
        padding: 120px 0 80px;
        background: linear-gradient(135deg, var(--warm-white) 0%, var(--cream) 100%);
        position: relative;
        overflow: hidden;
    }

    /* Decorative blobs */
    .partners-hero::before {
        content: '';
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(38, 224, 166, 0.1) 0%, transparent 70%);
        border-radius: 60% 40% 70% 30% / 60% 30% 70% 40%;
        top: -200px;
        right: -200px;
        animation: morph 20s ease-in-out infinite;
    }

    .partners-hero::after {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(0, 230, 118, 0.12) 0%, transparent 70%);
        border-radius: 40% 60% 50% 50% / 60% 40% 60% 40%;
        bottom: -100px;
        left: -100px;
        animation: morph 15s ease-in-out infinite reverse;
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

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 60px;
        position: relative;
        z-index: 2;
    }

    .hero-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
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
        content: '🤝';
        font-size: 1.2rem;
    }

    .hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(3rem, 8vw, 5.5rem);
        font-weight: 700;
        color: var(--dark-forest);
        line-height: 1.1;
        margin-bottom: 30px;
    }

    .hero-description {
        font-size: 1.3rem;
        color: var(--earth);
        line-height: 1.8;
        margin-bottom: 50px;
        font-weight: 400;
    }

    .hero-stats {
        display: flex;
        gap: 60px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .hero-stat {
        text-align: center;
    }

    .hero-stat-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--nature-green);
        line-height: 1;
        display: block;
        margin-bottom: 10px;
    }

    .hero-stat-label {
        font-size: 1rem;
        color: var(--earth);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 500;
    }

    /* Partners Grid Section */
    .partners-grid-section {
        padding: 100px 0;
        background: white;
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
        font-size: clamp(2.5rem, 5vw, 4rem);
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

    /* Partner Cards Grid */
    .partners-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 32px;
        margin-bottom: 60px;
    }

    .partner-card {
        background: var(--warm-white);
        border-radius: 30px;
        padding: 50px 40px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .partner-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(38, 224, 166, 0.05) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .partner-card:hover::before {
        opacity: 1;
    }

    .partner-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(38, 224, 166, 0.2);
        border-color: var(--soft-green);
        background: white;
    }

    .partner-logo {
        height: 80px;
        width: auto;
        max-width: 180px;
        object-fit: contain;
        margin-bottom: 30px;
        filter: grayscale(100%);
        opacity: 0.7;
        transition: all 0.4s ease;
    }

    .partner-card:hover .partner-logo {
        filter: grayscale(0%);
        opacity: 1;
        transform: scale(1.05);
    }

    .partner-name {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--dark-forest);
        margin-bottom: 12px;
    }

    .partner-category {
        font-size: 0.9rem;
        color: var(--earth);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 500;
    }

    /* Collaboration Types Section */
    .collaboration-section {
        padding: 100px 0;
        background: linear-gradient(135deg, var(--sage) 0%, var(--soft-green) 100%);
    }

    .collaboration-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 32px;
    }

    .collaboration-card {
        background: white;
        padding: 45px 40px;
        border-radius: 30px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .collaboration-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(38, 224, 166, 0.25);
    }

    .collaboration-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--nature-green), var(--neon-green));
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        margin-bottom: 24px;
        box-shadow: 0 8px 24px rgba(38, 224, 166, 0.3);
        transition: all 0.4s ease;
    }

    .collaboration-card:hover .collaboration-icon {
        transform: rotate(-5deg) scale(1.1);
        border-radius: 28px;
    }

    .collaboration-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark-forest);
        margin-bottom: 16px;
    }

    .collaboration-description {
        font-size: 1.05rem;
        color: var(--earth);
        line-height: 1.7;
    }

    /* Impact Numbers */
    .impact-banner {
        padding: 80px 0;
        background: var(--dark-forest);
        position: relative;
        overflow: hidden;
    }

    .impact-banner::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(143, 243, 212, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }

    .impact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        position: relative;
        z-index: 2;
    }

    .impact-item {
        text-align: center;
    }

    .impact-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 4rem;
        font-weight: 700;
        color: var(--soft-green);
        line-height: 1;
        margin-bottom: 12px;
    }

    .impact-label {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 500;
    }

    /* Testimonial Section */
    .testimonial-section {
        padding: 100px 0;
        background: white;
    }

    .testimonial-card {
        background: var(--warm-white);
        padding: 60px 50px;
        border-radius: 40px;
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }

    .quote-icon {
        font-size: 4rem;
        color: var(--soft-green);
        opacity: 0.3;
        line-height: 1;
        margin-bottom: 20px;
    }

    .testimonial-text {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem;
        color: var(--dark-forest);
        line-height: 1.8;
        margin-bottom: 30px;
        font-style: italic;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .author-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--nature-green), var(--soft-green));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        font-weight: 700;
    }

    .author-info h4 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark-forest);
        margin-bottom: 4px;
    }

    .author-info p {
        font-size: 0.95rem;
        color: var(--earth);
    }

    /* CTA Section */
    .cta-section {
        padding: 100px 60px;
        background: linear-gradient(135deg, var(--dark-forest) 0%, var(--nature-green) 100%);
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(143, 243, 212, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        top: -100px;
        left: -100px;
        animation: morph 15s ease-in-out infinite;
    }

    .cta-content {
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
        position: relative;
        z-index: 2;
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
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.8;
        margin-bottom: 40px;
    }

    .cta-button {
        padding: 16px 40px;
        background: white;
        color: var(--dark-forest);
        text-decoration: none;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
        background: var(--sage);
        color: var(--dark-forest);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .partners-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 30px;
        }

        .partners-hero {
            min-height: 70vh;
            padding: 80px 0 60px;
        }

        .hero-stats {
            gap: 40px;
        }

        .hero-stat-number {
            font-size: 3rem;
        }

        .partners-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .collaboration-grid {
            grid-template-columns: 1fr;
        }

        .impact-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .impact-number {
            font-size: 3rem;
        }

        .testimonial-card {
            padding: 40px 30px;
            border-radius: 30px;
        }

        .testimonial-text {
            font-size: 1.3rem;
        }

        .cta-section {
            padding: 80px 30px;
        }
    }

    /* Animations */
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
</style>

<!-- Hero Section -->
<section class="partners-hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Our Partnerships</div>
            <h1 class="hero-title">Partners & Collaborations</h1>
            <p class="hero-description">
                Building a sustainable future together through strategic collaborations
with global companies, organizations, and communities that share our vision.
            </p>
            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-number">11+</span>
                    <span class="hero-stat-label">Strategic Partners</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-number">50+</span>
                    <span class="hero-stat-label">Countries</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-number">500+</span>
                    <span class="hero-stat-label">Joint Projects</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partners Grid -->
<section class="partners-grid-section">
    <div class="container">
        <div class="section-header fade-up">
            <span class="section-tag">Trusted By</span>
            <h2 class="section-title">Our Strategic Partners</h2>
            <p class="section-description">
                Working with leading global companies to create a positive impact on the environment and society.
            </p>
        </div>

        <div class="partners-grid">
            <!-- Amazon -->
            <div class="partner-card fade-up stagger-1">
                <img src="{{ asset('images/partners/amazon.webp') }}" 
                     alt="Amazon" 
                     class="partner-logo">
                <h3 class="partner-name">Amazon</h3>
                <p class="partner-category">Technology & Logistics</p>
            </div>

            <!-- Astra -->
            <div class="partner-card fade-up stagger-1">
                <img src="{{ asset('images/partners/astra.png') }}" 
                     alt="Astra" 
                     class="partner-logo">
                <h3 class="partner-name">Astra</h3>
                <p class="partner-category">Automotive & Industry</p>
            </div>

            <!-- Garuda -->
            <div class="partner-card fade-up stagger-2">
                <img src="{{ asset('images/partners/garuda.png') }}" 
                     alt="Garuda Indonesia" 
                     class="partner-logo">
                <h3 class="partner-name">Garuda Indonesia</h3>
                <p class="partner-category">Aviation</p>
            </div>

            <!-- Google -->
            <div class="partner-card fade-up stagger-2">
                <img src="{{ asset('images/partners/google.png') }}" 
                     alt="Google" 
                     class="partner-logo">
                <h3 class="partner-name">Google</h3>
                <p class="partner-category">Technology</p>
            </div>

            <!-- GoTo -->
            <div class="partner-card fade-up stagger-3">
                <img src="{{ asset('images/partners/goto.png') }}" 
                     alt="GoTo" 
                     class="partner-logo">
                <h3 class="partner-name">GoTo</h3>
                <p class="partner-category">Technology & Mobility</p>
            </div>

            <!-- Microsoft -->
            <div class="partner-card fade-up stagger-3">
                <img src="{{ asset('images/partners/microsoft.png') }}" 
                     alt="Microsoft" 
                     class="partner-logo">
                <h3 class="partner-name">Microsoft</h3>
                <p class="partner-category">Technology</p>
            </div>

            <!-- Nestle -->
            <div class="partner-card fade-up stagger-4">
                <img src="{{ asset('images/partners/nestle.png') }}" 
                     alt="Nestle" 
                     class="partner-logo">
                <h3 class="partner-name">Nestlé</h3>
                <p class="partner-category">Food & Beverage</p>
            </div>

            <!-- Netflix -->
            <div class="partner-card fade-up stagger-4">
                <img src="{{ asset('images/partners/netflix.png') }}" 
                     alt="Netflix" 
                     class="partner-logo">
                <h3 class="partner-name">Netflix</h3>
                <p class="partner-category">Entertainment</p>
            </div>

            <!-- Nike -->
            <div class="partner-card fade-up stagger-1">
                <img src="{{ asset('images/partners/nike.png') }}" 
                     alt="Nike" 
                     class="partner-logo">
                <h3 class="partner-name">Nike</h3>
                <p class="partner-category">Sports & Apparel</p>
            </div>

            <!-- Pertamina -->
            <div class="partner-card fade-up stagger-2">
                <img src="{{ asset('images/partners/pertamina.png') }}" 
                     alt="Pertamina" 
                     class="partner-logo">
                <h3 class="partner-name">Pertamina</h3>
                <p class="partner-category">Energy</p>
            </div>

            <!-- Spotify -->
            <div class="partner-card fade-up stagger-3">
                <img src="{{ asset('images/partners/spotify.png') }}" 
                     alt="Spotify" 
                     class="partner-logo">
                <h3 class="partner-name">Spotify</h3>
                <p class="partner-category">Entertainment & Media</p>
            </div>
        </div>
    </div>
</section>

<!-- Collaboration Types -->
<section class="collaboration-section">
    <div class="container">
        <div class="section-header fade-up">
            <span class="section-tag">How We Collaborate</span>
            <h2 class="section-title">Types of Collaboration</h2>
            <p class="section-description">
                Various forms of partnerships we offer to achieve 
                shared sustainability goals.
            </p>
        </div>

        <div class="collaboration-grid">
            <div class="collaboration-card fade-up stagger-1">
                <div class="collaboration-icon">🌱</div>
                <h3 class="collaboration-title">Carbon Offset Programs</h3>
                <p class="collaboration-description">
                    Verified and measurable carbon offset programs to reduce your company's carbon footprint.
                </p>
            </div>

            <div class="collaboration-card fade-up stagger-2">
                <div class="collaboration-icon">🤝</div>
                <h3 class="collaboration-title">Strategic Partnerships</h3>
                <p class="collaboration-description">
                    Long-term partnerships in developing sustainable projects 
                    and green technology innovation.
                </p>
            </div>

            <div class="collaboration-card fade-up stagger-3">
                <div class="collaboration-icon">🎓</div>
                <h3 class="collaboration-title">Education & Training</h3>
                <p class="collaboration-description">
                    Education and training programs to enhance environmental awareness 
                    in your organization.
                </p>
            </div>

            <div class="collaboration-card fade-up stagger-4">
                <div class="collaboration-icon">💡</div>
                <h3 class="collaboration-title">Research & Innovation</h3>
                <p class="collaboration-description">
                    Research collaboration to develop innovative solutions in 
                    climate change mitigation.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Impact Numbers -->
<section class="impact-banner">
    <div class="container">
        <div class="impact-grid fade-up">
            <div class="impact-item">
                <div class="impact-number" data-target="1">0</div>
                <div class="impact-label">Million Tons CO₂ Offset</div>
            </div>
            <div class="impact-item">
                <div class="impact-number" data-target="500">0</div>
                <div class="impact-label">Joint Projects</div>
            </div>
            <div class="impact-item">
                <div class="impact-number" data-target="50">0</div>
                <div class="impact-label">Countries Reached</div>
            </div>
            <div class="impact-item">
                <div class="impact-number" data-target="10">0</div>
                <div class="impact-label">Thousand Hectares</div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial -->
<section class="testimonial-section">
    <div class="container">
        <div class="testimonial-card fade-up">
            <div class="quote-icon">"</div>
            <p class="testimonial-text">
                Partnership with this carbon compensation company has helped us 
                achieve our net-zero emissions target faster than we anticipated. 
                Their professionalism and commitment to sustainability is exceptional.
            </p>
            <div class="testimonial-author">
                <div class="author-avatar">S</div>
                <div class="author-info">
                    <h4>Sarah Johnson</h4>
                    <p>Sustainability Director, Global Tech Corp</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="cta-content">
        <h2 class="cta-title">Join Us as a Partner</h2>
        <p class="cta-text">
            Let's work together to create a positive impact for our planet. 
            Contact us to start strategic collaboration.
        </p>
        <a href="/contact" class="cta-button">Contact Us</a>
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