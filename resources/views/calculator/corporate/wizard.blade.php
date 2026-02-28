@extends('layouts.app')

@section('content')
<style>
/* ===== ORIGINAL COLOR SCHEME (preserved) ===== */
.wizard-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    padding: 40px 20px;
    margin-top: 80px;
}

.wizard-card {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,.1);
    overflow: hidden;
}

.wizard-header {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 40px;
    text-align: center;
}

.wizard-title { font-size: 2rem; font-weight: 800; margin-bottom: 10px; }
.wizard-subtitle { font-size: 1rem; opacity: 0.9; }

.audit-notice {
    display: flex; align-items: flex-start; gap: 14px;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.3);
    border-radius: 12px; padding: 14px 18px; margin-top: 20px; text-align: left;
}
.audit-notice .icon { font-size: 1.3rem; flex-shrink: 0; margin-top: 2px; }
.audit-notice p { font-size: 0.85rem; opacity: .92; line-height: 1.6; margin: 0; }
.audit-notice strong { display: block; margin-bottom: 3px; font-size: .9rem; }

/* PROGRESS */
.wizard-progress {
    display: flex; justify-content: space-between;
    padding: 30px 40px;
    background: #f8fafc; border-bottom: 2px solid #e2e8f0;
}
.progress-step { flex: 1; text-align: center; position: relative; }
.progress-step:not(:last-child)::after {
    content: ''; position: absolute;
    top: 20px; left: 60%; width: 80%; height: 2px;
    background: #e2e8f0; z-index: 0;
}
.progress-step.active:not(:last-child)::after,
.progress-step.completed:not(:last-child)::after { background: #10b981; }
.step-number {
    width: 40px; height: 40px; border-radius: 50%;
    background: #e2e8f0; color: #64748b;
    display: inline-flex; align-items: center; justify-content: center;
    font-weight: 700; margin-bottom: 8px; position: relative; z-index: 1; transition: all .3s;
}
.progress-step.active .step-number   { background: #10b981; color: white; }
.progress-step.completed .step-number{ background: #059669; color: white; }
.step-label { font-size: 0.85rem; color: #64748b; font-weight: 600; }
.progress-step.active .step-label { color: #10b981; }

/* BODY */
.wizard-body { padding: 40px; }
.wizard-step { display: none; }
.wizard-step.active { display: block; animation: fadeIn .3s ease; }
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
.step-title { font-size: 1.8rem; font-weight: 700; color: #064e3b; margin-bottom: 10px; }
.step-description { color: #64748b; margin-bottom: 30px; }
.form-group { margin-bottom: 25px; }
.form-label { display: block; font-weight: 600; color: #1e293b; margin-bottom: 8px; }
.form-label .required { color: #ef4444; }
.form-control {
    width: 100%; padding: 12px 16px;
    border: 2px solid #e2e8f0; border-radius: 10px;
    font-size: 1rem; transition: all .3s ease; background: white;
    font-family: inherit;
}
.form-control:focus { outline: none; border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,.1); }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
@media(max-width: 640px) { .form-row { grid-template-columns: 1fr; } }
.form-help { font-size: 0.85rem; color: #64748b; margin-top: 5px; }

.alert-info {
    display: flex; gap: 10px; align-items: flex-start;
    background: #dbeafe; border: 2px solid #3b82f6; color: #1e40af;
    padding: 14px 18px; border-radius: 10px; margin-bottom: 20px;
    font-size: .88rem; line-height: 1.6;
}

/* ═══════════════════════════════════════
   DAMAGE LEVEL SELECTOR
═══════════════════════════════════════ */
.damage-intro {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border: 2px solid #bbf7d0; border-radius: 16px;
    padding: 22px 24px; margin-bottom: 28px; text-align: center;
}
.damage-intro h3 { color: #064e3b; font-size: 1.05rem; font-weight: 700; margin-bottom: 6px; }
.damage-intro p  { color: #64748b; font-size: .87rem; line-height: 1.6; }

.damage-pillars {
    display: grid; grid-template-columns: repeat(3,1fr); gap: 18px; margin-bottom: 28px;
}
@media(max-width: 640px) { .damage-pillars { grid-template-columns: 1fr; } }

.pillar-card {
    border: 2px solid #e2e8f0; border-radius: 18px;
    padding: 22px 18px; background: #fafafa;
    transition: all .25s; position: relative; overflow: hidden;
}
.pillar-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px;
    background: #e2e8f0; transition: background .3s;
}
.pillar-card.land  { border-color: #bbf7d0; background: #f0fdf4; }
.pillar-card.land::before  { background: linear-gradient(90deg,#10b981,#059669); }
.pillar-card.air   { border-color: #bfdbfe; background: #eff6ff; }
.pillar-card.air::before   { background: linear-gradient(90deg,#3b82f6,#0ea5e9); }
.pillar-card.water { border-color: #ddd6fe; background: #f5f3ff; }
.pillar-card.water::before { background: linear-gradient(90deg,#8b5cf6,#6366f1); }

.pillar-icon { font-size: 2rem; margin-bottom: 8px; display: block; }
.pillar-name { font-size: .95rem; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
.pillar-sub  { font-size: .75rem; color: #64748b; margin-bottom: 16px; line-height: 1.5; }

/* LEVEL OPTIONS */
.level-label {
    font-size: .72rem; font-weight: 700; color: #475569;
    text-transform: uppercase; letter-spacing: .06em;
    margin-bottom: 8px; display: block;
}
.level-options { display: flex; flex-direction: column; gap: 5px; }

.level-opt {
    display: flex; align-items: center; gap: 9px;
    padding: 9px 11px; border: 1.5px solid #e2e8f0; border-radius: 10px;
    cursor: pointer; transition: all .2s; background: white; user-select: none;
}
.level-opt:hover { border-color: #10b981; background: #f0fdf4; }
.level-opt input[type=radio] { display: none; }

/* Selected states */
.level-opt.selected.lvl-none   { border-color: #cbd5e1; background: #f8fafc; }
.level-opt.selected.lvl-low    { border-color: #6ee7b7; background: #ecfdf5; }
.level-opt.selected.lvl-medium { border-color: #fcd34d; background: #fffbeb; }
.level-opt.selected.lvl-high   { border-color: #fca5a5; background: #fef2f2; }

.level-dot {
    width: 9px; height: 9px; border-radius: 50%;
    border: 2px solid #cbd5e1; flex-shrink: 0; transition: all .2s;
}
.level-opt.selected.lvl-none   .level-dot { background: #94a3b8; border-color: transparent; }
.level-opt.selected.lvl-low    .level-dot { background: #10b981; border-color: transparent; }
.level-opt.selected.lvl-medium .level-dot { background: #f59e0b; border-color: transparent; }
.level-opt.selected.lvl-high   .level-dot { background: #ef4444; border-color: transparent; }

.level-text { flex: 1; min-width: 0; }
.level-name { font-size: .8rem; font-weight: 600; color: #1e293b; }
.level-desc { font-size: .68rem; color: #64748b; line-height: 1.4; }

.level-tag {
    font-size: .65rem; font-weight: 700; padding: 2px 7px;
    border-radius: 100px; flex-shrink: 0; white-space: nowrap;
}
.tag-none   { background: #f1f5f9; color: #64748b; }
.tag-low    { background: #d1fae5; color: #065f46; }
.tag-medium { background: #fef3c7; color: #92400e; }
.tag-high   { background: #fee2e2; color: #991b1b; }

/* LIVE SUMMARY */
.damage-summary-box {
    background: #f0fdf4; border: 2px solid #bbf7d0;
    border-radius: 12px; padding: 16px 20px;
}
.damage-summary-title {
    font-size: .78rem; font-weight: 700; color: #065f46;
    text-transform: uppercase; letter-spacing: .06em; margin-bottom: 10px;
}
.damage-summary { display: flex; flex-wrap: wrap; gap: 8px; }
.dmg-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 12px; border-radius: 100px;
    font-size: .78rem; font-weight: 600;
    border: 1.5px solid #e2e8f0; background: #f8fafc; color: #475569;
    transition: all .25s;
}
.dmg-pill.active-low    { background: #d1fae5; border-color: #6ee7b7; color: #065f46; }
.dmg-pill.active-medium { background: #fef3c7; border-color: #fcd34d; color: #92400e; }
.dmg-pill.active-high   { background: #fee2e2; border-color: #fca5a5; color: #991b1b; }

/* PAYMENT */
.payment-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 14px; margin-top: 10px; }
@media(max-width: 640px) { .payment-grid { grid-template-columns: 1fr; } }

.pay-card {
    border: 2px solid #e2e8f0; border-radius: 14px;
    padding: 18px; cursor: pointer; transition: all .25s;
    background: #fafafa; position: relative;
}
.pay-card:hover { border-color: #10b981; background: #f0fdf4; }
.pay-card.selected { border-color: #10b981; background: #f0fdf4; box-shadow: 0 4px 12px rgba(16,185,129,.15); }
.pay-check {
    display: none; position: absolute; top: 12px; right: 12px;
    width: 20px; height: 20px; background: #10b981; border-radius: 50%;
    color: white; font-size: .65rem; font-weight: 900;
    align-items: center; justify-content: center;
}
.pay-card.selected .pay-check { display: flex; }
.pay-card input[type=radio] { display: none; }
.pay-card-icon  { font-size: 1.4rem; margin-bottom: 8px; display: block; }
.pay-card-title { font-size: .9rem; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
.pay-card-desc  { font-size: .78rem; color: #64748b; line-height: 1.5; }

/* ALLOC GRID */
.alloc-grid {
    display: grid; grid-template-columns: repeat(4,1fr); gap: 12px; margin-top: 16px;
}
@media(max-width: 640px) { .alloc-grid { grid-template-columns: repeat(2,1fr); } }
.alloc-item {
    background: white; border-radius: 12px; padding: 14px; text-align: center;
    border: 2px solid #e2e8f0;
}
.alloc-icon { font-size: 1.3rem; margin-bottom: 6px; }
.alloc-label { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 4px; }
.alloc-pct   { font-size: 1.3rem; font-weight: 800; margin-bottom: 2px; }
.alloc-desc  { font-size: .68rem; color: #64748b; }

/* SCOPE BOX */
.scope-box { background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 16px; padding: 20px; margin-top: 16px; }
.scope-box-title { font-size: .88rem; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
.scope-box-sub   { font-size: .82rem; color: #64748b; line-height: 1.6; }

/* REVIEW */
.review-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
@media(max-width: 640px) { .review-grid { grid-template-columns: 1fr; } }
.review-block { background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 14px; padding: 18px; }
.review-block h4 {
    font-size: .8rem; font-weight: 700; color: #10b981;
    text-transform: uppercase; letter-spacing: .08em;
    margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;
}
.review-row { display: flex; justify-content: space-between; gap: 10px; margin-bottom: 7px; align-items: flex-start; }
.review-row:last-child { margin-bottom: 0; }
.rk { font-size: .8rem; color: #64748b; }
.rv { font-size: .82rem; color: #1e293b; font-weight: 500; text-align: right; }

/* FOOTER */
.wizard-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding: 30px 40px; background: #f8fafc; border-top: 2px solid #e2e8f0;
}
.btn { padding: 14px 32px; border-radius: 10px; font-weight: 600; font-size: 1rem; border: none; cursor: pointer; transition: all .3s ease; display: inline-flex; align-items: center; gap: 10px; }
.btn-primary { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(16,185,129,.3); }
.btn-secondary { background: white; color: #64748b; border: 2px solid #e2e8f0; }
.btn-secondary:hover { background: #f8fafc; border-color: #cbd5e1; }
.step-counter { font-size: .82rem; color: #94a3b8; font-weight: 500; }
.step-counter b { color: #10b981; }

.err-alert { background: #fee2e2; border: 2px solid #ef4444; color: #991b1b; padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: .88rem; }

@media(max-width: 768px) {
    .wizard-progress { padding: 20px; }
    .step-label { font-size: .72rem; }
    .wizard-body { padding: 28px 20px; }
    .wizard-footer { flex-direction: column; gap: 12px; padding: 20px; }
    .btn { width: 100%; justify-content: center; }
    .step-counter { order: -1; }
}
</style>

<div class="wizard-container">
<div class="wizard-card">

    <!-- HEADER -->
    <div class="wizard-header">
        <h1 class="wizard-title">🌍 Kalkulator Emisi Karbon Korporat</h1>
        <p class="wizard-subtitle">Hitung jejak karbon perusahaan Anda berdasarkan GHG Protocol</p>
        <div class="audit-notice">
            <div class="icon">🏛️</div>
            <p><strong>Diverifikasi Tim Auditor Kementerian Lingkungan Hidup</strong>
            Data yang Anda masukkan akan diaudit secara resmi. Pastikan semua informasi akurat dan dapat dipertanggungjawabkan sesuai peraturan yang berlaku.</p>
        </div>
    </div>

    <!-- PROGRESS -->
    <div class="wizard-progress">
        <div class="progress-step active" data-step="1">
            <div class="step-number">1</div>
            <div class="step-label">Profil Korporat</div>
        </div>
        <div class="progress-step" data-step="2">
            <div class="step-number">2</div>
            <div class="step-label">Dampak Lingkungan</div>
        </div>
        <div class="progress-step" data-step="3">
            <div class="step-number">3</div>
            <div class="step-label">Skema Pembayaran</div>
        </div>
        <div class="progress-step" data-step="4">
            <div class="step-number">4</div>
            <div class="step-label">Review</div>
        </div>
    </div>

    <form id="calcForm" method="POST" action="{{ route('calc.corporate.calculate') }}">
    @csrf

    <div class="wizard-body">

        @if($errors->any() || session('error'))
        <div class="err-alert">
            ⚠️
            @if(session('error')){{ session('error') }}@endif
            @if($errors->has('emission')){{ $errors->first('emission') }}@endif
        </div>
        @endif

        <!-- ─── STEP 1 ─── -->
        <div class="wizard-step active" data-step="1">
            <h2 class="step-title">Profil Korporat</h2>
            <p class="step-description">Informasi identitas dan legalitas perusahaan Anda</p>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Perusahaan <span class="required">*</span></label>
                    <input type="text" name="company_name" class="form-control" required placeholder="PT. Contoh Indonesia" value="{{ old('company_name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">No. SIUP / NIB <span class="required">*</span></label>
                    <input type="text" name="company_siup" class="form-control" required placeholder="0123456789101112" value="{{ old('company_siup') }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Email Perusahaan <span class="required">*</span></label>
                    <input type="email" name="company_email" class="form-control" required placeholder="info@perusahaan.com" value="{{ old('company_email') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">No. Telepon</label>
                    <input type="tel" name="company_phone" class="form-control" placeholder="+62 21 1234 5678" value="{{ old('company_phone') }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kategori Usaha <span class="required">*</span></label>
                    <select name="industry_type" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <optgroup label="Pabrik & Industri">
                            <option value="manufacturing">Manufaktur</option>
                            <option value="chemical">Industri Kimia</option>
                            <option value="mining">Pertambangan</option>
                            <option value="cement">Semen & Material</option>
                            <option value="pulp">Pulp & Kertas</option>
                            <option value="palm_oil">Pabrik Kelapa Sawit</option>
                            <option value="steel">Baja & Logam</option>
                        </optgroup>
                        <optgroup label="Lainnya">
                            <option value="construction">Konstruksi</option>
                            <option value="transportation">Transportasi & Logistik</option>
                            <option value="energy">Energi & Utilitas</option>
                            <option value="agriculture">Pertanian & Perkebunan</option>
                            <option value="service">Jasa & Layanan</option>
                            <option value="technology">Teknologi</option>
                            <option value="other">Lainnya</option>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Afiliasi / Grup Korporasi</label>
                    <input type="text" name="company_affiliate" class="form-control" placeholder="Misal: Astra Group" value="{{ old('company_affiliate') }}">
                    <small class="form-help">Kosongkan jika perusahaan independen</small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Jumlah Fasilitas / Pabrik <span class="required">*</span></label>
                    <input type="number" name="facility_count" class="form-control" required placeholder="1" min="1" value="{{ old('facility_count', 1) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi Operasional Utama <span class="required">*</span></label>
                    <input type="text" name="company_location" class="form-control" required placeholder="Kota, Provinsi" value="{{ old('company_location') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Tahun Perhitungan <span class="required">*</span></label>
                <select name="calculation_year" class="form-control" required style="max-width:220px;">
                    <option value="">Pilih Tahun</option>
                    @for($year = date('Y') + 1; $year >= 2020; $year--)
                        <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- ─── STEP 2 ─── -->
        <div class="wizard-step" data-step="2">
            <h2 class="step-title">Dampak Lingkungan</h2>
            <p class="step-description">Pilih tingkat kerusakan yang telah ditimbulkan operasional perusahaan Anda</p>

            <div class="damage-intro">
                <h3>📋 Cara Pengisian</h3>
                <p>Pilih satu tingkat kerusakan untuk setiap elemen — <strong>Tanah, Udara, dan Air</strong>. Tim auditor KLH akan memverifikasi dan menghitung nilai kompensasi berdasarkan pilihan Anda.</p>
            </div>

            <div class="damage-pillars">

                <!-- TANAH -->
                <div class="pillar-card land">
                    <span class="pillar-icon">🏔️</span>
                    <div class="pillar-name">Kerusakan Tanah</div>
                    <div class="pillar-sub">Degradasi lahan, deforestasi, pencemaran tanah, alih fungsi lahan</div>
                    <span class="level-label">Tingkat Dampak</span>
                    <div class="level-options">
                        <label class="level-opt lvl-none selected" data-pillar="land" data-level="none">
                            <input type="radio" name="damage[land]" value="none" checked>
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Tidak Ada</div><div class="level-desc">Tidak ada dampak terhadap tanah</div></div>
                            <span class="level-tag tag-none">—</span>
                        </label>
                        <label class="level-opt lvl-low" data-pillar="land" data-level="low">
                            <input type="radio" name="damage[land]" value="low">
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Ringan</div><div class="level-desc">Dampak terbatas, area &lt; 1 ha</div></div>
                            <span class="level-tag tag-low">Ringan</span>
                        </label>
                        <label class="level-opt lvl-medium" data-pillar="land" data-level="medium">
                            <input type="radio" name="damage[land]" value="medium">
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Sedang</div><div class="level-desc">Pencemaran nyata, 1–10 ha</div></div>
                            <span class="level-tag tag-medium">Sedang</span>
                        </label>
                        <label class="level-opt lvl-high" data-pillar="land" data-level="high">
                            <input type="radio" name="damage[land]" value="high">
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Berat</div><div class="level-desc">Deforestasi / degradasi besar &gt; 10 ha</div></div>
                            <span class="level-tag tag-high">Berat</span>
                        </label>
                    </div>
                </div>

                <!-- UDARA -->
                <div class="pillar-card air">
                    <span class="pillar-icon">💨</span>
                    <div class="pillar-name">Pencemaran Udara</div>
                    <div class="pillar-sub">Emisi GRK, partikulat, SOx, NOx dari cerobong dan operasi pabrik</div>
                    <span class="level-label">Tingkat Dampak</span>
                    <div class="level-options">
                        <label class="level-opt lvl-none selected" data-pillar="air" data-level="none">
                            <input type="radio" name="damage[air]" value="none" checked>
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Tidak Ada</div><div class="level-desc">Tidak ada emisi signifikan</div></div>
                            <span class="level-tag tag-none">—</span>
                        </label>
                        <label class="level-opt lvl-low" data-pillar="air" data-level="low">
                            <input type="radio" name="damage[air]" value="low">
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Ringan</div><div class="level-desc">Emisi di bawah ambang baku mutu</div></div>
                            <span class="level-tag tag-low">Ringan</span>
                        </label>
                        <label class="level-opt lvl-medium" data-pillar="air" data-level="medium">
                            <input type="radio" name="damage[air]" value="medium">
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Sedang</div><div class="level-desc">Melebihi baku mutu, dampak lokal</div></div>
                            <span class="level-tag tag-medium">Sedang</span>
                        </label>
                        <label class="level-opt lvl-high" data-pillar="air" data-level="high">
                            <input type="radio" name="damage[air]" value="high">
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Berat</div><div class="level-desc">Emisi masif, dampak regional</div></div>
                            <span class="level-tag tag-high">Berat</span>
                        </label>
                    </div>
                </div>

                <!-- AIR -->
                <div class="pillar-card water">
                    <span class="pillar-icon">💧</span>
                    <div class="pillar-name">Pencemaran Air</div>
                    <div class="pillar-sub">Limbah cair industri, kontaminasi sungai, laut, dan air tanah</div>
                    <span class="level-label">Tingkat Dampak</span>
                    <div class="level-options">
                        <label class="level-opt lvl-none selected" data-pillar="water" data-level="none">
                            <input type="radio" name="damage[water]" value="none" checked>
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Tidak Ada</div><div class="level-desc">Tidak ada pencemaran air</div></div>
                            <span class="level-tag tag-none">—</span>
                        </label>
                        <label class="level-opt lvl-low" data-pillar="water" data-level="low">
                            <input type="radio" name="damage[water]" value="low">
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Ringan</div><div class="level-desc">Limbah cair memenuhi baku mutu</div></div>
                            <span class="level-tag tag-low">Ringan</span>
                        </label>
                        <label class="level-opt lvl-medium" data-pillar="water" data-level="medium">
                            <input type="radio" name="damage[water]" value="medium">
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Sedang</div><div class="level-desc">Melampaui baku mutu, badan air lokal</div></div>
                            <span class="level-tag tag-medium">Sedang</span>
                        </label>
                        <label class="level-opt lvl-high" data-pillar="water" data-level="high">
                            <input type="radio" name="damage[water]" value="high">
                            <div class="level-dot"></div>
                            <div class="level-text"><div class="level-name">Berat</div><div class="level-desc">Pencemaran sungai / laut skala besar</div></div>
                            <span class="level-tag tag-high">Berat</span>
                        </label>
                    </div>
                </div>

            </div><!-- /.damage-pillars -->

            <div class="form-group">
                <label class="form-label">Keterangan Tambahan <small style="font-weight:400;color:#64748b;">(opsional)</small></label>
                <textarea name="damage_description" class="form-control" rows="3" placeholder="Deskripsikan secara singkat kondisi dampak lingkungan yang ada..."></textarea>
            </div>

            <div class="damage-summary-box">
                <div class="damage-summary-title">📊 Ringkasan Dampak Terpilih</div>
                <div class="damage-summary">
                    <span class="dmg-pill" id="pill-land">🏔️ Tanah: —</span>
                    <span class="dmg-pill" id="pill-air">💨 Udara: —</span>
                    <span class="dmg-pill" id="pill-water">💧 Air: —</span>
                </div>
            </div>
        </div>

        <!-- ─── STEP 3 ─── -->
        <div class="wizard-step" data-step="3">
            <h2 class="step-title">Skema Pembayaran Kompensasi</h2>
            <p class="step-description">Tentukan cara pembayaran dana kompensasi lingkungan yang paling sesuai</p>

            <div class="alert-info">
                ℹ️ <span>Kompensasi dibayar secara bertahap. Pembayaran pertama untuk program restorasi awal. Pembayaran selanjutnya digunakan untuk <strong>biaya maintenance & monitoring</strong> program yang berjalan.</span>
            </div>

            <div class="form-group">
                <label class="form-label">Pilih Skema Pembayaran <span class="required">*</span></label>
                <div class="payment-grid">
                    <label class="pay-card selected" id="pay-annual">
                        <input type="radio" name="payment_scheme" value="annual" checked>
                        <div class="pay-check">✓</div>
                        <span class="pay-card-icon">🗓️</span>
                        <div class="pay-card-title">Tahunan</div>
                        <div class="pay-card-desc">Bayar 1× setahun berdasarkan emisi aktual yang diverifikasi auditor</div>
                    </label>
                    <label class="pay-card" id="pay-semi">
                        <input type="radio" name="payment_scheme" value="semi_annual">
                        <div class="pay-check">✓</div>
                        <span class="pay-card-icon">📆</span>
                        <div class="pay-card-title">Semesteran</div>
                        <div class="pay-card-desc">Bayar 2× setahun — lebih fleksibel untuk arus kas perusahaan</div>
                    </label>
                    <label class="pay-card" id="pay-quarterly">
                        <input type="radio" name="payment_scheme" value="quarterly">
                        <div class="pay-check">✓</div>
                        <span class="pay-card-icon">📅</span>
                        <div class="pay-card-title">Kuartalan</div>
                        <div class="pay-card-desc">Bayar 4× setahun — distribusi beban finansial merata</div>
                    </label>
                </div>
            </div>

            <div class="scope-box">
                <div class="scope-box-title">💰 Alokasi Dana Kompensasi</div>
                <div class="scope-box-sub" style="margin-bottom:14px;">Setiap pembayaran dialokasikan ke program restorasi dan maintenance sesuai ketentuan KLH</div>
                <div class="alloc-grid">
                    <div class="alloc-item" style="border-color:#d1fae5;">
                        <div class="alloc-icon">🌱</div>
                        <div class="alloc-label" style="color:#065f46;">Reforestasi</div>
                        <div class="alloc-pct" style="color:#10b981;">40%</div>
                        <div class="alloc-desc">Penanaman pohon & lahan kritis</div>
                    </div>
                    <div class="alloc-item" style="border-color:#bfdbfe;">
                        <div class="alloc-icon">🔬</div>
                        <div class="alloc-label" style="color:#1e40af;">Monitoring</div>
                        <div class="alloc-pct" style="color:#3b82f6;">25%</div>
                        <div class="alloc-desc">Stasiun pemantau udara & air</div>
                    </div>
                    <div class="alloc-item" style="border-color:#ddd6fe;">
                        <div class="alloc-icon">💧</div>
                        <div class="alloc-label" style="color:#5b21b6;">Restorasi Air</div>
                        <div class="alloc-pct" style="color:#8b5cf6;">25%</div>
                        <div class="alloc-desc">Rehabilitasi sungai & pesisir</div>
                    </div>
                    <div class="alloc-item" style="border-color:#fef3c7;">
                        <div class="alloc-icon">⚙️</div>
                        <div class="alloc-label" style="color:#92400e;">Maintenance</div>
                        <div class="alloc-pct" style="color:#f59e0b;">10%</div>
                        <div class="alloc-desc">Operasional program berjalan</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── STEP 4 ─── -->
        <div class="wizard-step" data-step="4">
            <h2 class="step-title">Review & Konfirmasi</h2>
            <p class="step-description">Periksa kembali seluruh data sebelum dikirimkan</p>
            <div class="alert-info" style="margin-bottom:24px;">
                🔒 <span>Data Anda diproses secara aman dan hanya dapat diakses oleh tim auditor yang berwenang dari Kementerian Lingkungan Hidup.</span>
            </div>
            <div id="reviewContent"><!-- JS populated --></div>
        </div>

    </div><!-- /.wizard-body -->

    <!-- FOOTER -->
    <div class="wizard-footer">
        <button type="button" class="btn btn-secondary" id="prevBtn" style="display:none;">← Kembali</button>
        <div class="step-counter">Langkah <b id="stepNum">1</b> dari 4</div>
        <button type="button" class="btn btn-primary" id="nextBtn">Selanjutnya →</button>
    </div>

    </form>
</div>
</div>

<script>
let cur = 1;
const total = 4;

const lvlLabel  = { none:'—', low:'Ringan', medium:'Sedang', high:'Berat' };
const pillClass = { none:'', low:'active-low', medium:'active-medium', high:'active-high' };
const payLabel  = { annual:'🗓️ Tahunan', semi_annual:'📆 Semesteran', quarterly:'📅 Kuartalan' };

document.addEventListener('DOMContentLoaded', () => {
    updateUI();

    // Level option clicks
    document.querySelectorAll('.level-opt').forEach(opt => {
        opt.addEventListener('click', () => {
            const pillar = opt.dataset.pillar;
            const level  = opt.dataset.level;

            document.querySelectorAll(`.level-opt[data-pillar="${pillar}"]`).forEach(o => o.classList.remove('selected'));
            opt.classList.add('selected');
            opt.querySelector('input[type=radio]').checked = true;

            // Update pill
            const pill = document.getElementById(`pill-${pillar}`);
            const icons = { land:'🏔️', air:'💨', water:'💧' };
            const names = { land:'Tanah', air:'Udara', water:'Air' };
            pill.className = 'dmg-pill ' + pillClass[level];
            pill.textContent = `${icons[pillar]} ${names[pillar]}: ${lvlLabel[level]}`;
        });
    });

    // Payment card clicks
    document.querySelectorAll('.pay-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('.pay-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            card.querySelector('input[type=radio]').checked = true;
        });
    });
});

document.getElementById('nextBtn').addEventListener('click', () => {
    if (cur < total) {
        if (!validateStep(cur)) return;
        if (cur === 3) populateReview();
        cur++;
        showStep(cur);
    } else {
        document.getElementById('calcForm').submit();
    }
});

document.getElementById('prevBtn').addEventListener('click', () => {
    if (cur > 1) { cur--; showStep(cur); }
});

function showStep(n) {
    document.querySelectorAll('.wizard-step').forEach(el => el.classList.remove('active'));
    document.querySelector(`.wizard-step[data-step="${n}"]`).classList.add('active');
    document.querySelectorAll('.progress-step').forEach((el, i) => {
        el.classList.remove('active','completed');
        if (i + 1 < n) el.classList.add('completed');
        else if (i + 1 === n) el.classList.add('active');
    });
    updateUI();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function updateUI() {
    document.getElementById('stepNum').textContent = cur;
    document.getElementById('prevBtn').style.display = cur === 1 ? 'none' : 'inline-flex';
    document.getElementById('nextBtn').textContent = cur === total ? '🌿 Kirim & Hitung Kompensasi' : 'Selanjutnya →';
}

function validateStep(n) {
    const el = document.querySelector(`.wizard-step[data-step="${n}"]`);
    for (let f of el.querySelectorAll('[required]')) {
        if (!f.value) {
            f.focus();
            f.style.borderColor = '#ef4444';
            setTimeout(() => f.style.borderColor = '', 2000);
            return false;
        }
    }
    return true;
}

function getVal(name) {
    const el = document.querySelector(`[name="${name}"]:checked`) || document.querySelector(`[name="${name}"]`);
    return el ? el.value : '—';
}

function populateReview() {
    const fd = new FormData(document.getElementById('calcForm'));
    const land  = getVal('damage[land]');
    const air   = getVal('damage[air]');
    const water = getVal('damage[water]');
    const pay   = getVal('payment_scheme');

    const badge = (lvl) => {
        const map = { none:'#f1f5f9|#64748b', low:'#d1fae5|#065f46', medium:'#fef3c7|#92400e', high:'#fee2e2|#991b1b' };
        const [bg,c] = (map[lvl] || map.none).split('|');
        return `<span style="background:${bg};color:${c};padding:2px 10px;border-radius:100px;font-size:.72rem;font-weight:700;">${lvlLabel[lvl] || '—'}</span>`;
    };

    document.getElementById('reviewContent').innerHTML = `
    <div class="review-grid">
        <div class="review-block">
            <h4>Profil Korporat</h4>
            <div class="review-row"><span class="rk">Nama</span><span class="rv">${fd.get('company_name')||'—'}</span></div>
            <div class="review-row"><span class="rk">SIUP/NIB</span><span class="rv">${fd.get('company_siup')||'—'}</span></div>
            <div class="review-row"><span class="rk">Email</span><span class="rv">${fd.get('company_email')||'—'}</span></div>
            <div class="review-row"><span class="rk">Kategori</span><span class="rv">${fd.get('industry_type')||'—'}</span></div>
            <div class="review-row"><span class="rk">Afiliasi</span><span class="rv">${fd.get('company_affiliate')||'Independen'}</span></div>
            <div class="review-row"><span class="rk">Fasilitas</span><span class="rv">${fd.get('facility_count')||'—'} lokasi</span></div>
            <div class="review-row"><span class="rk">Lokasi</span><span class="rv">${fd.get('company_location')||'—'}</span></div>
            <div class="review-row"><span class="rk">Tahun</span><span class="rv">${fd.get('calculation_year')||'—'}</span></div>
        </div>
        <div class="review-block">
            <h4>Dampak & Pembayaran</h4>
            <div class="review-row" style="margin-bottom:12px;"><span class="rk">🏔️ Tanah</span><span class="rv">${badge(land)}</span></div>
            <div class="review-row" style="margin-bottom:12px;"><span class="rk">💨 Udara</span><span class="rv">${badge(air)}</span></div>
            <div class="review-row" style="margin-bottom:16px;"><span class="rk">💧 Air</span><span class="rv">${badge(water)}</span></div>
            ${fd.get('damage_description') ? `<div class="review-row"><span class="rk">Keterangan</span><span class="rv" style="max-width:200px;">${fd.get('damage_description')}</span></div>` : ''}
            <div class="review-row" style="margin-top:8px;"><span class="rk">Skema Bayar</span><span class="rv">${payLabel[pay]||pay}</span></div>
        </div>
    </div>`;
}
</script>

@endsection