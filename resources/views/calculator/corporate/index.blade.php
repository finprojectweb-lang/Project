@extends('layouts.app')

@section('content')
<style>
.corporate-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    padding: 60px 20px;
}

.hero-section {
    text-align: center;
    margin-bottom: 50px;
}

.hero-title {
    font-size: 3rem;
    font-weight: 800;
    color: #064e3b;
    margin-bottom: 20px;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: #059669;
    margin-bottom: 40px;
}

.action-card {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    text-align: center;
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
    margin: 50px auto 0;
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
</style>

<div class="corporate-container">
    <div class="hero-section">
        <h1 class="hero-title">🌍 Kalkulator Emisi Karbon Korporat</h1>
        <p class="hero-subtitle">Hitung jejak karbon perusahaan Anda dan berkontribusi pada masa depan yang lebih hijau</p>
    </div>

    <div class="action-card">
        <h2 style="margin-bottom: 20px; color: #064e3b;">Mulai Perhitungan Baru</h2>
        <p style="color: #64748b; margin-bottom: 30px;">Hitung emisi karbon dari semua aktivitas perusahaan Anda dalam 3 scope emisi</p>
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
@endsection