@extends('layouts.app')

@section('title', 'Pembayaran Kompensasi Korporat - NulliCarbon')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Mono:wght@400;500&display=swap');

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

:root {
    --green-950: #052e16;
    --green-900: #064e3b;
    --green-700: #047857;
    --green-600: #059669;
    --green-500: #10b981;
    --green-400: #34d399;
    --green-100: #d1fae5;
    --green-50:  #ecfdf5;
    --slate-900: #0f172a;
    --slate-700: #334155;
    --slate-500: #64748b;
    --slate-300: #cbd5e1;
    --slate-200: #e2e8f0;
    --slate-100: #f1f5f9;
    --slate-50:  #f8fafc;
    --amber-500: #f59e0b;
    --amber-100: #fef3c7;
    --red-100:   #fee2e2;
    --red-600:   #dc2626;
}

.pay-wrap {
    min-height: 100vh;
    background: linear-gradient(160deg, #f0fdf4 0%, #dcfce7 45%, #ecfdf5 100%);
    padding: 100px 20px 60px;
}

.pay-shell {
    max-width: 1160px;
    margin: 0 auto;
}

/* ══ PAGE HEADER ══ */
.pay-hero {
    text-align: center;
    margin-bottom: 40px;
    position: relative;
}

.pay-back {
    position: absolute; left: 0; top: 50%;
    transform: translateY(-50%);
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 18px; border-radius: 12px;
    background: white; border: 2px solid var(--slate-200);
    color: var(--slate-700); font-size: .84rem; font-weight: 700;
    text-decoration: none; transition: all .2s;
    box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.pay-back:hover { background: var(--green-50); border-color: var(--green-400); color: var(--green-700); }

.pay-hero-title {
    font-size: 2rem; font-weight: 900; color: var(--green-900);
    letter-spacing: -.03em; margin-bottom: 8px;
}

.pay-hero-sub {
    font-size: .95rem; color: var(--slate-500); font-weight: 500;
}

/* ══ LAYOUT ══ */
.pay-grid {
    display: grid;
    grid-template-columns: 420px 1fr;
    gap: 24px;
    align-items: start;
}

@media(max-width: 980px) { .pay-grid { grid-template-columns: 1fr; } }

/* ══ LEFT — SUMMARY PANEL ══ */
.summary-panel {
    position: sticky; top: 24px;
    display: flex; flex-direction: column; gap: 16px;
}

.panel {
    background: white; border: 2px solid var(--slate-100);
    border-radius: 22px; overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
}

.panel-head {
    padding: 18px 22px; border-bottom: 2px solid var(--slate-100);
    font-size: .82rem; font-weight: 800; color: var(--slate-500);
    text-transform: uppercase; letter-spacing: .08em;
    display: flex; align-items: center; gap: 8px;
}

.panel-body { padding: 20px 22px; }

/* Company info block */
.company-block {
    display: flex; align-items: center; gap: 14px;
    margin-bottom: 18px; padding-bottom: 18px;
    border-bottom: 2px solid var(--slate-100);
}

.company-avatar {
    width: 52px; height: 52px; border-radius: 14px;
    background: linear-gradient(135deg, var(--green-500), var(--green-700));
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; flex-shrink: 0;
}

.company-name {
    font-size: 1rem; font-weight: 800; color: var(--slate-900);
    margin-bottom: 3px; letter-spacing: -.01em;
}

.company-meta {
    font-size: .74rem; color: var(--slate-500); font-weight: 500;
    display: flex; flex-wrap: wrap; gap: 6px;
}

.company-meta-pill {
    display: inline-flex; align-items: center; gap: 4px;
    background: var(--slate-100); border-radius: 100px;
    padding: 2px 8px; font-size: .7rem; font-weight: 600;
}

/* Damage summary */
.dmg-row {
    display: flex; gap: 8px; margin-bottom: 16px;
}

.dmg-chip {
    flex: 1; padding: 9px 10px; border-radius: 12px;
    border: 2px solid; text-align: center;
}

.dmg-chip.land  { border-color: #bbf7d0; background: #f0fdf4; }
.dmg-chip.air   { border-color: #bfdbfe; background: #eff6ff; }
.dmg-chip.water { border-color: #ddd6fe; background: #f5f3ff; }

.dmg-chip-icon  { font-size: .95rem; display: block; margin-bottom: 3px; }
.dmg-chip-name  { font-size: .62rem; font-weight: 700; color: var(--slate-500); text-transform: uppercase; letter-spacing: .05em; margin-bottom: 4px; }
.dmg-chip-level {
    display: inline-block; padding: 2px 7px; border-radius: 100px;
    font-size: .65rem; font-weight: 800;
}

.lvl-none   { background: #f1f5f9; color: #64748b; }
.lvl-low    { background: #d1fae5; color: #065f46; }
.lvl-medium { background: #fef3c7; color: #92400e; }
.lvl-high   { background: #fee2e2; color: #991b1b; }

/* Cost breakdown */
.cost-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 9px 0; border-bottom: 1px solid var(--slate-100);
    font-size: .84rem;
}
.cost-row:last-child { border-bottom: none; }
.cost-label { color: var(--slate-500); font-weight: 500; }
.cost-val   { color: var(--slate-900); font-weight: 700; font-family: 'DM Mono', monospace; font-size: .8rem; }
.cost-val.green { color: var(--green-600); }

.cost-total-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 14px 18px; border-radius: 14px;
    background: linear-gradient(135deg, var(--green-900), var(--green-700));
    margin-top: 14px;
}
.cost-total-label { color: rgba(255,255,255,.8); font-size: .82rem; font-weight: 600; }
.cost-total-val   { color: white; font-size: 1.3rem; font-weight: 900; font-family: 'DM Mono', monospace; letter-spacing: -.02em; }

/* Scheme badge */
.scheme-row {
    display: flex; align-items: center; justify-content: space-between;
    background: var(--green-50); border: 2px solid var(--green-100);
    border-radius: 12px; padding: 12px 16px; margin-top: 10px;
}
.scheme-icon-label { display: flex; align-items: center; gap: 8px; font-size: .84rem; font-weight: 700; color: var(--green-700); }
.scheme-installment { font-size: .78rem; color: var(--slate-500); text-align: right; }
.scheme-installment b { color: var(--green-700); display: block; font-size: .88rem; }

/* Maintenance fixed notice */
.maintenance-notice {
    display: flex; align-items: flex-start; gap: 10px;
    background: var(--amber-100); border: 2px solid #fcd34d;
    border-radius: 13px; padding: 13px 15px; margin-top: 0;
}
.maintenance-notice .mn-icon { font-size: 1.1rem; flex-shrink: 0; margin-top: 1px; }
.maintenance-notice .mn-text { font-size: .78rem; color: #92400e; line-height: 1.6; }
.maintenance-notice .mn-text strong { display: block; margin-bottom: 2px; font-size: .8rem; }

/* Live allocation bar */
.alloc-bar-wrap { margin-top: 4px; }
.alloc-bar-label { font-size: .72rem; font-weight: 700; color: var(--slate-500); text-transform: uppercase; letter-spacing: .06em; margin-bottom: 8px; }
.alloc-bar-track { height: 10px; border-radius: 100px; background: var(--slate-100); overflow: hidden; display: flex; }
.alloc-seg { height: 100%; transition: width .5s cubic-bezier(.4,0,.2,1); }
.alloc-legend { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px; }
.alloc-leg { display: flex; align-items: center; gap: 5px; font-size: .72rem; color: var(--slate-700); font-weight: 600; }
.alloc-dot { width: 9px; height: 9px; border-radius: 3px; flex-shrink: 0; }

/* ══ RIGHT — FORM PANEL ══ */
.form-panel {
    background: white; border: 2px solid var(--slate-100);
    border-radius: 22px; padding: 32px 34px;
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
}

.form-section { margin-bottom: 32px; }
.form-section:last-child { margin-bottom: 0; }

.fs-title {
    font-size: 1.05rem; font-weight: 900; color: var(--slate-900);
    margin-bottom: 6px; letter-spacing: -.01em;
    display: flex; align-items: center; gap: 9px;
}

.fs-title .fs-num {
    width: 28px; height: 28px; border-radius: 8px; flex-shrink: 0;
    background: var(--green-500); color: white;
    font-size: .75rem; font-weight: 900;
    display: inline-flex; align-items: center; justify-content: center;
}

.fs-sub { font-size: .84rem; color: var(--slate-500); margin-bottom: 18px; line-height: 1.6; }

.fs-divider { height: 2px; background: var(--slate-100); border-radius: 100px; margin-bottom: 22px; }

/* ── Program Allocation Section ── */
.fixed-maintenance {
    display: flex; align-items: center; justify-content: space-between;
    background: linear-gradient(135deg, #fffbeb, #fef3c7);
    border: 2px solid #fcd34d; border-radius: 14px;
    padding: 14px 18px; margin-bottom: 18px;
}
.fm-left { display: flex; align-items: center; gap: 10px; }
.fm-icon { font-size: 1.3rem; }
.fm-label { font-size: .86rem; font-weight: 700; color: #92400e; margin-bottom: 2px; }
.fm-desc  { font-size: .74rem; color: #a16207; }
.fm-pct   { font-size: 1.4rem; font-weight: 900; color: #d97706; font-family: 'DM Mono', monospace; }

.alloc-instruction {
    font-size: .82rem; color: var(--slate-500); margin-bottom: 16px;
    background: var(--slate-50); border-radius: 10px; padding: 11px 14px;
    border-left: 3px solid var(--green-400);
    line-height: 1.6;
}

/* Program cards */
.program-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
    margin-bottom: 18px;
}

@media(max-width: 640px) { .program-grid { grid-template-columns: 1fr; } }

.prog-option { cursor: pointer; }
.prog-option input[type="checkbox"] { position: absolute; opacity: 0; pointer-events: none; }

.prog-card {
    border: 2px solid var(--slate-200); border-radius: 16px;
    padding: 16px; background: var(--slate-50);
    transition: all .22s; position: relative; user-select: none;
}

.prog-card:hover { border-color: var(--green-400); background: var(--green-50); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(16,185,129,.12); }

.prog-option input:checked + .prog-card {
    border-color: var(--green-500);
    background: var(--green-50);
    box-shadow: 0 4px 16px rgba(16,185,129,.18);
}

.prog-check {
    width: 20px; height: 20px; border-radius: 6px;
    border: 2px solid var(--slate-300);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 10px; transition: all .2s; background: white;
}

.prog-check svg { width: 11px; height: 11px; stroke: white; opacity: 0; transition: opacity .15s; }

.prog-option input:checked + .prog-card .prog-check {
    background: var(--green-500); border-color: var(--green-500);
}
.prog-option input:checked + .prog-card .prog-check svg { opacity: 1; }

.prog-icon { font-size: 1.6rem; margin-bottom: 8px; display: block; }
.prog-name { font-size: .88rem; font-weight: 800; color: var(--slate-900); margin-bottom: 4px; }
.prog-desc { font-size: .74rem; color: var(--slate-500); line-height: 1.5; margin-bottom: 8px; }
.prog-badge {
    display: inline-block; padding: 3px 9px; border-radius: 100px;
    font-size: .66rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em;
}

.badge-energy  { background: #dbeafe; color: #1e40af; }
.badge-forest  { background: #d1fae5; color: #065f46; }
.badge-waste   { background: #fef3c7; color: #92400e; }
.badge-ocean   { background: #ede9fe; color: #5b21b6; }
.badge-land    { background: #fce7f3; color: #9d174d; }
.badge-air     { background: #cffafe; color: #155e75; }

/* Split amount badge on card */
.prog-split {
    position: absolute; top: 11px; right: 11px;
    background: var(--green-600); color: white;
    font-size: .68rem; font-weight: 800;
    padding: 3px 9px; border-radius: 100px;
    font-family: 'DM Mono', monospace;
    display: none;
}

.prog-option input:checked + .prog-card .prog-split { display: block; }

/* Remaining % indicator */
.remain-bar-wrap { margin-bottom: 20px; }
.remain-label {
    display: flex; justify-content: space-between;
    font-size: .78rem; font-weight: 700; margin-bottom: 7px;
}
.remain-label span { color: var(--slate-500); }
.remain-label .remain-pct { color: var(--green-600); }
.remain-pct.warn { color: #ef4444; }
.remain-track { height: 8px; background: var(--slate-100); border-radius: 100px; overflow: hidden; }
.remain-fill  { height: 100%; border-radius: 100px; background: linear-gradient(90deg, var(--green-500), var(--green-400)); transition: width .4s ease; }

/* ── Info fields ── */
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
@media(max-width: 640px) { .form-row { grid-template-columns: 1fr; } }

.form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 14px; }
.form-group:last-child { margin-bottom: 0; }

.form-label {
    font-size: .78rem; font-weight: 700; color: var(--slate-700);
    text-transform: uppercase; letter-spacing: .05em;
}

.form-control {
    padding: 12px 14px; border: 2px solid var(--slate-200);
    border-radius: 11px; font-size: .9rem; font-family: inherit;
    color: var(--slate-900); background: var(--slate-50);
    transition: all .2s;
}
.form-control:focus {
    outline: none; border-color: var(--green-500);
    background: white; box-shadow: 0 0 0 3px rgba(16,185,129,.1);
}
.form-control[readonly] { opacity: .7; cursor: default; }

/* ── Payment method ── */
.method-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; }
@media(max-width: 480px) { .method-grid { grid-template-columns: 1fr; } }

.method-opt { cursor: pointer; }
.method-opt input[type="radio"] { position: absolute; opacity: 0; pointer-events: none; }

.method-card {
    display: flex; flex-direction: column; align-items: center; gap: 7px;
    padding: 16px 10px; border-radius: 14px;
    border: 2px solid var(--slate-200); background: var(--slate-50);
    transition: all .2s; text-align: center;
}

.method-card:hover { border-color: var(--green-400); background: var(--green-50); }

.method-opt input:checked + .method-card {
    border-color: var(--green-500); background: var(--green-50);
    box-shadow: 0 4px 14px rgba(16,185,129,.15);
}

.method-icon  { font-size: 1.6rem; }
.method-title { font-size: .8rem; font-weight: 800; color: var(--slate-900); }
.method-sub   { font-size: .68rem; color: var(--slate-500); line-height: 1.4; }

/* ── Termin / installment view ── */
.termin-grid { display: flex; flex-direction: column; gap: 8px; margin-bottom: 4px; }

.termin-row {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 16px; border-radius: 12px;
    background: var(--slate-50); border: 2px solid var(--slate-100);
}

.termin-num {
    width: 28px; height: 28px; border-radius: 8px; flex-shrink: 0;
    background: var(--green-100); color: var(--green-700);
    font-size: .74rem; font-weight: 900;
    display: flex; align-items: center; justify-content: center;
}

.termin-info { flex: 1; }
.termin-label { font-size: .8rem; font-weight: 700; color: var(--slate-900); margin-bottom: 1px; }
.termin-date  { font-size: .72rem; color: var(--slate-500); font-family: 'DM Mono', monospace; }
.termin-amt   { font-size: .9rem; font-weight: 900; color: var(--green-700); font-family: 'DM Mono', monospace; }

/* ── Agreement ── */
.agree-label {
    display: flex; align-items: flex-start; gap: 11px;
    cursor: pointer; font-size: .84rem; color: var(--slate-600); line-height: 1.65;
}
.agree-label input { margin-top: 3px; accent-color: var(--green-500); width: 17px; height: 17px; cursor: pointer; flex-shrink: 0; }

/* ── Submit ── */
.btn-submit {
    width: 100%; padding: 17px;
    border-radius: 14px; border: none; cursor: pointer;
    background: linear-gradient(135deg, var(--green-900), var(--green-700));
    color: white; font-size: 1rem; font-weight: 900;
    letter-spacing: -.01em;
    display: flex; align-items: center; justify-content: center; gap: 10px;
    transition: all .25s;
    box-shadow: 0 8px 24px rgba(6,78,59,.3);
    margin-top: 20px;
}
.btn-submit:hover { transform: translateY(-2px); box-shadow: 0 14px 32px rgba(6,78,59,.4); }
.btn-submit:active { transform: translateY(0); }

.secure-note {
    text-align: center; font-size: .78rem; color: var(--slate-500);
    margin-top: 12px; display: flex; align-items: center; justify-content: center; gap: 5px;
}

/* ── Error alert ── */
.err-box { background: var(--red-100); border: 2px solid #fca5a5; border-radius: 13px; padding: 14px 18px; margin-bottom: 22px; font-size: .84rem; color: var(--red-600); }

/* ── responsive ── */
@media(max-width: 768px) {
    .pay-hero { padding-top: 50px; }
    .pay-back { position: static; display: inline-flex; margin-bottom: 18px; }
    .pay-hero-title { font-size: 1.5rem; }
    .form-panel { padding: 22px 18px; }
}
</style>

@php
    /* ── Pricing ── */
    $damageCosts = ['none'=>0,'low'=>250_000_000,'medium'=>750_000_000,'high'=>1_750_000_000];
    $dmg        = $calculation->damage_data ?? ['land'=>'none','air'=>'none','water'=>'none'];
    $landLvl    = $dmg['land']  ?? 'none';
    $airLvl     = $dmg['air']   ?? 'none';
    $waterLvl   = $dmg['water'] ?? 'none';
    $landCost   = $damageCosts[$landLvl]  ?? 0;
    $airCost    = $damageCosts[$airLvl]   ?? 0;
    $waterCost  = $damageCosts[$waterLvl] ?? 0;
    $totalComp  = $calculation->compensation_cost ?? ($landCost + $airCost + $waterCost);

    /* ── Maintenance fixed 10% ── */
    $maintAmt   = $totalComp * 0.10;
    $allocable  = $totalComp * 0.90;   /* 90% yang bisa dipilih user */

    /* ── Payment scheme ── */
    $scheme       = $calculation->payment_scheme ?? 'annual';
    $schemeLabels = ['annual'=>'Tahunan','semi_annual'=>'Semesteran','quarterly'=>'Kuartalan'];
    $schemeIcons  = ['annual'=>'🗓️','semi_annual'=>'📆','quarterly'=>'📅'];
    $installNums  = ['annual'=>1,'semi_annual'=>2,'quarterly'=>4];
    $installRates = ['annual'=>1.0,'semi_annual'=>0.55,'quarterly'=>0.30];
    $instCount    = $installNums[$scheme]  ?? 1;
    $instRate     = $installRates[$scheme] ?? 1.0;
    $instAmt      = $totalComp * $instRate;

    /* ── Level labels ── */
    $lvlLabel = ['none'=>'Tidak Ada','low'=>'Ringan','medium'=>'Sedang','high'=>'Berat'];
    $lvlClass = ['none'=>'lvl-none','low'=>'lvl-low','medium'=>'lvl-medium','high'=>'lvl-high'];

    /* ── Industry label ── */
    $industryMap = [
        'manufacturing'=>'Manufaktur','chemical'=>'Ind. Kimia','mining'=>'Pertambangan',
        'cement'=>'Semen','pulp'=>'Pulp & Kertas','palm_oil'=>'Kelapa Sawit',
        'steel'=>'Baja & Logam','construction'=>'Konstruksi','transportation'=>'Transportasi',
        'energy'=>'Energi','agriculture'=>'Pertanian','service'=>'Jasa',
        'technology'=>'Teknologi','other'=>'Lainnya',
    ];

    /* ── Installment dates ── */
    $calcYear = $calculation->calculation_year ?? date('Y');
    $termins  = [];
    for ($i = 0; $i < $instCount; $i++) {
        $monthAdd = ($scheme === 'quarterly') ? $i * 3 : (($scheme === 'semi_annual') ? $i * 6 : $i * 12);
        $termins[] = \Carbon\Carbon::create($calcYear, 1, 15)->addMonths($monthAdd)->format('d M Y');
    }
@endphp

<div class="pay-wrap">
<div class="pay-shell">

    <!-- HEADER -->
    <div class="pay-hero">
        <a href="{{ route('calc.corporate.result', $calculation->id) }}" class="pay-back">← Kembali ke Hasil</a>
        <h1 class="pay-hero-title">💳 Pembayaran Kompensasi Lingkungan</h1>
        <p class="pay-hero-sub">Alokasikan dana Anda ke program restorasi yang paling sesuai prioritas perusahaan</p>
    </div>

    <div class="pay-grid">

        <!-- ══ LEFT: SUMMARY ══ -->
        <div class="summary-panel">

            <!-- Company Info -->
            <div class="panel">
                <div class="panel-head">🏭 Identitas Perusahaan</div>
                <div class="panel-body">
                    <div class="company-block">
                        <div class="company-avatar">🏢</div>
                        <div>
                            <div class="company-name">{{ $calculation->company_name }}</div>
                            <div class="company-meta">
                                <span class="company-meta-pill">🗂️ {{ $calculation->company_siup }}</span>
                                <span class="company-meta-pill">📍 {{ $calculation->company_location }}</span>
                                <span class="company-meta-pill">🏗️ {{ $calculation->facility_count }} Fasilitas</span>
                                <span class="company-meta-pill">{{ $industryMap[$calculation->industry_type] ?? ucfirst($calculation->industry_type) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Damage chips -->
                    <div class="dmg-row">
                        <div class="dmg-chip land">
                            <span class="dmg-chip-icon">🏔️</span>
                            <div class="dmg-chip-name">Tanah</div>
                            <span class="dmg-chip-level {{ $lvlClass[$landLvl] }}">{{ $lvlLabel[$landLvl] }}</span>
                        </div>
                        <div class="dmg-chip air">
                            <span class="dmg-chip-icon">💨</span>
                            <div class="dmg-chip-name">Udara</div>
                            <span class="dmg-chip-level {{ $lvlClass[$airLvl] }}">{{ $lvlLabel[$airLvl] }}</span>
                        </div>
                        <div class="dmg-chip water">
                            <span class="dmg-chip-icon">💧</span>
                            <div class="dmg-chip-name">Air</div>
                            <span class="dmg-chip-level {{ $lvlClass[$waterLvl] }}">{{ $lvlLabel[$waterLvl] }}</span>
                        </div>
                    </div>

                    <!-- Cost rows -->
                    @if($landCost > 0)
                    <div class="cost-row">
                        <span class="cost-label">🏔️ Kompensasi Tanah</span>
                        <span class="cost-val">Rp {{ number_format($landCost,0,',','.') }}</span>
                    </div>
                    @endif
                    @if($airCost > 0)
                    <div class="cost-row">
                        <span class="cost-label">💨 Kompensasi Udara</span>
                        <span class="cost-val">Rp {{ number_format($airCost,0,',','.') }}</span>
                    </div>
                    @endif
                    @if($waterCost > 0)
                    <div class="cost-row">
                        <span class="cost-label">💧 Kompensasi Air</span>
                        <span class="cost-val">Rp {{ number_format($waterCost,0,',','.') }}</span>
                    </div>
                    @endif
                    <div class="cost-row">
                        <span class="cost-label">⚙️ Maintenance (10% — fixed)</span>
                        <span class="cost-val">Rp {{ number_format($maintAmt,0,',','.') }}</span>
                    </div>

                    <div class="cost-total-row">
                        <span class="cost-total-label">Total Kompensasi</span>
                        <span class="cost-total-val">Rp {{ number_format($totalComp,0,',','.') }}</span>
                    </div>

                    <!-- Scheme -->
                    <div class="scheme-row">
                        <div class="scheme-icon-label">
                            {{ $schemeIcons[$scheme] ?? '🗓️' }}
                            Skema {{ $schemeLabels[$scheme] ?? 'Tahunan' }}
                        </div>
                        <div class="scheme-installment">
                            <b>Rp {{ number_format($instAmt,0,',','.') }}</b>
                            per termin × {{ $instCount }}×
                        </div>
                    </div>
                </div>
            </div>

            <!-- Live Allocation Bar -->
            <div class="panel">
                <div class="panel-head">📊 Live Alokasi Dana</div>
                <div class="panel-body">
                    <div class="alloc-bar-wrap">
                        <div class="alloc-bar-label">Distribusi 100% Dana</div>
                        <div class="alloc-bar-track" id="allocBar">
                            <div class="alloc-seg" id="seg-maint" style="width:10%;background:linear-gradient(90deg,#f59e0b,#fbbf24);" title="Maintenance 10%"></div>
                            <div class="alloc-seg" id="seg-prog"  style="width:0%;background:linear-gradient(90deg,#10b981,#34d399);"  title="Program"></div>
                            <div class="alloc-seg" id="seg-sisa"  style="width:90%;background:#e2e8f0;" title="Belum dialokasikan"></div>
                        </div>
                        <div class="alloc-legend">
                            <div class="alloc-leg"><div class="alloc-dot" style="background:#f59e0b;"></div>Maintenance 10%</div>
                            <div class="alloc-leg"><div class="alloc-dot" style="background:#10b981;"></div>Program <span id="prog-pct-label" style="margin-left:3px;">0%</span></div>
                            <div class="alloc-leg"><div class="alloc-dot" style="background:#e2e8f0;"></div>Belum dipilih <span id="sisa-pct-label" style="margin-left:3px;">90%</span></div>
                        </div>
                    </div>
                    <!-- Dynamic breakdown populated by JS -->
                    <div id="liveBreakdown" style="display:none;margin-top:14px;"></div>
                </div>
            </div>

        </div><!-- /summary-panel -->

        <!-- ══ RIGHT: FORM ══ -->
        <div class="form-panel">

            @if($errors->any())
            <div class="err-box">
                ⚠️ {{ $errors->first() }}
            </div>
            @endif

            <form id="payForm" method="POST" action="{{ route('payment.process') }}">
                @csrf
                <input type="hidden" name="calculation_id"  value="{{ $calculation->id }}">
                <input type="hidden" name="total_amount"    value="{{ $totalComp }}">
                <input type="hidden" name="maintenance_amt" value="{{ $maintAmt }}">
                <input type="hidden" name="calculator_type" value="corporate">
                <input type="hidden" name="payment_scheme"  value="{{ $scheme }}">

                <!-- ── SECTION 1: ALOKASI PROGRAM ── -->
                <div class="form-section">
                    <div class="fs-title">
                        <span class="fs-num">1</span>
                        Alokasi Program Restorasi
                    </div>
                    <div class="fs-sub">
                        <strong>10% (Rp {{ number_format($maintAmt,0,',','.') }})</strong> sudah ditetapkan untuk maintenance operasional.
                        Sisa <strong>90% (Rp {{ number_format($allocable,0,',','.') }})</strong> dapat Anda alokasikan ke program di bawah — pilih satu atau lebih, dana akan <strong>dibagi rata</strong>.
                    </div>
                    <div class="fs-divider"></div>

                    <!-- Fixed maintenance block -->
                    <div class="fixed-maintenance">
                        <div class="fm-left">
                            <div class="fm-icon">⚙️</div>
                            <div>
                                <div class="fm-label">Maintenance & Operasional</div>
                                <div class="fm-desc">Monitoring lapangan, administrasi program, audit KLH — ditetapkan otomatis</div>
                            </div>
                        </div>
                        <div class="fm-pct">10%</div>
                    </div>

                    <div class="alloc-instruction">
                        💡 Pilih minimal 1 program untuk mengalokasikan sisa 90% dana. Dana dibagi rata jika memilih lebih dari satu program.
                    </div>

                    <!-- Remaining % indicator -->
                    <div class="remain-bar-wrap">
                        <div class="remain-label">
                            <span>Sisa yang harus dialokasikan</span>
                            <span class="remain-pct" id="remainPctLabel">90% tersisa</span>
                        </div>
                        <div class="remain-track">
                            <div class="remain-fill" id="remainFill" style="width:0%;"></div>
                        </div>
                    </div>

                    <div class="program-grid">

                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="water_turbine" data-label="Turbin Air" data-icon="💧">
                            <div class="prog-card">
                                <div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
                                <span class="prog-split" id="split-water_turbine"></span>
                                <span class="prog-icon">💧</span>
                                <div class="prog-name">Turbin Air Mikro-Hidro</div>
                                <div class="prog-desc">Membangun turbin mikro-hidro untuk energi bersih komunitas di sekitar area operasional</div>
                                <span class="prog-badge badge-energy">Energi Terbarukan</span>
                            </div>
                        </label>

                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="mangrove" data-label="Mangrove" data-icon="🌿">
                            <div class="prog-card">
                                <div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
                                <span class="prog-split" id="split-mangrove"></span>
                                <span class="prog-icon">🌿</span>
                                <div class="prog-name">Penanaman Mangrove</div>
                                <div class="prog-desc">Menanam & melindungi hutan mangrove pesisir untuk menyerap CO₂ dan menjaga ekosistem laut</div>
                                <span class="prog-badge badge-forest">Konservasi Hutan</span>
                            </div>
                        </label>

                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="reforestation" data-label="Reforestasi" data-icon="🌱">
                            <div class="prog-card">
                                <div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
                                <span class="prog-split" id="split-reforestation"></span>
                                <span class="prog-icon">🌱</span>
                                <div class="prog-name">Reforestasi Lahan Kritis</div>
                                <div class="prog-desc">Penanaman pohon di lahan terdegradasi untuk memulihkan tutupan hutan & mengurangi erosi tanah</div>
                                <span class="prog-badge badge-land">Pemulihan Lahan</span>
                            </div>
                        </label>

                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="waste_recycle" data-label="Daur Ulang" data-icon="♻️">
                            <div class="prog-card">
                                <div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
                                <span class="prog-split" id="split-waste_recycle"></span>
                                <span class="prog-icon">♻️</span>
                                <div class="prog-name">Daur Ulang Industri</div>
                                <div class="prog-desc">Mendukung fasilitas pengolahan limbah industri untuk mengurangi emisi dari TPA dan mendorong ekonomi sirkular</div>
                                <span class="prog-badge badge-waste">Pengelolaan Limbah</span>
                            </div>
                        </label>

                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="coral_reef" data-label="Terumbu Karang" data-icon="🪸">
                            <div class="prog-card">
                                <div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
                                <span class="prog-split" id="split-coral_reef"></span>
                                <span class="prog-icon">🪸</span>
                                <div class="prog-name">Restorasi Terumbu Karang</div>
                                <div class="prog-desc">Merestorasi ekosistem terumbu karang yang mendukung keanekaragaman hayati laut & menyerap karbon</div>
                                <span class="prog-badge badge-ocean">Konservasi Laut</span>
                            </div>
                        </label>

                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="air_quality" data-label="Kualitas Udara" data-icon="🌬️">
                            <div class="prog-card">
                                <div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
                                <span class="prog-split" id="split-air_quality"></span>
                                <span class="prog-icon">🌬️</span>
                                <div class="prog-name">Pemantauan Kualitas Udara</div>
                                <div class="prog-desc">Pembangunan & operasional stasiun pemantau kualitas udara di sekitar kawasan industri terdampak</div>
                                <span class="prog-badge badge-air">Kualitas Udara</span>
                            </div>
                        </label>

                    </div><!-- /program-grid -->
                </div><!-- /section 1 -->

                <!-- ── SECTION 2: JADWAL TERMIN ── -->
                <div class="form-section">
                    <div class="fs-title">
                        <span class="fs-num">2</span>
                        Jadwal Pembayaran Termin
                    </div>
                    <div class="fs-sub">Berdasarkan skema {{ $schemeLabels[$scheme] ?? 'Tahunan' }} yang telah Anda pilih — pembayaran pertama dilakukan sekarang.</div>
                    <div class="fs-divider"></div>

                    <div class="termin-grid">
                        @foreach($termins as $idx => $tDate)
                        <div class="termin-row">
                            <div class="termin-num">{{ $idx + 1 }}</div>
                            <div class="termin-info">
                                <div class="termin-label">
                                    @if($idx === 0) Pembayaran Pertama (Sekarang)
                                    @elseif($idx === count($termins) - 1) Pembayaran Final
                                    @else Termin {{ $idx + 1 }}
                                    @endif
                                </div>
                                <div class="termin-date">{{ $tDate }}</div>
                            </div>
                            <div class="termin-amt">Rp {{ number_format($instAmt,0,',','.') }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- ── SECTION 3: DATA PERUSAHAAN ── -->
                <div class="form-section">
                    <div class="fs-title">
                        <span class="fs-num">3</span>
                        Data PIC Perusahaan
                    </div>
                    <div class="fs-sub">Person in Charge yang bertanggung jawab atas pembayaran kompensasi ini.</div>
                    <div class="fs-divider"></div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" value="{{ $calculation->company_name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. SIUP / NIB</label>
                            <input type="text" class="form-control" value="{{ $calculation->company_siup }}" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama PIC <span style="color:#ef4444;">*</span></label>
                            <input type="text" name="pic_name" class="form-control" required
                                   placeholder="Nama lengkap PIC"
                                   value="{{ old('pic_name', Auth::check() ? Auth::user()->name : '') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jabatan PIC <span style="color:#ef4444;">*</span></label>
                            <input type="text" name="pic_position" class="form-control" required
                                   placeholder="Direktur Keuangan / HSE Manager / dll"
                                   value="{{ old('pic_position') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email PIC <span style="color:#ef4444;">*</span></label>
                            <input type="email" name="pic_email" class="form-control" required
                                   placeholder="pic@perusahaan.com"
                                   value="{{ old('pic_email', Auth::check() ? Auth::user()->email : '') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. Telepon PIC <span style="color:#ef4444;">*</span></label>
                            <input type="tel" name="pic_phone" class="form-control" required
                                   placeholder="08xxxxxxxxxx"
                                   value="{{ old('pic_phone', $calculation->company_phone ?? '') }}">
                        </div>
                    </div>
                </div>

                <!-- ── SECTION 4: METODE PEMBAYARAN ── -->
                <div class="form-section">
                    <div class="fs-title">
                        <span class="fs-num">4</span>
                        Metode Pembayaran
                    </div>
                    <div class="fs-sub">Pilih metode pembayaran untuk termin pertama sebesar <strong>Rp {{ number_format($instAmt,0,',','.') }}</strong>.</div>
                    <div class="fs-divider"></div>

                    <div class="method-grid">
                        <label class="method-opt">
                            <input type="radio" name="payment_method" value="bank_transfer" required>
                            <div class="method-card">
                                <span class="method-icon">🏦</span>
                                <div class="method-title">Transfer Bank</div>
                                <div class="method-sub">BCA, Mandiri, BNI, BRI</div>
                            </div>
                        </label>
                        <label class="method-opt">
                            <input type="radio" name="payment_method" value="e_wallet">
                            <div class="method-card">
                                <span class="method-icon">📱</span>
                                <div class="method-title">E-Wallet</div>
                                <div class="method-sub">GoPay, OVO, DANA</div>
                            </div>
                        </label>
                        <label class="method-opt">
                            <input type="radio" name="payment_method" value="virtual_account">
                            <div class="method-card">
                                <span class="method-icon">💳</span>
                                <div class="method-title">Virtual Account</div>
                                <div class="method-sub">Semua bank BUKU IV</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- ── AGREEMENT ── -->
                <label class="agree-label">
                    <input type="checkbox" name="agreement" required>
                    <span>Saya menyatakan bahwa data yang disampaikan adalah benar dan perusahaan bersedia diaudit oleh tim Kementerian Lingkungan Hidup. Pembayaran ini merupakan kewajiban kompensasi lingkungan sesuai regulasi yang berlaku.</span>
                </label>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>🌿 Konfirmasi & Bayar Termin Pertama</span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M7.5 5L12.5 10L7.5 15" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <div class="secure-note">
                    🔒 Data terenkripsi · Diverifikasi KLH · Sertifikat diterbitkan pasca-lunas
                </div>

            </form>
        </div><!-- /form-panel -->

    </div><!-- /pay-grid -->
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Constants ── */
    const TOTAL       = {{ $totalComp }};
    const MAINT_AMT   = {{ $maintAmt }};
    const ALLOC_AMT   = {{ $allocable }};   // 90%
    const INST_AMT    = {{ $instAmt }};

    const checkboxes  = document.querySelectorAll('input[name="offset_program[]"]');
    const segProg     = document.getElementById('seg-prog');
    const segSisa     = document.getElementById('seg-sisa');
    const progPctLbl  = document.getElementById('prog-pct-label');
    const sisaPctLbl  = document.getElementById('sisa-pct-label');
    const remainFill  = document.getElementById('remainFill');
    const remainLbl   = document.getElementById('remainPctLabel');
    const liveBreak   = document.getElementById('liveBreakdown');

    function fmt(n) {
        return 'Rp ' + Math.round(n).toLocaleString('id-ID');
    }

    function update() {
        const checked = [...checkboxes].filter(cb => cb.checked);
        const count   = checked.length;
        const split   = count > 0 ? ALLOC_AMT / count : 0;
        const progPct = count > 0 ? 90 : 0;
        const sisaPct = 90 - progPct;

        /* ── bar segments ── */
        segProg.style.width = progPct + '%';
        segSisa.style.width = sisaPct + '%';
        progPctLbl.textContent = progPct + '%';
        sisaPctLbl.textContent = sisaPct + '%';

        /* ── remain indicator ── */
        const filledPct = count > 0 ? 100 : 0;
        remainFill.style.width = filledPct + '%';
        if (count === 0) {
            remainLbl.textContent   = '90% tersisa';
            remainLbl.className     = 'remain-pct warn';
        } else {
            remainLbl.textContent   = '✓ Teralokasi penuh';
            remainLbl.className     = 'remain-pct';
        }

        /* ── split badges on cards ── */
        checkboxes.forEach(cb => {
            const badge = document.getElementById('split-' + cb.value);
            if (!badge) return;
            if (cb.checked && count > 0) {
                badge.textContent   = fmt(split);
                badge.style.display = 'block';
            } else {
                badge.style.display = 'none';
            }
        });

        /* ── live breakdown panel ── */
        if (count === 0) {
            liveBreak.style.display = 'none';
            liveBreak.innerHTML     = '';
        } else {
            liveBreak.style.display = 'block';
            const rows = checked.map(cb => {
                const icon  = cb.dataset.icon  || '🌿';
                const label = cb.dataset.label || cb.value;
                return `<div style="display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid #f1f5f9;font-size:.8rem;">
                    <span style="color:#334155;font-weight:600;display:flex;align-items:center;gap:6px;">${icon} ${label}</span>
                    <span style="color:#047857;font-weight:800;font-family:'DM Mono',monospace;font-size:.76rem;">${fmt(split)}</span>
                </div>`;
            }).join('');

            liveBreak.innerHTML = `
                <div style="font-size:.72rem;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px;">Distribusi 90% Per Program</div>
                ${rows}
                <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0 0;font-size:.78rem;">
                    <span style="color:#64748b;font-weight:600;">⚙️ Maintenance (fixed)</span>
                    <span style="color:#d97706;font-weight:800;font-family:'DM Mono',monospace;">${fmt(MAINT_AMT)}</span>
                </div>
            `;
        }
    }

    /* init + listeners */
    checkboxes.forEach(cb => cb.addEventListener('change', update));
    update();

    /* ── Form validation ── */
    document.getElementById('payForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const errs    = [];
        const checked = [...checkboxes].filter(cb => cb.checked);

        if (checked.length === 0)
            errs.push('Pilih minimal 1 program alokasi dana restorasi.');

        const picName = document.querySelector('[name="pic_name"]').value.trim();
        if (!picName) errs.push('Nama PIC wajib diisi.');

        const picPos  = document.querySelector('[name="pic_position"]').value.trim();
        if (!picPos)  errs.push('Jabatan PIC wajib diisi.');

        const picEmail = document.querySelector('[name="pic_email"]').value.trim();
        if (!picEmail) errs.push('Email PIC wajib diisi.');

        const picPhone = document.querySelector('[name="pic_phone"]').value.trim();
        if (!picPhone) errs.push('Nomor telepon PIC wajib diisi.');

        const method   = document.querySelector('[name="payment_method"]:checked');
        if (!method)   errs.push('Pilih metode pembayaran.');

        const agree    = document.querySelector('[name="agreement"]');
        if (!agree.checked) errs.push('Anda harus menyetujui pernyataan di atas.');

        if (errs.length > 0) {
            alert('Harap lengkapi:\n\n• ' + errs.join('\n• '));
            return false;
        }

        this.submit();
    });
});
</script>

@endsection