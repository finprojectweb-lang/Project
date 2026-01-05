@extends('layouts.app')

@section('content')
<style>
body {
    padding-top: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

.calc-choice-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.calc-title {
    text-align: center;
    color: white;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 50px;
}

.calc-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.calc-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
    display: block;
}

.calc-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.calc-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    color: #667eea;
}

.calc-card h4 {
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
}

.calc-card p {
    color: #666;
    font-size: 0.9rem;
}
</style>

<div class="calc-choice-container">
    <h2 class="calc-title">Choose Your Carbon Calculator</h2>

    <div class="calc-grid">
        <!-- Housing -->
        <a href="{{ route('calc.housing') }}" class="calc-card">
            <div class="calc-icon">
                <i class="bi bi-house-fill"></i>
            </div>
            <h4>Housing</h4>
            <p>Calculate emissions from your home energy usage</p>
        </a>

        <!-- Transport -->
        <a href="{{ route('calc.transport') }}" class="calc-card">
            <div class="calc-icon">
                <i class="bi bi-car-front-fill"></i>
            </div>
            <h4>Transportation</h4>
            <p>Calculate emissions from your daily commute</p>
        </a>

        <!-- Food -->
        <a href="{{ route('calc.food') }}" class="calc-card">
            <div class="calc-icon">
                <i class="bi bi-egg-fried"></i>
            </div>
            <h4>Food</h4>
            <p>Calculate emissions from your diet choices</p>
        </a>

        <!-- Expenditure -->
        <a href="{{ route('calc.expenditure') }}" class="calc-card">
            <div class="calc-icon">
                <i class="bi bi-bag-fill"></i>
            </div>
            <h4>Expenditure</h4>
            <p>Calculate emissions from your shopping habits</p>
        </a>
    </div>
</div>
@endsection