@extends('layouts.app')

@section('title', 'Transaction History - NulliCarbon')

@section('content')
<style>
body {
    background-color: #F0F8FF;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(22, 101, 52, 0.08);
    border-left: 4px solid;
    transition: all 0.3s ease;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(22, 101, 52, 0.15);
}

.stat-card:nth-child(1) { border-left-color: #22c55e; }
.stat-card:nth-child(2) { border-left-color: #3b82f6; }
.stat-card:nth-child(3) { border-left-color: #f59e0b; }
.stat-card:nth-child(4) { border-left-color: #8b5cf6; }

.stat-card h6 {
    color: #64748b;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
}

.stat-card h3 {
    font-size: 32px;
    font-weight: 700;
    margin: 0;
}

.stat-card .text-success { color: #22c55e !important; }
.stat-card .text-primary { color: #3b82f6 !important; }
.stat-card .text-warning { color: #f59e0b !important; }
.stat-card .text-info { color: #8b5cf6 !important; }

.transactions-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(22, 101, 52, 0.08);
    overflow: hidden;
}

.transactions-card .card-header {
    background: linear-gradient(135deg, #166534, #22c55e);
    color: white;
    padding: 24px 30px;
    border: none;
}

.transactions-card .card-header h5 {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
}

.table-responsive {
    padding: 0;
}

.table {
    margin: 0;
}

.table thead th {
    background: #f8fafc;
    color: #475569;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
    padding: 18px 20px;
}

.table tbody tr {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f1f5f9;
}

.table tbody tr:hover {
    background: #f8fafc;
}

.table tbody td {
    padding: 20px;
    vertical-align: middle;
    color: #334155;
    font-size: 14px;
}

.table tbody td code {
    background: #f1f5f9;
    color: #166534;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    font-family: 'Courier New', monospace;
}

.badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.bg-success { background-color: #dcfce7 !important; color: #166534 !important; }
.bg-warning { background-color: #fef3c7 !important; color: #92400e !important; }
.bg-danger { background-color: #fee2e2 !important; color: #991b1b !important; }
.bg-secondary { background-color: #f1f5f9 !important; color: #475569 !important; }

.btn-outline-primary {
    color: #166534;
    border-color: #166534;
    padding: 8px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: #166534;
    border-color: #166534;
    color: white;
    transform: translateY(-2px);
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-state i {
    font-size: 80px;
    color: #cbd5e1;
    margin-bottom: 20px;
}

.empty-state h4 {
    color: #475569;
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 12px;
}

.empty-state p {
    color: #94a3b8;
    font-size: 16px;
    margin-bottom: 30px;
}

.btn-success {
    background: linear-gradient(135deg, #166534, #22c55e);
    border: none;
    padding: 12px 32px;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(22, 101, 52, 0.3);
}

.page-header {
    margin-bottom: 40px;
}

.page-header h1 {
    font-size: 36px;
    font-weight: 700;
    color: #166534;
    margin-bottom: 8px;
}

.page-header p {
    color: #64748b;
    font-size: 16px;
    margin: 0;
}

.pagination {
    margin: 0;
    padding: 20px;
}

.pagination .page-link {
    color: #166534;
    border-color: #e2e8f0;
    padding: 10px 16px;
    margin: 0 4px;
    border-radius: 8px;
}

.pagination .page-link:hover {
    background: #166534;
    border-color: #166534;
    color: white;
}

.pagination .page-item.active .page-link {
    background: #166534;
    border-color: #166534;
}

@media (max-width: 768px) {
    .page-header h1 {
        font-size: 28px;
    }
    
    .stat-card h3 {
        font-size: 24px;
    }
    
    .table {
        font-size: 13px;
    }
    
    .table tbody td {
        padding: 14px 10px;
    }
}
</style>

<div class="container py-5">
    <!-- Page Header -->
    <div class="page-header" style="padding-top: 100px !important;">
        <h1>Transaction History</h1>
        <p>Track your carbon offset contributions and payment status</p>
    </div>
    
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <h6>Total Spent</h6>
                <h3 class="text-success">Rp {{ number_format($data['total_spent'], 0, ',', '.') }}</h3>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <h6>CO₂ Offset</h6>
                <h3 class="text-primary">{{ number_format($data['co2_offset'], 2) }} kg</h3>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <h6>Total Transactions</h6>
                <h3 class="text-warning">{{ $data['total_transactions'] }}</h3>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <h6>This Month</h6>
                <h3 class="text-info">{{ number_format($data['this_month_offset'], 2) }} kg</h3>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="transactions-card">
        <div class="card-header">
            <h5>All Transactions</h5>
        </div>
        <div class="card-body p-0">
            @if($transactions->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Program</th>
                                <th>CO₂ Offset</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td><code>{{ $transaction->order_id }}</code></td>
                                <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ ucfirst(str_replace('_', ' ', $transaction->calculator_type)) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $programs = [
                                            'water_turbine' => '💧 Water Turbine',
                                            'mangrove' => '🌿 Mangrove',
                                            'waste_recycle' => '♻️ Waste Recycle',
                                            'coral_reef' => '🪸 Coral Reef'
                                        ];
                                    @endphp
                                    {{ $programs[$transaction->offset_program] ?? ucfirst(str_replace('_', ' ', $transaction->offset_program)) }}
                                </td>
                                <td>{{ number_format($transaction->carbon_amount, 2) }} kg</td>
                                <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($transaction->status === 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($transaction->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($transaction->status === 'cancelled')
                                        <span class="badge bg-secondary">Cancelled</span>
                                    @else
                                        <span class="badge bg-danger">Failed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('transactions.show', $transaction->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($transactions->hasPages())
                <div class="pagination-wrapper">
                    {{ $transactions->links() }}
                </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>No Transactions Yet</h4>
                    <p>Start calculating your carbon footprint and make your first contribution!</p>
                    <a href="/calculator" class="btn btn-success">
                        <i class="bi bi-calculator me-2"></i>Start Calculating
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection