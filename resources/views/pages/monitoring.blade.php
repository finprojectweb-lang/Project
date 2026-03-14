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

.mon-wrap {
    min-height: 100vh;
    background: linear-gradient(160deg, #f0fdf4 0%, #dcfce7 40%, #ecfdf5 100%);
    padding: 90px 20px 60px;
}

.mon-shell { max-width: 1200px; margin: 0 auto; }

/* ─── PAGE HEADER ─── */
.page-header {
    background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #047857 100%);
    border-radius: 24px;
    padding: 40px 44px;
    color: white;
    margin-bottom: 24px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
    position: relative;
    overflow: hidden;
    box-shadow: 0 16px 48px rgba(6,78,59,.3);
}

.page-header::before {
    content: '';
    position: absolute; top: -60px; right: -60px;
    width: 260px; height: 260px; border-radius: 50%;
    background: radial-gradient(circle, rgba(52,211,153,.15) 0%, transparent 70%);
}

.page-header-left h1 {
    font-size: 1.85rem; font-weight: 900; margin-bottom: 6px;
    position: relative; z-index: 1; letter-spacing: -.02em;
}

.page-header-left p {
    opacity: .82; font-size: .88rem; margin-bottom: 18px;
    position: relative; z-index: 1; line-height: 1.6;
}

.company-meta { display: flex; flex-wrap: wrap; gap: 7px; position: relative; z-index: 1; }

.meta-pill {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.25);
    border-radius: 100px; padding: 5px 12px;
    font-size: .75rem; font-weight: 600;
}

.page-header-right {
    display: flex; flex-direction: column; align-items: flex-end; gap: 10px;
    position: relative; z-index: 1;
}

.status-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.18); border: 1px solid rgba(255,255,255,.35);
    border-radius: 100px; padding: 9px 18px;
    font-size: .84rem; font-weight: 700;
}

.status-dot {
    width: 8px; height: 8px; border-radius: 50%; background: #4ade80;
    animation: blink 2s infinite;
}

@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.2} }

.btn-hdr {
    padding: 10px 20px; border-radius: 10px;
    border: 2px solid rgba(255,255,255,.3);
    background: transparent; color: white;
    font-weight: 700; font-size: .82rem; cursor: pointer;
    transition: all .2s; text-decoration: none; display: inline-block;
}
.btn-hdr:hover { background: rgba(255,255,255,.12); color: white; }

/* ─── ALERT BANNER ─── */
.alert-banner {
    background: white; border: 2px solid #fcd34d;
    border-radius: 18px; padding: 20px 24px;
    margin-bottom: 20px;
    display: flex; align-items: center; gap: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
}

.alert-banner.paid {
    border-color: var(--green-400);
}

.alert-icon { font-size: 1.5rem; flex-shrink: 0; }
.alert-text { flex: 1; }
.alert-text strong { display: block; color: #92400e; font-size: .9rem; margin-bottom: 3px; }
.alert-text.paid strong { color: var(--green-700); }
.alert-text p { color: #78350f; font-size: .83rem; line-height: 1.6; margin: 0; }
.alert-text.paid p { color: var(--green-700); }

.btn-amber {
    padding: 11px 24px; border-radius: 11px; border: none;
    background: linear-gradient(135deg, #f59e0b, #f97316);
    color: white; font-weight: 700; font-size: .84rem;
    cursor: pointer; transition: all .2s; white-space: nowrap; flex-shrink: 0;
    text-decoration: none; display: inline-block;
    box-shadow: 0 4px 12px rgba(245,158,11,.3);
}
.btn-amber:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(245,158,11,.4); color: white; }

/* ─── STAT CARDS ─── */
.stat-row {
    display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; margin-bottom: 20px;
}
@media(max-width: 900px) { .stat-row { grid-template-columns: repeat(2,1fr); } }
@media(max-width: 480px) { .stat-row { grid-template-columns: 1fr; } }

.stat-card {
    background: white; border: 2px solid var(--slate-100);
    border-radius: 20px; padding: 22px;
    box-shadow: 0 2px 12px rgba(0,0,0,.05);
    transition: all .25s; position: relative; overflow: hidden;
}
.stat-card:hover { box-shadow: 0 8px 28px rgba(0,0,0,.1); transform: translateY(-2px); }
.stat-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px;
}
.stat-card.green::before  { background: linear-gradient(90deg,#10b981,#059669); }
.stat-card.blue::before   { background: linear-gradient(90deg,#3b82f6,#0ea5e9); }
.stat-card.amber::before  { background: linear-gradient(90deg,#f59e0b,#f97316); }
.stat-card.purple::before { background: linear-gradient(90deg,#8b5cf6,#6366f1); }

.stat-icon { font-size: 1.5rem; margin-bottom: 10px; display: block; }
.stat-val  { font-size: 1.9rem; font-weight: 900; color: var(--slate-900); line-height: 1; margin-bottom: 2px; letter-spacing: -.02em; }
.stat-unit { font-size: .72rem; color: var(--slate-500); font-weight: 500; }
.stat-label { font-size: .78rem; color: var(--slate-500); margin-top: 6px; }
.stat-change { font-size: .74rem; font-weight: 700; margin-top: 5px; }
.stat-change.up   { color: #059669; }
.stat-change.down { color: #dc2626; }

/* ─── PANELS ─── */
.panel {
    background: white; border: 2px solid var(--slate-100);
    border-radius: 22px; overflow: hidden;
    box-shadow: 0 2px 14px rgba(0,0,0,.05);
}

.panel-head {
    padding: 18px 24px; border-bottom: 2px solid var(--slate-100);
    display: flex; align-items: center; justify-content: space-between; gap: 10px;
}

.panel-title { font-size: .95rem; font-weight: 800; color: var(--slate-900); }
.panel-sub   { font-size: .76rem; color: var(--slate-500); margin-top: 2px; }
.panel-body  { padding: 22px; }

/* ─── PROGRESS BARS ─── */
.prog-item { margin-bottom: 22px; }
.prog-item:last-child { margin-bottom: 0; }

.prog-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 9px; }
.prog-name { font-size: .85rem; font-weight: 700; color: var(--slate-900); display: flex; align-items: center; gap: 8px; }
.prog-dot  { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
.prog-pct  { font-size: .88rem; font-weight: 900; color: var(--slate-900); }

.prog-bar  { height: 10px; background: var(--slate-100); border-radius: 100px; overflow: hidden; }
.prog-fill { height: 100%; border-radius: 100px; transition: width 1.4s cubic-bezier(.4,0,.2,1); }

.prog-info { display: flex; justify-content: space-between; margin-top: 6px; }
.prog-info span { font-size: .72rem; color: var(--slate-500); }

/* ─── TIMELINE ─── */
.timeline { padding-left: 26px; position: relative; }
.timeline::before { content:''; position:absolute; left:9px; top:10px; bottom:10px; width:2px; background: linear-gradient(180deg, var(--green-400), var(--slate-200)); }

.tl-item { position: relative; padding-bottom: 24px; }
.tl-item:last-child { padding-bottom: 0; }

.tl-dot {
    position: absolute; left: -22px; top: 2px;
    width: 18px; height: 18px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: .58rem; font-weight: 900;
}
.tl-dot.paid     { background: var(--green-100); border: 2px solid var(--green-400); color: var(--green-700); }
.tl-dot.upcoming { background: #fef3c7; border: 2px solid #fcd34d; color: #92400e; }
.tl-dot.planned  { background: var(--slate-100); border: 2px solid var(--slate-300); color: #94a3b8; }

.tl-date   { font-size: .72rem; color: #94a3b8; margin-bottom: 2px; font-family: 'DM Mono', monospace; }
.tl-label  { font-size: .87rem; font-weight: 700; color: var(--slate-900); margin-bottom: 4px; }
.tl-amount { font-size: .87rem; font-weight: 700; display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }

.tl-chip {
    display: inline-block; padding: 2px 9px; border-radius: 100px;
    font-size: .67rem; font-weight: 800;
}
.chip-paid     { background: var(--green-100); color: var(--green-700); }
.chip-upcoming { background: #fef3c7; color: #92400e; }
.chip-planned  { background: var(--slate-100); color: #64748b; }

/* ─── GRID LAYOUTS ─── */
.grid-2-1 { display: grid; grid-template-columns: 2fr 1fr; gap: 18px; margin-bottom: 18px; }
.grid-3-2 { display: grid; grid-template-columns: 3fr 2fr; gap: 18px; margin-bottom: 18px; }
@media(max-width: 900px) {
    .grid-2-1, .grid-3-2 { grid-template-columns: 1fr; }
}

/* ─── ACTIVITY TABLE ─── */
.act-table { width: 100%; border-collapse: collapse; }
.act-table th {
    text-align: left; font-size: .7rem; font-weight: 800; color: #94a3b8;
    text-transform: uppercase; letter-spacing: .07em;
    padding: 0 12px 14px; border-bottom: 2px solid var(--slate-100);
}
.act-table td {
    padding: 13px 12px; font-size: .83rem; color: #475569;
    border-bottom: 1px solid var(--slate-50); vertical-align: middle;
}
.act-table tr:last-child td { border-bottom: none; }
.act-table tr:hover td { background: var(--slate-50); }

.act-name { font-weight: 700; color: var(--slate-900); display: flex; align-items: center; gap: 7px; }
.act-dot  { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

.s-chip {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 10px; border-radius: 100px; font-size: .71rem; font-weight: 700;
}
.s-done { background: var(--green-100); color: var(--green-700); }
.s-prog { background: #dbeafe; color: #1e40af; }
.s-warn { background: #fef3c7; color: #92400e; }

/* ─── IMPACT BREAKDOWN ─── */
.impact-item {
    display: flex; align-items: center; gap: 14px;
    padding: 14px 0; border-bottom: 1px solid var(--slate-50);
}
.impact-item:last-child { border-bottom: none; }

.impact-icon {
    width: 44px; height: 44px; border-radius: 13px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; flex-shrink: 0;
}

.impact-text { flex: 1; }
.impact-name { font-size: .88rem; font-weight: 800; color: var(--slate-900); margin-bottom: 1px; }
.impact-level { font-size: .74rem; color: var(--slate-500); }
.impact-right { text-align: right; }
.impact-pct  { font-size: 1rem; font-weight: 900; }
.impact-cost { font-size: .72rem; color: var(--slate-500); margin-top: 2px; }

/* ─── CERTIFICATE ─── */
.cert-card {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border: 2px solid #6ee7b7; border-radius: 20px;
    padding: 26px; text-align: center;
    position: relative; overflow: hidden;
}

.cert-card::before {
    content: '';
    position: absolute; top: -30px; right: -30px;
    width: 120px; height: 120px; border-radius: 50%;
    background: radial-gradient(circle, rgba(16,185,129,.1) 0%, transparent 70%);
}

.cert-seal  { font-size: 2.8rem; margin-bottom: 8px; display: block; }
.cert-title { font-size: .78rem; font-weight: 900; color: var(--green-700);
    text-transform: uppercase; letter-spacing: .12em; margin-bottom: 4px; }
.cert-id    { font-size: .74rem; color: #94a3b8; font-family: 'DM Mono', monospace; margin-bottom: 14px; }
.cert-status { font-size: .83rem; color: #475569; line-height: 1.8; }
.cert-status strong { color: var(--green-700); }
.cert-note  { font-size: .72rem; color: #94a3b8; margin-top: 12px; line-height: 1.6;
    background: rgba(255,255,255,.6); border-radius: 10px; padding: 10px; }

/* ─── DAMAGE SUMMARY SIDE ─── */
.lvl-none   { background: #f1f5f9; color: #64748b; }
.lvl-low    { background: var(--green-100); color: var(--green-700); }
.lvl-medium { background: #fef3c7; color: #92400e; }
.lvl-high   { background: #fee2e2; color: #991b1b; }

.dmg-level-tag {
    display: inline-block; padding: 2px 10px; border-radius: 100px;
    font-size: .7rem; font-weight: 800;
}

/* ─── BACK BUTTON ─── */
.back-row {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 20px;
}

.btn-back {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 18px; border-radius: 12px;
    background: white; border: 2px solid var(--slate-200);
    color: var(--slate-700); font-weight: 700; font-size: .84rem;
    text-decoration: none; transition: all .2s;
    box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.btn-back:hover { background: var(--slate-50); border-color: var(--slate-300); color: var(--slate-900); }

/* ─── RESPONSIVE ─── */
@media(max-width: 640px) {
    .page-header { flex-direction: column; padding: 28px 22px; }
    .page-header-right { align-items: flex-start; }
    .alert-banner { flex-direction: column; align-items: flex-start; gap: 12px; }
    .btn-amber { width: 100%; text-align: center; }
    .act-table th:nth-child(3), .act-table td:nth-child(3) { display: none; }
}
.tl-color-paid     { color: #059669; }
.tl-color-upcoming { color: #d97706; }
.tl-color-planned  { color: #94a3b8; }

</style>

@php
    /* ── Pull from calculation model ─────────── */
    $damageData  = $calculation->damage_data ?? ['land'=>'none','air'=>'none','water'=>'none'];
    $landLevel   = $damageData['land']  ?? 'none';
    $airLevel    = $damageData['air']   ?? 'none';
    $waterLevel  = $damageData['water'] ?? 'none';

    $damageCosts = ['none'=>0,'low'=>250_000_000,'medium'=>750_000_000,'high'=>1_750_000_000];
    $landCost    = $damageCosts[$landLevel]  ?? 0;
    $airCost     = $damageCosts[$airLevel]   ?? 0;
    $waterCost   = $damageCosts[$waterLevel] ?? 0;
    $totalComp   = $calculation->compensation_cost ?? ($landCost + $airCost + $waterCost);

    $scheme      = $calculation->payment_scheme ?? 'annual';
    $schemeLabel = ['annual'=>'Tahunan','semi_annual'=>'Semesteran','quarterly'=>'Kuartalan'][$scheme] ?? 'Tahunan';
    $installments= ['annual'=>1,'semi_annual'=>2,'quarterly'=>4][$scheme] ?? 1;
    $installRates= ['annual'=>1.0,'semi_annual'=>0.55,'quarterly'=>0.30];
    $installAmt  = $totalComp * ($installRates[$scheme] ?? 1.0);

    $lvlLabel = ['none'=>'Tidak Ada','low'=>'Ringan','medium'=>'Sedang','high'=>'Berat'];
    $lvlClass = ['none'=>'lvl-none','low'=>'lvl-low','medium'=>'lvl-medium','high'=>'lvl-high'];

    /* ── Determine next payment ──────────────── */
    $paidCount   = $calculation->paid_installments ?? 0;  // count of paid installments
    $nextDue     = $paidCount < $installments;
    $calcYear    = $calculation->calculation_year ?? date('Y');
    $nextDueDate = \Carbon\Carbon::create($calcYear + $paidCount, 3, 31)->format('d M Y');

    /* ── Percentage breakdown ────────────────── */
    $landPct  = $totalComp > 0 ? round($landCost  / $totalComp * 100) : 0;
    $airPct   = $totalComp > 0 ? round($airCost   / $totalComp * 100) : 0;
    $waterPct = $totalComp > 0 ? round($waterCost / $totalComp * 100) : 0;

    /* ── Mock progress (replace with DB) ──────── */
    $overallPct  = $paidCount > 0 ? min(100, intval($paidCount / $installments * 100 * 0.6)) : 5;
    $reforPct    = max(5, $overallPct + 2);
    $airQualPct  = max(5, $overallPct - 5);
    $riverPct    = max(2, $overallPct - 12);
    $mangrovePct = max(2, $overallPct - 22);

    /* ── Certificate ID ─────────────────────── */
    $certId = 'CCO-' . $calcYear . '-' . strtoupper(substr(preg_replace('/[^A-Za-z]/','',$calculation->company_name ?? 'CMP'),0,3)) . '-' . str_pad($calculation->id ?? 1, 5, '0', STR_PAD_LEFT);
@endphp

<div class="mon-wrap">
<div class="mon-shell">

    <!-- BACK BUTTON -->
    <div class="back-row">
        <a href="{{ route('calc.corporate.result', $calculation->id) }}" class="btn-back">
            ← Kembali ke Hasil
        </a>
    </div>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div class="page-header-left">
            <h1>📊 Dashboard Monitoring</h1>
            <p>Pantau perkembangan program kompensasi lingkungan perusahaan Anda secara real-time</p>
            <div class="company-meta">
                <div class="meta-pill">🏭 {{ $calculation->company_name }}</div>
                <div class="meta-pill">🗂️ SIUP: {{ $calculation->company_siup }}</div>
                <div class="meta-pill">📅 Tahun: {{ $calculation->calculation_year }}</div>
                <div class="meta-pill">📍 {{ $calculation->company_location }}</div>
                <div class="meta-pill">🏗️ {{ $calculation->facility_count }} Fasilitas</div>
            </div>
        </div>
        <div class="page-header-right">
            <div class="status-badge">
                <div class="status-dot"></div>
                Program Aktif
            </div>
            <a href="{{ route('calc.corporate.export-pdf', $calculation->id) }}" class="btn-hdr">⬇ Unduh Laporan</a>
        </div>
    </div>

    <!-- ALERT BANNER -->
    @if($nextDue && $paidCount < $installments)
    <div class="alert-banner">
        <div class="alert-icon">💳</div>
        <div class="alert-text">
            <strong>Pembayaran Terdekat — Jatuh Tempo {{ $nextDueDate }}</strong>
            <p>Termin ke-{{ $paidCount + 1 }} sebesar <strong>Rp {{ number_format($installAmt, 0, ',', '.') }}</strong> akan segera jatuh tempo. Dana ini dialokasikan untuk maintenance program reforestasi & monitoring kualitas udara yang sedang berjalan.</p>
        </div>
        @auth
        <a href="{{ route('payment.create', ['calculation' => $calculation->id]) }}" class="btn-amber">Bayar Sekarang</a>
        @endauth
    </div>
    @else
    <div class="alert-banner paid">
        <div class="alert-icon">✅</div>
        <div class="alert-text paid">
            <strong>Semua Pembayaran Termin Lunas</strong>
            <p>Terima kasih! Seluruh kewajiban pembayaran kompensasi telah diselesaikan. Program restorasi berlanjut sesuai jadwal.</p>
        </div>
    </div>
    @endif

    <!-- STAT CARDS -->
    <div class="stat-row">
        <div class="stat-card green">
            <span class="stat-icon">💰</span>
            <div class="stat-val">Rp {{ number_format($totalComp/1_000_000, 0, ',', '.') }}M</div>
            <div class="stat-unit">Total Kompensasi</div>
            <div class="stat-label">Kewajiban Offset</div>
            <div class="stat-change up">{{ $installments }}× termin · {{ $schemeLabel }}</div>
        </div>
        <div class="stat-card blue">
            <span class="stat-icon">✅</span>
            <div class="stat-val">{{ $paidCount }}/{{ $installments }}</div>
            <div class="stat-unit">Termin Dibayar</div>
            <div class="stat-label">Progres Pembayaran</div>
            <div class="stat-change {{ $paidCount > 0 ? 'up' : '' }}">
                @if($paidCount > 0) Rp {{ number_format($installAmt * $paidCount, 0, ',', '.') }} lunas
                @else Belum ada pembayaran
                @endif
            </div>
        </div>
        <div class="stat-card amber">
            <span class="stat-icon">🌱</span>
            <div class="stat-val">{{ number_format($reforPct * 78) }}</div>
            <div class="stat-unit">Pohon Ditanam</div>
            <div class="stat-label">Program Reforestasi</div>
            <div class="stat-change up">{{ $reforPct > 10 ? '▲ ' . round($reforPct*0.17) . ' pohon bulan ini' : 'Program dimulai' }}</div>
        </div>
        <div class="stat-card purple">
            <span class="stat-icon">📋</span>
            <div class="stat-val">{{ $overallPct }}%</div>
            <div class="stat-unit">Target Offset</div>
            <div class="stat-label">Progress Keseluruhan</div>
            <div class="stat-change {{ $overallPct >= 20 ? 'up' : '' }}">{{ $overallPct >= 20 ? 'On track ✓' : 'Baru dimulai' }}</div>
        </div>
    </div>

    <!-- PROGRESS + TIMELINE -->
    <div class="grid-2-1">

        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Progress Offset per Program</div>
                    <div class="panel-sub">Target penyelesaian: Desember {{ $calcYear + 4 }}</div>
                </div>
            </div>
            <div class="panel-body">
                @if($landLevel !== 'none')
                <div class="prog-item">
                    <div class="prog-top">
                        <div class="prog-name"><div class="prog-dot" style="background:#10b981;"></div>Reforestasi Lahan Kritis</div>
                        <div class="prog-pct">{{ $reforPct }}%</div>
                    </div>
                    <div class="prog-bar"><div class="prog-fill" data-width="{{ $reforPct }}" style="width:0%;background:linear-gradient(90deg,#10b981,#059669);"></div></div>
                    <div class="prog-info">
                        <span>{{ number_format($reforPct*78) }} / {{ number_format(7800) }} pohon</span>
                        <span>Target: Jun {{ $calcYear + 2 }}</span>
                    </div>
                </div>
                @endif

                @if($airLevel !== 'none')
                <div class="prog-item">
                    <div class="prog-top">
                        <div class="prog-name"><div class="prog-dot" style="background:#3b82f6;"></div>Pemulihan Kualitas Udara</div>
                        <div class="prog-pct">{{ $airQualPct }}%</div>
                    </div>
                    <div class="prog-bar"><div class="prog-fill" data-width="{{ $airQualPct }}" style="width:0%;background:linear-gradient(90deg,#3b82f6,#0ea5e9);"></div></div>
                    <div class="prog-info">
                        <span>{{ max(1, intval($airQualPct/14)) }} dari 7 stasiun monitor aktif</span>
                        <span>Target: Des {{ $calcYear + 1 }}</span>
                    </div>
                </div>
                @endif

                @if($waterLevel !== 'none')
                <div class="prog-item">
                    <div class="prog-top">
                        <div class="prog-name"><div class="prog-dot" style="background:#f59e0b;"></div>Restorasi Badan Air</div>
                        <div class="prog-pct">{{ $riverPct }}%</div>
                    </div>
                    <div class="prog-bar"><div class="prog-fill" data-width="{{ $riverPct }}" style="width:0%;background:linear-gradient(90deg,#f59e0b,#f97316);"></div></div>
                    <div class="prog-info">
                        <span>{{ number_format($riverPct * 0.075, 1) }}km / 7.5km direhabilitasi</span>
                        <span>Target: Mar {{ $calcYear + 3 }}</span>
                    </div>
                </div>
                @endif

                <div class="prog-item">
                    <div class="prog-top">
                        <div class="prog-name"><div class="prog-dot" style="background:#8b5cf6;"></div>Mangrove & Pesisir</div>
                        <div class="prog-pct">{{ $mangrovePct }}%</div>
                    </div>
                    <div class="prog-bar"><div class="prog-fill" data-width="{{ $mangrovePct }}" style="width:0%;background:linear-gradient(90deg,#8b5cf6,#6366f1);"></div></div>
                    <div class="prog-info">
                        <span>{{ number_format($mangrovePct * 80) }} / 8.000 bibit mangrove</span>
                        <span>Target: Des {{ $calcYear + 4 }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Riwayat Pembayaran</div>
                    <div class="panel-sub">Skema {{ $schemeLabel }} · {{ $installments }} Termin</div>
                </div>
            </div>
            <div class="panel-body">
                <div class="timeline">
                    @for($i = 1; $i <= $installments; $i++)
                    @php
                        $monthOffset  = ($scheme === 'quarterly') ? ($i - 1) * 3 : (($scheme === 'semi_annual') ? ($i - 1) * 6 : ($i - 1) * 12);
                        $dueDate      = \Carbon\Carbon::create($calcYear, 1, 15)->addMonths($monthOffset);
                        $isPaid       = $i <= $paidCount;
                        $isNext       = $i === $paidCount + 1;
                        $tlDotClass   = $isPaid ? 'paid'      : ($isNext ? 'upcoming' : 'planned');
                        $tlDotIcon    = $isPaid ? '✓'         : ($isNext ? '!'        : '○');
                        $tlAmtColor   = $isPaid ? '#059669'   : ($isNext ? '#d97706'  : '#94a3b8');
                        $tlChipClass  = $isPaid ? 'chip-paid' : ($isNext ? 'chip-upcoming' : 'chip-planned');
                        $tlChipLabel  = $isPaid ? 'LUNAS'     : ($isNext ? 'JATUH TEMPO'   : 'TERJADWAL');
                        $tlLabel      = ($i === 1) ? 'Pembayaran Awal' : (($i === $installments) ? 'Pembayaran Final + Audit Penutup' : 'Termin ' . $i . ' + Maintenance');
                    @endphp
                    <div class="tl-item">
                        <div class="tl-dot {{ $tlDotClass }}">{{ $tlDotIcon }}</div>
                        <div class="tl-date">{{ $dueDate->format('d M Y') }}</div>
                        <div class="tl-label">{{ $tlLabel }}</div>
                        <div class="tl-amount tl-color-{{ $tlDotClass }}">
                            Rp {{ number_format($installAmt, 0, ',', '.') }}
                            <span class="tl-chip {{ $tlChipClass }}">{{ $tlChipLabel }}</span>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>

    </div>

    <!-- ACTIVITY + SIDE -->
    <div class="grid-3-2">

        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Log Aktivitas Restorasi</div>
                    <div class="panel-sub">Diverifikasi tim auditor Kementerian Lingkungan Hidup</div>
                </div>
                <a href="#" style="font-size:.78rem;color:var(--green-500);font-weight:700;text-decoration:none;">Lihat Semua →</a>
            </div>
            <div class="panel-body" style="padding: 0 22px 10px;">
                <table class="act-table">
                    <thead>
                        <tr>
                            <th>Aktivitas</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th>CO₂e Offset</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($landLevel !== 'none')
                        <tr>
                            <td><div class="act-name"><div class="act-dot" style="background:#10b981;"></div>Penanaman Pohon</div></td>
                            <td>{{ $calculation->company_location }}</td>
                            <td>{{ \Carbon\Carbon::now()->format('d M Y') }}</td>
                            <td style="color:#059669;font-weight:700;">+128 ton</td>
                            <td><span class="s-chip s-done">✓ Terverifikasi</span></td>
                        </tr>
                        @endif
                        @if($airLevel !== 'none')
                        <tr>
                            <td><div class="act-name"><div class="act-dot" style="background:#3b82f6;"></div>Uji Kualitas Udara</div></td>
                            <td>Lokasi Pabrik</td>
                            <td>{{ \Carbon\Carbon::now()->subDays(8)->format('d M Y') }}</td>
                            <td style="color:#94a3b8;">—</td>
                            <td><span class="s-chip s-done">✓ Terverifikasi</span></td>
                        </tr>
                        @endif
                        @if($waterLevel !== 'none')
                        <tr>
                            <td><div class="act-name"><div class="act-dot" style="background:#f59e0b;"></div>Pembersihan Sungai</div></td>
                            <td>Area Operasional</td>
                            <td>{{ \Carbon\Carbon::now()->subDays(14)->format('d M Y') }}</td>
                            <td style="color:#94a3b8;">—</td>
                            <td><span class="s-chip s-prog">⟳ Berlangsung</span></td>
                        </tr>
                        @endif
                        <tr>
                            <td><div class="act-name"><div class="act-dot" style="background:#8b5cf6;"></div>Bibit Mangrove</div></td>
                            <td>Wilayah Pesisir</td>
                            <td>{{ \Carbon\Carbon::now()->subDays(29)->format('d M Y') }}</td>
                            <td style="color:#059669;font-weight:700;">+44 ton</td>
                            <td><span class="s-chip s-prog">⟳ Berlangsung</span></td>
                        </tr>
                        <tr>
                            <td><div class="act-name"><div class="act-dot" style="background:#ef4444;"></div>Audit KLH</div></td>
                            <td>Fasilitas Utama</td>
                            <td>{{ \Carbon\Carbon::now()->subDays(43)->format('d M Y') }}</td>
                            <td style="color:#94a3b8;">—</td>
                            <td><span class="s-chip s-warn">⚠ Review</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:16px;">

            <!-- DAMAGE BREAKDOWN -->
            <div class="panel">
                <div class="panel-head">
                    <div class="panel-title">Porsi Dampak Lingkungan</div>
                </div>
                <div class="panel-body" style="padding-top:14px;">
                    <div class="impact-item">
                        <div class="impact-icon" style="background:#f0fdf4;">🏔️</div>
                        <div class="impact-text">
                            <div class="impact-name">Kerusakan Tanah</div>
                            <div class="impact-level">
                                <span class="dmg-level-tag {{ $lvlClass[$landLevel] }}">{{ $lvlLabel[$landLevel] }}</span>
                            </div>
                        </div>
                        <div class="impact-right">
                            <div class="impact-pct" style="color:#10b981;">{{ $landPct }}%</div>
                            <div class="impact-cost">Rp {{ number_format($landCost/1_000_000, 0, ',', '.') }}M</div>
                        </div>
                    </div>
                    <div class="impact-item">
                        <div class="impact-icon" style="background:#eff6ff;">💨</div>
                        <div class="impact-text">
                            <div class="impact-name">Pencemaran Udara</div>
                            <div class="impact-level">
                                <span class="dmg-level-tag {{ $lvlClass[$airLevel] }}">{{ $lvlLabel[$airLevel] }}</span>
                            </div>
                        </div>
                        <div class="impact-right">
                            <div class="impact-pct" style="color:#3b82f6;">{{ $airPct }}%</div>
                            <div class="impact-cost">Rp {{ number_format($airCost/1_000_000, 0, ',', '.') }}M</div>
                        </div>
                    </div>
                    <div class="impact-item">
                        <div class="impact-icon" style="background:#f5f3ff;">💧</div>
                        <div class="impact-text">
                            <div class="impact-name">Pencemaran Air</div>
                            <div class="impact-level">
                                <span class="dmg-level-tag {{ $lvlClass[$waterLevel] }}">{{ $lvlLabel[$waterLevel] }}</span>
                            </div>
                        </div>
                        <div class="impact-right">
                            <div class="impact-pct" style="color:#8b5cf6;">{{ $waterPct }}%</div>
                            <div class="impact-cost">Rp {{ number_format($waterCost/1_000_000, 0, ',', '.') }}M</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CERTIFICATE -->
            <div class="cert-card">
                <span class="cert-seal">🏅</span>
                <div class="cert-title">Sertifikat Offset Karbon</div>
                <div class="cert-id">ID: {{ $certId }}</div>
                <div class="cert-status">
                    Diterbitkan oleh<br>
                    <strong>Kementerian Lingkungan Hidup RI</strong><br>
                    Valid: <strong>Jan {{ $calcYear }} – Des {{ $calcYear + 4 }}</strong>
                </div>
                <p class="cert-note">Sertifikat penuh diterbitkan setelah offset 100% tercapai dan audit akhir selesai oleh auditor KLH.</p>
            </div>

        </div>
    </div>

</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Animate progress bars on load
    setTimeout(() => {
        document.querySelectorAll('.prog-fill[data-width]').forEach(bar => {
            bar.style.width = bar.dataset.width + '%';
        });
    }, 200);
});
</script>

@endsection