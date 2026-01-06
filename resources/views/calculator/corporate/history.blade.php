@extends('layouts.app')

@section('content')
<style>
.history-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    padding: 60px 20px;
}

.history-header {
    max-width: 1200px;
    margin: 0 auto 40px;
    text-align: center;
}

.history-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #064e3b;
    margin-bottom: 10px;
}

.history-subtitle {
    color: #059669;
    font-size: 1.1rem;
}

/* FILTERS */
.filters-card {
    max-width: 1200px;
    margin: 0 auto 30px;
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.filters-row {
    display: flex;
    gap: 15px;
    align-items: flex-end;
    flex-wrap: wrap;
}

.filter-group {
    flex: 1;
    min-width: 200px;
}

.filter-label {
    display: block;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.filter-control {
    width: 100%;
    padding: 10px 14px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.filter-control:focus {
    outline: none;
    border-color: #10b981;
}

.btn-filter {
    padding: 10px 24px;
    background: #10b981;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-filter:hover {
    background: #059669;
}

.btn-reset {
    padding: 10px 24px;
    background: white;
    color: #64748b;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-reset:hover {
    background: #f8fafc;
}

/* STATS CARDS */
.stats-grid {
    max-width: 1200px;
    margin: 0 auto 30px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.stat-icon {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.stat-value {
    font-size: 2rem;
    font-weight: 800;
    color: #10b981;
    margin-bottom: 5px;
}

.stat-label {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 600;
}

/* HISTORY LIST */
.history-list {
    max-width: 1200px;
    margin: 0 auto;
}

.history-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.history-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f1f5f9;
}

.card-info {
    flex: 1;
}

.company-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}

.company-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #64748b;
    font-size: 0.9rem;
}

.meta-item i {
    color: #10b981;
}

.card-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    white-space: nowrap;
}

.badge-completed {
    background: #d1fae5;
    color: #065f46;
}

/* EMISSIONS GRID */
.emissions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.emission-item {
    background: #f8fafc;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
}

.emission-value {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
}

.emission-label {
    color: #64748b;
    font-size: 0.85rem;
    font-weight: 600;
}

.emission-total {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.emission-total .emission-value,
.emission-total .emission-label {
    color: white;
}

/* ACTIONS */
.card-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-action {
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-view {
    background: #10b981;
    color: white;
}

.btn-view:hover {
    background: #059669;
    color: white;
}

.btn-pdf {
    background: #ef4444;
    color: white;
}

.btn-pdf:hover {
    background: #dc2626;
    color: white;
}

.btn-delete {
    background: #64748b;
    color: white;
}

.btn-delete:hover {
    background: #475569;
    color: white;
}

/* EMPTY STATE */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 16px;
}

.empty-icon {
    font-size: 5rem;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}

.empty-text {
    font-size: 1.1rem;
    color: #64748b;
    margin-bottom: 30px;
}

.btn-primary {
    padding: 14px 32px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    color: white;
}

/* PAGINATION */
.pagination {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 30px;
}

.pagination a,
.pagination span {
    padding: 10px 16px;
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    color: #64748b;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pagination a:hover {
    background: #f8fafc;
    border-color: #10b981;
    color: #10b981;
}

.pagination .active {
    background: #10b981;
    border-color: #10b981;
    color: white;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .history-title {
        font-size: 2rem;
    }

    .filters-row {
        flex-direction: column;
    }

    .filter-group {
        width: 100%;
    }

    .card-header {
        flex-direction: column;
        gap: 15px;
    }

    .emissions-grid {
        grid-template-columns: 1fr;
    }

    .card-actions {
        flex-direction: column;
    }

    .btn-action {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="history-container">
    <!-- HEADER -->
    <div class="history-header">
        <h1 class="history-title">📊 Riwayat Perhitungan</h1>
        <p class="history-subtitle">Lihat semua perhitungan emisi karbon yang pernah Anda lakukan</p>
    </div>

    @if($calculations->count() > 0)
        <!-- STATS -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📝</div>
                <div class="stat-value">{{ $calculations->count() }}</div>
                <div class="stat-label">Total Perhitungan</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🌍</div>
                <div class="stat-value">{{ number_format($calculations->sum('total_emission') / 1000, 2) }}</div>
                <div class="stat-label">Total Emisi (Ton CO₂e)</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📈</div>
                <div class="stat-value">{{ number_format($calculations->avg('total_emission') / 1000, 2) }}</div>
                <div class="stat-label">Rata-rata Emisi (Ton CO₂e)</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-value">Rp {{ number_format($calculations->sum('compensation_cost') / 1000000, 1) }}M</div>
                <div class="stat-label">Total Biaya Kompensasi</div>
            </div>
        </div>

        <!-- FILTERS -->
        <div class="filters-card">
            <form method="GET" action="{{ route('calc.corporate.history') }}">
                <div class="filters-row">
                    <div class="filter-group">
                        <label class="filter-label">Tahun</label>
                        <select name="year" class="filter-control">
                            <option value="">Semua Tahun</option>
                            @for($year = date('Y') + 1; $year >= 2020; $year--)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Industri</label>
                        <select name="industry" class="filter-control">
                            <option value="">Semua Industri</option>
                            <option value="manufacturing" {{ request('industry') == 'manufacturing' ? 'selected' : '' }}>Manufaktur</option>
                            <option value="service" {{ request('industry') == 'service' ? 'selected' : '' }}>Jasa/Layanan</option>
                            <option value="retail" {{ request('industry') == 'retail' ? 'selected' : '' }}>Retail</option>
                            <option value="technology" {{ request('industry') == 'technology' ? 'selected' : '' }}>Teknologi</option>
                            <option value="other" {{ request('industry') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Urutkan</label>
                        <select name="sort" class="filter-control">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Emisi Tertinggi</option>
                            <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : '' }}>Emisi Terendah</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-filter">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('calc.corporate.history') }}" class="btn-reset">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- HISTORY LIST -->
        <div class="history-list">
            @foreach($calculations as $calc)
            <div class="history-card">
                <div class="card-header">
                    <div class="card-info">
                        <h3 class="company-name">{{ $calc->company_name }}</h3>
                        <div class="company-meta">
                            <span class="meta-item">
                                <i class="bi bi-calendar"></i>
                                {{ $calc->created_at->format('d M Y, H:i') }}
                            </span>
                            <span class="meta-item">
                                <i class="bi bi-building"></i>
                                {{ ucfirst($calc->industry_type) }}
                            </span>
                            <span class="meta-item">
                                <i class="bi bi-calendar-check"></i>
                                Tahun {{ $calc->calculation_year }}
                            </span>
                            @if($calc->employee_count)
                            <span class="meta-item">
                                <i class="bi bi-people"></i>
                                {{ number_format($calc->employee_count) }} Karyawan
                            </span>
                            @endif
                        </div>
                    </div>
                    <span class="card-badge badge-completed">
                        <i class="bi bi-check-circle"></i> {{ ucfirst($calc->status) }}
                    </span>
                </div>

                <div class="emissions-grid">
                    <div class="emission-item emission-total">
                        <div class="emission-value">{{ number_format($calc->total_emission / 1000, 2) }}</div>
                        <div class="emission-label">Total CO₂e (Ton)</div>
                    </div>
                    <div class="emission-item">
                        <div class="emission-value">{{ number_format($calc->scope1_total / 1000, 2) }}</div>
                        <div class="emission-label">Scope 1</div>
                    </div>
                    <div class="emission-item">
                        <div class="emission-value">{{ number_format($calc->scope2_total / 1000, 2) }}</div>
                        <div class="emission-label">Scope 2</div>
                    </div>
                    <div class="emission-item">
                        <div class="emission-value">{{ number_format($calc->scope3_total / 1000, 2) }}</div>
                        <div class="emission-label">Scope 3</div>
                    </div>
                </div>

                <div style="background: #f8fafc; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                    <strong style="color: #064e3b;">Biaya Kompensasi:</strong>
                    <span style="color: #10b981; font-size: 1.2rem; font-weight: 700; margin-left: 10px;">
                        Rp {{ number_format($calc->compensation_cost, 0, ',', '.') }}
                    </span>
                </div>

                <div class="card-actions">
                    <a href="{{ route('calc.corporate.result', $calc->id) }}" class="btn-action btn-view">
                        <i class="bi bi-eye"></i> Lihat Detail
                    </a>
                    <a href="{{ route('calc.corporate.export-pdf', $calc->id) }}" class="btn-action btn-pdf">
                        <i class="bi bi-file-pdf"></i> Download PDF
                    </a>
                    <form method="POST" action="{{ route('calc.corporate.delete', $calc->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus perhitungan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- PAGINATION -->
        @if($calculations->hasPages())
        <div class="pagination">
            {{ $calculations->links() }}
        </div>
        @endif

    @else
        <!-- EMPTY STATE -->
        <div class="empty-state">
            <div class="empty-icon">📊</div>
            <h2 class="empty-title">Belum Ada Riwayat</h2>
            <p class="empty-text">Anda belum memiliki riwayat perhitungan emisi karbon. Mulai perhitungan pertama Anda sekarang!</p>
            <a href="{{ route('calc.corporate.create') }}" class="btn-primary">
                <i class="bi bi-calculator"></i>
                Mulai Perhitungan
            </a>
        </div>
    @endif
</div>

@endsection