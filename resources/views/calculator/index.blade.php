@extends('layouts.app')

@section('content')
<style>
.eco-calc {
    padding: 120px 20px;
    background: linear-gradient(180deg, #f4fdf9, #e8f6ef);
    text-align: center;
}

.eco-title {
    font-size: 2.6rem;
    font-weight: 800;
    color: #064e3b;
}

.eco-sub {
    margin: 12px 0 50px;
    color: #475569;
}

.eco-grid {
    max-width: 1100px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 36px;
}

.eco-card {
    border-radius: 28px;
    padding: 36px 24px;
    text-decoration: none;
    color: white;
    position: relative;
    transition: all 0.35s ease;
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
}

.eco-card:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 30px 60px rgba(0,0,0,.25);
}

/* ICON */
.eco-icon {
    width: 82px;
    height: 82px;
    margin: auto;
    border-radius: 24px;
    background: rgba(255,255,255,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.8rem;
    margin-bottom: 20px;
}

/* TEXT */
.eco-card h4 {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 6px;
}

.eco-card span {
    font-size: 0.9rem;
    opacity: 0.9;
}

/* VARIANTS */
.green  { background: linear-gradient(135deg,#10b981,#047857); }
.blue   { background: linear-gradient(135deg,#38bdf8,#0369a1); }
.orange { background: linear-gradient(135deg,#fb923c,#c2410c); }
.purple { background: linear-gradient(135deg,#a78bfa,#6d28d9); }

/* MOBILE */
@media (max-width: 640px) {
    .eco-title { font-size: 2rem; }
    .eco-card { padding: 30px 20px; }
}

</style>

<div class="eco-calc">
    <h2 class="eco-title">Carbon Calculator</h2>
    <p class="eco-sub">Choose a category to measure your impact</p>

    <div class="eco-grid">

        <a href="{{ route('calc.housing') }}" class="eco-card green">
            <div class="eco-icon">
                <i class="bi bi-house-fill"></i>
            </div>
            <h4>Housing</h4>
            <span>Electricity & Home Energy</span>
        </a>

        <a href="{{ route('calc.transport') }}" class="eco-card blue">
            <div class="eco-icon">
                <i class="bi bi-car-front-fill"></i>
            </div>
            <h4>Transport</h4>
            <span>Daily Travel & Commute</span>
        </a>

        <a href="{{ route('calc.food') }}" class="eco-card orange">
            <div class="eco-icon">
                <i class="bi bi-egg-fried"></i>
            </div>
            <h4>Food</h4>
            <span>Diet & Consumption</span>
        </a>

        <a href="{{ route('calc.expenditure') }}" class="eco-card purple">
            <div class="eco-icon">
                <i class="bi bi-bag-fill"></i>
            </div>
            <h4>Shopping</h4>
            <span>Lifestyle Spending</span>
        </a>

    </div>
</div>
@endsection