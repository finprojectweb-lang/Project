@extends('layouts.app')

@section('title', 'Riwayat Transaksi - NulliCarbon')

@section('content')
<style>
    .transaction-page {
        background-color: #F0F8FF;
        min-height: 100vh;
        padding: 60px 0;
        font-family: 'Arima', sans-serif;
    }

    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 24px rgba(22, 101, 52, 0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #166534, #22c55e);
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 32px rgba(22, 101, 52, 0.15);
        border-color: #22c55e;
    }

    .stats-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-bottom: 20px;
    }

    .icon-green { background: linear-gradient(135deg, #166534, #22c55e); color: white; }
    .icon-blue { background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; }
    .icon-orange { background: linear-gradient(135deg, #ea580c, #fb923c); color: white; }
    .icon-purple { background: linear-gradient(135deg, #7c3aed, #a78bfa); color: white; }

    .stats-number {
        font-size: 36px;
        font-weight: 700;
        color: #166534;
        margin: 10px 0;
    }

    .stats-label {
        color: #64748b;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 50px;
        animation: fadeInDown 0.8s ease;
    }

    .page-title {
        font-size: 48px;
        font-weight: 700;
        color: #166534;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(22, 101, 52, 0.1);
    }

    .page-subtitle {
        font-size: 18px;
        color: #64748b;
    }

    .transaction-table-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(22, 101, 52, 0.1);
        overflow: hidden;
        margin-top: 40px;
    }

    .table-header {
        background: linear-gradient(135deg, #166534, #22c55e);
        color: white;
        padding: 25px 30px;
        font-size: 24px;
        font-weight: 600;
    }

    .custom-table {
        width: 100%;
        margin: 0;
    }

    .custom-table thead {
        background: #f8fafc;
    }

    .custom-table thead th {
        padding: 20px;
        font-weight: 600;
        color: #166534;
        border: none;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 1px;
    }

    .custom-table tbody td {
        padding: 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }

    .custom-table tbody tr {
        transition: all 0.3s ease;
    }

    .custom-table tbody tr:hover {
        background: #f8fafc;
        transform: scale(1.01);
    }

    .transaction-id {
        font-family: 'Courier New', monospace;
        background: #f1f5f9;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #166534;
    }

    .badge-custom {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-transport { background: #fef3c7; color: #92400e; }
    .badge-electricity { background: #dbeafe; color: #1e40af; }
    .badge-waste { background: #dcfce7; color: #166534; }
    .badge-event { background: #fce7f3; color: #9f1239; }

    .status-paid { background: #dcfce7; color: #166534; }
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-failed { background: #fee2e2; color: #991b1b; }
    .status-cancelled { background: #f1f5f9; color: #64748b; }

    .btn-detail {
        background: linear-gradient(135deg, #166534, #22c55e);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(22, 101, 52, 0.3);
        color: white;
    }

    .empty-state {
        padding: 80px 20px;
        text-align: center;
    }

    .empty-icon {
        font-size: 80px;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .pagination {
        justify-content: center;
        margin-top: 30px;
    }

    .pagination .page-link {
        color: #166534;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        margin: 0 5px;
        padding: 10px 16px;
        font-weight: 600;
    }

    .pagination .page-link:hover {
        background: #166534;
        color: white;
        border-color: #166534;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #166534, #22c55e);
        border-color: #166534;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
</style>

<div class="transaction-page">
    <div class="container">
        <!-- Header -->
        <div class="page-header reveal">
            <h1 class="page-title">🌿 Riwayat Kompensasi Karbon</h1>
            <p class="page-subtitle">Lihat semua kontribusi Anda untuk lingkungan yang lebih hijau</p>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6 reveal">
                <div class="stats-card">
                    <div class="stats-icon icon-green mx-auto">
                        <i class="bi bi-tree-fill"></i>
                    </div>
                    <div class="text-center">
                        <div class="stats-label">Total Offset</div>
                        <div class="stats-number">{{ number_format($stats['total_offset'], 2) }}</div>
                        <div class="stats-label">kg CO₂e</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="stats-card">
                    <div class="stats-icon icon-blue mx-auto">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <div class="text-center">
                        <div class="stats-label">Total Kontribusi</div>
                        <div class="stats-number">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</div>
                        <div class="stats-label">Total Pengeluaran</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="stats-card">
                    <div class="stats-icon icon-orange mx-auto">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div class="text-center">
                        <div class="stats-label">Transaksi</div>
                        <div class="stats-number">{{ $stats['total_transactions'] }}</div>
                        <div class="stats-label">Berhasil</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="stats-card">
                    <div class="stats-icon icon-purple mx-auto">
                        <i class="bi bi-calendar-month"></i>
                    </div>
                    <div class="text-center">
                        <div class="stats-label">Bulan Ini</div>
                        <div class="stats-number">{{ number_format($stats['this_month_offset'], 2) }}</div>
                        <div class="stats-label">kg CO₂e</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="transaction-table-card reveal">
            <div class="table-header">
                <i class="bi bi-clock-history me-2"></i>Daftar Transaksi
            </div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kalkulator</th>
                            <th>Emisi (kg CO₂e)</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                        <tr>
                            <td>
                                <span class="transaction-id">{{ $transaction->transaction_id }}</span>
                            </td>
                            <td>
                                <strong>{{ $transaction->created_at->format('d M Y') }}</strong><br>
                                <small style="color: #94a3b8;">{{ $transaction->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <span class="badge-custom badge-{{ $transaction->calculator_type }}">
                                    {{ $transaction->calculator_type_name }}
                                </span>
                            </td>
                            <td>
                                <strong style="color: #166534; font-size: 18px;">{{ number_format($transaction->co2_offset, 2) }}</strong>
                            </td>
                            <td>
                                <strong style="color: #166534; font-size: 16px;">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                <span class="badge-custom status-{{ $transaction->status }}">
                                    {{ $transaction->status_text }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('transactions.show', $transaction->id) }}" class="btn-detail">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <h4 style="color: #64748b; margin-bottom: 10px;">Belum ada transaksi</h4>
                                    <p style="color: #94a3b8;">Mulai kompensasi karbon Anda sekarang!</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($transactions->hasPages())
            <div style="padding: 30px;">
                {{ $transactions->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection