@extends('layouts.app')

@section('title', 'Detail Transaksi - NulliCarbon')

@section('content')
<style>
    body {
        background-color: #F0F8FF;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .detail-page {
        min-height: 100vh;
        padding: 120px 0;
    }

    .back-btn {
        background: white;
        color: #166534;
        border: 2px solid #166534;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 30px;
    }

    .back-btn:hover {
        background: linear-gradient(135deg, #166534, #22c55e);
        color: white;
        border-color: #166534;
        transform: translateX(-5px);
    }

    .detail-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 24px rgba(22, 101, 52, 0.1);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .detail-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #166534, #22c55e);
    }

    .card-title {
        font-size: 28px;
        font-weight: 700;
        color: #166534;
        margin-bottom: 5px;
    }

    .status-badge-large {
        padding: 12px 24px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .status-paid { background: #dcfce7; color: #166534; }
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-cancelled { background: #f1f5f9; color: #64748b; }
    .status-failed { background: #fee2e2; color: #991b1b; }

    .info-row {
        padding: 15px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-size: 13px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .info-value {
        font-size: 18px;
        color: #166534;
        font-weight: 600;
    }

    .highlight-card {
        background: linear-gradient(135deg, #166534, #22c55e);
        border-radius: 20px;
        padding: 40px;
        text-align: center;
        color: white;
        box-shadow: 0 12px 32px rgba(22, 101, 52, 0.3);
        position: relative;
        overflow: hidden;
    }

    .highlight-card::before {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }

    .highlight-icon {
        font-size: 60px;
        margin-bottom: 20px;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .highlight-number {
        font-size: 48px;
        font-weight: 700;
        margin: 15px 0;
    }

    .section-header {
        font-size: 24px;
        font-weight: 700;
        color: #166534;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-header i {
        font-size: 28px;
    }

    .data-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        border-left: 4px solid #166534;
        transition: all 0.3s ease;
    }

    .data-box:hover {
        background: #f1f5f9;
        transform: translateX(5px);
    }

    .data-key {
        font-size: 13px;
        color: #64748b;
        text-transform: capitalize;
        margin-bottom: 5px;
    }

    .data-value {
        font-size: 16px;
        color: #166534;
        font-weight: 600;
    }

    .alert-custom {
        border-radius: 12px;
        padding: 20px;
        border: none;
        font-weight: 600;
    }

    .alert-warning-custom {
        background: #fef3c7;
        color: #92400e;
    }

    .alert-success-custom {
        background: #dcfce7;
        color: #166534;
    }

    .chart-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 24px rgba(22, 101, 52, 0.1);
        margin-bottom: 30px;
        height: 100%;
    }

    .chart-card canvas {
        max-height: 300px;
    }

    .insight-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 16px rgba(22, 101, 52, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        border: 2px solid transparent;
    }

    .insight-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(22, 101, 52, 0.15);
        border-color: #22c55e;
    }

    .insight-icon-box {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 15px;
    }

    .icon-red { background: linear-gradient(135deg, #dc2626, #f87171); color: white; }
    .icon-green { background: linear-gradient(135deg, #166534, #22c55e); color: white; }
    .icon-blue { background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; }
    .icon-orange { background: linear-gradient(135deg, #ea580c, #fb923c); color: white; }
    .icon-purple { background: linear-gradient(135deg, #7c3aed, #a78bfa); color: white; }
    .icon-gray { background: linear-gradient(135deg, #64748b, #94a3b8); color: white; }

    .insight-label {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .insight-value {
        font-size: 24px;
        font-weight: 700;
        color: #166534;
        margin-bottom: 5px;
    }

    .insight-desc {
        font-size: 13px;
        color: #94a3b8;
    }

    .certificate-card {
        background: linear-gradient(135deg, #7c3aed, #a78bfa);
        border-radius: 20px;
        padding: 40px;
        color: white;
        box-shadow: 0 12px 32px rgba(124, 58, 237, 0.3);
        position: relative;
        overflow: hidden;
    }

    .certificate-card::before {
        content: '🏆';
        position: absolute;
        font-size: 150px;
        opacity: 0.1;
        right: -30px;
        top: -30px;
    }

    .btn-download {
        background: white;
        color: #7c3aed;
        border: none;
        padding: 15px 35px;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-download:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        color: #7c3aed;
    }

    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease;
    }

    .reveal.show {
        opacity: 1;
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .detail-page {
            padding: 30px 0;
        }

        .detail-card {
            padding: 24px;
        }

        .card-title {
            font-size: 22px;
        }

        .highlight-number {
            font-size: 36px;
        }

        .chart-card {
            padding: 20px;
        }
    }
</style>

<div class="detail-page">
    <div class="container">
        <!-- Back Button -->
        <a href="{{ route('transactions.index') }}" class="back-btn reveal">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Riwayat
        </a>

        <!-- Header Section -->
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="detail-card reveal">
                    <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
                        <div>
                            <h2 class="card-title">Detail Transaksi</h2>
                            <p style="color: #64748b; margin: 0; font-family: 'Courier New', monospace;">
                                {{ $payment->order_id }}
                            </p>
                        </div>
                        <span class="status-badge-large status-{{ $payment->status }}">
                            @if($payment->status === 'paid')
                                Paid
                            @elseif($payment->status === 'pending')
                                Pending
                            @elseif($payment->status === 'cancelled')
                                Cancelled
                            @else
                                Failed
                            @endif
                        </span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-row">
                                <div class="info-label">Tanggal Transaksi</div>
                                <div class="info-value">{{ $payment->created_at->format('d F Y, H:i') }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-row">
                                <div class="info-label">Jenis Kalkulator</div>
                                <div class="info-value">{{ ucfirst(str_replace('_', ' ', $payment->calculator_type)) }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-row">
                                <div class="info-label">Metode Pembayaran</div>
                                <div class="info-value">{{ $payment->payment_method_name }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-row">
                                <div class="info-label">Tanggal Pembayaran</div>
                                <div class="info-value">
                                    {{ $payment->paid_at ? $payment->paid_at->format('d F Y, H:i') : 'Belum dibayar' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-row">
                                <div class="info-label">Nama</div>
                                <div class="info-value">{{ $payment->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-row">
                                <div class="info-label">Email</div>
                                <div class="info-value">{{ $payment->email }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-row">
                                <div class="info-label">Telepon</div>
                                <div class="info-value">{{ $payment->phone }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-row">
                                <div class="info-label">Program Offset</div>
                                <div class="info-value">{{ $payment->program_name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="highlight-card reveal">
                    <div class="highlight-icon">🌿</div>
                    <div class="info-label" style="color: rgba(255,255,255,0.8);">Total Offset CO₂</div>
                    <div class="highlight-number">{{ number_format($payment->carbon_amount, 2) }}</div>
                    <div style="font-size: 16px; margin-bottom: 20px;">kg CO₂e</div>
                    <hr style="border-color: rgba(255,255,255,0.3); margin: 25px 0;">
                    <div class="info-label" style="color: rgba(255,255,255,0.8);">Subtotal</div>
                    <div style="font-size: 24px; font-weight: 600; margin-bottom: 10px;">
                        Rp {{ number_format($payment->subtotal, 0, ',', '.') }}
                    </div>
                    <div class="info-label" style="color: rgba(255,255,255,0.8);">Admin Fee</div>
                    <div style="font-size: 18px; font-weight: 600; margin-bottom: 20px;">
                        Rp {{ number_format($payment->admin_fee, 0, ',', '.') }}
                    </div>
                    <hr style="border-color: rgba(255,255,255,0.3); margin: 25px 0;">
                    <div class="info-label" style="color: rgba(255,255,255,0.8);">Total Pembayaran</div>
                    <div style="font-size: 32px; font-weight: 700;">
                        Rp {{ number_format($payment->total_amount, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Calculator Data Section -->
        @if($payment->carbonCalculation)
        <div class="detail-card reveal">
            <h3 class="section-header">
                <i class="bi bi-calculator"></i>
                Data Kalkulator
            </h3>
            <div class="row g-3">
                @if($payment->carbonCalculation->details)
                    @foreach($payment->carbonCalculation->details as $key => $detail)
                    <div class="col-md-4">
                        <div class="data-box">
                            <div class="data-key">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
                            <div class="data-value">
                                @if(is_array($detail))
                                    @if(isset($detail['distance']))
                                        {{ $detail['distance'] }} km - {{ $detail['emission'] ?? 0 }} kg CO₂e
                                    @elseif(isset($detail['amount']))
                                        Rp {{ number_format($detail['amount'], 0, ',', '.') }}
                                    @elseif(isset($detail['kgPerWeek']))
                                        {{ $detail['kgPerWeek'] }} kg/week
                                    @else
                                        {{ json_encode($detail) }}
                                    @endif
                                @else
                                    {{ $detail }}
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="alert-custom alert-warning-custom">
                        <i class="bi bi-recycle me-2"></i>
                        <strong>Plastik Setara:</strong> {{ $payment->carbonCalculation->plastic_eq }} Kg
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert-custom alert-success-custom">
                        <i class="bi bi-tree-fill me-2"></i>
                        <strong>Pohon Setara:</strong> {{ $payment->carbonCalculation->tree_eq }} Pohon
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert-custom" style="background: #dbeafe; color: #1e40af;">
                        <i class="bi bi-water me-2"></i>
                        <strong>Karang Setara:</strong> {{ $payment->carbonCalculation->coral_eq }} Fragmen
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Charts Section -->
        <div class="row g-4 mb-4">
            <div class="col-lg-6 reveal">
                <div class="chart-card">
                    <h3 class="section-header">
                        <i class="bi bi-graph-up"></i>
                        Offset per Bulan
                    </h3>
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
            <div class="col-lg-6 reveal">
                <div class="chart-card">
                    <h3 class="section-header">
                        <i class="bi bi-graph-up-arrow"></i>
                        Akumulasi Offset
                    </h3>
                    <canvas id="cumulativeChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Insights Section -->
        <div class="mb-4">
            <h3 class="section-header reveal" style="font-size: 32px; margin-bottom: 30px;">
                <i class="bi bi-lightbulb-fill" style="color: #fb923c;"></i>
                Insights & Analisis
            </h3>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-4 col-md-6 reveal">
                <div class="insight-card">
                    <div class="insight-icon-box icon-red">
                        <i class="bi bi-arrow-up-circle-fill"></i>
                    </div>
                    <div class="insight-label">Aktivitas Tertinggi Bulan Ini</div>
                    @if($insights['highest_emission'])
                    <div class="insight-value">{{ ucfirst(str_replace('_', ' ', $insights['highest_emission']->calculator_type)) }}</div>
                    <div style="color: #dc2626; font-size: 18px; font-weight: 600;">
                        {{ number_format($insights['highest_emission']->carbon_amount, 2) }} kg CO₂e
                    </div>
                    @else
                    <div class="insight-desc">Belum ada data</div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal">
                <div class="insight-card">
                    <div class="insight-icon-box icon-green">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <div class="insight-label">Offset Paling Efisien</div>
                    @if($insights['most_efficient'])
                    <div class="insight-value">{{ ucfirst(str_replace('_', ' ', $insights['most_efficient']->calculator_type)) }}</div>
                    <div style="color: #166534; font-size: 18px; font-weight: 600;">
                        Rp {{ number_format($insights['most_efficient']->total_amount / $insights['most_efficient']->carbon_amount, 0, ',', '.') }}/kg
                    </div>
                    @else
                    <div class="insight-desc">Belum ada data</div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal">
                <div class="insight-card">
                    <div class="insight-icon-box icon-blue">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="insight-label">Potensi Pengurangan</div>
                    <div class="insight-value">{{ number_format($insights['potential_reduction'], 2) }} kg</div>
                    <div class="insight-desc">Dengan mengurangi 30% aktivitas</div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal">
                <div class="insight-card">
                    <div class="insight-icon-box icon-orange">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="insight-label">Rata-rata Offset Bulanan</div>
                    <div class="insight-value">{{ number_format($insights['avg_monthly_offset'], 2) }} kg</div>
                    <div class="insight-desc">CO₂e per bulan tahun ini</div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal">
                <div class="insight-card">
                    <div class="insight-icon-box icon-purple">
                        <i class="bi bi-graph-{{ $insights['trend'] == 'increasing' ? 'up' : ($insights['trend'] == 'decreasing' ? 'down' : 'up-arrow') }}"></i>
                    </div>
                    <div class="insight-label">Tren Jejak Karbon</div>
                    <div class="insight-value text-capitalize">
                        {{ $insights['trend'] == 'increasing' ? 'Meningkat' : ($insights['trend'] == 'decreasing' ? 'Menurun' : 'Stabil') }}
                    </div>
                    <div class="insight-desc">{{ abs($insights['trend_percentage']) }}% dari bulan lalu</div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 reveal">
                <div class="insight-card">
                    <div class="insight-icon-box icon-gray">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <div class="insight-label">Efisiensi Transaksi Ini</div>
                    <div class="insight-value">Rp {{ number_format($payment->total_amount / $payment->carbon_amount, 0, ',', '.') }}</div>
                    <div class="insight-desc">per kg CO₂e</div>
                </div>
            </div>
        </div>

        <!-- Breakdown Chart -->
        <div class="chart-card reveal">
            <h3 class="section-header">
                <i class="bi bi-pie-chart-fill"></i>
                Breakdown Offset per Kategori
            </h3>
            <div style="max-width: 500px; margin: 0 auto;">
                <canvas id="typeBreakdownChart"></canvas>
            </div>
        </div>

        <!-- Certificate Section -->
        @if($payment->status === 'paid')
        <div class="certificate-card reveal" style="margin-top: 40px;">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 style="font-size: 32px; font-weight: 700; margin-bottom: 15px;">
                        <i class="bi bi-award-fill me-2"></i>Sertifikat Kompensasi Karbon
                    </h3>
                    <p style="font-size: 18px; margin-bottom: 10px;">
                        <strong>Nomor Sertifikat:</strong> CERT-{{ strtoupper(substr($payment->order_id, -8)) }}
                    </p>
                    <p style="font-size: 16px; opacity: 0.9; margin: 0;">
                        Terima kasih telah berkontribusi dalam mengurangi jejak karbon sebesar {{ number_format($payment->carbon_amount, 2) }} kg CO₂e 
                        melalui program {{ $payment->program_name }}.
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('transactions.certificate', $payment->id) }}" class="btn-download">
                        <i class="bi bi-download me-2"></i>Download Sertifikat
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Reveal animation on scroll
const reveals = document.querySelectorAll('.reveal');
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
    });
}, { threshold: 0.1 });

reveals.forEach(reveal => revealObserver.observe(reveal));

// Monthly Chart
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
const monthlyData = @json($monthlyData);
const monthlyLabels = monthlyData.map(item => {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    return months[item.month - 1] + ' ' + item.year;
});
const monthlyValues = monthlyData.map(item => parseFloat(item.total_offset));

new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: monthlyLabels,
        datasets: [{
            label: 'Offset (kg CO₂e)',
            data: monthlyValues,
            borderColor: '#22c55e',
            backgroundColor: 'rgba(34, 197, 94, 0.1)',
            tension: 0.4,
            fill: true,
            borderWidth: 3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
            x: { grid: { display: false } }
        }
    }
});

// Cumulative Chart
const cumulativeCtx = document.getElementById('cumulativeChart').getContext('2d');
const cumulativeData = @json($cumulativeData);
const cumulativeLabels = cumulativeData.map(item => {
    const date = new Date(item.date);
    return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
});
const cumulativeValues = cumulativeData.map(item => parseFloat(item.cumulative));

new Chart(cumulativeCtx, {
    type: 'line',
    data: {
        labels: cumulativeLabels,
        datasets: [{
            label: 'Total Akumulasi (kg CO₂e)',
            data: cumulativeValues,
            borderColor: '#166534',
            backgroundColor: 'rgba(22, 101, 52, 0.2)',
            tension: 0.4,
            fill: true,
            borderWidth: 3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
            x: { grid: { display: false } }
        }
    }
});

// Type Breakdown Chart
const typeCtx = document.getElementById('typeBreakdownChart').getContext('2d');
const typeData = @json($typeBreakdown);
const typeLabels = typeData.map(item => {
    const types = { 
        transport: 'Transportasi',
        transportation: 'Transportasi',
        food: 'Makanan', 
        expenditure: 'Pengeluaran', 
        housing_energy: 'Hunian & Energi',
        housing: 'Hunian & Energi'
    };
    return types[item.calculator_type] || item.calculator_type;
});
const typeValues = typeData.map(item => parseFloat(item.total));

new Chart(typeCtx, {
    type: 'doughnut',
    data: {
        labels: typeLabels,
        datasets: [{
            data: typeValues,
            backgroundColor: [
                'rgba(239, 68, 68, 0.8)',
                'rgba(59, 130, 246, 0.8)',
                'rgba(34, 197, 94, 0.8)',
                'rgba(168, 85, 247, 0.8)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: { position: 'bottom', labels: { padding: 20, font: { size: 14 } } }
        }
    }
});
</script>
@endsection