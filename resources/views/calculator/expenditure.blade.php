@extends('layouts.app')

@section('content')

<style>
/* JARAK DARI NAVBAR */
body{
    padding-top: 80px;
    overflow-y: auto;
    overflow-x: hidden;
}

body::-webkit-scrollbar {
    display: none;
}

/* Section Title */
.section-title {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    padding-bottom: 10px;
    font-size: 1.25rem;
    font-weight: 700;
}

.section-title::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 300px;
    height: 1px;
    background-color: #064E3B;
    border-radius: 2px;
}

/* Result Box */
.result-box{
    background: #B1F0DC;
    color: #064E3B;
}

/* Expenditure Section */
.expenditure-section {
    box-shadow: none;
    border: none;
    max-width: 600px;
    margin: 0 auto;
}

.expenditure-section .card-body {
    background: linear-gradient(180deg, #6AD3CA, #39CD4A);
    padding: 20px;
    border-radius: 30px;
}

/* Row Gap */
.expenditure-section .row {
    row-gap: 20px;
}

/* Column padding */
.expenditure-section .row .col-6 {
    padding: 0 8px;
}

/* Expenditure Box */
.expenditure-box {
    border: 1px solid #064E3B;
    border-radius: 15px;
    padding: 15px;
    background-color: rgba(255, 255, 255, 0.15);
    transition: transform 0.2s, box-shadow 0.2s;
    height: 100%;
}

.expenditure-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.expenditure-box label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    color: #064E3B;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
}

.expenditure-box label i {
    font-size: 1rem;
    color: #064E3B;
}

.expenditure-box input {
    width: 100%;
    padding: 10px 12px;
    border: 2px solid rgba(6, 78, 59, 0.3);
    border-radius: 10px;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    background-color: white;
}

.expenditure-box input:focus {
    outline: none;
    border-color: #064E3B;
    box-shadow: 0 0 0 3px rgba(6, 78, 59, 0.1);
}

/* Back Button */
.back-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #6AD3CA, #39CD4A);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(106, 211, 202, 0.3);
}

.back-button:hover {
    background: linear-gradient(135deg, #5BC4BB, #2EBD3F);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(106, 211, 202, 0.4);
    color: white;
}

.back-button i {
    font-size: 1rem;
}

/* Header with Back Button */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    gap: 15px;
}

.page-header h4 {
    flex: 1;
    text-align: center;
    margin: 0;
}

.payment-button-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

/* Powered by */
.powered-by{
    display: block;
    margin-top: 0;
    line-height: 1;
}

.powered-by-inner{
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.powered-text{
    font-size: 12px;
    color: #6c757d;
    line-height: 1;
}

.powered-logo{
    height: 100px;
    object-fit: contain;
    display: block;
}

@media(max-width:768px){
    body{ padding-top: 95px; }
    .result-box h2{font-size:26px;}
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .page-header h4 {
        text-align: left;
        width: 100%;
    }
    
    .expenditure-section {
        max-width: 100%;
    }
    
    .expenditure-section .card-body {
        padding: 15px;
    }
    
    .expenditure-box {
        padding: 12px;
    }
    
    .payment-button-container {
        flex-direction: column;
        align-items: stretch;
    }
    
    .payment-button-container .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="container py-4">

    <!-- Header with Back Button -->
    <div class="page-header">
        <a href="javascript:history.back()" class="back-button">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </a>
        
        <h4 class="fw-bold">Calculate Your Carbon Footprint</h4>
        
        <!-- Empty div for spacing balance -->
        <div style="width: 100px;"></div>
    </div>

    <!-- UPDATE RESULT PANEL - Replace existing result-box div -->
    <div class="result-box text-center p-4 rounded-4 mb-4">
        <h6>Your Total Carbon Footprint</h6>
        <h2 id="totalCarbon">0 kgCO₂e</h2>
        
        <!-- TAMBAHAN: HARGA -->
        <div class="price-section mt-3 p-3 bg-white rounded-3">
            <h5 class="text-success mb-2">
                <i class="fas fa-money-bill-wave me-2"></i>Compensation Cost
            </h5>
            <h3 class="fw-bold text-success" id="totalPrice">Rp 0</h3>
            <small class="text-muted">@ Rp 15.000 per kgCO₂e</small>
        </div>

        <div class="row mt-3 small">
            <div class="col-4">
                <strong id="plasticEq">0 Kg</strong><br> Plastic bottles
            </div>
            <div class="col-4">
                <strong id="treeEq">0 Tree(s)</strong><br> Trees needed
            </div>
            <div class="col-4">
                <strong id="coralEq">0 Fragment</strong><br> Coral fragments
            </div>
        </div>
    </div>

    @include('pages.carbon-nav')

    <!-- EXPENDITURE SECTION -->
    <div class="card border-0 rounded-4 expenditure-section">
        <div class="card-body">
            <h5 class="fw-bold mb-3 section-title">Expenditure</h5>
            
            <div class="row g-3">
                <!-- Eating Out -->
                <div class="col-6">
                    <div class="expenditure-box">
                        <label>
                            <i class="fas fa-utensils"></i>
                            <span>Eating Out</span>
                        </label>
                        <input type="number" class="calc" id="eatingOut" placeholder="Enter amount (IDR)" min="0" step="1000">
                    </div>
                </div>
                
                <!-- Clothing -->
                <div class="col-6">
                    <div class="expenditure-box">
                        <label>
                            <i class="fas fa-tshirt"></i>
                            <span>Clothing</span>
                        </label>
                        <input type="number" class="calc" id="clothing" placeholder="Enter amount (IDR)" min="0" step="1000">
                    </div>
                </div>
                
                <!-- Computers & Electronics -->
                <div class="col-6">
                    <div class="expenditure-box">
                        <label>
                            <i class="fas fa-laptop"></i>
                            <span>Computers & Electronics</span>
                        </label>
                        <input type="number" class="calc" id="electronics" placeholder="Enter amount (IDR)" min="0" step="1000">
                    </div>
                </div>
                
                <!-- Telephone & Internet -->
                <div class="col-6">
                    <div class="expenditure-box">
                        <label>
                            <i class="fas fa-mobile-alt"></i>
                            <span>Telephone & Internet</span>
                        </label>
                        <input type="number" class="calc" id="telephone" placeholder="Enter amount (IDR)" min="0" step="1000">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- BUTTONS AND POWERED BY -->
    <div class="text-center mt-4">
        <div class="payment-button-container">
            @auth
                <button id="proceedPayment" class="btn btn-success px-4 py-2">
                    <i class="fas fa-credit-card me-2"></i>Proceed to Payment
                </button>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-success px-4 py-2">
                    <i class="fas fa-lock me-2"></i>Login to Proceed Payment
                </a>
            @endguest
        </div>

        <!-- Powered By -->
        <div class="powered-by mt-3">
            <div class="powered-by-inner">
                <span class="powered-text">Powered by</span>
                <img src="/images/nullicarbon.png" class="powered-logo">
            </div>
        </div>
    </div>

</div>

<script>
    // Emission factors (kgCO₂e per IDR 1,000,000 spent)
    // Based on average carbon intensity of different spending categories
    const expenditureEmissionFactors = {
        eatingOut: 0.4,        // kgCO₂e per IDR 1 juta (food services)
        clothing: 0.6,         // kgCO₂e per IDR 1 juta (textile production)
        electronics: 0.8,      // kgCO₂e per IDR 1 juta (electronics manufacturing)
        telephone: 0.2         // kgCO₂e per IDR 1 juta (telecom services)
    };

    // HARGA PER KG CO2
    const PRICE_PER_KG_CO2 = 15000;

    // Store total carbon globally
    let totalCarbonValue = 0;
    let totalPriceValue = 0;

    // Calculate carbon
    function calculateCarbon(){
        let total = 0;
        const details = {};
        
        // Calculate for each expenditure type
        for(const expType in expenditureEmissionFactors) {
            const amount = parseFloat(document.getElementById(expType).value) || 0;
            
            if(amount > 0) {
                // Convert amount to millions (Rp)
                const amountInMillions = amount / 1000000;
                
                // Calculate emission
                const emission = amountInMillions * expenditureEmissionFactors[expType];
                
                total += emission;
                
                details[expType] = {
                    amount: amount,
                    amountFormatted: formatRupiah(amount),
                    emission: emission.toFixed(2)
                };
            }
        }
        
        totalCarbonValue = total;
        totalPriceValue = total * PRICE_PER_KG_CO2;
        
        // Update display
        document.getElementById("totalCarbon").innerText = total.toFixed(2)+" kgCO₂e";
        document.getElementById("totalPrice").innerText = formatRupiah(totalPriceValue);
        document.getElementById("plasticEq").innerText = (total/1.67).toFixed(1)+" Kg";
        document.getElementById("treeEq").innerText = (total/3.3).toFixed(2)+" Tree(s)";
        document.getElementById("coralEq").innerText = (total/10).toFixed(2)+" Fragment";
        
        // Store in sessionStorage
        sessionStorage.setItem('carbonData', JSON.stringify({
            type: 'expenditure',
            total: total.toFixed(2),
            price: totalPriceValue,
            priceFormatted: formatRupiah(totalPriceValue),
            pricePerKg: PRICE_PER_KG_CO2,
            details: details,
            plasticEq: (total/1.67).toFixed(1),
            treeEq: (total/3.3).toFixed(2),
            coralEq: (total/10).toFixed(2),
            calculatedAt: new Date().toISOString()
        }));
    }

    // Format Rupiah
    function formatRupiah(number) {
        return 'Rp ' + Math.round(number).toLocaleString('id-ID');
    }

    // Add event listeners
    document.querySelectorAll(".calc").forEach(el=>{
        el.addEventListener("input", calculateCarbon);
        el.addEventListener("change", calculateCarbon);
    });
</script>

@auth
<script>
    // Handle Proceed to Payment button
    document.getElementById("proceedPayment").addEventListener("click", function() {
        if(totalCarbonValue === 0) {
            alert('Silakan isi data kalkulator terlebih dahulu!');
            return;
        }
        
        if(confirm(`Total emisi karbon: ${totalCarbonValue.toFixed(2)} kgCO₂e\nBiaya kompensasi: ${formatRupiah(totalPriceValue)}\n\nLanjutkan ke pembayaran?`)) {
            window.location.href = "{{ route('payment') }}";
        }
    });
</script>
@endauth

<!-- TAMBAHAN CSS -->
<style>
/* Price Section Styles - Tambahkan di setiap file kalkulator */
.price-section {
    border: 2px solid #10B981;
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.1);
}

.price-section h3 {
    font-size: 2rem;
    margin: 0;
}

@media(max-width:768px){
    .price-section h3 {
        font-size: 1.5rem;
    }
}
</style>

@endsection