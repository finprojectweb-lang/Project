@extends('layouts.app')

@section('title', 'Review Pembayaran Kompensasi - NulliCarbon')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Mono:wght@400;500&display=swap');

* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

:root {
    --g900: #064e3b; --g700: #047857; --g600: #059669; --g500: #10b981; --g400: #34d399;
    --g100: #d1fae5; --g50: #ecfdf5;
    --s900: #0f172a; --s700: #334155; --s500: #64748b; --s300: #cbd5e1; --s200: #e2e8f0; --s100: #f1f5f9; --s50: #f8fafc;
}

.review-wrap { min-height:100vh; background:linear-gradient(160deg,#f0fdf4 0%,#dcfce7 45%,#ecfdf5 100%); padding:100px 20px 60px; }
.review-shell { max-width:1000px; margin:0 auto; }

.success-hero { background:linear-gradient(135deg,#064e3b 0%,#065f46 50%,#047857 100%); border-radius:28px; padding:48px 44px; color:white; position:relative; overflow:hidden; margin-bottom:28px; box-shadow:0 24px 64px rgba(6,78,59,.35); text-align:center; }
.success-hero::before { content:''; position:absolute; top:-80px; right:-80px; width:320px; height:320px; border-radius:50%; background:radial-gradient(circle,rgba(52,211,153,.18) 0%,transparent 70%); }
.success-hero::after  { content:''; position:absolute; bottom:-60px; left:60px; width:220px; height:220px; border-radius:50%; background:radial-gradient(circle,rgba(16,185,129,.12) 0%,transparent 70%); }
.success-icon  { width:80px; height:80px; border-radius:24px; background:rgba(255,255,255,.15); border:2px solid rgba(255,255,255,.25); display:inline-flex; align-items:center; justify-content:center; font-size:2.4rem; margin-bottom:20px; position:relative; z-index:1; }
.success-title { font-size:2rem; font-weight:900; letter-spacing:-.03em; margin-bottom:10px; position:relative; z-index:1; }
.success-sub   { font-size:.95rem; opacity:.85; font-weight:500; position:relative; z-index:1; margin-bottom:20px; }
.success-meta  { display:flex; flex-wrap:wrap; justify-content:center; gap:8px; position:relative; z-index:1; }
.success-pill  { display:inline-flex; align-items:center; gap:5px; padding:6px 14px; background:rgba(255,255,255,.13); border:1px solid rgba(255,255,255,.22); border-radius:100px; font-size:.78rem; font-weight:600; }

/* ── DATE BANNER ── */
.date-banner {
    display:flex; align-items:center; justify-content:center; gap:20px;
    flex-wrap:wrap;
    background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.2);
    border-radius:14px; padding:12px 20px; margin-top:16px;
    position:relative; z-index:1;
}
.date-item { display:flex; align-items:center; gap:7px; font-size:.8rem; font-weight:600; }
.date-item-sep { opacity:.4; font-size:.9rem; }

.section-header { display:flex; align-items:center; gap:14px; margin:28px 0 18px; }
.section-line   { flex:1; height:2px; background:linear-gradient(90deg,var(--g100),transparent); border-radius:2px; }
.section-title  { font-size:1rem; font-weight:900; color:var(--g900); white-space:nowrap; display:flex; align-items:center; gap:9px; }
.section-num    { width:28px; height:28px; border-radius:8px; background:linear-gradient(135deg,var(--g500),var(--g700)); color:white; font-size:.74rem; font-weight:900; display:inline-flex; align-items:center; justify-content:center; }

.card { background:white; border:2px solid var(--s100); border-radius:20px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.06); margin-bottom:16px; }
.card-head { padding:16px 24px; border-bottom:2px solid var(--s100); font-size:.78rem; font-weight:800; color:var(--s500); text-transform:uppercase; letter-spacing:.08em; display:flex; align-items:center; gap:8px; background:var(--s50); }
.card-body { padding:24px; }

.detail-grid  { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
@media(max-width:640px) { .detail-grid { grid-template-columns:1fr; } }
.detail-item  { background:var(--s50); border:2px solid var(--s100); border-radius:14px; padding:14px 18px; }
.detail-label { font-size:.68rem; font-weight:700; color:var(--s500); text-transform:uppercase; letter-spacing:.07em; margin-bottom:5px; }
.detail-val   { font-size:.92rem; font-weight:700; color:var(--s900); }
.detail-item.highlight { border-color:var(--g100); background:var(--g50); }
.detail-item.highlight .detail-label { color:var(--g700); }
.detail-item.highlight .detail-val   { color:var(--g700); }

.dmg-row { display:grid; grid-template-columns:repeat(3,1fr); gap:12px; margin-bottom:20px; }
@media(max-width:480px) { .dmg-row { grid-template-columns:1fr; } }
.dmg-chip       { border-radius:14px; border:2px solid; padding:16px; text-align:center; }
.dmg-chip.land  { border-color:#bbf7d0; background:#f0fdf4; }
.dmg-chip.air   { border-color:#bfdbfe; background:#eff6ff; }
.dmg-chip.water { border-color:#ddd6fe; background:#f5f3ff; }
.dmg-chip-icon  { font-size:1.5rem; display:block; margin-bottom:6px; }
.dmg-chip-name  { font-size:.72rem; font-weight:700; color:var(--s500); text-transform:uppercase; letter-spacing:.05em; margin-bottom:6px; }
.dmg-chip-level { display:inline-block; padding:3px 10px; border-radius:100px; font-size:.74rem; font-weight:800; }
.dmg-chip-cost  { font-size:.8rem; font-weight:800; margin-top:8px; font-family:'DM Mono',monospace; }
.dmg-chip.land  .dmg-chip-cost { color:#059669; }
.dmg-chip.air   .dmg-chip-cost { color:#2563eb; }
.dmg-chip.water .dmg-chip-cost { color:#7c3aed; }
.lvl-none   { background:#f1f5f9; color:#64748b; }
.lvl-low    { background:#d1fae5; color:#065f46; }
.lvl-medium { background:#fef3c7; color:#92400e; }
.lvl-high   { background:#fee2e2; color:#991b1b; }

.cost-rows  { display:flex; flex-direction:column; }
.cost-row   { display:flex; justify-content:space-between; align-items:center; padding:12px 0; border-bottom:1px solid var(--s100); font-size:.86rem; }
.cost-row:last-child { border-bottom:none; }
.cost-label { color:var(--s500); font-weight:500; }
.cost-val   { color:var(--s900); font-weight:700; font-family:'DM Mono',monospace; font-size:.82rem; }
.cost-total-block { display:flex; justify-content:space-between; align-items:center; padding:18px 22px; border-radius:16px; background:linear-gradient(135deg,var(--g900),var(--g700)); margin-top:16px; }
.cost-total-label { color:rgba(255,255,255,.8); font-size:.86rem; font-weight:600; }
.cost-total-val   { color:white; font-size:1.5rem; font-weight:900; font-family:'DM Mono',monospace; letter-spacing:-.02em; }

.scheme-badge    { display:flex; align-items:center; justify-content:space-between; background:var(--g50); border:2px solid var(--g100); border-radius:14px; padding:14px 18px; margin-bottom:20px; }
.scheme-label    { font-size:.9rem; font-weight:800; color:var(--g700); display:flex; align-items:center; gap:8px; }
.scheme-inst-amt { font-size:1rem; font-weight:900; color:var(--g700); font-family:'DM Mono',monospace; }
.scheme-inst-sub { font-size:.72rem; color:var(--s500); margin-top:2px; text-align:right; }

.termin-list { display:flex; flex-direction:column; gap:8px; }
.termin-row  { display:flex; align-items:center; gap:12px; padding:14px 18px; border-radius:13px; background:var(--s50); border:2px solid var(--s100); }
.termin-row.first { border-color:var(--g400); background:var(--g50); }
.termin-num  { width:30px; height:30px; border-radius:9px; flex-shrink:0; background:var(--g100); color:var(--g700); font-size:.78rem; font-weight:900; display:flex; align-items:center; justify-content:center; }
.termin-row.first .termin-num { background:var(--g500); color:white; }
.termin-info { flex:1; }
.termin-label-text { font-size:.84rem; font-weight:700; color:var(--s900); margin-bottom:2px; }
.termin-date  { font-size:.74rem; color:var(--s500); font-family:'DM Mono',monospace; }
.termin-amt   { font-size:.95rem; font-weight:900; color:var(--g700); font-family:'DM Mono',monospace; }
.termin-badge { font-size:.66rem; font-weight:800; padding:3px 9px; border-radius:100px; background:var(--g500); color:white; margin-left:8px; }

.program-list { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
@media(max-width:540px) { .program-list { grid-template-columns:1fr; } }
.prog-chip      { display:flex; align-items:center; gap:10px; padding:12px 14px; border-radius:12px; background:var(--g50); border:2px solid var(--g100); }
.prog-chip-icon { font-size:1.3rem; flex-shrink:0; }
.prog-chip-info { flex:1; min-width:0; }
.prog-chip-name { font-size:.82rem; font-weight:700; color:var(--s900); margin-bottom:2px; }
.prog-chip-amt  { font-size:.74rem; font-weight:800; color:var(--g700); font-family:'DM Mono',monospace; }

.pic-grid     { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
@media(max-width:480px) { .pic-grid { grid-template-columns:1fr; } }
.pic-pill       { background:var(--s50); border:2px solid var(--s100); border-radius:12px; padding:12px 16px; }
.pic-pill-label { font-size:.66rem; color:var(--s400); font-weight:700; text-transform:uppercase; letter-spacing:.05em; display:block; margin-bottom:3px; }
.pic-pill-val   { font-size:.88rem; color:var(--s900); font-weight:700; }

.method-badge { display:inline-flex; align-items:center; gap:10px; padding:12px 18px; border-radius:13px; background:var(--g50); border:2px solid var(--g100); font-size:.9rem; font-weight:700; color:var(--s900); }
.method-badge span { font-size:1.4rem; }

.maint-notice      { display:flex; align-items:flex-start; gap:10px; background:#fffbeb; border:2px solid #fcd34d; border-radius:13px; padding:14px 18px; margin-bottom:16px; }
.maint-notice-text { font-size:.82rem; color:#92400e; line-height:1.6; }
.maint-notice-text strong { display:block; margin-bottom:2px; }

.action-row { display:flex; gap:12px; flex-wrap:wrap; background:white; border-radius:20px; padding:24px; border:2px solid var(--s100); box-shadow:0 4px 16px rgba(0,0,0,.04); margin-top:8px; }
.btn-act    { flex:1; min-width:140px; display:inline-flex; align-items:center; justify-content:center; gap:8px; padding:14px 20px; border-radius:13px; font-size:.86rem; font-weight:700; cursor:pointer; border:2px solid; text-decoration:none; transition:all .2s; }
.btn-act.g  { border-color:var(--g500); color:var(--g700); background:var(--g50); }
.btn-act.g:hover { background:var(--g100); transform:translateY(-1px); }
.btn-act.s  { border-color:var(--s300); color:var(--s700); background:white; }
.btn-act.s:hover { background:var(--s50); transform:translateY(-1px); }

.powered-bar  { text-align:center; padding:24px; display:flex; align-items:center; justify-content:center; gap:10px; font-size:.78rem; color:var(--s500); font-weight:600; }
.powered-logo { height:26px; }

@media(max-width:768px) {
    .success-hero { padding:36px 20px; }
    .success-title { font-size:1.5rem; }
    .card-body { padding:18px; }
    .action-row { flex-direction:column; }
    .btn-act { width:100%; }
    .date-banner { gap:12px; }
}
</style>

@php
    $calc = $calculation;

    $pay = session('payment_review_' . $calc->id, []);

    $totalComp  = $pay['total_amount']    ?? $calc->compensation_cost ?? 0;
    $maintAmt   = $pay['maintenance_amt'] ?? ($totalComp * 0.10);
    $allocable  = $totalComp * 0.90;
    $scheme     = $pay['payment_scheme']  ?? $calc->payment_scheme ?? 'annual';
    $programs   = $pay['offset_program']  ?? [];
    $method     = $pay['payment_method']  ?? '';

    $picName     = $pay['pic_name']     ?? $calc->pic_name     ?? '—';
    $picPosition = $pay['pic_position'] ?? $calc->pic_position ?? '—';
    $picEmail    = $pay['pic_email']    ?? $calc->pic_email    ?? '—';
    $picPhone    = $pay['pic_phone']    ?? $calc->pic_phone    ?? '—';

    $schemeLabels = ['annual'=>'Tahunan','semi_annual'=>'Semesteran','quarterly'=>'Kuartalan'];
    $schemeIcons  = ['annual'=>'🗓️','semi_annual'=>'📆','quarterly'=>'📅'];
    $installNums  = ['annual'=>1,'semi_annual'=>2,'quarterly'=>4];
    $installRates = ['annual'=>1.0,'semi_annual'=>0.55,'quarterly'=>0.30];
    $instCount    = $installNums[$scheme]  ?? 1;
    $instRate     = $installRates[$scheme] ?? 1.0;
    $instAmt      = $totalComp * $instRate;

    $methodLabels = ['bank_transfer'=>'Transfer Bank','e_wallet'=>'E-Wallet','virtual_account'=>'Virtual Account'];
    $methodIcons  = ['bank_transfer'=>'🏦','e_wallet'=>'📱','virtual_account'=>'💳'];

    $industryMap = [
        'manufacturing'=>'Manufaktur','chemical'=>'Ind. Kimia','mining'=>'Pertambangan',
        'cement'=>'Semen','pulp'=>'Pulp & Kertas','palm_oil'=>'Kelapa Sawit',
        'steel'=>'Baja & Logam','construction'=>'Konstruksi','transportation'=>'Transportasi',
        'energy'=>'Energi','agriculture'=>'Pertanian','service'=>'Jasa',
        'technology'=>'Teknologi','other'=>'Lainnya',
    ];

    $damageCosts = ['none'=>0,'low'=>250_000_000,'medium'=>750_000_000,'high'=>1_750_000_000];
    $landLvl  = $calc->damage_land  ?? 'none';
    $airLvl   = $calc->damage_air   ?? 'none';
    $waterLvl = $calc->damage_water ?? 'none';
    $landCost  = $damageCosts[$landLvl]  ?? 0;
    $airCost   = $damageCosts[$airLvl]   ?? 0;
    $waterCost = $damageCosts[$waterLvl] ?? 0;

    $lvlLabel = ['none'=>'Tidak Ada','low'=>'Ringan','medium'=>'Sedang','high'=>'Berat'];
    $lvlClass = ['none'=>'lvl-none','low'=>'lvl-low','medium'=>'lvl-medium','high'=>'lvl-high'];

    $calcYear = $calc->calculation_year ?? date('Y');

    /* ── Tanggal ── */
    $createdAt  = $calc->created_at ? $calc->created_at->locale('id')->translatedFormat('d F Y, H:i') : '—';
    $updatedAt  = $calc->updated_at ? $calc->updated_at->locale('id')->translatedFormat('d F Y, H:i') : '—';
    /* Anggap updated_at = tanggal bayar jika status sudah active */
    $paidAt     = ($calc->status === 'active' && $calc->updated_at)
                    ? $calc->updated_at->locale('id')->translatedFormat('d F Y, H:i')
                    : null;

    $termins = [];
    for ($i = 0; $i < $instCount; $i++) {
        $addMonths = ($scheme === 'quarterly') ? $i * 3 : (($scheme === 'semi_annual') ? $i * 6 : $i * 12);
        $termins[] = \Carbon\Carbon::create($calcYear, 1, 15)->addMonths($addMonths)->locale('id')->translatedFormat('d F Y');
    }

    $programMeta = [
        'water_turbine' => ['icon'=>'💧','label'=>'Turbin Air Mikro-Hidro'],
        'mangrove'      => ['icon'=>'🌿','label'=>'Penanaman Mangrove'],
        'reforestation' => ['icon'=>'🌱','label'=>'Reforestasi Lahan Kritis'],
        'waste_recycle' => ['icon'=>'♻️','label'=>'Daur Ulang Industri'],
        'coral_reef'    => ['icon'=>'🪸','label'=>'Restorasi Terumbu Karang'],
        'air_quality'   => ['icon'=>'🌬️','label'=>'Pemantauan Kualitas Udara'],
    ];

    $progCount = count($programs);
    $splitAmt  = $progCount > 0 ? $allocable / $progCount : 0;
@endphp

<div class="review-wrap">
<div class="review-shell">

    {{-- ── HERO ── --}}
    <div class="success-hero">
        <div class="success-icon">✅</div>
        <h1 class="success-title">Pembayaran Berhasil Dikonfirmasi!</h1>
        <p class="success-sub">Berikut adalah ringkasan lengkap pembayaran kompensasi lingkungan Anda.</p>
        <div class="success-meta">
            <span class="success-pill">🏭 {{ $calc->company_name }}</span>
            <span class="success-pill">📅 {{ $calcYear }}</span>
            <span class="success-pill">🗂️ {{ $calc->company_siup }}</span>
            <span class="success-pill">💰 Rp {{ number_format($totalComp,0,',','.') }}</span>
            <span class="success-pill">{{ $schemeIcons[$scheme] ?? '🗓️' }} Skema {{ $schemeLabels[$scheme] ?? 'Tahunan' }}</span>
        </div>

        {{-- ── DATE BANNER ── --}}
        <div class="date-banner">
            <div class="date-item">
                <span>📝</span>
                <span>Dibuat: <strong>{{ $createdAt }}</strong></span>
            </div>
            @if($paidAt)
            <span class="date-item-sep">·</span>
            <div class="date-item">
                <span>✅</span>
                <span>Dibayar: <strong>{{ $paidAt }}</strong></span>
            </div>
            @endif
        </div>
    </div>

    {{-- 1. IDENTITAS PERUSAHAAN --}}
    <div class="section-header">
        <div class="section-title"><span class="section-num">1</span> Identitas Perusahaan</div>
        <div class="section-line"></div>
    </div>
    <div class="card">
        <div class="card-head">🏭 Data Perusahaan</div>
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item"><div class="detail-label">Nama Perusahaan</div><div class="detail-val">{{ $calc->company_name }}</div></div>
                <div class="detail-item"><div class="detail-label">No. SIUP / NIB</div><div class="detail-val">{{ $calc->company_siup }}</div></div>
                <div class="detail-item"><div class="detail-label">Kategori Usaha</div><div class="detail-val">{{ $industryMap[$calc->industry_type] ?? ucfirst($calc->industry_type) }}</div></div>
                <div class="detail-item"><div class="detail-label">Lokasi Operasional</div><div class="detail-val">{{ $calc->company_location }}</div></div>
                <div class="detail-item"><div class="detail-label">Jumlah Fasilitas</div><div class="detail-val">{{ $calc->facility_count }} Fasilitas</div></div>
                <div class="detail-item"><div class="detail-label">Tahun Perhitungan</div><div class="detail-val">{{ $calcYear }}</div></div>
                @if($calc->company_email)
                <div class="detail-item"><div class="detail-label">Email Perusahaan</div><div class="detail-val">{{ $calc->company_email }}</div></div>
                @endif
                @if($calc->company_affiliate)
                <div class="detail-item"><div class="detail-label">Afiliasi / Grup</div><div class="detail-val">{{ $calc->company_affiliate }}</div></div>
                @endif
                {{-- ── TANGGAL ── --}}
                <div class="detail-item highlight">
                    <div class="detail-label">📝 Tanggal Dibuat</div>
                    <div class="detail-val">{{ $createdAt }}</div>
                </div>
                @if($paidAt)
                <div class="detail-item highlight">
                    <div class="detail-label">✅ Tanggal Dibayar</div>
                    <div class="detail-val">{{ $paidAt }}</div>
                </div>
                @else
                <div class="detail-item">
                    <div class="detail-label">🔄 Terakhir Diperbarui</div>
                    <div class="detail-val">{{ $updatedAt }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- 2. DATA PIC --}}
    <div class="section-header">
        <div class="section-title"><span class="section-num">2</span> Person in Charge</div>
        <div class="section-line"></div>
    </div>
    <div class="card">
        <div class="card-head">👤 Data PIC</div>
        <div class="card-body">
            <div class="pic-grid">
                <div class="pic-pill"><span class="pic-pill-label">Nama PIC</span><span class="pic-pill-val">{{ $picName }}</span></div>
                <div class="pic-pill"><span class="pic-pill-label">Jabatan</span><span class="pic-pill-val">{{ $picPosition }}</span></div>
                <div class="pic-pill"><span class="pic-pill-label">Email PIC</span><span class="pic-pill-val">{{ $picEmail }}</span></div>
                <div class="pic-pill"><span class="pic-pill-label">No. Telepon</span><span class="pic-pill-val">{{ $picPhone }}</span></div>
            </div>
        </div>
    </div>

    {{-- 3. DAMPAK & BIAYA --}}
    <div class="section-header">
        <div class="section-title"><span class="section-num">3</span> Rincian Dampak & Biaya Kompensasi</div>
        <div class="section-line"></div>
    </div>
    <div class="card">
        <div class="card-head">🌍 Dampak Lingkungan & Perhitungan</div>
        <div class="card-body">
            <div class="dmg-row">
                <div class="dmg-chip land">
                    <span class="dmg-chip-icon">🏔️</span>
                    <div class="dmg-chip-name">Kerusakan Tanah</div>
                    <span class="dmg-chip-level {{ $lvlClass[$landLvl] }}">{{ $lvlLabel[$landLvl] }}</span>
                    <div class="dmg-chip-cost">{{ $landCost > 0 ? 'Rp '.number_format($landCost,0,',','.') : 'Rp 0' }}</div>
                </div>
                <div class="dmg-chip air">
                    <span class="dmg-chip-icon">💨</span>
                    <div class="dmg-chip-name">Pencemaran Udara</div>
                    <span class="dmg-chip-level {{ $lvlClass[$airLvl] }}">{{ $lvlLabel[$airLvl] }}</span>
                    <div class="dmg-chip-cost">{{ $airCost > 0 ? 'Rp '.number_format($airCost,0,',','.') : 'Rp 0' }}</div>
                </div>
                <div class="dmg-chip water">
                    <span class="dmg-chip-icon">💧</span>
                    <div class="dmg-chip-name">Pencemaran Air</div>
                    <span class="dmg-chip-level {{ $lvlClass[$waterLvl] }}">{{ $lvlLabel[$waterLvl] }}</span>
                    <div class="dmg-chip-cost">{{ $waterCost > 0 ? 'Rp '.number_format($waterCost,0,',','.') : 'Rp 0' }}</div>
                </div>
            </div>
            <div class="cost-rows">
                @if($landCost > 0)<div class="cost-row"><span class="cost-label">🏔️ Kompensasi Kerusakan Tanah</span><span class="cost-val">Rp {{ number_format($landCost,0,',','.') }}</span></div>@endif
                @if($airCost > 0)<div class="cost-row"><span class="cost-label">💨 Kompensasi Pencemaran Udara</span><span class="cost-val">Rp {{ number_format($airCost,0,',','.') }}</span></div>@endif
                @if($waterCost > 0)<div class="cost-row"><span class="cost-label">💧 Kompensasi Pencemaran Air</span><span class="cost-val">Rp {{ number_format($waterCost,0,',','.') }}</span></div>@endif
                <div class="cost-row"><span class="cost-label">⚙️ Maintenance & Operasional (10% — fixed)</span><span class="cost-val">Rp {{ number_format($maintAmt,0,',','.') }}</span></div>
                <div class="cost-row"><span class="cost-label">🌿 Program Restorasi (90% — dialokasikan)</span><span class="cost-val">Rp {{ number_format($allocable,0,',','.') }}</span></div>
            </div>
            <div class="cost-total-block">
                <span class="cost-total-label">Total Kompensasi Lingkungan {{ $calcYear }}</span>
                <span class="cost-total-val">Rp {{ number_format($totalComp,0,',','.') }}</span>
            </div>
        </div>
    </div>

    {{-- 4. SKEMA & JADWAL --}}
    <div class="section-header">
        <div class="section-title"><span class="section-num">4</span> Skema & Jadwal Pembayaran</div>
        <div class="section-line"></div>
    </div>
    <div class="card">
        <div class="card-head">📅 Termin Pembayaran</div>
        <div class="card-body">
            <div class="scheme-badge">
                <div class="scheme-label">{{ $schemeIcons[$scheme] ?? '🗓️' }} Skema {{ $schemeLabels[$scheme] ?? 'Tahunan' }}</div>
                <div>
                    <div class="scheme-inst-amt">Rp {{ number_format($instAmt,0,',','.') }}</div>
                    <div class="scheme-inst-sub">per termin × {{ $instCount }}×</div>
                </div>
            </div>
            <div class="termin-list">
                @foreach($termins as $idx => $tDate)
                <div class="termin-row {{ $idx === 0 ? 'first' : '' }}">
                    <div class="termin-num">{{ $idx + 1 }}</div>
                    <div class="termin-info">
                        <div class="termin-label-text">
                            @if($idx === 0) Pembayaran Pertama (Sekarang)
                            @elseif($idx === count($termins) - 1) Pembayaran Final
                            @else Termin {{ $idx + 1 }}
                            @endif
                        </div>
                        <div class="termin-date">{{ $tDate }}</div>
                    </div>
                    <div style="display:flex;align-items:center;">
                        <div class="termin-amt">Rp {{ number_format($instAmt,0,',','.') }}</div>
                        @if($idx === 0)<span class="termin-badge">✓ Dibayar</span>@endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 5. PROGRAM RESTORASI --}}
    <div class="section-header">
        <div class="section-title"><span class="section-num">5</span> Alokasi Program Restorasi</div>
        <div class="section-line"></div>
    </div>
    <div class="card">
        <div class="card-head">🌿 Program yang Dipilih</div>
        <div class="card-body">
            <div class="maint-notice">
                <span style="font-size:1.2rem;">⚙️</span>
                <div class="maint-notice-text">
                    <strong>Maintenance & Operasional — 10% (Rp {{ number_format($maintAmt,0,',','.') }})</strong>
                    Ditetapkan otomatis untuk monitoring lapangan, administrasi program, dan audit KLH.
                </div>
            </div>
            @if($progCount > 0)
            <div class="program-list">
                @foreach($programs as $prog)
                @php $meta = $programMeta[$prog] ?? ['icon'=>'🌿','label'=>ucfirst($prog)]; @endphp
                <div class="prog-chip">
                    <div class="prog-chip-icon">{{ $meta['icon'] }}</div>
                    <div class="prog-chip-info">
                        <div class="prog-chip-name">{{ $meta['label'] }}</div>
                        <div class="prog-chip-amt">Rp {{ number_format($splitAmt,0,',','.') }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            <div style="margin-top:14px;padding:12px 16px;background:var(--s50);border:2px solid var(--s100);border-radius:12px;font-size:.82rem;color:var(--s500);">
                Dana 90% (Rp {{ number_format($allocable,0,',','.') }}) dibagi rata ke <strong>{{ $progCount }} program</strong> — masing-masing mendapat <strong>Rp {{ number_format($splitAmt,0,',','.') }}</strong>.
            </div>
            @else
            <div style="text-align:center;padding:24px;color:var(--s500);font-size:.88rem;">Tidak ada program yang dipilih.</div>
            @endif
        </div>
    </div>

    {{-- 6. METODE PEMBAYARAN --}}
    <div class="section-header">
        <div class="section-title"><span class="section-num">6</span> Metode Pembayaran</div>
        <div class="section-line"></div>
    </div>
    <div class="card">
        <div class="card-head">💳 Metode yang Digunakan</div>
        <div class="card-body">
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;">
                <div class="method-badge">
                    <span>{{ $methodIcons[$method] ?? '💳' }}</span>
                    {{ $methodLabels[$method] ?? ($method ? ucfirst(str_replace('_',' ',$method)) : '—') }}
                </div>
                <div style="text-align:right;">
                    <div style="font-size:.78rem;color:var(--s500);font-weight:600;margin-bottom:4px;">Jumlah Termin Pertama</div>
                    <div style="font-size:1.2rem;font-weight:900;color:var(--g700);font-family:'DM Mono',monospace;">Rp {{ number_format($instAmt,0,',','.') }}</div>
                </div>
            </div>
            <div style="margin-top:14px;padding:12px 16px;border-radius:11px;background:var(--g50);border:2px solid var(--g100);font-size:.82rem;color:#065f46;display:flex;align-items:center;gap:8px;">
                🔒 <span>Data terenkripsi · Diverifikasi KLH · Sertifikat diterbitkan pasca-lunas</span>
            </div>
        </div>
    </div>

    {{-- ACTION BUTTONS --}}
    <div class="action-row">
        <a href="{{ route('calc.corporate.export-pdf', $calc->id) }}" class="btn-act g">⬇ Download PDF</a>
        <a href="{{ route('calc.corporate.monitoring', $calc->id) }}" class="btn-act g">📊 Monitoring</a>
        <a href="{{ route('calc.corporate.create') }}" class="btn-act s">🔄 Hitung Ulang</a>
        <a href="{{ route('calc.corporate.history') }}" class="btn-act s">📋 Riwayat</a>
    </div>

    <div class="powered-bar">
        <span>Powered by</span>
        <img src="/images/nullicarbon.png" alt="NulliCarbon" class="powered-logo">
    </div>

</div>
</div>
@endsection