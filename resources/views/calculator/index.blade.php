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

.toggle-btn.disabled {
    cursor: not-allowed;
    opacity: 0.5;
}

.toggle-btn.disabled:hover {
    transform: none;
}

.coming-soon-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    font-size: 0.65rem;
    padding: 3px 8px;
    border-radius: 10px;
    font-weight: 700;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4);
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

/* COMING SOON CARD */
.eco-card.coming-soon {
    cursor: not-allowed;
    opacity: 0.7;
    pointer-events: none;
}

.eco-card.coming-soon::after {
    content: 'Coming Soon';
    position: absolute;
    top: 16px;
    right: 16px;
    background: rgba(0,0,0,0.3);
    backdrop-filter: blur(10px);
    color: white;
    font-size: 0.7rem;
    padding: 4px 12px;
    border-radius: 12px;
    font-weight: 700;
    letter-spacing: 0.5px;
}

/* TABLET */
@media (max-width: 992px) {
    .eco-grid {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 28px;
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
    
    .coming-soon-badge {
        font-size: 0.6rem;
        padding: 2px 6px;
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
        <button class="toggle-btn disabled" onclick="showComingSoon(event)">
            <i class="bi bi-building"></i>
            <span>Corporate</span>
            <span class="coming-soon-badge">SOON</span>
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

    <!-- CORPORATE CALCULATOR (Coming Soon) -->
    <div id="corporate-calc" class="calc-section">
        <div class="section-label">
            <h3>Corporate Carbon Footprint</h3>
            <p>Measure your organization's environmental impact - Coming Soon!</p>
        </div>
        
        <div class="eco-grid">
            <div class="eco-card teal coming-soon">
                <div class="eco-icon">
                    <i class="bi bi-building"></i>
                </div>
                <h4>Facilities</h4>
                <span>Office & Building Energy</span>
            </div>

            <div class="eco-card indigo coming-soon">
                <div class="eco-icon">
                    <i class="bi bi-truck"></i>
                </div>
                <h4>Fleet & Logistics</h4>
                <span>Transportation & Delivery</span>
            </div>

            <div class="eco-card amber coming-soon">
                <div class="eco-icon">
                    <i class="bi bi-gear-fill"></i>
                </div>
                <h4>Operations</h4>
                <span>Production & Manufacturing</span>
            </div>

            <div class="eco-card pink coming-soon">
                <div class="eco-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h4>Supply Chain</h4>
                <span>Procurement & Suppliers</span>
            </div>

            <div class="eco-card orange coming-soon">
                <div class="eco-icon">
                    <i class="bi bi-recycle"></i>
                </div>
                <h4>Waste</h4>
                <span>Waste Management & Recycling</span>
            </div>

            <div class="eco-card purple coming-soon">
                <div class="eco-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h4>Employees</h4>
                <span>Staff Commute & Travel</span>
            </div>
        </div>
    </div>
</div>

<script>
function switchCalc(type) {
    // Update buttons
    const buttons = document.querySelectorAll('.toggle-btn:not(.disabled)');
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.closest('.toggle-btn').classList.add('active');
    
    // Update sections
    const sections = document.querySelectorAll('.calc-section');
    sections.forEach(section => section.classList.remove('active'));
    
    document.getElementById(type + '-calc').classList.add('active');
}

function showComingSoon(event) {
    event.preventDefault();
    
    // Optional: Show toast/alert notification
    // Uncomment jika ingin tampilkan notifikasi
    /*
    alert('Corporate calculator coming soon! We are working hard to bring this feature to you.');
    */
}
</script>

@endsection