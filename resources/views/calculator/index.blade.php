@extends('layouts.app')

@section('content')
<style>
.eco-calc {
    padding: 100px 20px 120px;
    background: linear-gradient(180deg, #f4fdf9, #e8f6ef);
}

.eco-header {
    text-align: center;
    margin-bottom: 60px;
}

.eco-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #064e3b;
    margin-bottom: 12px;
}

.eco-sub {
    color: #475569;
    font-size: 1.1rem;
}

/* TOGGLE SECTION */
.calc-type-toggle {
    max-width: 500px;
    margin: 0 auto 70px;
    background: white;
    padding: 8px;
    border-radius: 50px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
    display: flex;
    gap: 8px;
}

.toggle-btn {
    flex: 1;
    padding: 16px 28px;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    background: transparent;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    position: relative;
}

.toggle-btn i {
    font-size: 1.2rem;
}

.toggle-btn.active {
    background: linear-gradient(135deg, #10b981, #047857);
    color: white;
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

/* CALCULATOR GRIDS */
.calc-section {
    display: none;
    animation: fadeIn 0.5s ease;
}

.calc-section.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.section-label {
    text-align: center;
    margin-bottom: 40px;
}

.section-label h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #064e3b;
    margin-bottom: 8px;
}

.section-label p {
    color: #64748b;
    font-size: 0.95rem;
}

.eco-grid {
    max-width: 1200px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 32px;
}

.eco-card {
    border-radius: 24px;
    padding: 40px 28px;
    text-decoration: none;
    color: white;
    position: relative;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 15px 35px rgba(0,0,0,.12);
    overflow: hidden;
}

.eco-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
    opacity: 0;
    transition: opacity 0.4s ease;
}

.eco-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0,0,0,.2);
}

.eco-card:hover::before {
    opacity: 1;
}

/* ICON */
.eco-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 24px;
    border-radius: 20px;
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    transition: all 0.4s ease;
}

.eco-card:hover .eco-icon {
    transform: scale(1.1) rotate(5deg);
    background: rgba(255,255,255,0.35);
}

/* TEXT */
.eco-card h4 {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 8px;
    position: relative;
}

.eco-card span {
    font-size: 0.95rem;
    opacity: 0.95;
    display: block;
    line-height: 1.4;
}

/* COLOR VARIANTS */
.green  { background: linear-gradient(135deg, #10b981, #047857); }
.blue   { background: linear-gradient(135deg, #38bdf8, #0369a1); }
.orange { background: linear-gradient(135deg, #fb923c, #c2410c); }
.purple { background: linear-gradient(135deg, #a78bfa, #6d28d9); }
.teal   { background: linear-gradient(135deg, #2dd4bf, #0d9488); }
.pink   { background: linear-gradient(135deg, #f472b6, #be185d); }
.indigo { background: linear-gradient(135deg, #818cf8, #4338ca); }
.amber  { background: linear-gradient(135deg, #fbbf24, #d97706); }

/* CORPORATE SECTION STYLES */
.corporate-hero {
    text-align: center;
    margin-bottom: 50px;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: #059669;
    margin-bottom: 40px;
}

.action-card {
    max-width: 800px;
    margin: 0 auto 50px;
    background: white;
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    text-align: center;
}

.action-card h2 {
    margin-bottom: 20px;
    color: #064e3b;
    font-size: 1.8rem;
    font-weight: 700;
}

.action-card p {
    color: #64748b;
    margin-bottom: 30px;
    font-size: 1rem;
}

.btn-start {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 20px 40px;
    border-radius: 12px;
    font-size: 1.2rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-start:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
    color: white;
}

.calculations-list {
    max-width: 1200px;
    margin: 0 auto;
}

.list-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.list-title {
    font-size: 2rem;
    font-weight: 700;
    color: #064e3b;
}

.calculation-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.calculation-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.calc-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 20px;
}

.calc-company {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
}

.calc-date {
    color: #64748b;
    font-size: 0.9rem;
}

.calc-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.stat-item {
    text-align: center;
    padding: 15px;
    background: #f8fafc;
    border-radius: 12px;
}

.stat-value {
    font-size: 1.8rem;
    font-weight: 700;
    color: #10b981;
}

.stat-label {
    color: #64748b;
    font-size: 0.9rem;
    margin-top: 5px;
}

.calc-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
}

.btn-view {
    padding: 10px 20px;
    background: #10b981;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-view:hover {
    background: #059669;
    color: white;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 16px;
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 20px;
}

.empty-text {
    font-size: 1.2rem;
    color: #64748b;
    margin-bottom: 30px;
}

/* TABLET */
@media (max-width: 992px) {
    .eco-grid {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 28px;
    }
    
    .calc-stats {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* MOBILE */
@media (max-width: 640px) {
    .eco-calc {
        padding: 80px 16px 100px;
    }
    
    .eco-title {
        font-size: 2rem;
    }
    
    .eco-sub {
        font-size: 1rem;
    }
    
    .calc-type-toggle {
        flex-direction: column;
        gap: 8px;
        padding: 8px;
        max-width: 100%;
    }
    
    .toggle-btn {
        padding: 14px 20px;
        font-size: 0.95rem;
    }
    
    .section-label h3 {
        font-size: 1.5rem;
    }
    
    .eco-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    .eco-card {
        padding: 32px 24px;
    }
    
    .eco-icon {
        width: 70px;
        height: 70px;
        font-size: 2.2rem;
    }
    
    .action-card {
        padding: 30px 20px;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .btn-start {
        padding: 16px 32px;
        font-size: 1rem;
    }
    
    .calc-stats {
        grid-template-columns: 1fr;
    }
}

/* SMALL MOBILE */
@media (max-width: 375px) {
    .eco-title {
        font-size: 1.75rem;
    }
    
    .toggle-btn {
        padding: 12px 16px;
        font-size: 0.9rem;
        gap: 8px;
    }
    
    .toggle-btn i {
        font-size: 1rem;
    }
}
</style>

<div class="eco-calc">
    <div class="eco-header">
        <h2 class="eco-title">Carbon Calculator</h2>
        <p class="eco-sub">Measure and reduce your environmental impact</p>
    </div>

    <!-- TOGGLE SELECTOR -->
    <div class="calc-type-toggle">
        <button class="toggle-btn active" onclick="switchCalc('personal')">
            <i class="bi bi-person-fill"></i>
            <span>Personal</span>
        </button>
        <button class="toggle-btn" onclick="switchCalc('corporate')">
            <i class="bi bi-building"></i>
            <span>Corporate</span>
        </button>
    </div>

    <!-- PERSONAL CALCULATOR -->
    <div id="personal-calc" class="calc-section active">
        <div class="section-label">
            <h3>Personal Carbon Footprint</h3>
            <p>Calculate your individual environmental impact</p>
        </div>
        
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

    <!-- CORPORATE CALCULATOR -->
    <div id="corporate-calc" class="calc-section">
        <div class="corporate-hero">
            <h3 class="section-label h3" style="font-size: 1.8rem; font-weight: 700; color: #064e3b; margin-bottom: 8px;">🌍 Kalkulator Emisi Karbon Korporat</h3>
            <p class="hero-subtitle">Hitung jejak karbon perusahaan Anda dan berkontribusi pada masa depan yang lebih hijau</p>
        </div>

        <div class="action-card">
            <h2>Mulai Perhitungan Baru</h2>
            <p>Hitung emisi karbon dari semua aktivitas perusahaan Anda dalam 3 scope emisi</p>
            <a href="{{ route('calc.corporate.create') }}" class="btn-start">
                <i class="bi bi-calculator"></i>
                Mulai Perhitungan
            </a>
        </div>

        @if(isset($calculations) && $calculations->count() > 0)
        <div class="calculations-list">
            <div class="list-header">
                <h2 class="list-title">Perhitungan Terakhir</h2>
            </div>

            @foreach($calculations as $calc)
            <div class="calculation-card">
                <div class="calc-header">
                    <div>
                        <h3 class="calc-company">{{ $calc->company_name }}</h3>
                        <p class="calc-date">{{ $calc->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <div class="calc-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ number_format($calc->total_emission / 1000, 2) }}</div>
                        <div class="stat-label">Ton CO₂e</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ number_format($calc->scope1_total / 1000, 2) }}</div>
                        <div class="stat-label">Scope 1</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ number_format($calc->scope2_total / 1000, 2) }}</div>
                        <div class="stat-label">Scope 2</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ number_format($calc->scope3_total / 1000, 2) }}</div>
                        <div class="stat-label">Scope 3</div>
                    </div>
                </div>

                <div class="calc-actions">
                    <a href="{{ route('calc.corporate.result', $calc->id) }}" class="btn-view">
                        <i class="bi bi-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="calculations-list">
            <div class="empty-state">
                <div class="empty-icon">📊</div>
                <p class="empty-text">Belum ada perhitungan. Mulai perhitungan pertama Anda sekarang!</p>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function switchCalc(type) {
    // Update buttons
    const buttons = document.querySelectorAll('.toggle-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.closest('.toggle-btn').classList.add('active');
    
    // Update sections
    const sections = document.querySelectorAll('.calc-section');
    sections.forEach(section => section.classList.remove('active'));
    
    document.getElementById(type + '-calc').classList.add('active');
}
</script>

@endsection