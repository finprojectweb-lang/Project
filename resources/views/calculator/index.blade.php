@extends('layouts.app')

@section('content')
<style>
/* SECTION */
.eco-orbit {
    padding: 150px 20px;
    background:
        radial-gradient(circle at top, #1a1f2b, #0b0f19);
    color: white;
    font-family: 'Inter', sans-serif;
}

/* HEADER */
.eco-header {
    text-align: center;
    margin-bottom: 80px;
}

.eco-header h2 {
    font-size: 2.9rem;
    font-weight: 800;
    background: linear-gradient(90deg, #00f5d4, #4cc9f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.eco-header p {
    opacity: .7;
    margin-top: 10px;
    font-size: 1.05rem;
}

/* GRID */
.eco-grid {
    max-width: 1050px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 48px;
}

/* CARD */
.eco-card {
    position: relative;
    padding: 46px 28px;
    border-radius: 36px;
    background: #121726;
    box-shadow:
        10px 10px 30px rgba(0,0,0,.6),
        -10px -10px 30px rgba(255,255,255,.02);
    transition: all .55s cubic-bezier(.4,0,.2,1);
    text-decoration: none;
    color: white;
}

/* ICON */
.eco-icon {
    width: 92px;
    height: 92px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.8rem;
    margin-bottom: 28px;
    background: rgba(255,255,255,.05);
    transition: all .6s ease;
}

/* TEXT */
.eco-card h4 {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 8px;
}

.eco-card span {
    font-size: .95rem;
    opacity: .7;
}

/* HOVER EFFECT */
.eco-card:hover {
    transform: translateY(-22px);
    box-shadow:
        0 30px 80px rgba(0,0,0,.9);
}

.eco-card:hover .eco-icon {
    transform: scale(1.15) rotate(8deg);
}

/* NEON ACCENTS */
.c1 .eco-icon { color: #00f5d4; box-shadow: 0 0 25px #00f5d4; }
.c2 .eco-icon { color: #4cc9f0; box-shadow: 0 0 25px #4cc9f0; }
.c3 .eco-icon { color: #f9c74f; box-shadow: 0 0 25px #f9c74f; }
.c4 .eco-icon { color: #f28482; box-shadow: 0 0 25px #f28482; }

/* MOBILE */
@media (max-width: 640px) {
    .eco-header h2 {
        font-size: 2.2rem;
    }

    .eco-card {
        padding: 38px 24px;
    }
}
</style>

<div class="eco-orbit">
    <div class="eco-header">
        <h2>Track Your Environmental Impact</h2>
        <p>Every choice leaves a footprint</p>
    </div>

    <div class="eco-grid">

        <a href="{{ route('calc.housing') }}" class="eco-card c1">
            <div class="eco-icon">
                <i class="bi bi-lightning-charge-fill"></i>
            </div>
            <h4>Energy</h4>
            <span>Home & electricity usage</span>
        </a>

        <a href="{{ route('calc.transport') }}" class="eco-card c2">
            <div class="eco-icon">
                <i class="bi bi-geo-alt-fill"></i>
            </div>
            <h4>Mobility</h4>
            <span>Daily travel emissions</span>
        </a>

        <a href="{{ route('calc.food') }}" class="eco-card c3">
            <div class="eco-icon">
                <i class="bi bi-flower1"></i>
            </div>
            <h4>Food</h4>
            <span>Diet & consumption</span>
        </a>

        <a href="{{ route('calc.expenditure') }}" class="eco-card c4">
            <div class="eco-icon">
                <i class="bi bi-wallet2"></i>
            </div>
            <h4>Lifestyle</h4>
            <span>Shopping & habits</span>
        </a>

    </div>
</div>
@endsection