@extends('layouts.app')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Mono:wght@400;500&display=swap');

* { font-family: 'Plus Jakarta Sans', sans-serif; }

:root {
    --green-900: #064e3b;
    --green-700: #047857;
    --green-500: #10b981;
    --green-400: #34d399;
    --green-100: #d1fae5;
    --green-50:  #ecfdf5;
    --slate-900: #0f172a;
    --slate-700: #334155;
    --slate-500: #64748b;
    --slate-300: #cbd5e1;
    --slate-100: #f1f5f9;
    --slate-50:  #f8fafc;
}

.history-wrap {
    min-height: 100vh;
    background: linear-gradient(160deg, #f0fdf4 0%, #dcfce7 40%, #ecfdf5 100%);
    padding: 90px 20px 60px;
}

.history-shell { max-width: 1100px; margin: 0 auto; }

/* ── PAGE HEADER ── */
.page-hero {
    background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #047857 100%);
    border-radius: 24px;
    padding: 40px 44px;
    color: white;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 16px 48px rgba(6,78,59,.3);
}

.page-hero::before {
    content: '';
    position: absolute; top: -70px; right: -70px;
    width: 280px; height: 280px; border-radius: 50%;
    background: radial-gradient(circle, rgba(52,211,153,.15) 0%, transparent 70%);
    pointer-events: none;
}

.page-hero h1 {
    font-size: 1.85rem; font-weight: 900;
    margin-bottom: 6px; letter-spacing: -.02em;
    position: relative; z-index: 1;
}

.page-hero p {
    opacity: .82; font-size: .9rem; margin: 0;
    position: relative; z-index: 1;
}

/* ── STAT CARDS ── */
.stats-row {
    display: grid; grid-template-columns: repeat(4,1fr); gap: 14px;
    margin-bottom: 20px;
}

@media(max-width: 900px) { .stats-row { grid-template-columns: repeat(2,1fr); } }
@media(max-width: 480px) { .stats-row { grid-template-columns: 1fr; } }

.stat-card {
    background: white; border: 2px solid var(--slate-100);
    border-radius: 20px; padding: 22px;
    box-shadow: 0 2px 12px rgba(0,0,0,.05);
    transition: all .25s; position: relative; overflow: hidden;
    text-align: center;
}

.stat-card:hover { box-shadow: 0 8px 28px rgba(0,0,0,.1); transform: translateY(-2px); }

.stat-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px;
}
.stat-card.green::before  { background: linear-gradient(90deg,#10b981,#059669); }
.stat-card.blue::before   { background: linear-gradient(90deg,#3b82f6,#0ea5e9); }
.stat-card.amber::before  { background: linear-gradient(90deg,#f59e0b,#f97316); }
.stat-card.purple::before { background: linear-gradient(90deg,#8b5cf6,#6366f1); }

.stat-icon  { font-size: 1.6rem; margin-bottom: 8px; display: block; }
.stat-val   { font-size: 1.7rem; font-weight: 900; color: var(--slate-900); line-height: 1; margin-bottom: 4px; letter-spacing: -.02em; }
.stat-label { font-size: .76rem; color: var(--slate-500); font-weight: 600; }

/* ── FILTER CARD ── */
.filter-card {
    background: white; border: 2px solid var(--slate-100);
    border-radius: 20px; padding: 22px 26px;
    margin-bottom: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,.04);
}

.filter-row {
    display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;
}

.filter-group { flex: 1; min-width: 160px; }

.filter-label {
    display: block; font-size: .78rem; font-weight: 700;
    color: var(--slate-700); margin-bottom: 6px;
    text-transform: uppercase; letter-spacing: .05em;
}

.filter-control {
    width: 100%; padding: 10px 14px;
    border: 2px solid var(--slate-200); border-radius: 10px;
    font-size: .88rem; font-family: inherit;
    color: var(--slate-900); background: var(--slate-50);
    transition: all .2s;
}

.filter-control:focus {
    outline: none; border-color: var(--green-500);
    background: white; box-shadow: 0 0 0 3px rgba(16,185,129,.1);
}

.btn-filter {
    padding: 10px 22px; border-radius: 10px; border: none;
    background: var(--green-500); color: white;
    font-weight: 700; font-size: .85rem; cursor: pointer;
    transition: all .2s; white-space: nowrap;
    display: inline-flex; align-items: center; gap: 6px;
}
.btn-filter:hover { background: var(--green-700); transform: translateY(-1px); }

.btn-reset {
    padding: 10px 20px; border-radius: 10px;
    background: white; color: var(--slate-500);
    border: 2px solid var(--slate-200);
    font-weight: 700; font-size: .85rem; cursor: pointer;
    transition: all .2s; text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;
}
.btn-reset:hover { background: var(--slate-50); color: var(--slate-700); }

/* ── HISTORY CARDS ── */
.history-list { display: flex; flex-direction: column; gap: 16px; }

.history-card {
    background: white; border: 2px solid var(--slate-100);
    border-radius: 22px; overflow: hidden;
    box-shadow: 0 2px 14px rgba(0,0,0,.05);
    transition: all .25s;
}

.history-card:hover {
    box-shadow: 0 10px 32px rgba(0,0,0,.1);
    transform: translateY(-2px);
}

/* top accent bar driven by highest damage level */
.history-card::before {
    content: ''; display: block; height: 4px;
}
.history-card.accent-none::before   { background: var(--slate-200); }
.history-card.accent-low::before    { background: linear-gradient(90deg,#10b981,#34d399); }
.history-card.accent-medium::before { background: linear-gradient(90deg,#f59e0b,#fbbf24); }
.history-card.accent-high::before   { background: linear-gradient(90deg,#ef4444,#f97316); }

.hc-body { padding: 26px 28px; }

/* CARD TOP ROW */
.hc-top {
    display: flex; align-items: flex-start;
    justify-content: space-between; gap: 16px;
    margin-bottom: 20px; padding-bottom: 18px;
    border-bottom: 2px solid var(--slate-100);
    flex-wrap: wrap;
}

.hc-info { flex: 1; min-width: 0; }

.hc-company {
    font-size: 1.25rem; font-weight: 900; color: var(--slate-900);
    margin-bottom: 6px; letter-spacing: -.01em;
}

.hc-meta {
    display: flex; flex-wrap: wrap; gap: 12px;
    font-size: .78rem; color: var(--slate-500);
}

.hc-meta-item {
    display: flex; align-items: center; gap: 5px; font-weight: 500;
}

.hc-meta-item i { color: var(--green-500); font-size: .8rem; }

.hc-status {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 14px; border-radius: 100px;
    font-size: .76rem; font-weight: 800;
    background: var(--green-100); color: var(--green-700);
    white-space: nowrap; flex-shrink: 0;
}

/* DAMAGE PILLS ROW */
.damage-row {
    display: flex; flex-wrap: wrap; gap: 10px;
    margin-bottom: 18px;
}

.dmg-block {
    display: flex; align-items: center; gap: 8px;
    padding: 10px 14px; border-radius: 14px;
    border: 2px solid; flex: 1; min-width: 140px;
}

.dmg-block.land  { border-color: #bbf7d0; background: #f0fdf4; }
.dmg-block.air   { border-color: #bfdbfe; background: #eff6ff; }
.dmg-block.water { border-color: #ddd6fe; background: #f5f3ff; }

.dmg-block-icon { font-size: 1.1rem; flex-shrink: 0; }
.dmg-block-info { flex: 1; min-width: 0; }
.dmg-block-name { font-size: .7rem; font-weight: 700; color: var(--slate-500); text-transform: uppercase; letter-spacing: .06em; margin-bottom: 3px; }
.dmg-block-level {
    display: inline-block; padding: 2px 9px; border-radius: 100px;
    font-size: .72rem; font-weight: 800;
}

.lvl-none   { background: #f1f5f9; color: #64748b; }
.lvl-low    { background: #d1fae5; color: #065f46; }
.lvl-medium { background: #fef3c7; color: #92400e; }
.lvl-high   { background: #fee2e2; color: #991b1b; }

/* COMPENSATION ROW */
.comp-row {
    display: flex; align-items: center; justify-content: space-between;
    background: var(--slate-50); border: 2px solid var(--slate-100);
    border-radius: 14px; padding: 14px 18px;
    margin-bottom: 18px; flex-wrap: wrap; gap: 10px;
}

.comp-left { display: flex; flex-direction: column; gap: 2px; }
.comp-label { font-size: .72rem; font-weight: 700; color: var(--slate-500); text-transform: uppercase; letter-spacing: .06em; }
.comp-value { font-size: 1.4rem; font-weight: 900; color: var(--green-500); letter-spacing: -.02em; }

.comp-right { display: flex; flex-direction: column; align-items: flex-end; gap: 2px; }
.scheme-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 12px; border-radius: 100px;
    background: var(--green-50); border: 1.5px solid var(--green-100);
    font-size: .76rem; font-weight: 700; color: var(--green-700);
}
.installment-info { font-size: .74rem; color: var(--slate-500); font-weight: 500; }

/* ACTIONS */
.hc-actions { display: flex; gap: 8px; flex-wrap: wrap; }

.btn-act {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 18px; border-radius: 11px;
    font-size: .82rem; font-weight: 700;
    cursor: pointer; transition: all .2s;
    border: 2px solid; text-decoration: none;
}

.btn-act.view {
    background: var(--green-500); border-color: var(--green-500); color: white;
}
.btn-act.view:hover { background: var(--green-700); border-color: var(--green-700); color: white; }

.btn-act.monitoring {
    background: white; border-color: var(--green-400); color: var(--green-700);
}
.btn-act.monitoring:hover { background: var(--green-50); }

.btn-act.pdf {
    background: white; border-color: #fca5a5; color: #991b1b;
}
.btn-act.pdf:hover { background: #fef2f2; }

.btn-act.del {
    background: white; border-color: var(--slate-300); color: var(--slate-500);
}
.btn-act.del:hover { background: var(--slate-50); color: var(--slate-700); }

/* ── EMPTY STATE ── */
.empty-state {
    text-align: center; padding: 80px 20px;
    background: white; border-radius: 22px;
    border: 2px solid var(--slate-100);
    box-shadow: 0 4px 20px rgba(0,0,0,.05);
}

.empty-icon  { font-size: 4.5rem; margin-bottom: 18px; opacity: .5; }
.empty-title { font-size: 1.5rem; font-weight: 800; color: var(--slate-900); margin-bottom: 10px; }
.empty-text  { font-size: .95rem; color: var(--slate-500); margin-bottom: 28px; line-height: 1.7; }

.btn-primary-cta {
    display: inline-flex; align-items: center; gap: 9px;
    padding: 14px 32px; border-radius: 13px;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white; font-weight: 700; font-size: .95rem;
    border: none; cursor: pointer; text-decoration: none;
    transition: all .25s;
    box-shadow: 0 6px 20px rgba(16,185,129,.3);
}
.btn-primary-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(16,185,129,.4);
    color: white;
}

/* ── PAGINATION ── */
.pagination-wrap {
    display: flex; justify-content: center; margin-top: 28px;
}

.pagination-wrap nav { display: flex; gap: 8px; flex-wrap: wrap; justify-content: center; }

/* override Laravel's default pagination */
.pagination-wrap .pagination {
    display: flex; gap: 8px; list-style: none; padding: 0; margin: 0;
}

.pagination-wrap .page-item .page-link {
    padding: 9px 16px; background: white;
    border: 2px solid var(--slate-200); border-radius: 10px;
    color: var(--slate-500); text-decoration: none;
    font-weight: 700; font-size: .84rem; transition: all .2s;
}

.pagination-wrap .page-item .page-link:hover {
    background: var(--green-50); border-color: var(--green-400); color: var(--green-700);
}

.pagination-wrap .page-item.active .page-link {
    background: var(--green-500); border-color: var(--green-500); color: white;
}

/* ── RESPONSIVE ── */
@media(max-width: 768px) {
    .page-hero { padding: 30px 22px; }
    .page-hero h1 { font-size: 1.5rem; }
    .hc-body { padding: 20px; }
    .hc-top { flex-direction: column; gap: 10px; }
    .comp-row { flex-direction: column; align-items: flex-start; }
    .comp-right { align-items: flex-start; }
    .hc-actions { flex-direction: column; }
    .btn-act { width: 100%; justify-content: center; }
    .filter-row { flex-direction: column; }
    .filter-group { width: 100%; }
    .btn-filter, .btn-reset { width: 100%; justify-content: center; }
}
</style>

@php
    /* ── Pricing map (same as result/monitoring) ── */
    $damageCosts = ['none'=>0,'low'=>250_000_000,'medium'=>750_000_000,'high'=>1_750_000_000];
    $lvlLabel    = ['none'=>'Tidak Ada','low'=>'Ringan','medium'=>'Sedang','high'=>'Berat'];
    $lvlClass    = ['none'=>'lvl-none','low'=>'lvl-low','medium'=>'lvl-medium','high'=>'lvl-high'];
    $schemeLabel = ['annual'=>'🗓️ Tahunan','semi_annual'=>'📆 Semesteran','quarterly'=>'📅 Kuartalan'];
    $installNums = ['annual'=>1,'semi_annual'=>2,'quarterly'=>4];
    $installRate = ['annual'=>1.0,'semi_annual'=>0.55,'quarterly'=>0.30];
    $industryMap = [
        'manufacturing'=>'Manufaktur','chemical'=>'Industri Kimia',
        'mining'=>'Pertambangan','cement'=>'Semen & Material',
        'pulp'=>'Pulp & Kertas','palm_oil'=>'Kelapa Sawit',
        'steel'=>'Baja & Logam','construction'=>'Konstruksi',
        'transportation'=>'Transportasi','energy'=>'Energi & Utilitas',
        'agriculture'=>'Pertanian','service'=>'Jasa & Layanan',
        'technology'=>'Teknologi','other'=>'Lainnya',
    ];

    /* ── Stats ── */
    if ($calculations->count() > 0) {
        $totalComp = $calculations->sum(function($c) use ($damageCosts) {
            $d = $c->damage_data ?? ['land'=>'none','air'=>'none','water'=>'none'];
            return ($damageCosts[$d['land']??'none'] ?? 0)
                 + ($damageCosts[$d['air']??'none']  ?? 0)
                 + ($damageCosts[$d['water']??'none'] ?? 0);
        });
        $latestYear = $calculations->max('calculation_year');
    }
@endphp

<div class="history-wrap">
<div class="history-shell">

    <!-- PAGE HERO -->
    <div class="page-hero">
        <h1>📋 Riwayat Perhitungan Kompensasi</h1>
        <p>Semua perhitungan emisi & kompensasi lingkungan yang pernah Anda lakukan</p>
    </div>

    @if($calculations->count() > 0)

    <!-- STATS -->
    <div class="stats-row">
        <div class="stat-card green">
            <span class="stat-icon">📝</span>
            <div class="stat-val">{{ $calculations->total() }}</div>
            <div class="stat-label">Total Perhitungan</div>
        </div>
        <div class="stat-card blue">
            <span class="stat-icon">💰</span>
            <div class="stat-val">Rp {{ number_format($totalComp/1_000_000, 0, ',', '.') }}M</div>
            <div class="stat-label">Total Kompensasi</div>
        </div>
        <div class="stat-card amber">
            <span class="stat-icon">🏭</span>
            <div class="stat-val">{{ $calculations->unique('company_name')->count() }}</div>
            <div class="stat-label">Perusahaan Berbeda</div>
        </div>
        <div class="stat-card purple">
            <span class="stat-icon">📅</span>
            <div class="stat-val">{{ $latestYear }}</div>
            <div class="stat-label">Tahun Terakhir</div>
        </div>
    </div>

    <!-- FILTERS -->
    <div class="filter-card">
        <form method="GET" action="{{ route('calc.corporate.history') }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label class="filter-label">Tahun</label>
                    <select name="year" class="filter-control">
                        <option value="">Semua Tahun</option>
                        @for($y = date('Y') + 1; $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Kategori Usaha</label>
                    <select name="industry" class="filter-control">
                        <option value="">Semua Industri</option>
                        @foreach($industryMap as $val => $label)
                            <option value="{{ $val }}" {{ request('industry') == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Tingkat Dampak</label>
                    <select name="damage_level" class="filter-control">
                        <option value="">Semua Level</option>
                        <option value="none"   {{ request('damage_level')=='none'   ? 'selected':'' }}>Tidak Ada</option>
                        <option value="low"    {{ request('damage_level')=='low'    ? 'selected':'' }}>Ringan</option>
                        <option value="medium" {{ request('damage_level')=='medium' ? 'selected':'' }}>Sedang</option>
                        <option value="high"   {{ request('damage_level')=='high'   ? 'selected':'' }}>Berat</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Urutkan</label>
                    <select name="sort" class="filter-control">
                        <option value="latest"  {{ request('sort','latest')=='latest'  ? 'selected':'' }}>Terbaru</option>
                        <option value="oldest"  {{ request('sort')=='oldest'  ? 'selected':'' }}>Terlama</option>
                        <option value="highest" {{ request('sort')=='highest' ? 'selected':'' }}>Kompensasi Tertinggi</option>
                        <option value="lowest"  {{ request('sort')=='lowest'  ? 'selected':'' }}>Kompensasi Terendah</option>
                    </select>
                </div>
                <button type="submit" class="btn-filter">
                    <i class="bi bi-funnel-fill"></i> Filter
                </button>
                <a href="{{ route('calc.corporate.history') }}" class="btn-reset">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- HISTORY LIST -->
    <div class="history-list">
        @foreach($calculations as $calc)
        @php
            $dmg       = $calc->damage_data ?? ['land'=>'none','air'=>'none','water'=>'none'];
            $landLvl   = $dmg['land']  ?? 'none';
            $airLvl    = $dmg['air']   ?? 'none';
            $waterLvl  = $dmg['water'] ?? 'none';

            $landCost  = $damageCosts[$landLvl]  ?? 0;
            $airCost   = $damageCosts[$airLvl]   ?? 0;
            $waterCost = $damageCosts[$waterLvl] ?? 0;
            $compTotal = $calc->compensation_cost ?? ($landCost + $airCost + $waterCost);

            $scheme    = $calc->payment_scheme ?? 'annual';
            $instNum   = $installNums[$scheme]  ?? 1;
            $instAmt   = $compTotal * ($installRate[$scheme] ?? 1.0);

            /* highest damage level for accent color */
            $levels  = ['none'=>0,'low'=>1,'medium'=>2,'high'=>3];
            $maxLvl  = collect([$landLvl,$airLvl,$waterLvl])
                         ->sortByDesc(fn($l) => $levels[$l] ?? 0)->first();
            $accentClass = 'accent-' . $maxLvl;
        @endphp

        <div class="history-card {{ $accentClass }}">
            <div class="hc-body">

                <!-- TOP ROW -->
                <div class="hc-top">
                    <div class="hc-info">
                        <div class="hc-company">{{ $calc->company_name }}</div>
                        <div class="hc-meta">
                            <span class="hc-meta-item">
                                <i class="bi bi-calendar3"></i>
                                {{ $calc->created_at->format('d M Y, H:i') }}
                            </span>
                            <span class="hc-meta-item">
                                <i class="bi bi-building"></i>
                                {{ $industryMap[$calc->industry_type] ?? ucfirst($calc->industry_type) }}
                            </span>
                            <span class="hc-meta-item">
                                <i class="bi bi-calendar-check"></i>
                                Tahun {{ $calc->calculation_year }}
                            </span>
                            <span class="hc-meta-item">
                                <i class="bi bi-geo-alt"></i>
                                {{ $calc->company_location }}
                            </span>
                            <span class="hc-meta-item">
                                <i class="bi bi-diagram-3"></i>
                                {{ $calc->facility_count }} fasilitas
                            </span>
                        </div>
                    </div>
                    <div class="hc-status">
                        ✓ Selesai
                    </div>
                </div>

                <!-- DAMAGE BLOCKS -->
                <div class="damage-row">
                    <div class="dmg-block land">
                        <div class="dmg-block-icon">🏔️</div>
                        <div class="dmg-block-info">
                            <div class="dmg-block-name">Tanah</div>
                            <span class="dmg-block-level {{ $lvlClass[$landLvl] }}">{{ $lvlLabel[$landLvl] }}</span>
                        </div>
                    </div>
                    <div class="dmg-block air">
                        <div class="dmg-block-icon">💨</div>
                        <div class="dmg-block-info">
                            <div class="dmg-block-name">Udara</div>
                            <span class="dmg-block-level {{ $lvlClass[$airLvl] }}">{{ $lvlLabel[$airLvl] }}</span>
                        </div>
                    </div>
                    <div class="dmg-block water">
                        <div class="dmg-block-icon">💧</div>
                        <div class="dmg-block-info">
                            <div class="dmg-block-name">Air</div>
                            <span class="dmg-block-level {{ $lvlClass[$waterLvl] }}">{{ $lvlLabel[$waterLvl] }}</span>
                        </div>
                    </div>
                </div>

                <!-- COMPENSATION ROW -->
                <div class="comp-row">
                    <div class="comp-left">
                        <div class="comp-label">Total Kompensasi</div>
                        <div class="comp-value">Rp {{ number_format($compTotal, 0, ',', '.') }}</div>
                    </div>
                    <div class="comp-right">
                        <div class="scheme-badge">{{ $schemeLabel[$scheme] ?? '🗓️ Tahunan' }}</div>
                        <div class="installment-info">
                            {{ $instNum }}× termin · Rp {{ number_format($instAmt, 0, ',', '.') }}/termin
                        </div>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="hc-actions">
                    <a href="{{ route('calc.corporate.result', $calc->id) }}" class="btn-act view">
                        <i class="bi bi-eye-fill"></i> Lihat Hasil
                    </a>
                    <a href="{{ route('calc.corporate.monitoring', $calc->id) }}" class="btn-act monitoring">
                        <i class="bi bi-bar-chart-fill"></i> Monitoring
                    </a>
                    <a href="{{ route('calc.corporate.export-pdf', $calc->id) }}" class="btn-act pdf">
                        <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                    </a>
                    <form method="POST"
                          action="{{ route('calc.corporate.delete', $calc->id) }}"
                          style="display:inline;"
                          onsubmit="return confirm('Yakin ingin menghapus perhitungan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-act del">
                            <i class="bi bi-trash3-fill"></i> Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    <!-- PAGINATION -->
    @if($calculations->hasPages())
    <div class="pagination-wrap">
        {{ $calculations->links() }}
    </div>
    @endif

    @else

    <!-- EMPTY STATE -->
    <div class="empty-state">
        <div class="empty-icon">📋</div>
        <h2 class="empty-title">Belum Ada Riwayat</h2>
        <p class="empty-text">Anda belum memiliki riwayat perhitungan emisi karbon.<br>Mulai perhitungan pertama perusahaan Anda sekarang!</p>
        <a href="{{ route('calc.corporate.create') }}" class="btn-primary-cta">
            <i class="bi bi-calculator-fill"></i>
            Mulai Perhitungan
        </a>
    </div>

    @endif

</div>
</div>

@endsection