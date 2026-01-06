@extends('layouts.app')

@section('title', 'Payment Success - NulliCarbon')

@section('content')
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

        <h1 class="success-title">Payment Initiated Successfully! 🎉</h1>
        <p class="success-subtitle">Thank you for contributing to a greener future</p>

        <!-- Payment Details Card -->
        <div class="details-card">
            <h2 class="card-title">Payment Details</h2>
            
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Order ID</span>
                    <span class="detail-value">{{ $paymentData['order_id'] ?? 'N/A' }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Name</span>
                    <span class="detail-value">{{ $paymentData['name'] ?? 'N/A' }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Email</span>
                    <span class="detail-value">{{ $paymentData['email'] ?? 'N/A' }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Phone</span>
                    <span class="detail-value">{{ $paymentData['phone'] ?? 'N/A' }}</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Carbon Offset</span>
                    <span class="detail-value">{{ $paymentData['carbon_amount'] ?? 0 }} kg CO₂</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Program</span>
                    <span class="detail-value program-badge">
                        @php
                            $programs = [
                                'water_turbine' => '💧 Water Turbine',
                                'mangrove' => '🌿 Mangrove Planting',
                                'waste_recycle' => '♻️ Waste Recycling',
                                'coral_reef' => '🪸 Coral Reef Restoration'
                            ];
                            echo $programs[$paymentData['offset_program'] ?? ''] ?? 'N/A';
                        @endphp
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Payment Method</span>
                    <span class="detail-value">
                        @php
                            $methods = [
                                'bank_transfer' => '🏦 Bank Transfer',
                                'e_wallet' => '📱 E-Wallet',
                                'credit_card' => '💳 Credit Card'
                            ];
                            echo $methods[$paymentData['payment_method'] ?? ''] ?? 'N/A';
                        @endphp
                    </span>
                </div>

                <div class="detail-item highlight">
                    <span class="detail-label">Total Payment</span>
                    <span class="detail-value total">Rp {{ number_format($paymentData['total_amount'] ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="status-badge">
                <span class="status-dot"></span>
                Status: Pending Payment
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

        <!-- Impact Message -->
        <div class="impact-message">
            <div class="impact-icon">🌍</div>
            <p><strong>You're making a difference!</strong> Your contribution will help reduce {{ $paymentData['carbon_amount'] ?? 0 }} kg of CO₂ from the atmosphere.</p>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="/" class="btn btn-primary">Back to Home</a>
            <a href="/calculator" class="btn btn-secondary">Calculate Again</a>
        </div>

        <!-- Footer Note -->
        <p class="footer-note">
            Need help? Contact us at <a href="mailto:support@nullicarbon.com">support@nullicarbon.com</a>
        </p>
    </div>
</div>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.success-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f8faf7 0%, #e8f0e5 100%);
    padding: 100px 20px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

.success-wrapper {
    max-width: 700px;
    margin: 0 auto;
    text-align: center;
}

.success-icon {
    margin-bottom: 30px;
    animation: scaleIn 0.5s ease-out;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.success-title {
    font-size: 32px;
    font-weight: 700;
    color: #2d3e1f;
    margin-bottom: 12px;
}

.success-subtitle {
    font-size: 16px;
    color: #6b7c5a;
    margin-bottom: 40px;
}

.details-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(85, 107, 47, 0.1);
    margin-bottom: 24px;
    text-align: left;
}

.card-title {
    font-size: 22px;
    font-weight: 700;
    color: #2d3e1f;
    margin-bottom: 24px;
    text-align: center;
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 24px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.detail-item.highlight {
    grid-column: 1 / -1;
    background: linear-gradient(135deg, #f0f7eb 0%, #e3f0d9 100%);
    padding: 16px;
    border-radius: 12px;
    text-align: center;
}

.detail-label {
    font-size: 13px;
    color: #6b7c5a;
    font-weight: 500;
}

.detail-value {
    font-size: 15px;
    color: #2d3e1f;
    font-weight: 600;
}

.detail-value.total {
    font-size: 24px;
    color: #556B2F;
    font-weight: 700;
}

.program-badge {
    display: inline-block;
    padding: 6px 12px;
    background: rgba(85, 107, 47, 0.1);
    border-radius: 8px;
    width: fit-content;
}

.status-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px;
    background: #fff9e6;
    border: 2px solid #ffd700;
    border-radius: 10px;
    color: #997a00;
    font-weight: 600;
    font-size: 14px;
}

.status-dot {
    width: 10px;
    height: 10px;
    background: #ffd700;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.next-steps-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(85, 107, 47, 0.1);
    margin-bottom: 24px;
    text-align: left;
}

.card-subtitle {
    font-size: 18px;
    font-weight: 700;
    color: #2d3e1f;
    margin-bottom: 16px;
}

.steps-list {
    padding-left: 24px;
    color: #6b7c5a;
    line-height: 2;
}

.steps-list li {
    margin-bottom: 8px;
}

.impact-message {
    background: linear-gradient(135deg, #556B2F 0%, #6b8e3d 100%);
    color: white;
    padding: 24px;
    border-radius: 16px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 16px;
    text-align: left;
}

.impact-icon {
    font-size: 40px;
    flex-shrink: 0;
}

.impact-message p {
    line-height: 1.6;
}

.action-buttons {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 24px;
}

.btn {
    padding: 14px 32px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}

.btn-primary {
    background: linear-gradient(135deg, #556B2F 0%, #6b8e3d 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(85, 107, 47, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(85, 107, 47, 0.4);
}

.btn-secondary {
    background: white;
    color: #556B2F;
    border: 2px solid #556B2F;
}

.btn-secondary:hover {
    background: #556B2F;
    color: white;
}

.footer-note {
    font-size: 14px;
    color: #6b7c5a;
}

.footer-note a {
    color: #556B2F;
    text-decoration: underline;
}

@media (max-width: 640px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }

    .success-title {
        font-size: 24px;
    }

    .details-card,
    .next-steps-card {
        padding: 20px;
    }

    .action-buttons {
        flex-direction: column;
    }

    .btn {
        width: 100%;
    }
}
</style>
@endsection