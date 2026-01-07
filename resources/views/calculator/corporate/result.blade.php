@extends('layouts.app')

@section('content')
<style>
.result-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    padding: 60px 20px;
}

.result-card {
    max-width: 1100px;
    margin: 0 auto;
    background: white;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,.1);
    overflow: hidden;
}

/* HEADER */
.result-header {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 50px 40px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.result-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: pulse 15s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.1) rotate(180deg); }
}

.result-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}

.result-title {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
}

.result-company {
    font-size: 1.3rem;
    opacity: 0.95;
    position: relative;
    z-index: 1;
}

/* MAIN EMISSION */
.main-emission {
    text-align: center;
    padding: 50px 40px;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-bottom: 3px solid #e2e8f0;
}

.emission-value {
    font-size: 4.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #10b981, #059669);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 10px;
}

.emission-unit {
    font-size: 1.3rem;
    color: #64748b;
    font-weight: 600;
}

.emission-desc {
    margin-top: 20px;
    color: #64748b;
    font-size: 1rem;
}

.compensation-box {
    background: white;
    border: 3px solid #10b981;
    border-radius: 16px;
    padding: 25px;
    margin-top: 30px;
    display: inline-block;
    min-width: 350px;
}

.compensation-label {
    font-size: 0.9rem;
    color: #64748b;
    font-weight: 600;
    margin-bottom: 8px;
}

.compensation-value {
    font-size: 2.5rem;
    font-weight: 800;
    color: #10b981;
}

/* BREAKDOWN */
.result-body {
    padding: 50px 40px;
}

.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #064e3b;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.breakdown-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-bottom: 50px;
}

.scope-card {
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    padding: 30px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.scope-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 5px;
    height: 100%;
    transition: width 0.3s ease;
}

.scope-card.scope1::before {
    background: linear-gradient(180deg, #ef4444, #dc2626);
}

.scope-card.scope2::before {
    background: linear-gradient(180deg, #3b82f6, #2563eb);
}

.scope-card.scope3::before {
    background: linear-gradient(180deg, #a855f7, #9333ea);
}

.scope-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,.1);
}

.scope-card:hover::before {
    width: 100%;
    opacity: 0.05;
}

.scope-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.scope-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: white;
}

.scope-badge.scope1 {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.scope-badge.scope2 {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
}

.scope-badge.scope3 {
    background: linear-gradient(135deg, #a855f7, #9333ea);
}

.scope-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1e293b;
}

.scope-emission {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 5px;
}

.scope-percentage {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 600;
}

.scope-details {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #f1f5f9;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-size: 0.9rem;
}

.detail-label {
    color: #64748b;
}

.detail-value {
    font-weight: 600;
    color: #1e293b;
}

/* CHART SECTION */
.chart-container {
    background: #f8fafc;
    border-radius: 16px;
    padding: 30px;
    margin-bottom: 40px;
}

.chart-wrapper {
    max-width: 500px;
    margin: 0 auto;
}

/* RECOMMENDATIONS */
.recommendations {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    border-radius: 16px;
    padding: 35px;
    margin-bottom: 40px;
}

.recommendation-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #92400e;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.recommendation-list {
    list-style: none;
    padding: 0;
}

.recommendation-list li {
    padding: 12px 0;
    padding-left: 35px;
    position: relative;
    color: #78350f;
    line-height: 1.6;
}

.recommendation-list li::before {
    content: '✓';
    position: absolute;
    left: 0;
    top: 12px;
    width: 24px;
    height: 24px;
    background: #f59e0b;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}

/* PAYMENT SECTION */
.payment-section {
    background: linear-gradient(135deg, #ecfdf5, #d1fae5);
    border-radius: 16px;
    padding: 40px;
    margin-bottom: 40px;
    text-align: center;
    border: 2px solid #10b981;
}

.payment-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #065f46;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}

.payment-description {
    color: #047857;
    font-size: 1rem;
    margin-bottom: 30px;
    line-height: 1.6;
}

.payment-button-container {
    margin-bottom: 20px;
}

.btn-payment {
    padding: 18px 40px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1.1rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.btn-payment.btn-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.btn-payment.btn-success:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
    color: white;
}

.btn-payment.btn-outline-success {
    background: white;
    color: #059669;
    border: 3px solid #10b981;
}

.btn-payment.btn-outline-success:hover {
    background: #f0fdf4;
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(16, 185, 129, 0.3);
    color: #059669;
}

.powered-by {
    padding-top: 20px;
    border-top: 2px solid #a7f3d0;
}

.powered-by-inner {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.powered-text {
    color: #059669;
    font-size: 0.9rem;
    font-weight: 600;
}

.powered-logo {
    height: 30px;
    filter: grayscale(0);
}

/* ACTION BUTTONS */
.action-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    padding: 40px;
    background: #f8fafc;
    border-top: 2px solid #e2e8f0;
}

.btn-action {
    flex: 1;
    min-width: 200px;
    padding: 16px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
    color: white;
}

.btn-secondary {
    background: white;
    color: #059669;
    border: 2px solid #10b981;
}

.btn-secondary:hover {
    background: #f0fdf4;
    transform: translateY(-2px);
    color: #059669;
}

.btn-outline {
    background: transparent;
    color: #64748b;
    border: 2px solid #e2e8f0;
}

.btn-outline:hover {
    background: white;
    border-color: #cbd5e1;
    color: #475569;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .result-header {
        padding: 40px 20px;
    }

    .result-title {
        font-size: 1.8rem;
    }

    .result-company {
        font-size: 1.1rem;
    }

    .emission-value {
        font-size: 3rem;
    }

    .compensation-box {
        min-width: auto;
        width: 100%;
    }

    .result-body {
        padding: 30px 20px;
    }

    .breakdown-grid {
        grid-template-columns: 1fr;
    }

    .payment-section {
        padding: 30px 20px;
    }

    .payment-title {
        font-size: 1.5rem;
    }

    .btn-payment {
        width: 100%;
        padding: 16px 30px;
        font-size: 1rem;
    }

    .action-buttons {
        flex-direction: column;
        padding: 30px 20px;
    }

    .btn-action {
        width: 100%;
    }
}
</style>

<div class="result-container">
    <div class="result-card">
        <!-- HEADER -->
        <div class="result-header">
            <div class="result-icon">🌍</div>
            <h1 class="result-title">Hasil Perhitungan Emisi Karbon</h1>
            <p class="result-company">{{ $calculation->company_name }}</p>
        </div>

        <!-- MAIN EMISSION -->
        <div class="main-emission">
            <div class="emission-value">{{ number_format($calculation->total_emission / 1000, 2) }}</div>
            <div class="emission-unit">Ton CO₂e per Tahun</div>
            <p class="emission-desc">Total emisi karbon dari semua aktivitas perusahaan Anda di tahun {{ $calculation->calculation_year }}</p>
            
            <div class="compensation-box">
                <div class="compensation-label">Biaya Kompensasi Karbon</div>
                <div class="compensation-value">Rp {{ number_format($calculation->compensation_cost, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- BODY -->
        <div class="result-body">
            <!-- BREAKDOWN BY SCOPE -->
            <h2 class="section-title">
                <i class="bi bi-pie-chart-fill" style="color: #10b981;"></i>
                Rincian Emisi per Scope
            </h2>
            
            <div class="breakdown-grid">
                <!-- SCOPE 1 -->
                <div class="scope-card scope1">
                    <div class="scope-card-header">
                        <span class="scope-badge scope1">SCOPE 1</span>
                        <span class="scope-name">Emisi Langsung</span>
                    </div>
                    <div class="scope-emission">{{ number_format($calculation->scope1_total / 1000, 2) }}</div>
                    <div class="scope-percentage">
                        Ton CO₂e ({{ $calculation->total_emission > 0 ? number_format(($calculation->scope1_total / $calculation->total_emission) * 100, 1) : 0 }}%)
                    </div>
                    
                    @if($calculation->scope1_data)
                    <div class="scope-details">
                        @foreach($calculation->scope1_data as $key => $value)
                            @if($value > 0)
                            <div class="detail-item">
                                <span class="detail-label">
                                    @if($key == 'diesel') Solar/Diesel
                                    @elseif($key == 'gasoline') Bensin
                                    @elseif($key == 'natural_gas') Gas Alam
                                    @elseif($key == 'lpg') LPG
                                    @endif
                                </span>
                                <span class="detail-value">{{ number_format($value, 0, ',', '.') }} 
                                    @if($key == 'diesel' || $key == 'gasoline') L
                                    @elseif($key == 'natural_gas') m³
                                    @elseif($key == 'lpg') Kg
                                    @endif
                                </span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- SCOPE 2 -->
                <div class="scope-card scope2">
                    <div class="scope-card-header">
                        <span class="scope-badge scope2">SCOPE 2</span>
                        <span class="scope-name">Emisi Energi</span>
                    </div>
                    <div class="scope-emission">{{ number_format($calculation->scope2_total / 1000, 2) }}</div>
                    <div class="scope-percentage">Ton CO₂e ({{ number_format(($calculation->scope2_total / $calculation->total_emission) * 100, 1) }}%)</div>
                    
                    @if($calculation->scope2_data)
                    <div class="scope-details">
                        @foreach($calculation->scope2_data as $key => $value)
                            @if($value > 0)
                            <div class="detail-item">
                                <span class="detail-label">Listrik PLN</span>
                                <span class="detail-value">{{ number_format($value, 0, ',', '.') }} kWh</span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- SCOPE 3 -->
                <div class="scope-card scope3">
                    <div class="scope-card-header">
                        <span class="scope-badge scope3">SCOPE 3</span>
                        <span class="scope-name">Emisi Rantai Nilai</span>
                    </div>
                    <div class="scope-emission">{{ number_format($calculation->scope3_total / 1000, 2) }}</div>
                    <div class="scope-percentage">Ton CO₂e ({{ number_format(($calculation->scope3_total / $calculation->total_emission) * 100, 1) }}%)</div>
                    
                    @if($calculation->scope3_data)
                    <div class="scope-details">
                        @foreach($calculation->scope3_data as $key => $value)
                            @if($value > 0)
                            <div class="detail-item">
                                <span class="detail-label">
                                    @if($key == 'flight_domestic_km') Penerbangan Domestik
                                    @elseif($key == 'flight_international_km') Penerbangan Internasional
                                    @elseif($key == 'shipping_ton_km') Pengiriman Barang
                                    @elseif($key == 'employee_commute_km') Transport Karyawan
                                    @endif
                                </span>
                                <span class="detail-value">{{ number_format($value, 0, ',', '.') }} 
                                    @if(str_contains($key, 'ton_km')) Ton-Km
                                    @else Km
                                    @endif
                                </span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <!-- CHART -->
            <div class="chart-container">
                <h3 class="section-title" style="margin-bottom: 25px;">
                    <i class="bi bi-bar-chart-fill" style="color: #10b981;"></i>
                    Visualisasi Emisi
                </h3>
                <div class="chart-wrapper">
                    <canvas id="emissionChart" 
                            data-scope1="{{ $calculation->scope1_total }}"
                            data-scope2="{{ $calculation->scope2_total }}"
                            data-scope3="{{ $calculation->scope3_total }}"
                            data-total="{{ $calculation->total_emission }}"></canvas>
                </div>
            </div>

            <!-- RECOMMENDATIONS -->
            <div class="recommendations">
                <h3 class="recommendation-title">
                    <i class="bi bi-lightbulb-fill"></i>
                    Rekomendasi Pengurangan Emisi
                </h3>
                <ul class="recommendation-list">
                    @if($calculation->scope1_total > $calculation->scope2_total)
                        <li>Pertimbangkan untuk menggunakan kendaraan listrik atau hybrid untuk mengurangi emisi Scope 1</li>
                        <li>Lakukan maintenance rutin pada kendaraan dan mesin untuk efisiensi bahan bakar</li>
                    @endif
                    
                    @if($calculation->scope2_total > 0)
                        <li>Instalasi panel surya dapat mengurangi ketergantungan pada listrik PLN</li>
                        <li>Gunakan peralatan hemat energi dan implementasikan kebijakan penghematan listrik</li>
                    @endif
                    
                    @if($calculation->scope3_total > 0)
                        <li>Dorong penggunaan transportasi umum atau carpool untuk karyawan</li>
                        <li>Gunakan video conference untuk mengurangi perjalanan dinas</li>
                    @endif
                    
                    <li>Lakukan audit energi berkala untuk identifikasi area yang perlu diperbaiki</li>
                    <li>Set target pengurangan emisi 20-30% dalam 3-5 tahun ke depan</li>
                </ul>
            </div>

            <!-- PAYMENT SECTION -->
            <!-- PAYMENT SECTION -->
<div class="payment-section">
    <h3 class="payment-title">
        <i class="bi bi-credit-card-fill"></i>
        Kompensasi Karbon
    </h3>
    <p class="payment-description">
        Ambil langkah nyata untuk mengurangi dampak emisi karbon perusahaan Anda. 
        Lakukan pembayaran kompensasi karbon dan berkontribusi pada program penanaman pohon dan energi terbarukan.
    </p>
    
@auth
    <a href="{{ route('payment.create', ['calculation' => $calculation->id]) }}" class="btn-payment btn-success">
        <i class="bi bi-credit-card"></i>
        Proceed to Payment
    </a>
@endauth

@guest
    <a href="{{ route('payment.create', ['calculation' => $calculation->id]) }}" class="btn-payment btn-outline-success">
        <i class="bi bi-lock-fill"></i>
        Login to Proceed Payment
    </a>
@endguest

    <!-- Powered By -->
    <div class="powered-by">
        <div class="powered-by-inner">
            <span class="powered-text">Powered by</span>
            <img src="/images/nullicarbon.png" alt="NulliCarbon" class="powered-logo">
        </div>
    </div>
</div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="action-buttons">
            <a href="{{ route('calc.corporate.export-pdf', $calculation->id) }}" class="btn-action btn-primary">
                <i class="bi bi-download"></i>
                Download Laporan PDF
            </a>
            <a href="{{ route('calc.corporate.create') }}" class="btn-action btn-secondary">
                <i class="bi bi-calculator"></i>
                Hitung Ulang
            </a>
            <a href="{{ route('calc.corporate.history') }}" class="btn-action btn-outline">
                <i class="bi bi-clock-history"></i>
                Riwayat Perhitungan
            </a>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Get data from HTML data attributes
const canvas = document.getElementById('emissionChart');
const scope1Total = parseFloat(canvas.dataset.scope1);
const scope2Total = parseFloat(canvas.dataset.scope2);
const scope3Total = parseFloat(canvas.dataset.scope3);
const totalEmission = parseFloat(canvas.dataset.total);

// Create Chart
const ctx = canvas.getContext('2d');
const emissionChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Scope 1', 'Scope 2', 'Scope 3'],
        datasets: [{
            data: [scope1Total, scope2Total, scope3Total],
            backgroundColor: [
                'rgba(239, 68, 68, 0.8)',
                'rgba(59, 130, 246, 0.8)',
                'rgba(168, 85, 247, 0.8)'
            ],
            borderColor: [
                'rgba(239, 68, 68, 1)',
                'rgba(59, 130, 246, 1)',
                'rgba(168, 85, 247, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    font: {
                        size: 14,
                        weight: 600
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        let value = context.parsed;
                        let percentage = ((value / totalEmission) * 100).toFixed(1);
                        return label + ': ' + (value/1000).toFixed(2) + ' Ton CO₂e (' + percentage + '%)';
                    }
                }
            }
        }
    }
});
</script>

@endsection