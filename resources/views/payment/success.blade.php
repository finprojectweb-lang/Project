@extends('layouts.app')

@section('title', 'Payment Success - NulliCarbon')

@section('content')

@php
    // Konstanta tarif — sama dengan PaymentController
    $TAX_PER_KG = 30;

    // Ambil data
    $carbonAmount   = $paymentData['carbon_amount'] ?? 0;
    $subtotal       = $paymentData['subtotal']       ?? 0;
    $adminFee       = $paymentData['admin_fee']      ?? 5000;
    $totalAmount    = $paymentData['total_amount']   ?? 0;

    // Hitung tax dari carbon_amount langsung (tidak bergantung kolom DB)
    $tax            = isset($paymentData['tax']) && $paymentData['tax'] > 0
                        ? $paymentData['tax']
                        : round($carbonAmount * $TAX_PER_KG);

    $offsetPrograms = $paymentData['offset_programs'] ?? [];
    $programLabels  = $paymentData['program_labels']  ?? [];
    $splitAmount    = $paymentData['split_amount']    ?? $totalAmount;
    $programCount   = $paymentData['program_count']   ?? 1;
@endphp

<div class="success-container">
    <div class="success-wrapper">

        <!-- Success Icon -->
        <div class="success-icon">
            <svg width="100" height="100" viewBox="0 0 100 100" fill="none">
                <circle cx="50" cy="50" r="45" fill="#556B2F" opacity="0.1"/>
                <circle cx="50" cy="50" r="35" fill="#556B2F" opacity="0.2"/>
                <path d="M30 50L45 65L70 35" stroke="#556B2F" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <h1 class="success-title">Payment Successful! 🎉</h1>
        <p class="success-subtitle">Thank you for your contribution to a greener future</p>

        <div class="order-badge">
            Order ID: <strong>{{ $paymentData['order_id'] }}</strong>
        </div>

        <div class="success-content">

            <!-- Left: Detail Pembayaran -->
            <div class="detail-section">
                <div class="detail-card">
                    <h2 class="card-title">Payment Details</h2>

                    <!-- Info Pribadi -->
                    <div class="info-group">
                        <h3 class="info-group-title">Personal Information</h3>
                        <div class="info-row">
                            <span class="info-label">Name</span>
                            <span class="info-value">{{ $paymentData['name'] }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $paymentData['email'] }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Phone</span>
                            <span class="info-value">{{ $paymentData['phone'] }}</span>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <!-- Carbon Info -->
                    <div class="info-group">
                        <h3 class="info-group-title">Carbon Offset Details</h3>
                        <div class="info-row">
                            <span class="info-label">Carbon Emission</span>
                            <span class="info-value">{{ number_format($carbonAmount, 2) }} kg CO₂</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Payment Method</span>
                            <span class="info-value">
                                @php
                                    $methodLabels = [
                                        'bank_transfer' => '🏦 Bank Transfer',
                                        'e_wallet'      => '📱 E-Wallet',
                                        'credit_card'   => '💳 Credit/Debit Card',
                                    ];
                                @endphp
                                {{ $methodLabels[$paymentData['payment_method']] ?? $paymentData['payment_method'] }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <div class="status-badge">
                                <span class="status-dot"></span>
                                {{ ucfirst($paymentData['status']) }}
                            </div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <!-- Program yang Dipilih -->
                    <div class="info-group">
                        <h3 class="info-group-title">
                            Selected Program(s)
                            @if($programCount > 1)
                                <span class="program-count-badge">{{ $programCount }} programs</span>
                            @endif
                        </h3>

                        @if($programCount > 1)
                            <p class="split-note">
                                💡 Total pembayaran dibagi rata ke <strong>{{ $programCount }} program</strong>
                                (masing-masing <strong>Rp {{ number_format($splitAmount, 0, ',', '.') }}</strong>)
                            </p>
                        @endif

                        <div class="program-list">
                            @foreach($offsetPrograms as $program)
                                @php
                                    $label = $programLabels[$program] ?? ['label' => $program, 'icon' => '🌱'];
                                @endphp
                                <div class="program-item">
                                    <div class="program-item-left">
                                        <span class="program-item-icon">{{ $label['icon'] }}</span>
                                        <div class="program-item-info">
                                            <span class="program-item-name">{{ $label['label'] }}</span>
                                            @if($programCount > 1)
                                                <span class="program-item-sub">1 of {{ $programCount }} selected programs</span>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="program-item-amount">
                                        Rp {{ number_format($splitAmount, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="divider"></div>

                    <!-- Total Pembayaran -->
                    <div class="payment-summary">
                        {{-- Subtotal --}}
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>

                        {{-- Tax — selalu dihitung dari carbon_amount × Rp30 --}}
                        <div class="summary-row summary-tax">
                            <span>
                                Tax
                                <small class="tax-rate-hint">(Rp {{ number_format($TAX_PER_KG, 0, ',', '.') }}/kg × {{ number_format($carbonAmount, 2) }} kg)</small>
                            </span>
                            <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>

                        {{-- Admin Fee --}}
                        <div class="summary-row">
                            <span>Admin Fee</span>
                            <span>Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                        </div>

                        {{-- Total --}}
                        <div class="summary-row summary-total">
                            <span>Total Payment</span>
                            <span>Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Dampak Lingkungan -->
            <div class="impact-section">
                <div class="impact-card">
                    <h2 class="card-title">🌍 Your Environmental Impact</h2>
                    <p class="impact-intro">
                        Kontribusi Anda akan membantu mengurangi
                        <strong>{{ number_format($carbonAmount, 2) }} kg CO₂</strong>
                        dari atmosfer melalui program berikut:
                    </p>

                    @php
                        $splitCarbon = $programCount > 0
                            ? $carbonAmount / $programCount
                            : $carbonAmount;

                        $impactDetails = [
                            'water_turbine' => [
                                'icon'        => '💧',
                                'title'       => 'Water Turbine Development',
                                'color_class' => 'impact-blue',
                                'stat1_value' => max(1, round($splitCarbon / 500)),
                                'stat1_label' => 'Turbin Dibangun',
                                'stat2_value' => max(1, round($splitCarbon / 10)),
                                'stat2_label' => 'Rumah Tangga Terlayani',
                            ],
                            'mangrove' => [
                                'icon'        => '🌿',
                                'title'       => 'Mangrove Planting',
                                'color_class' => 'impact-green',
                                'stat1_value' => max(1, round($splitCarbon / 5)),
                                'stat1_label' => 'Pohon Ditanam',
                                'stat2_value' => max(1, round($splitCarbon / 50)) . 'm',
                                'stat2_label' => 'Pantai Terlindungi',
                            ],
                            'waste_recycle' => [
                                'icon'        => '♻️',
                                'title'       => 'Waste Recycling',
                                'color_class' => 'impact-yellow',
                                'stat1_value' => max(1, round($splitCarbon * 2)) . 'kg',
                                'stat1_label' => 'Sampah Didaur Ulang',
                                'stat2_value' => max(1, round($splitCarbon / 100)),
                                'stat2_label' => 'Pekerja Didukung',
                            ],
                            'coral_reef' => [
                                'icon'        => '🪸',
                                'title'       => 'Coral Reef Restoration',
                                'color_class' => 'impact-pink',
                                'stat1_value' => max(1, round($splitCarbon / 10)),
                                'stat1_label' => 'Fragmen Karang',
                                'stat2_value' => max(1, round($splitCarbon / 20)) . 'm²',
                                'stat2_label' => 'Area Terumbu',
                            ],
                        ];
                    @endphp

                    <div class="impact-programs">
                        @foreach($offsetPrograms as $program)
                            @if(isset($impactDetails[$program]))
                                @php $detail = $impactDetails[$program]; @endphp
                                <div class="impact-program-card {{ $detail['color_class'] }}">
                                    <div class="impact-program-header">
                                        <span class="impact-program-icon">{{ $detail['icon'] }}</span>
                                        <strong>{{ $detail['title'] }}</strong>
                                    </div>
                                    <div class="impact-stats">
                                        <div class="impact-stat">
                                            <span class="stat-number">{{ $detail['stat1_value'] }}</span>
                                            <span class="stat-label">{{ $detail['stat1_label'] }}</span>
                                        </div>
                                        <div class="impact-stat">
                                            <span class="stat-number">{{ $detail['stat2_value'] }}</span>
                                            <span class="stat-label">{{ $detail['stat2_label'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="next-steps-card">
                    <h3 class="card-subtitle">📋 Next Steps</h3>
                    <ol class="steps-list">
                        <li>Check your email for payment instructions</li>
                        <li>Complete the payment using your selected method</li>
                        <li>Payment confirmation will be sent within 24 hours</li>
                        <li>Track your carbon offset impact in your dashboard</li>
                    </ol>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('transactions.index') }}" class="btn btn-primary">
                        📋 View Transaction History
                    </a>
                    <a href="{{ route('calculator.index') }}" class="btn btn-secondary">
                        🔄 Calculate Again
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline">
                        🏠 Back to Home
                    </a>
                </div>

                <p class="footer-note">
                    Need help? Contact us at
                    <a href="mailto:support@nullicarbon.com">support@nullicarbon.com</a>
                </p>
            </div>

        </div>
    </div>
</div>

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

.success-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f8faf7 0%, #e8f0e5 100%);
    padding: 40px 20px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

.success-wrapper {
    max-width: 1100px;
    margin: 0 auto;
    padding-top: 80px;
    text-align: center;
}

/* Checkmark Icon */
.success-icon {
    margin-bottom: 24px;
    animation: scaleIn 0.5s ease-out;
}

@keyframes scaleIn {
    from { transform: scale(0); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
}

.success-title {
    font-size: 36px;
    font-weight: 800;
    color: #2d3e1f;
    margin-bottom: 12px;
}

.success-subtitle {
    font-size: 17px;
    color: #6b7c5a;
    margin-bottom: 20px;
}

.order-badge {
    display: inline-block;
    background: white;
    border: 2px solid #e8f0e5;
    border-radius: 30px;
    padding: 10px 24px;
    font-size: 14px;
    color: #6b7c5a;
    margin-bottom: 40px;
}

.order-badge strong {
    color: #556B2F;
    font-family: monospace;
    font-size: 15px;
}

/* Layout */
.success-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
    text-align: left;
}

/* Cards */
.detail-card,
.impact-card,
.next-steps-card {
    background: white;
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 4px 20px rgba(85, 107, 47, 0.1);
    margin-bottom: 20px;
}

.card-title {
    font-size: 20px;
    font-weight: 700;
    color: #2d3e1f;
    margin-bottom: 24px;
}

.card-subtitle {
    font-size: 18px;
    font-weight: 700;
    color: #2d3e1f;
    margin-bottom: 16px;
}

/* Info Groups */
.info-group { margin-bottom: 8px; }

.info-group-title {
    font-size: 13px;
    font-weight: 700;
    color: #6b7c5a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.program-count-badge {
    background: #556B2F;
    color: white;
    font-size: 11px;
    padding: 2px 10px;
    border-radius: 20px;
    text-transform: none;
    letter-spacing: 0;
    font-weight: 600;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f0f5ec;
}

.info-row:last-child { border-bottom: none; }

.info-label { font-size: 14px; color: #6b7c5a; }
.info-value { font-size: 14px; color: #2d3e1f; font-weight: 600; text-align: right; }

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 14px;
    background: #fff9e6;
    border: 2px solid #ffd700;
    border-radius: 20px;
    color: #997a00;
    font-weight: 600;
    font-size: 13px;
}

.status-dot {
    width: 8px;
    height: 8px;
    background: #ffd700;
    border-radius: 50%;
    animation: pulse 2s infinite;
    flex-shrink: 0;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50%       { opacity: 0.4; }
}

/* Split Note */
.split-note {
    background: #f0f7eb;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    color: #4a6327;
    margin-bottom: 14px;
    line-height: 1.5;
}

/* Program List */
.program-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.program-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8faf7;
    border: 1.5px solid #e8f0e5;
    border-radius: 10px;
    padding: 12px 16px;
}

.program-item-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.program-item-icon { font-size: 24px; }

.program-item-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.program-item-name { font-size: 14px; font-weight: 600; color: #2d3e1f; }
.program-item-sub  { font-size: 11px; color: #6b7c5a; }

.program-item-amount {
    font-size: 14px;
    font-weight: 700;
    color: #556B2F;
    white-space: nowrap;
}

/* Payment Summary */
.payment-summary { margin-top: 8px; }

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 10px 0;
    font-size: 14px;
    color: #6b7c5a;
    border-bottom: 1px solid #f0f5ec;
}

/* Tax row khusus */
.summary-tax {
    background: #fffdf0;
    border-radius: 8px;
    padding: 10px 12px;
    margin: 4px 0;
    border-bottom: none;
    border: 1px solid #fde68a;
}

.summary-tax > span:first-child {
    display: flex;
    flex-direction: column;
    gap: 3px;
    color: #92400e;
    font-weight: 600;
}

.tax-rate-hint {
    font-size: 11px;
    color: #b8960a;
    font-weight: 400;
}

.summary-tax > span:last-child {
    color: #92400e;
    font-weight: 700;
    white-space: nowrap;
    padding-top: 2px;
}

/* Total row */
.summary-total {
    margin-top: 8px;
    padding-top: 14px !important;
    border-top: 2px solid #556B2F !important;
    border-bottom: none !important;
    font-size: 18px;
    font-weight: 800;
    color: #2d3e1f;
}

.summary-total span:last-child {
    color: #556B2F;
    font-size: 22px;
    font-weight: 800;
}

/* Divider */
.divider {
    height: 1.5px;
    background: linear-gradient(to right, #e8f0e5, #556B2F, #e8f0e5);
    margin: 20px 0;
}

/* Impact Card */
.impact-intro {
    font-size: 14px;
    color: #6b7c5a;
    line-height: 1.6;
    margin-bottom: 20px;
}

.impact-programs {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.impact-program-card {
    border: 2px solid;
    border-radius: 12px;
    padding: 18px;
}

.impact-blue   { background: #f0f9ff; border-color: #bae6fd; }
.impact-green  { background: #f0fdf4; border-color: #bbf7d0; }
.impact-yellow { background: #fffbeb; border-color: #fde68a; }
.impact-pink   { background: #fdf2f8; border-color: #fbcfe8; }

.impact-program-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
    font-size: 15px;
}

.impact-blue   .impact-program-header { color: #0369a1; }
.impact-green  .impact-program-header { color: #166534; }
.impact-yellow .impact-program-header { color: #92400e; }
.impact-pink   .impact-program-header { color: #9d174d; }

.impact-program-icon { font-size: 22px; }

.impact-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.impact-stat {
    background: white;
    border-radius: 10px;
    padding: 12px;
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.stat-number {
    font-size: 26px;
    font-weight: 800;
    line-height: 1;
}

.impact-blue   .stat-number { color: #0369a1; }
.impact-green  .stat-number { color: #166534; }
.impact-yellow .stat-number { color: #92400e; }
.impact-pink   .stat-number { color: #9d174d; }

.stat-label {
    font-size: 11px;
    color: #6b7c5a;
    line-height: 1.3;
}

/* Next Steps */
.steps-list {
    padding-left: 24px;
    color: #6b7c5a;
    line-height: 2;
}

.steps-list li { margin-bottom: 8px; }

/* Action Buttons */
.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 20px;
}

.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px 24px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    text-align: center;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #556B2F 0%, #6b8e3d 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(85, 107, 47, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(85, 107, 47, 0.4);
    color: white;
}

.btn-secondary {
    background: white;
    color: #556B2F;
    border: 2px solid #556B2F;
}

.btn-secondary:hover {
    background: rgba(85, 107, 47, 0.05);
    color: #556B2F;
}

.btn-outline {
    background: transparent;
    color: #6b7c5a;
    border: 2px solid #e8f0e5;
}

.btn-outline:hover {
    border-color: #556B2F;
    color: #556B2F;
}

/* Footer */
.footer-note {
    font-size: 14px;
    color: #6b7c5a;
    text-align: center;
}

.footer-note a {
    color: #556B2F;
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 968px) {
    .success-content { grid-template-columns: 1fr; }
    .success-title   { font-size: 28px; }
}

@media (max-width: 640px) {
    .success-container { padding: 20px 16px; }
    .detail-card,
    .impact-card,
    .next-steps-card   { padding: 20px; }
    .success-title     { font-size: 24px; }
    .stat-number       { font-size: 22px; }
    .btn               { width: 100%; }
}
</style>

@endsection