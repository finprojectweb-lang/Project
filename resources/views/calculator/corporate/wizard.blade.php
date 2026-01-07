@extends('layouts.app')

@section('content')
<style>
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

/* HEADER */
.wizard-header {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 40px;
    text-align: center;
}

.wizard-title {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 10px;
}

.wizard-subtitle {
    font-size: 1rem;
    opacity: 0.9;
}

/* PROGRESS STEPS */
.wizard-progress {
    display: flex;
    justify-content: space-between;
    padding: 30px 40px;
    background: #f8fafc;
    border-bottom: 2px solid #e2e8f0;
}

.progress-step {
    flex: 1;
    text-align: center;
    position: relative;
}

.progress-step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 20px;
    left: 60%;
    width: 80%;
    height: 2px;
    background: #e2e8f0;
    z-index: 0;
}

.progress-step.active:not(:last-child)::after {
    background: #10b981;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e2e8f0;
    color: #64748b;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin-bottom: 8px;
    position: relative;
    z-index: 1;
}

.progress-step.active .step-number {
    background: #10b981;
    color: white;
}

.progress-step.completed .step-number {
    background: #059669;
    color: white;
}

.step-label {
    font-size: 0.85rem;
    color: #64748b;
    font-weight: 600;
}

.progress-step.active .step-label {
    color: #10b981;
}

/* FORM CONTENT */
.wizard-body {
    padding: 40px;
}

.wizard-step {
    display: none;
}

.wizard-step.active {
    display: block;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.step-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #064e3b;
    margin-bottom: 10px;
}

.step-description {
    color: #64748b;
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
}

.form-label .required {
    color: #ef4444;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.form-help {
    font-size: 0.85rem;
    color: #64748b;
    margin-top: 5px;
}

.input-group {
    display: flex;
    gap: 10px;
}

.input-addon {
    background: #f1f5f9;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    color: #64748b;
    font-weight: 600;
}

/* SCOPE SECTIONS */
.scope-section {
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    padding: 25px;
    margin-bottom: 20px;
}

.scope-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.scope-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    color: white;
}

.scope-badge.scope1 {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.scope-badge.scope2 {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
}

.scope-badge.scope3 {
    background: linear-gradient(135deg, #a855f7, #9333ea);
}

.scope-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #1e293b;
}

.scope-description {
    color: #64748b;
    font-size: 0.9rem;
    margin-bottom: 20px;
}

/* NAVIGATION BUTTONS */
.wizard-footer {
    display: flex;
    justify-content: space-between;
    padding: 30px 40px;
    background: #f8fafc;
    border-top: 2px solid #e2e8f0;
}

.btn {
    padding: 14px 32px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.btn-primary {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}

.btn-secondary {
    background: white;
    color: #64748b;
    border: 2px solid #e2e8f0;
}

.btn-secondary:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
}

.btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* ALERT */
.alert {
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.alert-info {
    background: #dbeafe;
    border: 2px solid #3b82f6;
    color: #1e40af;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .wizard-progress {
        padding: 20px;
    }

    .step-label {
        font-size: 0.75rem;
    }

    .wizard-body {
        padding: 30px 20px;
    }

    .wizard-footer {
        flex-direction: column;
        gap: 10px;
    }

    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="wizard-container">
    <div class="wizard-card">
        <!-- HEADER -->
        <div class="wizard-header">
            <h1 class="wizard-title">🌍 Kalkulator Emisi Karbon Korporat</h1>
            <p class="wizard-subtitle">Hitung jejak karbon perusahaan Anda berdasarkan GHG Protocol</p>
        </div>

        <!-- PROGRESS STEPS -->
        <div class="wizard-progress">
            <div class="progress-step active" data-step="1">
                <div class="step-number">1</div>
                <div class="step-label">Info Perusahaan</div>
            </div>
            <div class="progress-step" data-step="2">
                <div class="step-number">2</div>
                <div class="step-label">Scope 1 & 2</div>
            </div>
            <div class="progress-step" data-step="3">
                <div class="step-number">3</div>
                <div class="step-label">Scope 3</div>
            </div>
            <div class="progress-step" data-step="4">
                <div class="step-number">4</div>
                <div class="step-label">Review</div>
            </div>
        </div>

        <!-- FORM -->
        <form id="calculatorForm" method="POST" action="{{ route('calc.corporate.calculate') }}">
            @csrf

            <div class="wizard-body">

                <div class="wizard-body">
    {{-- ERROR ALERT --}}
    @if($errors->any() || session('error'))
    <div class="alert alert-danger" style="background: #fee2e2; border: 2px solid #ef4444; color: #991b1b; margin-bottom: 30px;">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <strong>Perhatian!</strong>
        @if(session('error'))
            {{ session('error') }}
        @endif
        @if($errors->has('emission'))
            {{ $errors->first('emission') }}
        @endif
    </div>
    @endif
                <!-- STEP 1: COMPANY INFO -->
                <div class="wizard-step active" data-step="1">
                    <h2 class="step-title">Informasi Perusahaan</h2>
                    <p class="step-description">Masukkan informasi dasar perusahaan Anda</p>

                    <div class="form-group">
                        <label class="form-label">Nama Perusahaan <span class="required">*</span></label>
                        <input type="text" name="company_name" class="form-control" required placeholder="PT. Contoh Indonesia">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Perusahaan <span class="required">*</span></label>
                        <input type="email" name="company_email" class="form-control" required placeholder="info@perusahaan.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label">No. Telepon</label>
                        <input type="tel" name="company_phone" class="form-control" placeholder="+62 21 1234567">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Industri <span class="required">*</span></label>
                        <select name="industry_type" class="form-control" required>
                            <option value="">Pilih Jenis Industri</option>
                            <option value="manufacturing">Manufaktur</option>
                            <option value="service">Jasa/Layanan</option>
                            <option value="retail">Retail</option>
                            <option value="technology">Teknologi</option>
                            <option value="construction">Konstruksi</option>
                            <option value="agriculture">Pertanian</option>
                            <option value="transportation">Transportasi</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jumlah Karyawan</label>
                        <input type="number" name="employee_count" class="form-control" placeholder="100" min="1">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tahun Perhitungan <span class="required">*</span></label>
                        <select name="calculation_year" class="form-control" required>
                            <option value="">Pilih Tahun</option>
                            @for($year = date('Y') + 1; $year >= 2020; $year--)
                                <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- STEP 2: SCOPE 1 & 2 -->
                <div class="wizard-step" data-step="2">
                    <h2 class="step-title">Emisi Langsung & Energi</h2>
                    <p class="step-description">Scope 1 (Emisi Langsung) dan Scope 2 (Emisi Energi)</p>

                    <!-- SCOPE 1 -->
                    <div class="scope-section">
                        <div class="scope-header">
                            <span class="scope-badge scope1">SCOPE 1</span>
                            <span class="scope-title">Emisi Langsung</span>
                        </div>
                        <p class="scope-description">Emisi dari sumber yang dimiliki atau dikendalikan langsung oleh perusahaan</p>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Masukkan 0 jika tidak ada penggunaan
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konsumsi Solar/Diesel (Liter/Tahun)</label>
                            <div class="input-group">
                                <input type="number" name="scope1[diesel]" class="form-control" placeholder="0" min="0" step="0.01" value="0">
                                <span class="input-addon">Liter</span>
                            </div>
                            <small class="form-help">Untuk kendaraan operasional, generator diesel, dll</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konsumsi Bensin (Liter/Tahun)</label>
                            <div class="input-group">
                                <input type="number" name="scope1[gasoline]" class="form-control" placeholder="0" min="0" step="0.01" value="0">
                                <span class="input-addon">Liter</span>
                            </div>
                            <small class="form-help">Untuk kendaraan operasional</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konsumsi Gas Alam (m³/Tahun)</label>
                            <div class="input-group">
                                <input type="number" name="scope1[natural_gas]" class="form-control" placeholder="0" min="0" step="0.01" value="0">
                                <span class="input-addon">m³</span>
                            </div>
                            <small class="form-help">Untuk pemanas, boiler, dll</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konsumsi LPG (Kg/Tahun)</label>
                            <div class="input-group">
                                <input type="number" name="scope1[lpg]" class="form-control" placeholder="0" min="0" step="0.01" value="0">
                                <span class="input-addon">Kg</span>
                            </div>
                            <small class="form-help">Untuk dapur, pemanas, dll</small>
                        </div>
                    </div>

                    <!-- SCOPE 2 -->
                    <div class="scope-section">
                        <div class="scope-header">
                            <span class="scope-badge scope2">SCOPE 2</span>
                            <span class="scope-title">Emisi Energi</span>
                        </div>
                        <p class="scope-description">Emisi tidak langsung dari konsumsi energi yang dibeli</p>

                        <div class="form-group">
                            <label class="form-label">Konsumsi Listrik PLN (kWh/Tahun)</label>
                            <div class="input-group">
                                <input type="number" name="scope2[electricity]" class="form-control" placeholder="0" min="0" step="0.01" value="0">
                                <span class="input-addon">kWh</span>
                            </div>
                            <small class="form-help">Total konsumsi listrik dari PLN dalam setahun</small>
                        </div>
                    </div>
                </div>

                <!-- STEP 3: SCOPE 3 -->
                <div class="wizard-step" data-step="3">
                    <h2 class="step-title">Emisi Rantai Nilai</h2>
                    <p class="step-description">Scope 3 - Emisi tidak langsung dari rantai nilai perusahaan</p>

                    <div class="scope-section">
                        <div class="scope-header">
                            <span class="scope-badge scope3">SCOPE 3</span>
                            <span class="scope-title">Emisi Rantai Nilai</span>
                        </div>
                        <p class="scope-description">Emisi dari aktivitas yang tidak dimiliki langsung tapi terkait dengan operasi perusahaan</p>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Masukkan estimasi berdasarkan data historis perusahaan
                        </div>

                        <div class="form-group">
                            <label class="form-label">Perjalanan Udara Domestik (Km/Tahun)</label>
                            <div class="input-group">
                                <input type="number" name="scope3[flight_domestic_km]" class="form-control" placeholder="0" min="0" step="0.01" value="0">
                                <span class="input-addon">Km</span>
                            </div>
                            <small class="form-help">Total jarak perjalanan dinas dalam negeri</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Perjalanan Udara Internasional (Km/Tahun)</label>
                            <div class="input-group">
                                <input type="number" name="scope3[flight_international_km]" class="form-control" placeholder="0" min="0" step="0.01" value="0">
                                <span class="input-addon">Km</span>
                            </div>
                            <small class="form-help">Total jarak perjalanan dinas luar negeri</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Pengiriman Barang (Ton-Km/Tahun)</label>
                            <div class="input-group">
                                <input type="number" name="scope3[shipping_ton_km]" class="form-control" placeholder="0" min="0" step="0.01" value="0">
                                <span class="input-addon">Ton-Km</span>
                            </div>
                            <small class="form-help">Berat (ton) × Jarak (km) pengiriman produk</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Komuter Karyawan (Km/Tahun)</label>
                            <div class="input-group">
                                <input type="number" name="scope3[employee_commute_km]" class="form-control" placeholder="0" min="0" step="0.01" value="0">
                                <span class="input-addon">Km</span>
                            </div>
                            <small class="form-help">Total jarak perjalanan karyawan ke kantor dalam setahun</small>
                        </div>
                    </div>
                </div>

                <!-- STEP 4: REVIEW -->
                <div class="wizard-step" data-step="4">
                    <h2 class="step-title">Review Data</h2>
                    <p class="step-description">Periksa kembali data yang telah Anda masukkan</p>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Pastikan semua data sudah benar sebelum melakukan perhitungan
                    </div>

                    <div id="reviewContent">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- FOOTER NAVIGATION -->
            <div class="wizard-footer">
                <button type="button" class="btn btn-secondary" id="prevBtn" style="display: none;">
                    <i class="bi bi-arrow-left"></i>
                    Sebelumnya
                </button>
                <div></div>
                <button type="button" class="btn btn-primary" id="nextBtn">
                    Selanjutnya
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let currentStep = 1;
const totalSteps = 4;

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateButtons();
});

// Next button
document.getElementById('nextBtn').addEventListener('click', function() {
    if (currentStep < totalSteps) {
        if (validateStep(currentStep)) {
            if (currentStep === 3) {
                // Before going to review, populate review content
                populateReview();
            }
            currentStep++;
            showStep(currentStep);
            updateButtons();
        }
    } else {
        // Submit form
        if (validateStep(currentStep)) {
            document.getElementById('calculatorForm').submit();
        }
    }
});

// Previous button
document.getElementById('prevBtn').addEventListener('click', function() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
        updateButtons();
    }
});

// Show specific step
function showStep(step) {
    // Hide all steps
    document.querySelectorAll('.wizard-step').forEach(el => {
        el.classList.remove('active');
    });
    
    // Show current step
    document.querySelector(`.wizard-step[data-step="${step}"]`).classList.add('active');
    
    // Update progress
    document.querySelectorAll('.progress-step').forEach((el, index) => {
        el.classList.remove('active', 'completed');
        if (index + 1 < step) {
            el.classList.add('completed');
        } else if (index + 1 === step) {
            el.classList.add('active');
        }
    });
}

// Update buttons
function updateButtons() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    // Previous button
    if (currentStep === 1) {
        prevBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'inline-flex';
    }
    
    // Next button
    if (currentStep === totalSteps) {
        nextBtn.innerHTML = '<i class="bi bi-check-circle"></i> Hitung Emisi';
    } else {
        nextBtn.innerHTML = 'Selanjutnya <i class="bi bi-arrow-right"></i>';
    }
}

// Validate step
function validateStep(step) {
    const currentStepEl = document.querySelector(`.wizard-step[data-step="${step}"]`);
    const requiredFields = currentStepEl.querySelectorAll('[required]');
    
    for (let field of requiredFields) {
        if (!field.value) {
            field.focus();
            alert('Mohon lengkapi semua field yang wajib diisi');
            return false;
        }
    }
    
    return true;
}

// Populate review
function populateReview() {
    const form = document.getElementById('calculatorForm');
    const formData = new FormData(form);
    
    let html = '<div class="scope-section">';
    html += '<h3 style="color: #064e3b; margin-bottom: 20px;">Informasi Perusahaan</h3>';
    html += `<p><strong>Nama:</strong> ${formData.get('company_name')}</p>`;
    html += `<p><strong>Email:</strong> ${formData.get('company_email')}</p>`;
    html += `<p><strong>Industri:</strong> ${formData.get('industry_type')}</p>`;
    html += `<p><strong>Tahun:</strong> ${formData.get('calculation_year')}</p>`;
    html += '</div>';
    
    html += '<div class="scope-section">';
    html += '<div class="scope-header"><span class="scope-badge scope1">SCOPE 1</span><span class="scope-title">Emisi Langsung</span></div>';
    html += `<p>Diesel: ${formData.get('scope1[diesel]') || 0} Liter</p>`;
    html += `<p>Bensin: ${formData.get('scope1[gasoline]') || 0} Liter</p>`;
    html += `<p>Gas Alam: ${formData.get('scope1[natural_gas]') || 0} m³</p>`;
    html += `<p>LPG: ${formData.get('scope1[lpg]') || 0} Kg</p>`;
    html += '</div>';
    
    html += '<div class="scope-section">';
    html += '<div class="scope-header"><span class="scope-badge scope2">SCOPE 2</span><span class="scope-title">Emisi Energi</span></div>';
    html += `<p>Listrik: ${formData.get('scope2[electricity]') || 0} kWh</p>`;
    html += '</div>';
    
    html += '<div class="scope-section">';
    html += '<div class="scope-header"><span class="scope-badge scope3">SCOPE 3</span><span class="scope-title">Emisi Rantai Nilai</span></div>';
    html += `<p>Penerbangan Domestik: ${formData.get('scope3[flight_domestic_km]') || 0} Km</p>`;
    html += `<p>Penerbangan Internasional: ${formData.get('scope3[flight_international_km]') || 0} Km</p>`;
    html += `<p>Pengiriman Barang: ${formData.get('scope3[shipping_ton_km]') || 0} Ton-Km</p>`;
    html += `<p>Komuter Karyawan: ${formData.get('scope3[employee_commute_km]') || 0} Km</p>`;
    html += '</div>';
    
    document.getElementById('reviewContent').innerHTML = html;
}
</script>

@endsection