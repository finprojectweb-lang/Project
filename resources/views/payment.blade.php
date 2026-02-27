@extends('layouts.app')

@section('title', 'Payment - NulliCarbon')

@section('content')
<div class="payment-container">
    <div class="payment-wrapper">
        <!-- Header Section -->
        <div class="payment-header">
            <div class="header-top">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Back to Calculator
                </a>
            </div>
            <h1 class="page-title">Complete Your Payment</h1>
            <p class="page-subtitle">Choose your carbon offset program and contribute to a greener future</p>
        </div>

        <div class="payment-content">
            <!-- Left Column - Summary -->
            <div class="summary-section">
                <div class="summary-card">
                    <h2 class="section-title">Carbon Offset Summary</h2>
                    
                    <div class="calculation-details">
                        <div class="detail-row">
                            <span class="detail-label">Total Carbon Emission</span>
                            <span class="detail-value">{{ number_format($carbonAmount ?? 0, 2) }} kg CO₂</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Calculation Period</span>
                            <span class="detail-value">{{ $period ?? 'Weekly' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Offset Rate</span>
                            <span class="detail-value">Rp {{ number_format($rate ?? 15000, 0, ',', '.') }}/kg</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Tax Rate</span>
                            <span class="detail-value">Rp {{ number_format($taxRate ?? 30, 0, ',', '.') }}/kg</span>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="total-section">
                        <div class="total-row">
                            <span class="total-label">Subtotal</span>
                            <span class="total-value">Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-row">
                            <span class="total-label">Tax (Rp {{ number_format($taxRate ?? 30, 0, ',', '.') }}/kg × {{ number_format($carbonAmount ?? 0, 2) }} kg)</span>
                            <span class="total-value">Rp {{ number_format($tax ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-row">
                            <span class="total-label">Admin Fee</span>
                            <span class="total-value">Rp {{ number_format($adminFee ?? 5000, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-row final-total">
                            <span class="total-label">Total Payment</span>
                            <span class="total-value">Rp {{ number_format($totalAmount ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Program Distribution Breakdown -->
                    <div id="programBreakdown" class="program-breakdown" style="display:none;">
                        <div class="breakdown-title">
                            <span>💸</span> Dana Terdistribusi
                        </div>
                        <div id="breakdownList" class="breakdown-list"></div>
                    </div>

                    <div class="impact-info" id="impactInfo">
                        <div class="impact-icon">🌱</div>
                        <div class="impact-text">
                            <strong>Select a program to see environmental impact</strong>
                            <p>You can choose multiple programs — the cost will be split evenly</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Payment Form -->
            <div class="form-section">
                <form action="{{ route('payment.process') }}" method="POST" class="payment-form" id="paymentForm">
                    @csrf
                    <input type="hidden" name="carbon_amount"    value="{{ $carbonAmount ?? 0 }}">
                    <input type="hidden" name="total_amount"     value="{{ $totalAmount ?? 0 }}">
                    <input type="hidden" name="tax"              value="{{ $tax ?? 0 }}">
                    <input type="hidden" name="calculator_type"  value="{{ $calculatorType ?? 'general' }}">

                    <!-- Carbon Offset Program -->
                    <div class="form-group-wrapper">
                        <h3 class="form-section-title">Choose Carbon Offset Program *</h3>
                        <p class="section-description">
                            Select one or more programs — your payment will be <strong>split evenly</strong> across all selected programs
                        </p>
                        
                        <div class="program-options">
                            <label class="program-option">
                                <input type="checkbox" name="offset_program[]" value="water_turbine" data-impact="water_turbine" data-label="Water Turbine Development" data-icon="💧">
                                <div class="program-card">
                                    <div class="program-check">
                                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                    </div>
                                    <div class="program-icon">💧</div>
                                    <div class="program-content">
                                        <h4>Water Turbine Development</h4>
                                        <p>Build micro-hydro turbines to generate clean renewable energy for rural communities</p>
                                        <div class="program-badge">Renewable Energy</div>
                                    </div>
                                    <div class="program-split-badge" id="split-water_turbine" style="display:none;"></div>
                                </div>
                            </label>

                            <label class="program-option">
                                <input type="checkbox" name="offset_program[]" value="mangrove" data-impact="mangrove" data-label="Mangrove Planting" data-icon="🌿">
                                <div class="program-card">
                                    <div class="program-check">
                                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                    </div>
                                    <div class="program-icon">🌿</div>
                                    <div class="program-content">
                                        <h4>Mangrove Planting</h4>
                                        <p>Plant and protect mangrove forests that absorb CO₂ and protect coastal ecosystems</p>
                                        <div class="program-badge">Forest Conservation</div>
                                    </div>
                                    <div class="program-split-badge" id="split-mangrove" style="display:none;"></div>
                                </div>
                            </label>

                            <label class="program-option">
                                <input type="checkbox" name="offset_program[]" value="waste_recycle" data-impact="waste_recycle" data-label="Waste Recycling Program" data-icon="♻️">
                                <div class="program-card">
                                    <div class="program-check">
                                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                    </div>
                                    <div class="program-icon">♻️</div>
                                    <div class="program-content">
                                        <h4>Waste Recycling Program</h4>
                                        <p>Support waste management facilities that reduce landfill emissions and promote circular economy</p>
                                        <div class="program-badge">Waste Management</div>
                                    </div>
                                    <div class="program-split-badge" id="split-waste_recycle" style="display:none;"></div>
                                </div>
                            </label>

                            <label class="program-option">
                                <input type="checkbox" name="offset_program[]" value="coral_reef" data-impact="coral_reef" data-label="Coral Reef Restoration" data-icon="🪸">
                                <div class="program-card">
                                    <div class="program-check">
                                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                    </div>
                                    <div class="program-icon">🪸</div>
                                    <div class="program-content">
                                        <h4>Coral Reef Restoration</h4>
                                        <p>Restore and protect coral reefs that support marine biodiversity and absorb carbon</p>
                                        <div class="program-badge">Ocean Conservation</div>
                                    </div>
                                    <div class="program-split-badge" id="split-coral_reef" style="display:none;"></div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="form-group-wrapper">
                        <h3 class="form-section-title">Personal Information</h3>
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" id="name" name="name" class="form-control" required value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-control" required value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" class="form-control" required value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="form-group-wrapper">
                        <h3 class="form-section-title">Payment Method</h3>
                        
                        <div class="payment-methods">
                            <label class="payment-method-option">
                                <input type="radio" name="payment_method" value="bank_transfer">
                                <div class="method-card">
                                    <div class="method-icon">🏦</div>
                                    <div class="method-info">
                                        <strong>Bank Transfer</strong>
                                        <span>BCA, Mandiri, BNI, BRI</span>
                                    </div>
                                </div>
                            </label>

                            <label class="payment-method-option">
                                <input type="radio" name="payment_method" value="e_wallet">
                                <div class="method-card">
                                    <div class="method-icon">📱</div>
                                    <div class="method-info">
                                        <strong>E-Wallet</strong>
                                        <span>GoPay, OVO, DANA, ShopeePay</span>
                                    </div>
                                </div>
                            </label>

                            <label class="payment-method-option">
                                <input type="radio" name="payment_method" value="credit_card">
                                <div class="method-card">
                                    <div class="method-icon">💳</div>
                                    <div class="method-info">
                                        <strong>Credit/Debit Card</strong>
                                        <span>Visa, Mastercard, JCB</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Agreement -->
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="agreement" required>
                            <span>I agree to the Terms & Conditions and understand that this payment will be used for the selected carbon offset program</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit">
                        <span>Proceed to Payment</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M7.5 5L12.5 10L7.5 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <p class="secure-notice">
                        🔒 Your payment information is encrypted and secure
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.payment-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f8faf7 0%, #e8f0e5 100%);
    padding: 40px 20px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

.payment-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

/* Header Section */
.payment-header {
    text-align: center;
    margin-bottom: 40px;
    margin-top: 90px;
    position: relative;
}

.header-top {
    position: absolute;
    left: 0;
    top: 0;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #556B2F;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    padding: 10px 18px;
    border-radius: 8px;
    transition: all 0.3s ease;
    background: white;
    border: 2px solid #e8f0e5;
    white-space: nowrap;
}

.btn-back:hover {
    background: rgba(85, 107, 47, 0.1);
    border-color: #556B2F;
}

.page-title {
    font-size: 36px;
    font-weight: 700;
    color: #2d3e1f;
    margin-bottom: 12px;
}

.page-subtitle {
    font-size: 16px;
    color: #6b7c5a;
}

/* Content Layout */
.payment-content {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 30px;
}

/* Summary Section */
.summary-section {
    position: sticky;
    top: 20px;
    height: fit-content;
}

.summary-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(85, 107, 47, 0.1);
}

.section-title {
    font-size: 22px;
    font-weight: 700;
    color: #2d3e1f;
    margin-bottom: 24px;
}

.calculation-details {
    margin-bottom: 24px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #e8f0e5;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    color: #6b7c5a;
    font-size: 14px;
}

.detail-value {
    color: #2d3e1f;
    font-weight: 600;
    font-size: 14px;
}

.divider {
    height: 2px;
    background: linear-gradient(to right, #e8f0e5, #556B2F, #e8f0e5);
    margin: 24px 0;
}

.total-section {
    margin-bottom: 24px;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f0f5ec;
}

.total-row:last-child {
    border-bottom: none;
}

.total-label {
    color: #6b7c5a;
    font-size: 14px;
}

.total-value {
    color: #2d3e1f;
    font-weight: 600;
    font-size: 14px;
}

/* Tax row styling */
.tax-row .total-label {
    color: #997a00;
}

.tax-row .total-value {
    color: #997a00;
}

.final-total {
    margin-top: 12px;
    padding-top: 16px !important;
    border-top: 2px solid #556B2F !important;
    border-bottom: none !important;
}

.final-total .total-label {
    font-size: 18px;
    font-weight: 700;
    color: #2d3e1f;
}

.final-total .total-value {
    font-size: 24px;
    font-weight: 700;
    color: #556B2F;
}

/* Program Breakdown */
.program-breakdown {
    background: linear-gradient(135deg, #f0f7eb 0%, #e3f0d9 100%);
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 16px;
}

.breakdown-title {
    font-size: 13px;
    font-weight: 700;
    color: #2d3e1f;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.breakdown-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.breakdown-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    border-radius: 8px;
    padding: 10px 14px;
}

.breakdown-item-left {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #2d3e1f;
    font-weight: 500;
}

.breakdown-item-right {
    font-size: 13px;
    font-weight: 700;
    color: #556B2F;
}

.impact-info {
    background: linear-gradient(135deg, #f0f7eb 0%, #e3f0d9 100%);
    border-radius: 12px;
    padding: 20px;
    display: flex;
    gap: 16px;
    transition: all 0.3s ease;
}

.impact-icon {
    font-size: 32px;
}

.impact-text strong {
    display: block;
    color: #2d3e1f;
    font-size: 14px;
    margin-bottom: 6px;
}

.impact-text p {
    color: #6b7c5a;
    font-size: 13px;
    line-height: 1.5;
}

/* Form Section */
.form-section {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(85, 107, 47, 0.1);
}

.payment-form {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.form-group-wrapper {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.form-section-title {
    font-size: 18px;
    font-weight: 700;
    color: #2d3e1f;
    margin-bottom: 4px;
}

.section-description {
    font-size: 14px;
    color: #6b7c5a;
    margin-bottom: 8px;
}

/* Program Options - Checkbox Style */
.program-options {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.program-option {
    cursor: pointer;
}

.program-option input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.program-card {
    display: flex;
    gap: 18px;
    padding: 20px;
    border: 2px solid #e8f0e5;
    border-radius: 14px;
    transition: all 0.3s ease;
    background: white;
    position: relative;
    align-items: flex-start;
}

.program-check {
    width: 22px;
    height: 22px;
    border: 2px solid #c8d8b8;
    border-radius: 6px;
    flex-shrink: 0;
    margin-top: 2px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.25s ease;
    background: white;
}

.check-icon {
    width: 13px;
    height: 13px;
    stroke: white;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.program-option input[type="checkbox"]:checked + .program-card {
    border-color: #556B2F;
    background: linear-gradient(135deg, rgba(85, 107, 47, 0.05) 0%, rgba(85, 107, 47, 0.02) 100%);
    box-shadow: 0 4px 12px rgba(85, 107, 47, 0.15);
}

.program-option input[type="checkbox"]:checked + .program-card .program-check {
    background: #556B2F;
    border-color: #556B2F;
}

.program-option input[type="checkbox"]:checked + .program-card .check-icon {
    opacity: 1;
}

.program-card:hover {
    border-color: #6b8e3d;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(85, 107, 47, 0.1);
}

.program-icon {
    font-size: 36px;
    flex-shrink: 0;
}

.program-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.program-content h4 {
    color: #2d3e1f;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 4px;
}

.program-content p {
    color: #6b7c5a;
    font-size: 13px;
    line-height: 1.5;
    margin-bottom: 8px;
}

.program-badge {
    display: inline-block;
    padding: 4px 12px;
    background: rgba(85, 107, 47, 0.1);
    color: #556B2F;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    width: fit-content;
}

.program-split-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #556B2F;
    color: white;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    white-space: nowrap;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-label {
    font-size: 14px;
    font-weight: 600;
    color: #2d3e1f;
}

.form-control {
    padding: 12px 16px;
    border: 2px solid #e8f0e5;
    border-radius: 10px;
    font-size: 15px;
    transition: all 0.3s ease;
    font-family: inherit;
}

.form-control:focus {
    outline: none;
    border-color: #556B2F;
    box-shadow: 0 0 0 3px rgba(85, 107, 47, 0.1);
}

.payment-methods {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.payment-method-option {
    cursor: pointer;
}

.payment-method-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.method-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    border: 2px solid #e8f0e5;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.payment-method-option input[type="radio"]:checked + .method-card {
    border-color: #556B2F;
    background: rgba(85, 107, 47, 0.05);
}

.method-card:hover {
    border-color: #556B2F;
}

.method-icon {
    font-size: 28px;
}

.method-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.method-info strong {
    color: #2d3e1f;
    font-size: 15px;
}

.method-info span {
    color: #6b7c5a;
    font-size: 13px;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    cursor: pointer;
    font-size: 14px;
    color: #6b7c5a;
    line-height: 1.6;
}

.checkbox-label input[type="checkbox"] {
    margin-top: 3px;
    cursor: pointer;
    width: 18px;
    height: 18px;
    accent-color: #556B2F;
}

.btn-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #556B2F 0%, #6b8e3d 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(85, 107, 47, 0.3);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(85, 107, 47, 0.4);
}

.btn-submit:active {
    transform: translateY(0);
}

.secure-notice {
    text-align: center;
    font-size: 13px;
    color: #6b7c5a;
}

@media (max-width: 968px) {
    .payment-content {
        grid-template-columns: 1fr;
    }

    .summary-section {
        position: static;
    }

    .page-title {
        font-size: 28px;
    }
}

@media (max-width: 640px) {
    .payment-container {
        padding: 20px 16px;
    }

    .summary-card,
    .form-section {
        padding: 20px;
    }

    .page-title {
        font-size: 24px;
    }

    .final-total .total-value {
        font-size: 20px;
    }

    .program-card {
        flex-direction: column;
        text-align: center;
    }

    .program-check {
        margin: 0 auto;
    }

    .program-split-badge {
        position: static;
        margin-top: 8px;
        align-self: center;
        display: inline-block;
    }

    .program-icon {
        font-size: 40px;
    }

    .btn-back {
        font-size: 13px;
        padding: 8px 14px;
    }

    .btn-back svg {
        width: 16px;
        height: 16px;
    }

    .header-top {
        position: static;
        margin-bottom: 16px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form               = document.getElementById('paymentForm');
    const programCheckboxes  = document.querySelectorAll('input[name="offset_program[]"]');
    const impactInfo         = document.getElementById('impactInfo');
    const programBreakdown   = document.getElementById('programBreakdown');
    const breakdownList      = document.getElementById('breakdownList');

    const totalAmount  = parseFloat('{{ $totalAmount ?? 0 }}') || 0;
    const carbonAmount = parseFloat('{{ $carbonAmount ?? 0 }}') || 0;

    function formatRupiah(number) {
        return 'Rp ' + Math.round(number).toLocaleString('id-ID');
    }

    const impactData = {
        water_turbine: {
            icon: '💧',
            title: 'Water Turbine Development',
            getDescription: (splitCarbon) =>
                'Membantu membangun ' + Math.max(1, Math.round(splitCarbon / 500)) +
                ' turbin mikro-hidro, menyediakan energi bersih untuk sekitar ' +
                Math.max(1, Math.round(splitCarbon / 10)) + ' rumah tangga.'
        },
        mangrove: {
            icon: '🌿',
            title: 'Mangrove Planting',
            getDescription: (splitCarbon) =>
                'Menanam sekitar ' + Math.max(1, Math.round(splitCarbon / 5)) +
                ' pohon mangrove yang akan menyerap CO₂ selama puluhan tahun dan melindungi ' +
                Math.max(1, Math.round(splitCarbon / 50)) + ' meter garis pantai.'
        },
        waste_recycle: {
            icon: '♻️',
            title: 'Waste Recycling',
            getDescription: (splitCarbon) =>
                'Membantu mendaur ulang sekitar ' + Math.max(1, Math.round(splitCarbon * 2)) +
                ' kg sampah dan mendukung ' + Math.max(1, Math.round(splitCarbon / 100)) + ' pekerja pengumpul sampah.'
        },
        coral_reef: {
            icon: '🪸',
            title: 'Coral Reef Restoration',
            getDescription: (splitCarbon) =>
                'Merestorasi sekitar ' + Math.max(1, Math.round(splitCarbon / 10)) +
                ' fragmen karang, mencakup ' + Math.max(1, Math.round(splitCarbon / 20)) + ' m² area terumbu karang.'
        }
    };

    function updateUI() {
        const checked     = [...programCheckboxes].filter(cb => cb.checked);
        const count       = checked.length;
        const splitAmount = count > 0 ? totalAmount / count : 0;
        const splitCarbon = count > 0 ? carbonAmount / count : 0;

        // Update split badge di setiap program card
        programCheckboxes.forEach(cb => {
            const badge = document.getElementById('split-' + cb.value);
            if (cb.checked && count > 0) {
                badge.textContent = formatRupiah(splitAmount);
                badge.style.display = 'block';
            } else {
                badge.style.display = 'none';
            }
        });

        // Update breakdown
        if (count > 0) {
            programBreakdown.style.display = 'block';
            breakdownList.innerHTML = checked.map(cb => {
                const data = impactData[cb.value];
                return `
                    <div class="breakdown-item">
                        <div class="breakdown-item-left">
                            <span>${data.icon}</span>
                            <span>${data.title}</span>
                        </div>
                        <div class="breakdown-item-right">${formatRupiah(splitAmount)}</div>
                    </div>`;
            }).join('');
        } else {
            programBreakdown.style.display = 'none';
        }

        // Update impact info
        impactInfo.style.opacity = '0';
        setTimeout(() => {
            if (count === 0) {
                impactInfo.innerHTML = `
                    <div class="impact-icon">🌱</div>
                    <div class="impact-text">
                        <strong>Select a program to see environmental impact</strong>
                        <p>You can choose multiple programs — the cost will be split evenly</p>
                    </div>`;
            } else {
                const impactHTML = checked.map(cb => {
                    const data = impactData[cb.value];
                    return `
                        <div style="margin-bottom:${count > 1 ? '12px' : '0'}">
                            <strong>${data.icon} ${data.title}</strong>
                            <p>${data.getDescription(splitCarbon)}</p>
                        </div>`;
                }).join('');

                impactInfo.innerHTML = `
                    <div class="impact-icon" style="display:${count > 1 ? 'none' : 'block'}">
                        ${count === 1 ? impactData[checked[0].value].icon : ''}
                    </div>
                    <div class="impact-text">${impactHTML}</div>`;
            }
            impactInfo.style.opacity = '1';
        }, 150);
    }

    programCheckboxes.forEach(cb => cb.addEventListener('change', updateUI));

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        let isValid = true;
        let errors  = [];

        const checkedPrograms = [...programCheckboxes].filter(cb => cb.checked);
        if (checkedPrograms.length === 0) { isValid = false; errors.push('Please select at least one Carbon Offset Program'); }

        const name = document.getElementById('name').value.trim();
        if (!name) { isValid = false; errors.push('Please enter your Full Name'); }

        const email = document.getElementById('email').value.trim();
        if (!email) {
            isValid = false; errors.push('Please enter your Email Address');
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            isValid = false; errors.push('Please enter a valid Email Address');
        }

        const phone = document.getElementById('phone').value.trim();
        if (!phone) { isValid = false; errors.push('Please enter your Phone Number'); }

        const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
        if (!paymentMethod) { isValid = false; errors.push('Please select a Payment Method'); }

        const agreement = document.querySelector('input[name="agreement"]');
        if (!agreement.checked) { isValid = false; errors.push('Please agree to the Terms & Conditions'); }

        if (!isValid) {
            alert('Please complete the following:\n\n• ' + errors.join('\n• '));
            if (checkedPrograms.length === 0) {
                document.querySelector('.program-options').scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else if (!name) {
                document.getElementById('name').focus();
            } else if (!email) {
                document.getElementById('email').focus();
            } else if (!phone) {
                document.getElementById('phone').focus();
            }
            return false;
        }

        form.submit();
    });
});
</script>

@endsection