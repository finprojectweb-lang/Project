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
    --red-500:   #ef4444;
    --blue-500:  #3b82f6;
    --purple-500:#a855f7;
    --amber-500: #f59e0b;
}

.result-wrap {
    min-height: 100vh;
    background: linear-gradient(160deg, #f0fdf4 0%, #dcfce7 40%, #ecfdf5 100%);
    padding: 80px 20px 60px;
}

.result-shell { max-width: 1050px; margin: 0 auto; }

/* ══════════════════════════════
   HERO HEADER
══════════════════════════════ */
.res-hero {
    background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #047857 100%);
    border-radius: 28px;
    padding: 52px 44px;
    color: white;
    position: relative;
    overflow: hidden;
    margin-bottom: 24px;
    box-shadow: 0 24px 64px rgba(6,78,59,.35);
}

.res-hero::before {
    content: '';
    position: absolute; top: -80px; right: -80px;
    width: 320px; height: 320px; border-radius: 50%;
    background: radial-gradient(circle, rgba(52,211,153,.18) 0%, transparent 70%);
}

.res-hero::after {
    content: '';
    position: absolute; bottom: -60px; left: 60px;
    width: 220px; height: 220px; border-radius: 50%;
    background: radial-gradient(circle, rgba(16,185,129,.12) 0%, transparent 70%);
}

.hero-top {
    display: flex; align-items: flex-start; justify-content: space-between;
    gap: 20px; flex-wrap: wrap; position: relative; z-index: 1;
}

.hero-icon {
    width: 72px; height: 72px; border-radius: 20px;
    background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
    display: flex; align-items: center; justify-content: center;
    font-size: 2rem; margin-bottom: 20px;
}

.hero-title {
    font-size: 2.1rem; font-weight: 900; line-height: 1.15;
    margin-bottom: 8px; letter-spacing: -.02em;
}

.hero-company {
    font-size: 1rem; opacity: .85; font-weight: 500;
    display: flex; align-items: center; gap: 8px; margin-bottom: 6px;
}

.hero-meta { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 14px; }

.hero-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 13px;
    background: rgba(255,255,255,.13);
    border: 1px solid rgba(255,255,255,.22);
    border-radius: 100px; font-size: .76rem; font-weight: 600;
}

.hero-status {
    text-align: right;
}

.hero-status-label {
    font-size: .72rem; opacity: .7; text-transform: uppercase; letter-spacing: .08em;
    margin-bottom: 6px;
}

.hero-emission-big {
    font-size: 3rem; font-weight: 900; line-height: 1;
    letter-spacing: -.03em;
}

.hero-emission-unit {
    font-size: .85rem; opacity: .75; font-weight: 500; margin-top: 4px;
}

/* ══════════════════════════════
   KOMPENSASI UTAMA
══════════════════════════════ */
.comp-main {
    background: white;
    border: 2px solid var(--green-100);
    border-radius: 22px;
    padding: 36px 40px;
    margin-bottom: 24px;
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: center; gap: 32px;
    box-shadow: 0 8px 32px rgba(0,0,0,.06);
}

@media(max-width: 700px) {
    .comp-main { grid-template-columns: 1fr; text-align: center; }
    .comp-divider { display: none; }
}

.comp-main-label {
    font-size: .75rem; font-weight: 700; color: var(--slate-500);
    text-transform: uppercase; letter-spacing: .08em; margin-bottom: 8px;
}

.comp-main-val {
    font-size: 2.6rem; font-weight: 900; color: var(--green-500);
    letter-spacing: -.03em; line-height: 1;
}

.comp-main-sub { font-size: .82rem; color: var(--slate-500); margin-top: 6px; }

.comp-divider {
    width: 2px; height: 80px;
    background: linear-gradient(180deg, transparent, var(--slate-300), transparent);
}

.comp-scheme-badge {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 8px 16px; border-radius: 12px;
    background: var(--green-50); border: 2px solid var(--green-100);
    font-size: .82rem; font-weight: 700; color: var(--green-700);
    margin-bottom: 10px;
}

.comp-installment {
    font-size: 1.5rem; font-weight: 800; color: var(--slate-900);
    margin-bottom: 4px; letter-spacing: -.02em;
}

.comp-per { font-size: .82rem; color: var(--slate-500); }

/* ══════════════════════════════
   DAMAGE SUMMARY CARDS
══════════════════════════════ */
.damage-row {
    display: grid; grid-template-columns: repeat(3,1fr); gap: 14px;
    margin-bottom: 24px;
}

@media(max-width: 640px) { .damage-row { grid-template-columns: 1fr; } }

.dmg-card {
    border-radius: 18px; padding: 22px 20px; position: relative; overflow: hidden;
    border: 2px solid;
}

.dmg-card.land  { border-color: #bbf7d0; background: linear-gradient(135deg, #f0fdf4, #ecfdf5); }
.dmg-card.air   { border-color: #bfdbfe; background: linear-gradient(135deg, #eff6ff, #f0f9ff); }
.dmg-card.water { border-color: #ddd6fe; background: linear-gradient(135deg, #f5f3ff, #ede9fe); }

.dmg-card-icon { font-size: 1.6rem; margin-bottom: 10px; display: block; }
.dmg-card-name { font-size: .78rem; font-weight: 700; color: var(--slate-500); text-transform: uppercase; letter-spacing: .07em; margin-bottom: 6px; }
.dmg-card-level {
    display: inline-block; padding: 4px 12px; border-radius: 100px;
    font-size: .8rem; font-weight: 800;
}

.lvl-none   { background: #f1f5f9; color: #64748b; }
.lvl-low    { background: #d1fae5; color: #065f46; }
.lvl-medium { background: #fef3c7; color: #92400e; }
.lvl-high   { background: #fee2e2; color: #991b1b; }

.dmg-card-cost { font-size: 1.2rem; font-weight: 800; color: var(--slate-900); margin-top: 10px; }
.dmg-card-cost-label { font-size: .72rem; color: var(--slate-500); margin-top: 2px; }

/* ══════════════════════════════
   ALLOCATION
══════════════════════════════ */
.alloc-panel {
    background: white; border: 2px solid var(--slate-100);
    border-radius: 22px; padding: 30px 34px; margin-bottom: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,.05);
}

.panel-title-row {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 24px;
}

.panel-title {
    font-size: 1.1rem; font-weight: 800; color: var(--slate-900);
    display: flex; align-items: center; gap: 10px;
}

.alloc-bar-container { margin-bottom: 18px; }
.alloc-bar-row { display: flex; height: 10px; border-radius: 100px; overflow: hidden; margin-bottom: 12px; }
.alloc-seg { transition: width 1s ease; }

.alloc-legend { display: flex; flex-wrap: wrap; gap: 14px; }
.alloc-leg-item { display: flex; align-items: center; gap: 8px; font-size: .8rem; color: var(--slate-700); }
.alloc-leg-dot { width: 10px; height: 10px; border-radius: 3px; flex-shrink: 0; }
.alloc-leg-pct { font-weight: 700; color: var(--slate-900); }

/* ══════════════════════════════
   RECOMMENDATIONS
══════════════════════════════ */
.reco-panel {
    background: linear-gradient(135deg, #fffbeb, #fef3c7);
    border: 2px solid #fcd34d;
    border-radius: 22px; padding: 30px 34px; margin-bottom: 24px;
}

.reco-title {
    font-size: 1.1rem; font-weight: 800; color: #92400e;
    display: flex; align-items: center; gap: 10px; margin-bottom: 18px;
}

.reco-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
@media(max-width: 640px) { .reco-grid { grid-template-columns: 1fr; } }

.reco-item {
    background: white; border-radius: 14px;
    padding: 16px 18px; display: flex; gap: 12px; align-items: flex-start;
    border: 1px solid #fde68a;
}

.reco-num {
    width: 26px; height: 26px; border-radius: 8px;
    background: #f59e0b; color: white;
    font-size: .72rem; font-weight: 900;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 1px;
}

.reco-text { font-size: .84rem; color: #78350f; line-height: 1.6; }

/* ══════════════════════════════
   CTA SECTION
══════════════════════════════ */
.cta-section {
    display: grid; grid-template-columns: 1fr 1fr; gap: 16px;
    margin-bottom: 24px;
}

@media(max-width: 640px) { .cta-section { grid-template-columns: 1fr; } }

.cta-card {
    border-radius: 22px; padding: 32px 30px; text-align: center;
    text-decoration: none; transition: all .25s; display: block;
    border: 2px solid;
}

.cta-card.payment {
    background: linear-gradient(135deg, #064e3b, #065f46);
    border-color: #047857;
    box-shadow: 0 12px 36px rgba(6,78,59,.3);
}

.cta-card.payment:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 48px rgba(6,78,59,.4);
}

.cta-card.monitoring {
    background: white;
    border-color: var(--green-400);
}

.cta-card.monitoring:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(16,185,129,.15);
    background: var(--green-50);
}

.cta-icon { font-size: 2.4rem; margin-bottom: 14px; display: block; }

.cta-title {
    font-size: 1.15rem; font-weight: 800; margin-bottom: 8px;
}

.cta-card.payment .cta-title { color: white; }
.cta-card.monitoring .cta-title { color: var(--slate-900); }

.cta-desc {
    font-size: .84rem; line-height: 1.6; margin-bottom: 18px;
}

.cta-card.payment .cta-desc { color: rgba(255,255,255,.75); }
.cta-card.monitoring .cta-desc { color: var(--slate-500); }

.cta-btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 26px; border-radius: 12px;
    font-size: .88rem; font-weight: 700; cursor: pointer;
    border: none; text-decoration: none; transition: all .2s;
}

.cta-card.payment .cta-btn {
    background: white; color: var(--green-700);
}

.cta-card.payment .cta-btn:hover { background: var(--green-50); }

.cta-card.monitoring .cta-btn {
    background: var(--green-500); color: white;
}

.cta-card.monitoring .cta-btn:hover { background: var(--green-700); }

/* guest CTA */
.cta-card.guest {
    background: var(--slate-50); border-color: var(--slate-300);
}

.cta-card.guest .cta-btn {
    background: var(--slate-900); color: white;
}

/* ══════════════════════════════
   ACTION ROW
══════════════════════════════ */
.action-row {
    display: flex; gap: 12px; flex-wrap: wrap;
    background: white; border-radius: 18px; padding: 24px;
    border: 2px solid var(--slate-100);
    box-shadow: 0 4px 16px rgba(0,0,0,.04);
}

.btn-act {
    flex: 1; min-width: 160px;
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: 14px 22px; border-radius: 12px;
    font-size: .88rem; font-weight: 700; cursor: pointer;
    border: 2px solid; text-decoration: none; transition: all .2s;
}

.btn-act.outline-green {
    border-color: var(--green-500); color: var(--green-700); background: var(--green-50);
}

.btn-act.outline-green:hover { background: var(--green-100); }

.btn-act.outline-slate {
    border-color: var(--slate-300); color: var(--slate-700); background: white;
}

.btn-act.outline-slate:hover { background: var(--slate-50); }

/* ══════════════════════════════
   POWERED BY
══════════════════════════════ */
.powered-bar {
    text-align: center; padding: 20px;
    display: flex; align-items: center; justify-content: center; gap: 10px;
    font-size: .78rem; color: var(--slate-500); font-weight: 600;
    margin-top: 10px;
}

.powered-logo { height: 26px; }

/* ══════════════════════════════
   RESPONSIVE
══════════════════════════════ */
@media(max-width: 768px) {
    .res-hero { padding: 36px 24px; }
    .hero-title { font-size: 1.6rem; }
    .hero-emission-big { font-size: 2.2rem; }
    .comp-main { padding: 26px 22px; }
    .alloc-panel, .reco-panel { padding: 24px 20px; }
    .action-row { flex-direction: column; padding: 20px; }
    .btn-act { width: 100%; }
}
</style>

{{--
    ================================================================
    PRICING LOGIC (in controller / computed here for reference):
    Damage levels → multiplier per pillar
        none   = 0
        low    = Rp  250,000,000
        medium = Rp  750,000,000
        high   = Rp 1,750,000,000

    Payment scheme:
        annual     → 1 × total
        semi_annual→ 0.55 × total (per installment, 2×)
        quarterly  → 0.30 × total (per installment, 4×)
    ================================================================
--}}

@php
    /* ── Damage Costs ───────────────────────── */
    $damageCosts = [
        'none'   => 0,
        'low'    => 250_000_000,
        'medium' => 750_000_000,
        'high'   => 1_750_000_000,
    ];

    $damageData  = $calculation->damage_data ?? ['land'=>'none','air'=>'none','water'=>'none'];
    $landLevel   = $damageData['land']  ?? 'none';
    $airLevel    = $damageData['air']   ?? 'none';
    $waterLevel  = $damageData['water'] ?? 'none';

    $landCost    = $damageCosts[$landLevel]  ?? 0;
    $airCost     = $damageCosts[$airLevel]   ?? 0;
    $waterCost   = $damageCosts[$waterLevel] ?? 0;
    $totalComp   = $calculation->compensation_cost ?? ($landCost + $airCost + $waterCost);

    /* ── Payment Scheme ─────────────────────── */
    $scheme      = $calculation->payment_scheme ?? 'annual';
    $schemeLabel = ['annual'=>'Tahunan','semi_annual'=>'Semesteran','quarterly'=>'Kuartalan'][$scheme] ?? 'Tahunan';
    $schemeIcon  = ['annual'=>'🗓️','semi_annual'=>'📆','quarterly'=>'📅'][$scheme] ?? '🗓️';
    $installments= ['annual'=>1,'semi_annual'=>2,'quarterly'=>4][$scheme] ?? 1;
    $installRates= ['annual'=>1.0,'semi_annual'=>0.55,'quarterly'=>0.30];
    $installAmt  = $totalComp * ($installRates[$scheme] ?? 1.0);

    /* ── Level Labels ───────────────────────── */
    $lvlLabel = ['none'=>'Tidak Ada','low'=>'Ringan','medium'=>'Sedang','high'=>'Berat'];
    $lvlClass = ['none'=>'lvl-none','low'=>'lvl-low','medium'=>'lvl-medium','high'=>'lvl-high'];

    /* ── Recommendations ────────────────────── */
    $recos = [];
    if ($landLevel !== 'none')  $recos[] = 'Implementasikan program revegetasi & reboisasi di area terdampak untuk memulihkan tutupan lahan.';
    if ($landLevel === 'high')  $recos[] = 'Koordinasikan dengan KLHK untuk program pemulihan lahan kritis skala besar (> 10 ha).';
    if ($airLevel !== 'none')   $recos[] = 'Pasang scrubber & filter partikulat pada cerobong asap untuk mengurangi emisi GRK secara signifikan.';
    if ($airLevel === 'high')   $recos[] = 'Pertimbangkan transisi ke energi terbarukan (solar/biomassa) untuk menggantikan bahan bakar fosil.';
    if ($waterLevel !== 'none') $recos[] = 'Bangun atau upgrade IPAL (Instalasi Pengolahan Air Limbah) sebelum periode audit berikutnya.';
    if ($waterLevel === 'high') $recos[] = 'Lakukan pemantauan kualitas air sungai di hilir pabrik setiap bulan dan laporkan ke KLH.';
    if (count($recos) < 4) {
        $recos[] = 'Lakukan audit energi internal tahunan untuk identifikasi potensi efisiensi operasional.';
        $recos[] = 'Tetapkan target pengurangan emisi 20-30% dalam roadmap 3–5 tahun ke depan.';
    }
    $recos = array_slice($recos, 0, 6);
@endphp

<div class="result-wrap">
<div class="result-shell">

    {{-- ── HERO ── --}}
    <div class="res-hero">
        <div class="hero-top">
            <div>
                <div class="hero-icon">🌍</div>
                <h1 class="hero-title">Hasil Perhitungan<br>Kompensasi Lingkungan</h1>
                <div class="hero-company">
                    🏭 {{ $calculation->company_name }}
                </div>
                <div class="hero-meta">
                    <span class="hero-pill">🗂️ {{ $calculation->company_siup }}</span>
                    <span class="hero-pill">📅 {{ $calculation->calculation_year }}</span>
                    <span class="hero-pill">📍 {{ $calculation->company_location }}</span>
                    <span class="hero-pill">🏗️ {{ $calculation->facility_count }} Fasilitas</span>
                </div>
            </div>
            <div class="hero-status" style="text-align:right;position:relative;z-index:1;">
                <div class="hero-status-label">Total Kompensasi</div>
                <div class="hero-emission-big">Rp {{ number_format($totalComp, 0, ',', '.') }}</div>
                <div class="hero-emission-unit">Biaya Offset Lingkungan {{ $calculation->calculation_year }}</div>
            </div>
        </div>
    </div>

    {{-- ── KOMPENSASI UTAMA ── --}}
    <div class="comp-main">
        <div>
            <div class="comp-main-label">Total Kompensasi Wajib</div>
            <div class="comp-main-val">Rp {{ number_format($totalComp, 0, ',', '.') }}</div>
            <div class="comp-main-sub">Dihitung berdasarkan 3 pilar dampak lingkungan</div>
        </div>
        <div class="comp-divider"></div>
        <div>
            <div class="comp-scheme-badge">{{ $schemeIcon }} {{ $schemeLabel }}</div>
            <div class="comp-installment">Rp {{ number_format($installAmt, 0, ',', '.') }}</div>
            <div class="comp-per">per termin × {{ $installments }}× setahun</div>
        </div>
    </div>

    {{-- ── DAMAGE BREAKDOWN ── --}}
    <div class="damage-row">
        <div class="dmg-card land">
            <span class="dmg-card-icon">🏔️</span>
            <div class="dmg-card-name">Kerusakan Tanah</div>
            <span class="dmg-card-level {{ $lvlClass[$landLevel] }}">{{ $lvlLabel[$landLevel] }}</span>
            <div class="dmg-card-cost">
                @if($landCost > 0) Rp {{ number_format($landCost, 0, ',', '.') }}
                @else <span style="color:#94a3b8;">Rp 0</span>
                @endif
            </div>
            <div class="dmg-card-cost-label">Kompensasi pilar tanah</div>
        </div>
        <div class="dmg-card air">
            <span class="dmg-card-icon">💨</span>
            <div class="dmg-card-name">Pencemaran Udara</div>
            <span class="dmg-card-level {{ $lvlClass[$airLevel] }}">{{ $lvlLabel[$airLevel] }}</span>
            <div class="dmg-card-cost">
                @if($airCost > 0) Rp {{ number_format($airCost, 0, ',', '.') }}
                @else <span style="color:#94a3b8;">Rp 0</span>
                @endif
            </div>
            <div class="dmg-card-cost-label">Kompensasi pilar udara</div>
        </div>
        <div class="dmg-card water">
            <span class="dmg-card-icon">💧</span>
            <div class="dmg-card-name">Pencemaran Air</div>
            <span class="dmg-card-level {{ $lvlClass[$waterLevel] }}">{{ $lvlLabel[$waterLevel] }}</span>
            <div class="dmg-card-cost">
                @if($waterCost > 0) Rp {{ number_format($waterCost, 0, ',', '.') }}
                @else <span style="color:#94a3b8;">Rp 0</span>
                @endif
            </div>
            <div class="dmg-card-cost-label">Kompensasi pilar air</div>
        </div>
    </div>

    {{-- ── ALOKASI DANA ── --}}
    <div class="alloc-panel">
        <div class="panel-title-row">
            <div class="panel-title">💰 Alokasi Dana Kompensasi</div>
            <span style="font-size:.78rem;color:var(--slate-500);font-weight:600;">Total: Rp {{ number_format($totalComp,0,',','.') }}</span>
        </div>
        <div class="alloc-bar-container">
            <div class="alloc-bar-row">
                <div class="alloc-seg" style="width:40%;background:linear-gradient(90deg,#10b981,#059669);"></div>
                <div class="alloc-seg" style="width:25%;background:linear-gradient(90deg,#3b82f6,#0ea5e9);"></div>
                <div class="alloc-seg" style="width:25%;background:linear-gradient(90deg,#8b5cf6,#6366f1);"></div>
                <div class="alloc-seg" style="width:10%;background:linear-gradient(90deg,#f59e0b,#f97316);"></div>
            </div>
            <div class="alloc-legend">
                <div class="alloc-leg-item">
                    <div class="alloc-leg-dot" style="background:#10b981;"></div>
                    🌱 Reforestasi <span class="alloc-leg-pct">40%</span>
                    <span style="color:var(--slate-500);">· Rp {{ number_format($totalComp*0.4,0,',','.') }}</span>
                </div>
                <div class="alloc-leg-item">
                    <div class="alloc-leg-dot" style="background:#3b82f6;"></div>
                    🔬 Monitoring <span class="alloc-leg-pct">25%</span>
                    <span style="color:var(--slate-500);">· Rp {{ number_format($totalComp*0.25,0,',','.') }}</span>
                </div>
                <div class="alloc-leg-item">
                    <div class="alloc-leg-dot" style="background:#8b5cf6;"></div>
                    💧 Restorasi Air <span class="alloc-leg-pct">25%</span>
                    <span style="color:var(--slate-500);">· Rp {{ number_format($totalComp*0.25,0,',','.') }}</span>
                </div>
                <div class="alloc-leg-item">
                    <div class="alloc-leg-dot" style="background:#f59e0b;"></div>
                    ⚙️ Maintenance <span class="alloc-leg-pct">10%</span>
                    <span style="color:var(--slate-500);">· Rp {{ number_format($totalComp*0.1,0,',','.') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── REKOMENDASI ── --}}
    @if(count($recos) > 0)
    <div class="reco-panel">
        <div class="reco-title">💡 Rekomendasi Tindakan Perbaikan</div>
        <div class="reco-grid">
            @foreach($recos as $i => $reco)
            <div class="reco-item">
                <div class="reco-num">{{ $i + 1 }}</div>
                <div class="reco-text">{{ $reco }}</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ── CTA CARDS ── --}}
    <div class="cta-section">
        {{-- Payment --}}
        @auth
        <a href="{{ route('payment.create', ['calculation' => $calculation->id]) }}" class="cta-card payment">
            <span class="cta-icon">💳</span>
            <div class="cta-title">Lakukan Pembayaran</div>
            <div class="cta-desc">Bayar kompensasi lingkungan Anda secara aman. Termin pertama: Rp {{ number_format($installAmt, 0, ',', '.') }}</div>
            <span class="cta-btn">Bayar Sekarang →</span>
        </a>
        @endauth
        @guest
        <a href="{{ route('login') }}" class="cta-card payment guest" style="background:linear-gradient(135deg,#334155,#1e293b);border-color:#475569;">
            <span class="cta-icon">🔒</span>
            <div class="cta-title" style="color:white;">Login untuk Pembayaran</div>
            <div class="cta-desc" style="color:rgba(255,255,255,.7);">Masuk ke akun perusahaan Anda untuk melanjutkan proses pembayaran kompensasi.</div>
            <span class="cta-btn" style="background:white;color:#1e293b;">Login →</span>
        </a>
        @endguest

        {{-- Monitoring --}}
        <a href="{{ route('calc.corporate.monitoring', $calculation->id) }}" class="cta-card monitoring">
            <span class="cta-icon">📊</span>
            <div class="cta-title">Lihat Dashboard Monitoring</div>
            <div class="cta-desc">Pantau progres program kompensasi, reforestasi, dan status pembayaran secara real-time.</div>
            <span class="cta-btn">Buka Monitoring →</span>
        </a>
    </div>

    {{-- ── POWERED BY ── --}}
    <div class="powered-bar">
        <span>Powered by</span>
        <img src="/images/nullicarbon.png" alt="NulliCarbon" class="powered-logo">
    </div>

    {{-- ── ACTION ROW ── --}}
    <div class="action-row">
        <a href="{{ route('calc.corporate.export-pdf', $calculation->id) }}" class="btn-act outline-green">
            ⬇ Download Laporan PDF
        </a>
        <a href="{{ route('calc.corporate.create') }}" class="btn-act outline-slate">
            🔄 Hitung Ulang
        </a>
        <a href="{{ route('calc.corporate.history') }}" class="btn-act outline-slate">
            📋 Riwayat Perhitungan
        </a>
    </div>

</div>
</div>
@endsection