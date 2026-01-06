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
                            <span class="detail-value">{{ $period ?? 'Monthly' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Offset Rate</span>
                            <span class="detail-value">Rp {{ number_format($rate ?? 15000, 0, ',', '.') }}/kg</span>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="total-section">
                        <div class="total-row">
                            <span class="total-label">Subtotal</span>
                            <span class="total-value">Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
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

                    <div class="impact-info" id="impactInfo">
                        <div class="impact-icon">🌱</div>
                        <div class="impact-text">
                            <strong>Select a program to see environmental impact</strong>
                            <p>Choose your preferred carbon offset program below</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Payment Form -->
            <div class="form-section">
                <form action="{{ route('payment.process') }}" method="POST" class="payment-form" id="paymentForm">
                    @csrf
                    <input type="hidden" name="carbon_amount" value="{{ $carbonAmount ?? 0 }}">
                    <input type="hidden" name="total_amount" value="{{ $totalAmount ?? 0 }}">
                    <input type="hidden" name="calculator_type" value="{{ $calculatorType ?? 'general' }}">

                    <!-- Carbon Offset Program -->
                    <div class="form-group-wrapper">
                        <h3 class="form-section-title">Choose Carbon Offset Program *</h3>
                        <p class="section-description">Select the environmental project you'd like to support</p>
                        
                        <div class="program-options">
                            <label class="program-option">
                                <input type="radio" name="offset_program" value="water_turbine" data-impact="water_turbine">
                                <div class="program-card">
                                    <div class="program-icon">💧</div>
                                    <div class="program-content">
                                        <h4>Water Turbine Development</h4>
                                        <p>Build micro-hydro turbines to generate clean renewable energy for rural communities</p>
                                        <div class="program-badge">Renewable Energy</div>
                                    </div>
                                </div>
                            </label>

                            <label class="program-option">
                                <input type="radio" name="offset_program" value="mangrove" data-impact="mangrove">
                                <div class="program-card">
                                    <div class="program-icon">🌿</div>
                                    <div class="program-content">
                                        <h4>Mangrove Planting</h4>
                                        <p>Plant and protect mangrove forests that absorb CO₂ and protect coastal ecosystems</p>
                                        <div class="program-badge">Forest Conservation</div>
                                    </div>
                                </div>
                            </label>

                            <label class="program-option">
                                <input type="radio" name="offset_program" value="waste_recycle" data-impact="waste_recycle">
                                <div class="program-card">
                                    <div class="program-icon">♻️</div>
                                    <div class="program-content">
                                        <h4>Waste Recycling Program</h4>
                                        <p>Support waste management facilities that reduce landfill emissions and promote circular economy</p>
                                        <div class="program-badge">Waste Management</div>
                                    </div>
                                </div>
                            </label>

                            <label class="program-option">
                                <input type="radio" name="offset_program" value="coral_reef" data-impact="coral_reef">
                                <div class="program-card">
                                    <div class="program-icon">🪸</div>
                                    <div class="program-content">
                                        <h4>Coral Reef Restoration</h4>
                                        <p>Restore and protect coral reefs that support marine biodiversity and absorb carbon</p>
                                        <div class="program-badge">Ocean Conservation</div>
                                    </div>
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
    padding: 10px 0;
}

.final-total {
    margin-top: 12px;
    padding-top: 16px;
    border-top: 2px solid #556B2F;
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

.impact-info {
    background: linear-gradient(135deg, #f0f7eb 0%, #e3f0d9 100%);
    border-radius: 12px;
    padding: 20px;
    display: flex;
    gap: 16px;
    margin-top: 24px;
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

/* Program Options */
.program-options {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.program-option {
    cursor: pointer;
}

.program-option input[type="radio"] {
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
}

.program-option input[type="radio"]:checked + .program-card {
    border-color: #556B2F;
    background: linear-gradient(135deg, rgba(85, 107, 47, 0.05) 0%, rgba(85, 107, 47, 0.02) 100%);
    box-shadow: 0 4px 12px rgba(85, 107, 47, 0.15);
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

/* Payment Methods */
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

/* Checkbox */
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

.checkbox-label a {
    color: #556B2F;
    text-decoration: underline;
}

/* Submit Button */
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

/* Responsive Design */
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
    const form = document.getElementById('paymentForm');
    const programRadios = document.querySelectorAll('input[name="offset_program"]');
    const impactInfo = document.getElementById('impactInfo');
    const carbonAmount = parseFloat('{{ $carbonAmount ?? 0 }}') || 0;
    
    // Impact data untuk setiap program
    const impactData = {
        water_turbine: {
            icon: '💧',
            title: 'Water Turbine Development Impact',
            description: 'Your contribution will help build ' + Math.round(carbonAmount / 500) + ' micro-hydro turbine(s), providing clean energy to approximately ' + Math.round(carbonAmount / 10) + ' households in rural areas.'
        },
        mangrove: {
            icon: '🌿',
            title: 'Mangrove Planting Impact',
            description: 'Your contribution will plant approximately ' + Math.round(carbonAmount / 5) + ' mangrove trees, which will absorb CO₂ for decades and protect ' + Math.round(carbonAmount / 50) + ' meters of coastline.'
        },
        waste_recycle: {
            icon: '♻️',
            title: 'Waste Recycling Impact',
            description: 'Your contribution will help recycle approximately ' + Math.round(carbonAmount * 2) + ' kg of waste, preventing methane emissions and supporting ' + Math.round(carbonAmount / 100) + ' waste collection workers.'
        },
        coral_reef: {
            icon: '🪸',
            title: 'Coral Reef Restoration Impact',
            description: 'Your contribution will restore approximately ' + Math.round(carbonAmount / 10) + ' coral fragments, covering ' + Math.round(carbonAmount / 20) + 'm² of reef area and supporting marine biodiversity.'
        }
    };
    
    // Update impact info ketika program dipilih
    programRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            const impact = this.dataset.impact;
            const data = impactData[impact];
            
            if (data) {
                // Fade out effect
                impactInfo.style.opacity = '0';
                
                setTimeout(() => {
                    // Update content
                    impactInfo.innerHTML = 
                        '<div class="impact-icon">' + data.icon + '</div>' +
                        '<div class="impact-text">' +
                            '<strong>' + data.title + '</strong>' +
                            '<p>' + data.description + '</p>' +
                        '</div>';
                    
                    // Fade in effect
                    impactInfo.style.opacity = '1';
                }, 200);
            }
        });
    });
    
    // Form validation
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        let errors = [];
        
        // Check offset program
        const offsetProgram = document.querySelector('input[name="offset_program"]:checked');
        if (!offsetProgram) {
            isValid = false;
            errors.push('Please select a Carbon Offset Program');
        }
        
        // Check name
        const name = document.getElementById('name').value.trim();
        if (!name) {
            isValid = false;
            errors.push('Please enter your Full Name');
        }
        
        // Check email
        const email = document.getElementById('email').value.trim();
        if (!email) {
            isValid = false;
            errors.push('Please enter your Email Address');
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            isValid = false;
            errors.push('Please enter a valid Email Address');
        }
        
        // Check phone
        const phone = document.getElementById('phone').value.trim();
        if (!phone) {
            isValid = false;
            errors.push('Please enter your Phone Number');
        }
        
        // Check payment method
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
        if (!paymentMethod) {
            isValid = false;
            errors.push('Please select a Payment Method');
        }
        
        // Check agreement
        const agreement = document.querySelector('input[name="agreement"]');
        if (!agreement.checked) {
            isValid = false;
            errors.push('Please agree to the Terms & Conditions');
        }
        
        // Show errors or submit
        if (!isValid) {
            alert('Please complete the following:\n\n• ' + errors.join('\n• '));
            
            // Focus on first error field
            if (!offsetProgram) {
                document.querySelector('.program-options').scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else if (!name) {
                document.getElementById('name').focus();
            } else if (!email) {
                document.getElementById('email').focus();
            } else if (!phone) {
                document.getElementById('phone').focus();
            } else if (!agreement.checked) {
                agreement.focus();
            }
            
            return false;
        }
        
        // Submit form jika valid
        form.submit();
    });
});
</script>

@endsection