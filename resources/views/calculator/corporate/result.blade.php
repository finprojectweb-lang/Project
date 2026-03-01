@extends('layouts.app')

@section('title', 'Hasil & Pembayaran Kompensasi - NulliCarbon')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Mono:wght@400;500&display=swap');
* { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
:root {
    --g900: #064e3b; --g700: #047857; --g600: #059669; --g500: #10b981; --g400: #34d399;
    --g100: #d1fae5; --g50: #ecfdf5;
    --s900: #0f172a; --s700: #334155; --s500: #64748b; --s300: #cbd5e1; --s200: #e2e8f0; --s100: #f1f5f9; --s50: #f8fafc;
    --amber: #f59e0b; --red: #ef4444;
}
.page-wrap { min-height:100vh; background:linear-gradient(160deg,#f0fdf4 0%,#dcfce7 45%,#ecfdf5 100%); padding:100px 20px 60px; }
.page-shell { max-width:1160px; margin:0 auto; }

/* ── HERO ── */
.res-hero {
    background: linear-gradient(135deg,#064e3b 0%,#065f46 50%,#047857 100%);
    border-radius:28px; padding:52px 44px; color:white;
    position:relative; overflow:hidden; margin-bottom:28px;
    box-shadow:0 24px 64px rgba(6,78,59,.35);
}
.res-hero::before { content:''; position:absolute; top:-80px; right:-80px; width:320px; height:320px; border-radius:50%; background:radial-gradient(circle,rgba(52,211,153,.18) 0%,transparent 70%); }
.res-hero::after  { content:''; position:absolute; bottom:-60px; left:60px; width:220px; height:220px; border-radius:50%; background:radial-gradient(circle,rgba(16,185,129,.12) 0%,transparent 70%); }
.hero-top { display:flex; align-items:flex-start; justify-content:space-between; gap:20px; flex-wrap:wrap; position:relative; z-index:1; }
.hero-icon { width:72px; height:72px; border-radius:20px; background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2); display:flex; align-items:center; justify-content:center; font-size:2rem; margin-bottom:20px; }
.hero-title { font-size:2.1rem; font-weight:900; line-height:1.15; margin-bottom:8px; letter-spacing:-.02em; }
.hero-company { font-size:1rem; opacity:.85; font-weight:500; margin-bottom:6px; }
.hero-meta { display:flex; flex-wrap:wrap; gap:8px; margin-top:14px; }
.hero-pill { display:inline-flex; align-items:center; gap:5px; padding:5px 13px; background:rgba(255,255,255,.13); border:1px solid rgba(255,255,255,.22); border-radius:100px; font-size:.76rem; font-weight:600; }
.hero-status { text-align:right; }
.hero-status-label { font-size:.72rem; opacity:.7; text-transform:uppercase; letter-spacing:.08em; margin-bottom:6px; }
.hero-total { font-size:3rem; font-weight:900; line-height:1; letter-spacing:-.03em; }
.hero-total-sub { font-size:.85rem; opacity:.75; font-weight:500; margin-top:4px; }

/* ── DAMAGE BREAKDOWN ── */
.dmg-breakdown {
    display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:24px;
}
@media(max-width:640px) { .dmg-breakdown { grid-template-columns:1fr; } }
.dmg-card {
    border-radius:20px; padding:24px 22px; border:2px solid;
    position:relative; overflow:hidden;
}
.dmg-card.land  { border-color:#bbf7d0; background:linear-gradient(145deg,#f0fdf4,#ecfdf5); }
.dmg-card.air   { border-color:#bfdbfe; background:linear-gradient(145deg,#eff6ff,#f0f9ff); }
.dmg-card.water { border-color:#ddd6fe; background:linear-gradient(145deg,#f5f3ff,#ede9fe); }
.dmg-card-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; }
.dmg-card-icon-wrap { display:flex; align-items:center; gap:10px; }
.dmg-card-icon { font-size:1.8rem; }
.dmg-card-name { font-size:.88rem; font-weight:800; color:var(--s900); }
.dmg-card-sub  { font-size:.7rem; color:var(--s500); margin-top:1px; }
.dmg-level-badge { display:inline-block; padding:4px 12px; border-radius:100px; font-size:.75rem; font-weight:800; }
.lvl-none   { background:#f1f5f9; color:#64748b; }
.lvl-low    { background:#d1fae5; color:#065f46; }
.lvl-medium { background:#fef3c7; color:#92400e; }
.lvl-high   { background:#fee2e2; color:#991b1b; }
.dmg-card-amount {
    font-size:1.5rem; font-weight:900; letter-spacing:-.02em;
    font-family:'DM Mono',monospace;
}
.dmg-card.land  .dmg-card-amount { color:#059669; }
.dmg-card.air   .dmg-card-amount { color:#2563eb; }
.dmg-card.water .dmg-card-amount { color:#7c3aed; }
.dmg-card-amount-zero { color:#94a3b8 !important; font-size:1.1rem !important; }
.dmg-card-label { font-size:.7rem; color:var(--s500); margin-top:3px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; }

/* ── TOTAL BAR ── */
.total-bar {
    background:white; border:2px solid var(--g100); border-radius:22px;
    padding:28px 36px; margin-bottom:24px;
    display:grid; grid-template-columns:1fr auto 1fr; align-items:center; gap:28px;
    box-shadow:0 8px 32px rgba(0,0,0,.06);
}
@media(max-width:700px) { .total-bar { grid-template-columns:1fr; text-align:center; } .total-divider { display:none; } }
.total-label { font-size:.75rem; font-weight:700; color:var(--s500); text-transform:uppercase; letter-spacing:.08em; margin-bottom:6px; }
.total-val   { font-size:2.4rem; font-weight:900; color:var(--g500); letter-spacing:-.03em; line-height:1; }
.total-sub   { font-size:.82rem; color:var(--s500); margin-top:5px; }
.total-divider { width:2px; height:72px; background:linear-gradient(180deg,transparent,var(--s300),transparent); }
.total-scheme-badge { display:inline-flex; align-items:center; gap:7px; padding:8px 16px; border-radius:12px; background:var(--g50); border:2px solid var(--g100); font-size:.82rem; font-weight:700; color:var(--g700); margin-bottom:10px; }
.total-inst { font-size:1.5rem; font-weight:800; color:var(--s900); margin-bottom:3px; letter-spacing:-.02em; }
.total-inst-sub { font-size:.82rem; color:var(--s500); }

/* ── RECO ── */
.reco-panel { background:linear-gradient(135deg,#fffbeb,#fef3c7); border:2px solid #fcd34d; border-radius:22px; padding:28px 32px; margin-bottom:28px; }
.reco-title { font-size:1rem; font-weight:800; color:#92400e; display:flex; align-items:center; gap:10px; margin-bottom:16px; }
.reco-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
@media(max-width:640px) { .reco-grid { grid-template-columns:1fr; } }
.reco-item { background:white; border-radius:12px; padding:14px 16px; display:flex; gap:10px; align-items:flex-start; border:1px solid #fde68a; }
.reco-num { width:24px; height:24px; border-radius:7px; background:#f59e0b; color:white; font-size:.68rem; font-weight:900; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:1px; }
.reco-text { font-size:.82rem; color:#78350f; line-height:1.6; }

/* ── PAYMENT SECTION HEADER ── */
.pay-section-header {
    display:flex; align-items:center; gap:14px; margin-bottom:24px;
}
.pay-section-line { flex:1; height:2px; background:linear-gradient(90deg,var(--g100),transparent); border-radius:2px; }
.pay-section-title { font-size:1.15rem; font-weight:900; color:var(--g900); white-space:nowrap; display:flex; align-items:center; gap:10px; }
.pay-section-num { width:30px; height:30px; border-radius:9px; background:linear-gradient(135deg,var(--g500),var(--g700)); color:white; font-size:.78rem; font-weight:900; display:inline-flex; align-items:center; justify-content:center; }

/* ── GRID ── */
.pay-grid { display:grid; grid-template-columns:400px 1fr; gap:24px; align-items:start; }
@media(max-width:980px) { .pay-grid { grid-template-columns:1fr; } }

/* ── LEFT SUMMARY ── */
.summary-panel { position:sticky; top:24px; display:flex; flex-direction:column; gap:16px; }
.panel { background:white; border:2px solid var(--s100); border-radius:22px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.06); }
.panel-head { padding:16px 22px; border-bottom:2px solid var(--s100); font-size:.78rem; font-weight:800; color:var(--s500); text-transform:uppercase; letter-spacing:.08em; display:flex; align-items:center; gap:8px; }
.panel-body { padding:20px 22px; }
.company-block { display:flex; align-items:center; gap:14px; margin-bottom:16px; padding-bottom:16px; border-bottom:2px solid var(--s100); }
.company-avatar { width:50px; height:50px; border-radius:14px; background:linear-gradient(135deg,var(--g500),var(--g700)); display:flex; align-items:center; justify-content:center; font-size:1.3rem; flex-shrink:0; }
.company-name { font-size:.95rem; font-weight:800; color:var(--s900); margin-bottom:3px; }
.company-meta { font-size:.72rem; color:var(--s500); display:flex; flex-wrap:wrap; gap:5px; }
.company-meta-pill { display:inline-flex; align-items:center; gap:3px; background:var(--s100); border-radius:100px; padding:2px 7px; font-size:.68rem; font-weight:600; }
.cost-row { display:flex; justify-content:space-between; align-items:center; padding:8px 0; border-bottom:1px solid var(--s100); font-size:.83rem; }
.cost-row:last-child { border-bottom:none; }
.cost-label { color:var(--s500); font-weight:500; }
.cost-val { color:var(--s900); font-weight:700; font-family:'DM Mono',monospace; font-size:.78rem; }
.cost-total-row { display:flex; justify-content:space-between; align-items:center; padding:14px 18px; border-radius:14px; background:linear-gradient(135deg,var(--g900),var(--g700)); margin-top:14px; }
.cost-total-label { color:rgba(255,255,255,.8); font-size:.82rem; font-weight:600; }
.cost-total-val { color:white; font-size:1.25rem; font-weight:900; font-family:'DM Mono',monospace; letter-spacing:-.02em; }

/* Dmg chips small */
.dmg-row-sm { display:flex; gap:8px; margin-bottom:14px; }
.dmg-chip { flex:1; padding:9px 8px; border-radius:12px; border:2px solid; text-align:center; }
.dmg-chip.land  { border-color:#bbf7d0; background:#f0fdf4; }
.dmg-chip.air   { border-color:#bfdbfe; background:#eff6ff; }
.dmg-chip.water { border-color:#ddd6fe; background:#f5f3ff; }
.dmg-chip-icon { font-size:.9rem; display:block; margin-bottom:2px; }
.dmg-chip-name { font-size:.6rem; font-weight:700; color:var(--s500); text-transform:uppercase; letter-spacing:.04em; margin-bottom:3px; }
.dmg-chip-lv { display:inline-block; padding:2px 6px; border-radius:100px; font-size:.62rem; font-weight:800; }

/* Live alloc bar */
.alloc-bar-label { font-size:.72rem; font-weight:700; color:var(--s500); text-transform:uppercase; letter-spacing:.06em; margin-bottom:8px; }
.alloc-bar-track { height:10px; border-radius:100px; background:var(--s100); overflow:hidden; display:flex; }
.alloc-seg { height:100%; transition:width .5s cubic-bezier(.4,0,.2,1); }
.alloc-legend { display:flex; flex-wrap:wrap; gap:8px; margin-top:10px; }
.alloc-leg { display:flex; align-items:center; gap:5px; font-size:.72rem; color:var(--s700); font-weight:600; }
.alloc-dot { width:9px; height:9px; border-radius:3px; flex-shrink:0; }

/* ── SCHEME SELECTOR ── */
.scheme-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:12px; margin-bottom:6px; }
@media(max-width:480px) { .scheme-grid { grid-template-columns:1fr; } }
.scheme-opt { cursor:pointer; }
.scheme-opt input[type=radio] { position:absolute; opacity:0; pointer-events:none; }
.scheme-card {
    border:2px solid var(--s200); border-radius:16px; padding:18px 14px;
    background:var(--s50); transition:all .22s; text-align:center;
    position:relative;
}
.scheme-card:hover { border-color:var(--g400); background:var(--g50); transform:translateY(-2px); }
.scheme-opt input:checked + .scheme-card { border-color:var(--g500); background:var(--g50); box-shadow:0 4px 16px rgba(16,185,129,.18); }
.scheme-check { display:none; position:absolute; top:10px; right:10px; width:18px; height:18px; background:var(--g500); border-radius:50%; color:white; font-size:.6rem; font-weight:900; align-items:center; justify-content:center; }
.scheme-opt input:checked + .scheme-card .scheme-check { display:flex; }
.scheme-icon { font-size:1.6rem; margin-bottom:8px; display:block; }
.scheme-name { font-size:.88rem; font-weight:800; color:var(--s900); margin-bottom:4px; }
.scheme-freq { font-size:.7rem; color:var(--g600); font-weight:700; background:var(--g50); border:1px solid var(--g100); border-radius:100px; padding:2px 8px; display:inline-block; margin-bottom:6px; }
.scheme-desc { font-size:.72rem; color:var(--s500); line-height:1.5; }
.scheme-per-termin {
    background:linear-gradient(135deg,var(--g900),var(--g700)); color:white;
    border-radius:12px; padding:12px 16px; margin-top:12px; text-align:center;
    display:none;
}
.scheme-per-termin.show { display:block; }
.spt-label { font-size:.72rem; opacity:.75; font-weight:600; text-transform:uppercase; letter-spacing:.06em; margin-bottom:4px; }
.spt-val   { font-size:1.2rem; font-weight:900; font-family:'DM Mono',monospace; }
.spt-sub   { font-size:.7rem; opacity:.7; margin-top:2px; }

/* ── FORM PANEL ── */
.form-panel { background:white; border:2px solid var(--s100); border-radius:22px; padding:32px 34px; box-shadow:0 4px 20px rgba(0,0,0,.06); }
.form-section { margin-bottom:32px; }
.form-section:last-child { margin-bottom:0; }
.fs-title { font-size:1.05rem; font-weight:900; color:var(--s900); margin-bottom:6px; display:flex; align-items:center; gap:9px; }
.fs-num { width:28px; height:28px; border-radius:8px; flex-shrink:0; background:var(--g500); color:white; font-size:.75rem; font-weight:900; display:inline-flex; align-items:center; justify-content:center; }
.fs-sub { font-size:.84rem; color:var(--s500); margin-bottom:18px; line-height:1.6; }
.fs-divider { height:2px; background:var(--s100); border-radius:100px; margin-bottom:22px; }

/* Program cards */
.fixed-maint { display:flex; align-items:center; justify-content:space-between; background:linear-gradient(135deg,#fffbeb,#fef3c7); border:2px solid #fcd34d; border-radius:14px; padding:14px 18px; margin-bottom:18px; }
.fm-left { display:flex; align-items:center; gap:10px; }
.fm-icon { font-size:1.3rem; }
.fm-label { font-size:.86rem; font-weight:700; color:#92400e; margin-bottom:2px; }
.fm-desc  { font-size:.74rem; color:#a16207; }
.fm-pct   { font-size:1.4rem; font-weight:900; color:#d97706; font-family:'DM Mono',monospace; }
.alloc-instruction { font-size:.82rem; color:var(--s500); margin-bottom:16px; background:var(--s50); border-radius:10px; padding:11px 14px; border-left:3px solid var(--g400); line-height:1.6; }
.remain-bar-wrap { margin-bottom:20px; }
.remain-label { display:flex; justify-content:space-between; font-size:.78rem; font-weight:700; margin-bottom:7px; }
.remain-label span { color:var(--s500); }
.remain-pct { color:var(--g600); }
.remain-pct.warn { color:var(--red); }
.remain-track { height:8px; background:var(--s100); border-radius:100px; overflow:hidden; }
.remain-fill  { height:100%; border-radius:100px; background:linear-gradient(90deg,var(--g500),var(--g400)); transition:width .4s ease; }
.program-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:18px; }
@media(max-width:640px) { .program-grid { grid-template-columns:1fr; } }
.prog-option { cursor:pointer; }
.prog-option input[type=checkbox] { position:absolute; opacity:0; pointer-events:none; }
.prog-card { border:2px solid var(--s200); border-radius:16px; padding:16px; background:var(--s50); transition:all .22s; position:relative; user-select:none; }
.prog-card:hover { border-color:var(--g400); background:var(--g50); transform:translateY(-1px); box-shadow:0 4px 14px rgba(16,185,129,.12); }
.prog-option input:checked + .prog-card { border-color:var(--g500); background:var(--g50); box-shadow:0 4px 16px rgba(16,185,129,.18); }
.prog-check { width:20px; height:20px; border-radius:6px; border:2px solid var(--s300); display:flex; align-items:center; justify-content:center; margin-bottom:10px; transition:all .2s; background:white; }
.prog-check svg { width:11px; height:11px; stroke:white; opacity:0; transition:opacity .15s; }
.prog-option input:checked + .prog-card .prog-check { background:var(--g500); border-color:var(--g500); }
.prog-option input:checked + .prog-card .prog-check svg { opacity:1; }
.prog-icon { font-size:1.6rem; margin-bottom:8px; display:block; }
.prog-name { font-size:.88rem; font-weight:800; color:var(--s900); margin-bottom:4px; }
.prog-desc { font-size:.74rem; color:var(--s500); line-height:1.5; margin-bottom:8px; }
.prog-badge { display:inline-block; padding:3px 9px; border-radius:100px; font-size:.66rem; font-weight:700; text-transform:uppercase; letter-spacing:.05em; }
.badge-energy { background:#dbeafe; color:#1e40af; }
.badge-forest { background:#d1fae5; color:#065f46; }
.badge-waste  { background:#fef3c7; color:#92400e; }
.badge-ocean  { background:#ede9fe; color:#5b21b6; }
.badge-land   { background:#fce7f3; color:#9d174d; }
.badge-air    { background:#cffafe; color:#155e75; }
.prog-split { position:absolute; top:11px; right:11px; background:var(--g600); color:white; font-size:.68rem; font-weight:800; padding:3px 9px; border-radius:100px; font-family:'DM Mono',monospace; display:none; }
.prog-option input:checked + .prog-card .prog-split { display:block; }

/* Termin */
.termin-grid { display:flex; flex-direction:column; gap:8px; }
.termin-row { display:flex; align-items:center; gap:12px; padding:12px 16px; border-radius:12px; background:var(--s50); border:2px solid var(--s100); }
.termin-num { width:28px; height:28px; border-radius:8px; flex-shrink:0; background:var(--g100); color:var(--g700); font-size:.74rem; font-weight:900; display:flex; align-items:center; justify-content:center; }
.termin-info { flex:1; }
.termin-label { font-size:.8rem; font-weight:700; color:var(--s900); margin-bottom:1px; }
.termin-date  { font-size:.72rem; color:var(--s500); font-family:'DM Mono',monospace; }
.termin-amt   { font-size:.9rem; font-weight:900; color:var(--g700); font-family:'DM Mono',monospace; }

/* Payment method */
.method-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; }
@media(max-width:480px) { .method-grid { grid-template-columns:1fr; } }
.method-opt { cursor:pointer; }
.method-opt input[type=radio] { position:absolute; opacity:0; pointer-events:none; }
.method-card { display:flex; flex-direction:column; align-items:center; gap:7px; padding:16px 10px; border-radius:14px; border:2px solid var(--s200); background:var(--s50); transition:all .2s; text-align:center; }
.method-card:hover { border-color:var(--g400); background:var(--g50); }
.method-opt input:checked + .method-card { border-color:var(--g500); background:var(--g50); box-shadow:0 4px 14px rgba(16,185,129,.15); }
.method-icon { font-size:1.6rem; }
.method-title { font-size:.8rem; font-weight:800; color:var(--s900); }
.method-sub   { font-size:.68rem; color:var(--s500); line-height:1.4; }

/* PIC readonly */
.pic-block { background:var(--s50); border:2px solid var(--s100); border-radius:14px; padding:16px 20px; }
.pic-block-label { font-size:.72rem; font-weight:700; color:var(--s500); text-transform:uppercase; letter-spacing:.06em; margin-bottom:10px; }
.pic-pills { display:flex; flex-wrap:wrap; gap:8px; }
.pic-pill { background:white; border:1.5px solid var(--s200); border-radius:10px; padding:8px 14px; }
.pic-pill-label { font-size:.65rem; color:var(--s400); font-weight:600; display:block; margin-bottom:2px; text-transform:uppercase; letter-spacing:.04em; }
.pic-pill-val { font-size:.82rem; color:var(--s900); font-weight:700; }

/* Agreement & submit */
.agree-label { display:flex; align-items:flex-start; gap:11px; cursor:pointer; font-size:.84rem; color:var(--s600); line-height:1.65; }
.agree-label input { margin-top:3px; accent-color:var(--g500); width:17px; height:17px; cursor:pointer; flex-shrink:0; }
.btn-submit { width:100%; padding:17px; border-radius:14px; border:none; cursor:pointer; background:linear-gradient(135deg,var(--g900),var(--g700)); color:white; font-size:1rem; font-weight:900; display:flex; align-items:center; justify-content:center; gap:10px; transition:all .25s; box-shadow:0 8px 24px rgba(6,78,59,.3); margin-top:20px; }
.btn-submit:hover { transform:translateY(-2px); box-shadow:0 14px 32px rgba(6,78,59,.4); }
.secure-note { text-align:center; font-size:.78rem; color:var(--s500); margin-top:12px; display:flex; align-items:center; justify-content:center; gap:5px; }

/* Action row */
.action-row { display:flex; gap:12px; flex-wrap:wrap; background:white; border-radius:18px; padding:22px; border:2px solid var(--s100); box-shadow:0 4px 16px rgba(0,0,0,.04); margin-top:24px; }
.btn-act { flex:1; min-width:150px; display:inline-flex; align-items:center; justify-content:center; gap:8px; padding:13px 20px; border-radius:12px; font-size:.86rem; font-weight:700; cursor:pointer; border:2px solid; text-decoration:none; transition:all .2s; }
.btn-act.g { border-color:var(--g500); color:var(--g700); background:var(--g50); }
.btn-act.g:hover { background:var(--g100); }
.btn-act.s { border-color:var(--s300); color:var(--s700); background:white; }
.btn-act.s:hover { background:var(--s50); }

.err-box { background:#fee2e2; border:2px solid #fca5a5; border-radius:13px; padding:14px 18px; margin-bottom:22px; font-size:.84rem; color:#dc2626; }
.powered-bar { text-align:center; padding:20px; display:flex; align-items:center; justify-content:center; gap:10px; font-size:.78rem; color:var(--s500); font-weight:600; margin-top:10px; }
.powered-logo { height:26px; }

@media(max-width:768px) {
    .res-hero { padding:36px 24px; }
    .hero-title { font-size:1.6rem; }
    .hero-total { font-size:2.2rem; }
    .form-panel { padding:22px 18px; }
    .action-row { flex-direction:column; }
    .btn-act { width:100%; }
}
</style>

@php
    $damageCosts = ['none'=>0,'low'=>250_000_000,'medium'=>750_000_000,'high'=>1_750_000_000];
    $dmg      = $calculation->damage_data ?? ['land'=>'none','air'=>'none','water'=>'none'];
    $landLvl  = $dmg['land']  ?? 'none';
    $airLvl   = $dmg['air']   ?? 'none';
    $waterLvl = $dmg['water'] ?? 'none';
    $landCost = $damageCosts[$landLvl]  ?? 0;
    $airCost  = $damageCosts[$airLvl]   ?? 0;
    $waterCost= $damageCosts[$waterLvl] ?? 0;
    $totalComp= $calculation->compensation_cost ?? ($landCost + $airCost + $waterCost);
    $maintAmt = $totalComp * 0.10;
    $allocable= $totalComp * 0.90;

    $lvlLabel = ['none'=>'Tidak Ada','low'=>'Ringan','medium'=>'Sedang','high'=>'Berat'];
    $lvlClass = ['none'=>'lvl-none','low'=>'lvl-low','medium'=>'lvl-medium','high'=>'lvl-high'];

    $industryMap = [
        'manufacturing'=>'Manufaktur','chemical'=>'Ind. Kimia','mining'=>'Pertambangan',
        'cement'=>'Semen','pulp'=>'Pulp & Kertas','palm_oil'=>'Kelapa Sawit',
        'steel'=>'Baja & Logam','construction'=>'Konstruksi','transportation'=>'Transportasi',
        'energy'=>'Energi','agriculture'=>'Pertanian','service'=>'Jasa',
        'technology'=>'Teknologi','other'=>'Lainnya',
    ];

    $calcYear = $calculation->calculation_year ?? date('Y');

    /* Recommendations */
    $recos = [];
    if ($landLvl !== 'none')  $recos[] = 'Implementasikan program revegetasi & reboisasi di area terdampak untuk memulihkan tutupan lahan.';
    if ($landLvl === 'high')  $recos[] = 'Koordinasikan dengan KLHK untuk program pemulihan lahan kritis skala besar (> 10 ha).';
    if ($airLvl  !== 'none')  $recos[] = 'Pasang scrubber & filter partikulat pada cerobong asap untuk mengurangi emisi GRK.';
    if ($airLvl  === 'high')  $recos[] = 'Pertimbangkan transisi ke energi terbarukan (solar/biomassa) untuk menggantikan bahan bakar fosil.';
    if ($waterLvl!== 'none')  $recos[] = 'Bangun atau upgrade IPAL (Instalasi Pengolahan Air Limbah) sebelum periode audit berikutnya.';
    if ($waterLvl=== 'high')  $recos[] = 'Lakukan pemantauan kualitas air sungai di hilir pabrik setiap bulan dan laporkan ke KLH.';
    if (count($recos) < 4) {
        $recos[] = 'Lakukan audit energi internal tahunan untuk identifikasi potensi efisiensi operasional.';
        $recos[] = 'Tetapkan target pengurangan emisi 20-30% dalam roadmap 3–5 tahun ke depan.';
    }
    $recos = array_slice($recos, 0, 6);
@endphp

{{-- Pass PHP values to JS safely --}}
<script>
var PHP = {
    totalComp: @json($totalComp),
    maintAmt:  @json($maintAmt),
    allocable: @json($allocable),
    calcYear:  @json($calcYear)
};
</script>

<div class="page-wrap">
<div class="page-shell">

    {{-- HERO --}}
    <div class="res-hero">
        <div class="hero-top">
            <div>
                <div class="hero-icon">🌍</div>
                <h1 class="hero-title">Hasil & Pembayaran<br>Kompensasi Lingkungan</h1>
                <div class="hero-company">🏭 {{ $calculation->company_name }}</div>
                <div class="hero-meta">
                    <span class="hero-pill">🗂️ {{ $calculation->company_siup }}</span>
                    <span class="hero-pill">📅 {{ $calculation->calculation_year }}</span>
                    <span class="hero-pill">📍 {{ $calculation->company_location }}</span>
                    <span class="hero-pill">🏗️ {{ $calculation->facility_count }} Fasilitas</span>
                </div>
            </div>
            <div class="hero-status">
                <div class="hero-status-label">Total Kompensasi</div>
                <div class="hero-total">Rp {{ number_format($totalComp,0,',','.') }}</div>
                <div class="hero-total-sub">Biaya Offset Lingkungan {{ $calculation->calculation_year }}</div>
            </div>
        </div>
    </div>

    {{-- DAMAGE BREAKDOWN --}}
    <div class="dmg-breakdown">
        <div class="dmg-card land">
            <div class="dmg-card-top">
                <div class="dmg-card-icon-wrap">
                    <span class="dmg-card-icon">🏔️</span>
                    <div>
                        <div class="dmg-card-name">Kerusakan Tanah</div>
                        <div class="dmg-card-sub">Degradasi lahan & deforestasi</div>
                    </div>
                </div>
                <span class="dmg-level-badge {{ $lvlClass[$landLvl] }}">{{ $lvlLabel[$landLvl] }}</span>
            </div>
            <div class="dmg-card-amount{{ $landCost === 0 ? ' dmg-card-amount-zero' : '' }}">
                {{ $landCost > 0 ? 'Rp '.number_format($landCost,0,',','.') : 'Rp 0' }}
            </div>
            <div class="dmg-card-label">Kompensasi pilar tanah</div>
        </div>

        <div class="dmg-card air">
            <div class="dmg-card-top">
                <div class="dmg-card-icon-wrap">
                    <span class="dmg-card-icon">💨</span>
                    <div>
                        <div class="dmg-card-name">Pencemaran Udara</div>
                        <div class="dmg-card-sub">Emisi GRK & partikulat</div>
                    </div>
                </div>
                <span class="dmg-level-badge {{ $lvlClass[$airLvl] }}">{{ $lvlLabel[$airLvl] }}</span>
            </div>
            <div class="dmg-card-amount{{ $airCost === 0 ? ' dmg-card-amount-zero' : '' }}">
                {{ $airCost > 0 ? 'Rp '.number_format($airCost,0,',','.') : 'Rp 0' }}
            </div>
            <div class="dmg-card-label">Kompensasi pilar udara</div>
        </div>

        <div class="dmg-card water">
            <div class="dmg-card-top">
                <div class="dmg-card-icon-wrap">
                    <span class="dmg-card-icon">💧</span>
                    <div>
                        <div class="dmg-card-name">Pencemaran Air</div>
                        <div class="dmg-card-sub">Limbah cair & kontaminasi</div>
                    </div>
                </div>
                <span class="dmg-level-badge {{ $lvlClass[$waterLvl] }}">{{ $lvlLabel[$waterLvl] }}</span>
            </div>
            <div class="dmg-card-amount{{ $waterCost === 0 ? ' dmg-card-amount-zero' : '' }}">
                {{ $waterCost > 0 ? 'Rp '.number_format($waterCost,0,',','.') : 'Rp 0' }}
            </div>
            <div class="dmg-card-label">Kompensasi pilar air</div>
        </div>
    </div>

    {{-- PAYMENT SCHEME SELECTOR --}}
    <div class="pay-section-header">
        <div class="pay-section-title"><span class="pay-section-num">1</span> Pilih Skema Pembayaran</div>
        <div class="pay-section-line"></div>
    </div>

    <div class="scheme-grid" id="schemeGrid">
        <label class="scheme-opt">
            <input type="radio" name="_scheme_sel" value="annual" checked>
            <div class="scheme-card">
                <div class="scheme-check">✓</div>
                <span class="scheme-icon">🗓️</span>
                <div class="scheme-name">Tahunan</div>
                <div class="scheme-freq">1× setahun</div>
                <div class="scheme-desc">Bayar sekaligus per tahun berdasarkan emisi aktual yang diverifikasi auditor</div>
            </div>
        </label>
        <label class="scheme-opt">
            <input type="radio" name="_scheme_sel" value="semi_annual">
            <div class="scheme-card">
                <div class="scheme-check">✓</div>
                <span class="scheme-icon">📆</span>
                <div class="scheme-name">Semesteran</div>
                <div class="scheme-freq">2× setahun</div>
                <div class="scheme-desc">Lebih fleksibel untuk arus kas — tiap 6 bulan sekali</div>
            </div>
        </label>
        <label class="scheme-opt">
            <input type="radio" name="_scheme_sel" value="quarterly">
            <div class="scheme-card">
                <div class="scheme-check">✓</div>
                <span class="scheme-icon">📅</span>
                <div class="scheme-name">Kuartalan</div>
                <div class="scheme-freq">4× setahun</div>
                <div class="scheme-desc">Distribusi beban finansial merata tiap 3 bulan</div>
            </div>
        </label>
    </div>

    {{-- Dynamic per-termin summary --}}
    <div class="scheme-per-termin" id="schemePerTermin">
        <div class="spt-label">Pembayaran per Termin</div>
        <div class="spt-val" id="sptVal">Rp {{ number_format($totalComp,0,',','.') }}</div>
        <div class="spt-sub" id="sptSub">1 pembayaran · Jatuh tempo 15 Jan {{ $calcYear }}</div>
    </div>

    {{-- RECO --}}
    @if(count($recos) > 0)
    <div class="reco-panel" style="margin-top:24px;">
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

    {{-- PAY GRID --}}
    <div style="margin-top:28px;">
        <div class="pay-section-header">
            <div class="pay-section-title"><span class="pay-section-num">2</span> Detail Pembayaran & Alokasi</div>
            <div class="pay-section-line"></div>
        </div>
    </div>

    <div class="pay-grid">

        {{-- LEFT --}}
        <div class="summary-panel">
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
                    <div class="dmg-row-sm">
                        <div class="dmg-chip land"><span class="dmg-chip-icon">🏔️</span><div class="dmg-chip-name">Tanah</div><span class="dmg-chip-lv {{ $lvlClass[$landLvl] }}">{{ $lvlLabel[$landLvl] }}</span></div>
                        <div class="dmg-chip air"><span class="dmg-chip-icon">💨</span><div class="dmg-chip-name">Udara</div><span class="dmg-chip-lv {{ $lvlClass[$airLvl] }}">{{ $lvlLabel[$airLvl] }}</span></div>
                        <div class="dmg-chip water"><span class="dmg-chip-icon">💧</span><div class="dmg-chip-name">Air</div><span class="dmg-chip-lv {{ $lvlClass[$waterLvl] }}">{{ $lvlLabel[$waterLvl] }}</span></div>
                    </div>
                    @if($landCost > 0)<div class="cost-row"><span class="cost-label">🏔️ Kompensasi Tanah</span><span class="cost-val">Rp {{ number_format($landCost,0,',','.') }}</span></div>@endif
                    @if($airCost  > 0)<div class="cost-row"><span class="cost-label">💨 Kompensasi Udara</span><span class="cost-val">Rp {{ number_format($airCost,0,',','.') }}</span></div>@endif
                    @if($waterCost> 0)<div class="cost-row"><span class="cost-label">💧 Kompensasi Air</span><span class="cost-val">Rp {{ number_format($waterCost,0,',','.') }}</span></div>@endif
                    <div class="cost-row"><span class="cost-label">⚙️ Maintenance (10% — fixed)</span><span class="cost-val">Rp {{ number_format($maintAmt,0,',','.') }}</span></div>
                    <div class="cost-total-row">
                        <span class="cost-total-label">Total Kompensasi</span>
                        <span class="cost-total-val">Rp {{ number_format($totalComp,0,',','.') }}</span>
                    </div>
                    <div style="background:var(--g50);border:2px solid var(--g100);border-radius:12px;padding:12px 16px;margin-top:10px;display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-size:.84rem;font-weight:700;color:var(--g700);" id="schemeLabelSide">🗓️ Tahunan</span>
                        <div style="text-align:right;">
                            <div style="font-size:.88rem;font-weight:900;color:var(--g700);font-family:'DM Mono',monospace;" id="instAmtSide">Rp {{ number_format($totalComp,0,',','.') }}</div>
                            <div style="font-size:.7rem;color:var(--s500);" id="instCountSide">per termin × 1×</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-head">📊 Live Alokasi Dana</div>
                <div class="panel-body">
                    <div class="alloc-bar-label">Distribusi 100% Dana</div>
                    <div class="alloc-bar-track">
                        <div class="alloc-seg" id="seg-maint" style="width:10%;background:linear-gradient(90deg,#f59e0b,#fbbf24);"></div>
                        <div class="alloc-seg" id="seg-prog"  style="width:0%;background:linear-gradient(90deg,#10b981,#34d399);"></div>
                        <div class="alloc-seg" id="seg-sisa"  style="width:90%;background:#e2e8f0;"></div>
                    </div>
                    <div class="alloc-legend">
                        <div class="alloc-leg"><div class="alloc-dot" style="background:#f59e0b;"></div>Maintenance 10%</div>
                        <div class="alloc-leg"><div class="alloc-dot" style="background:#10b981;"></div>Program <span id="prog-pct-label" style="margin-left:3px;">0%</span></div>
                        <div class="alloc-leg"><div class="alloc-dot" style="background:#e2e8f0;"></div>Belum dipilih <span id="sisa-pct-label" style="margin-left:3px;">90%</span></div>
                    </div>
                    <div id="liveBreakdown" style="display:none;margin-top:14px;"></div>
                </div>
            </div>
        </div>

        {{-- RIGHT FORM --}}
        <div class="form-panel">

            @if($errors->any())
            <div class="err-box">⚠️ {{ $errors->first() }}</div>
            @endif

            <form id="payForm" method="POST" action="{{ route('payment.process') }}">
                @csrf
                <input type="hidden" name="calculation_id"  value="{{ $calculation->id }}">
                <input type="hidden" name="total_amount"    value="{{ $totalComp }}">
                <input type="hidden" name="maintenance_amt" value="{{ $maintAmt }}">
                <input type="hidden" name="calculator_type" value="corporate">
                <input type="hidden" name="payment_scheme"  id="paymentSchemeInput" value="annual">

                {{-- SECTION 1: PROGRAM --}}
                <div class="form-section">
                    <div class="fs-title"><span class="fs-num">1</span> Alokasi Program Restorasi</div>
                    <div class="fs-sub">
                        <strong>10% (Rp {{ number_format($maintAmt,0,',','.') }})</strong> ditetapkan untuk maintenance operasional.
                        Sisa <strong>90% (Rp {{ number_format($allocable,0,',','.') }})</strong> Anda alokasikan ke program di bawah — dibagi rata.
                    </div>
                    <div class="fs-divider"></div>
                    <div class="fixed-maint">
                        <div class="fm-left">
                            <div class="fm-icon">⚙️</div>
                            <div><div class="fm-label">Maintenance & Operasional</div><div class="fm-desc">Monitoring lapangan, administrasi, audit KLH — ditetapkan otomatis</div></div>
                        </div>
                        <div class="fm-pct">10%</div>
                    </div>
                    <div class="alloc-instruction">💡 Pilih minimal 1 program. Dana 90% dibagi rata jika memilih lebih dari satu.</div>
                    <div class="remain-bar-wrap">
                        <div class="remain-label">
                            <span>Sisa yang harus dialokasikan</span>
                            <span class="remain-pct warn" id="remainPctLabel">90% tersisa</span>
                        </div>
                        <div class="remain-track"><div class="remain-fill" id="remainFill" style="width:0%;"></div></div>
                    </div>
                    <div class="program-grid">
                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="water_turbine" data-label="Turbin Air" data-icon="💧">
                            <div class="prog-card"><div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><span class="prog-split" id="split-water_turbine"></span><span class="prog-icon">💧</span><div class="prog-name">Turbin Air Mikro-Hidro</div><div class="prog-desc">Membangun turbin mikro-hidro untuk energi bersih komunitas sekitar area operasional</div><span class="prog-badge badge-energy">Energi Terbarukan</span></div>
                        </label>
                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="mangrove" data-label="Mangrove" data-icon="🌿">
                            <div class="prog-card"><div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><span class="prog-split" id="split-mangrove"></span><span class="prog-icon">🌿</span><div class="prog-name">Penanaman Mangrove</div><div class="prog-desc">Menanam & melindungi hutan mangrove pesisir untuk menyerap CO₂ dan menjaga ekosistem laut</div><span class="prog-badge badge-forest">Konservasi Hutan</span></div>
                        </label>
                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="reforestation" data-label="Reforestasi" data-icon="🌱">
                            <div class="prog-card"><div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><span class="prog-split" id="split-reforestation"></span><span class="prog-icon">🌱</span><div class="prog-name">Reforestasi Lahan Kritis</div><div class="prog-desc">Penanaman pohon di lahan terdegradasi untuk memulihkan tutupan hutan & mengurangi erosi</div><span class="prog-badge badge-land">Pemulihan Lahan</span></div>
                        </label>
                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="waste_recycle" data-label="Daur Ulang" data-icon="♻️">
                            <div class="prog-card"><div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><span class="prog-split" id="split-waste_recycle"></span><span class="prog-icon">♻️</span><div class="prog-name">Daur Ulang Industri</div><div class="prog-desc">Mendukung fasilitas pengolahan limbah industri dan mendorong ekonomi sirkular</div><span class="prog-badge badge-waste">Pengelolaan Limbah</span></div>
                        </label>
                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="coral_reef" data-label="Terumbu Karang" data-icon="🪸">
                            <div class="prog-card"><div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><span class="prog-split" id="split-coral_reef"></span><span class="prog-icon">🪸</span><div class="prog-name">Restorasi Terumbu Karang</div><div class="prog-desc">Merestorasi ekosistem terumbu karang yang mendukung keanekaragaman hayati laut</div><span class="prog-badge badge-ocean">Konservasi Laut</span></div>
                        </label>
                        <label class="prog-option">
                            <input type="checkbox" name="offset_program[]" value="air_quality" data-label="Kualitas Udara" data-icon="🌬️">
                            <div class="prog-card"><div class="prog-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><span class="prog-split" id="split-air_quality"></span><span class="prog-icon">🌬️</span><div class="prog-name">Pemantauan Kualitas Udara</div><div class="prog-desc">Stasiun pemantau kualitas udara di sekitar kawasan industri terdampak</div><span class="prog-badge badge-air">Kualitas Udara</span></div>
                        </label>
                    </div>
                </div>

                {{-- SECTION 2: TERMIN --}}
                <div class="form-section">
                    <div class="fs-title"><span class="fs-num">2</span> Jadwal Pembayaran Termin</div>
                    <div class="fs-sub">Berdasarkan skema yang Anda pilih — pembayaran pertama dilakukan sekarang.</div>
                    <div class="fs-divider"></div>
                    <div class="termin-grid" id="terminGrid">
                        {{-- populated by JS --}}
                    </div>
                </div>

                {{-- SECTION 3: PIC --}}
                <div class="form-section">
                    <div class="fs-title"><span class="fs-num">3</span> Data PIC Perusahaan</div>
                    <div class="fs-sub">Data PIC yang telah diisi pada formulir pendaftaran.</div>
                    <div class="fs-divider"></div>
                    <div class="pic-block">
                        <div class="pic-block-label">👤 Person in Charge</div>
                        <div class="pic-pills">
                            <div class="pic-pill"><span class="pic-pill-label">Nama</span><span class="pic-pill-val">{{ $calculation->pic_name ?? '—' }}</span></div>
                            <div class="pic-pill"><span class="pic-pill-label">Jabatan</span><span class="pic-pill-val">{{ $calculation->pic_position ?? '—' }}</span></div>
                            <div class="pic-pill"><span class="pic-pill-label">Email</span><span class="pic-pill-val">{{ $calculation->pic_email ?? '—' }}</span></div>
                            <div class="pic-pill"><span class="pic-pill-label">Telepon</span><span class="pic-pill-val">{{ $calculation->pic_phone ?? '—' }}</span></div>
                        </div>
                    </div>
                    <input type="hidden" name="pic_name"     value="{{ $calculation->pic_name ?? '' }}">
                    <input type="hidden" name="pic_position" value="{{ $calculation->pic_position ?? '' }}">
                    <input type="hidden" name="pic_email"    value="{{ $calculation->pic_email ?? '' }}">
                    <input type="hidden" name="pic_phone"    value="{{ $calculation->pic_phone ?? '' }}">
                </div>

                {{-- SECTION 4: PAYMENT METHOD --}}
                <div class="form-section">
                    <div class="fs-title"><span class="fs-num">4</span> Metode Pembayaran</div>
                    <div class="fs-sub">Pilih metode untuk termin pertama sebesar <strong id="instAmtForm">Rp {{ number_format($totalComp,0,',','.') }}</strong>.</div>
                    <div class="fs-divider"></div>
                    <div class="method-grid">
                        <label class="method-opt"><input type="radio" name="payment_method" value="bank_transfer" required><div class="method-card"><span class="method-icon">🏦</span><div class="method-title">Transfer Bank</div><div class="method-sub">BCA, Mandiri, BNI, BRI</div></div></label>
                        <label class="method-opt"><input type="radio" name="payment_method" value="e_wallet"><div class="method-card"><span class="method-icon">📱</span><div class="method-title">E-Wallet</div><div class="method-sub">GoPay, OVO, DANA</div></div></label>
                        <label class="method-opt"><input type="radio" name="payment_method" value="virtual_account"><div class="method-card"><span class="method-icon">💳</span><div class="method-title">Virtual Account</div><div class="method-sub">Semua bank BUKU IV</div></div></label>
                    </div>
                </div>

                <label class="agree-label">
                    <input type="checkbox" name="agreement" required>
                    <span>Saya menyatakan bahwa data yang disampaikan adalah benar dan perusahaan bersedia diaudit oleh tim Kementerian Lingkungan Hidup. Pembayaran ini merupakan kewajiban kompensasi lingkungan sesuai regulasi yang berlaku.</span>
                </label>

                <button type="submit" class="btn-submit">
                    <span>🌿 Konfirmasi & Bayar Termin Pertama</span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M7.5 5L12.5 10L7.5 15" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="secure-note">🔒 Data terenkripsi · Diverifikasi KLH · Sertifikat diterbitkan pasca-lunas</div>
            </form>
        </div>
    </div>

    <div class="action-row">
        <a href="{{ route('calc.corporate.export-pdf', $calculation->id) }}" class="btn-act g">⬇ Download PDF</a>
        <a href="{{ route('calc.corporate.monitoring', $calculation->id) }}" class="btn-act g">📊 Monitoring</a>
        <a href="{{ route('calc.corporate.create') }}" class="btn-act s">🔄 Hitung Ulang</a>
        <a href="{{ route('calc.corporate.history') }}" class="btn-act s">📋 Riwayat</a>
    </div>

    <div class="powered-bar">
        <span>Powered by</span>
        <img src="/images/nullicarbon.png" alt="NulliCarbon" class="powered-logo">
    </div>

</div>
</div>

<script>
(function() {
    var TOTAL    = PHP.totalComp;
    var MAINT    = PHP.maintAmt;
    var ALLOCABLE= PHP.allocable;
    var YEAR     = PHP.calcYear;

    /* ── Scheme data ── */
    var schemes = {
        annual:      { label: '🗓️ Tahunan',    count: 1, rate: 1.00,  monthGap: 12 },
        semi_annual: { label: '📆 Semesteran', count: 2, rate: 0.55,  monthGap: 6  },
        quarterly:   { label: '📅 Kuartalan',  count: 4, rate: 0.30,  monthGap: 3  }
    };

    var selectedScheme = 'annual';

    /* ── Format ── */
    function fmt(n) {
        return 'Rp ' + Math.round(n).toLocaleString('id-ID');
    }

    function fmtDate(year, addMonths) {
        var monthNames = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        var totalMonths = 0 + addMonths;
        var y = parseInt(year) + Math.floor(totalMonths / 12);
        var m = totalMonths % 12;
        return '15 ' + monthNames[m] + ' ' + y;
    }

    /* ── Scheme selector ── */
    document.querySelectorAll('input[name="_scheme_sel"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            selectedScheme = this.value;
            document.getElementById('paymentSchemeInput').value = selectedScheme;
            updateSchemeUI();
            updateTermin();
        });
    });

    function updateSchemeUI() {
        var s = schemes[selectedScheme];
        var instAmt = TOTAL * s.rate;

        /* per-termin summary box */
        var box = document.getElementById('schemePerTermin');
        box.classList.add('show');
        document.getElementById('sptVal').textContent = fmt(instAmt);
        document.getElementById('sptSub').textContent = s.count + ' pembayaran · Pertama: 15 Jan ' + YEAR;

        /* sidebar */
        document.getElementById('schemeLabelSide').textContent  = s.label;
        document.getElementById('instAmtSide').textContent      = fmt(instAmt);
        document.getElementById('instCountSide').textContent    = 'per termin × ' + s.count + '×';

        /* form sub text */
        document.getElementById('instAmtForm').textContent = fmt(instAmt);
    }

    function updateTermin() {
        var s = schemes[selectedScheme];
        var instAmt = TOTAL * s.rate;
        var grid    = document.getElementById('terminGrid');
        var html    = '';
        for (var i = 0; i < s.count; i++) {
            var label;
            if (i === 0) label = 'Pembayaran Pertama (Sekarang)';
            else if (i === s.count - 1) label = 'Pembayaran Final';
            else label = 'Termin ' + (i + 1);
            var dt = fmtDate(YEAR, i * s.monthGap);
            html +=
                '<div class="termin-row">' +
                    '<div class="termin-num">' + (i + 1) + '</div>' +
                    '<div class="termin-info">' +
                        '<div class="termin-label">' + label + '</div>' +
                        '<div class="termin-date">' + dt + '</div>' +
                    '</div>' +
                    '<div class="termin-amt">' + fmt(instAmt) + '</div>' +
                '</div>';
        }
        grid.innerHTML = html;
    }

    /* ── Program allocation ── */
    var checkboxes = document.querySelectorAll('input[name="offset_program[]"]');

    function updateAlloc() {
        var checked = [];
        checkboxes.forEach(function(cb) { if (cb.checked) checked.push(cb); });
        var count   = checked.length;
        var split   = count > 0 ? ALLOCABLE / count : 0;
        var progPct = count > 0 ? 90 : 0;
        var sisaPct = 90 - progPct;

        document.getElementById('seg-prog').style.width  = progPct + '%';
        document.getElementById('seg-sisa').style.width  = sisaPct + '%';
        document.getElementById('prog-pct-label').textContent = progPct + '%';
        document.getElementById('sisa-pct-label').textContent = sisaPct + '%';

        document.getElementById('remainFill').style.width = count > 0 ? '100%' : '0%';
        var lbl = document.getElementById('remainPctLabel');
        if (count === 0) { lbl.textContent = '90% tersisa'; lbl.className = 'remain-pct warn'; }
        else             { lbl.textContent = '✓ Teralokasi penuh'; lbl.className = 'remain-pct'; }

        checkboxes.forEach(function(cb) {
            var badge = document.getElementById('split-' + cb.value);
            if (!badge) return;
            if (cb.checked && count > 0) { badge.textContent = fmt(split); badge.style.display = 'block'; }
            else { badge.style.display = 'none'; }
        });

        var liveBreak = document.getElementById('liveBreakdown');
        if (count === 0) {
            liveBreak.style.display = 'none';
            liveBreak.innerHTML = '';
        } else {
            liveBreak.style.display = 'block';
            var rows = '';
            checked.forEach(function(cb) {
                rows +=
                    '<div style="display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid #f1f5f9;font-size:.8rem;">' +
                        '<span style="color:#334155;font-weight:600;">' + (cb.dataset.icon || '🌿') + ' ' + (cb.dataset.label || cb.value) + '</span>' +
                        '<span style="color:#047857;font-weight:800;font-family:\'DM Mono\',monospace;font-size:.76rem;">' + fmt(split) + '</span>' +
                    '</div>';
            });
            liveBreak.innerHTML =
                '<div style="font-size:.72rem;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px;">Distribusi 90% Per Program</div>' +
                rows +
                '<div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0 0;font-size:.78rem;">' +
                    '<span style="color:#64748b;font-weight:600;">⚙️ Maintenance (fixed)</span>' +
                    '<span style="color:#d97706;font-weight:800;font-family:\'DM Mono\',monospace;">' + fmt(MAINT) + '</span>' +
                '</div>';
        }
    }

    checkboxes.forEach(function(cb) { cb.addEventListener('change', updateAlloc); });

    /* ── Form submit validation ── */
    document.getElementById('payForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var errs = [];
        var checked = [];
        checkboxes.forEach(function(cb) { if (cb.checked) checked.push(cb); });
        if (checked.length === 0) errs.push('Pilih minimal 1 program alokasi dana restorasi.');
        var method = document.querySelector('[name="payment_method"]:checked');
        if (!method) errs.push('Pilih metode pembayaran.');
        var agree = document.querySelector('[name="agreement"]');
        if (!agree.checked) errs.push('Anda harus menyetujui pernyataan di atas.');
        if (errs.length > 0) { alert('Harap lengkapi:\n\n• ' + errs.join('\n• ')); return; }
        this.submit();
    });

    /* ── Init ── */
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('paymentSchemeInput').value = selectedScheme;
        updateSchemeUI();
        updateTermin();
        updateAlloc();
    });
})();
</script>

@endsection 