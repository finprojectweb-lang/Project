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

    <!-- RESULT PANEL -->
    <div class="result-box text-center p-4 rounded-4 mb-4">
        <h6>Your Total Carbon Footprint</h6>
        <h2 id="totalCarbon">0 kgCO₂e</h2>

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
    // Emission factors for expenditure (kgCO₂e per IDR spent)
    // Based on average carbon intensity of consumer goods and services in Indonesia
    const emissionFactors = {
        // kgCO₂e per 1,000,000 IDR (per million rupiah)
        eatingOut: 150,          // Restaurant meals, food delivery (high emissions from transport + preparation)
        clothing: 200,           // Textile production, fast fashion (high water + energy use)
        electronics: 300,        // Manufacturing electronics (very high emissions)
        telephone: 50            // Telecommunication services (lower emissions, mostly infrastructure)
    };

    // Store total carbon globally
    let totalCarbonValue = 0;

    // Calculate carbon
    function calculateCarbon(){
        let total = 0;
        const details = {};
        
        // Get all input values (monthly expenditure in IDR)
        const eatingOut = parseFloat(document.getElementById("eatingOut").value) || 0;
        const clothing = parseFloat(document.getElementById("clothing").value) || 0;
        const electronics = parseFloat(document.getElementById("electronics").value) || 0;
        const telephone = parseFloat(document.getElementById("telephone").value) || 0;
        
        // Calculate emissions for each category
        // Formula: (Amount in IDR / 1,000,000) × Emission Factor
        const eatingOutEmission = (eatingOut / 1000000) * emissionFactors.eatingOut;
        const clothingEmission = (clothing / 1000000) * emissionFactors.clothing;
        const electronicsEmission = (electronics / 1000000) * emissionFactors.electronics;
        const telephoneEmission = (telephone / 1000000) * emissionFactors.telephone;
        
        // Sum all emissions
        total = eatingOutEmission + clothingEmission + electronicsEmission + telephoneEmission;
        
        // Store details
        if(eatingOut > 0) {
            details.eatingOut = { 
                amount: eatingOut.toLocaleString('id-ID'), 
                emission: eatingOutEmission.toFixed(2) 
            };
        }
        if(clothing > 0) {
            details.clothing = { 
                amount: clothing.toLocaleString('id-ID'), 
                emission: clothingEmission.toFixed(2) 
            };
        }
        if(electronics > 0) {
            details.electronics = { 
                amount: electronics.toLocaleString('id-ID'), 
                emission: electronicsEmission.toFixed(2) 
            };
        }
        if(telephone > 0) {
            details.telephone = { 
                amount: telephone.toLocaleString('id-ID'), 
                emission: telephoneEmission.toFixed(2) 
            };
        }
        
        totalCarbonValue = total;
        
        // Update display
        document.getElementById("totalCarbon").innerText = total.toFixed(2)+" kgCO₂e";
        document.getElementById("plasticEq").innerText = (total/1.67).toFixed(1)+" Kg";
        document.getElementById("treeEq").innerText   = (total/3.3).toFixed(2)+" Tree(s)";
        document.getElementById("coralEq").innerText  = (total/10).toFixed(2)+" Fragment";
        
        // Store in sessionStorage for payment page
        sessionStorage.setItem('carbonData', JSON.stringify({
            type: 'expenditure',
            total: total.toFixed(2),
            details: details,
            plasticEq: (total/1.67).toFixed(1),
            treeEq: (total/3.3).toFixed(2),
            coralEq: (total/10).toFixed(2),
            calculatedAt: new Date().toISOString()
        }));
    }

    // Add event listeners to all inputs
    document.querySelectorAll(".calc").forEach(el=>{
        el.addEventListener("input", calculateCarbon);
        el.addEventListener("change", calculateCarbon);
    });
</script>

@auth
<script>
    document.getElementById("proceedPayment")?.addEventListener("click", function() {
        // DEBUG: Cek nilai totalCarbonValue
        console.log("totalCarbonValue:", totalCarbonValue);
        
        if(!totalCarbonValue || totalCarbonValue === 0) {
            alert('Silakan isi data kalkulator terlebih dahulu!');
            return;
        }
        
        if(confirm(`Total emisi karbon Anda: ${totalCarbonValue.toFixed(2)} kgCO₂e\n\nLanjutkan ke pembayaran?`)) {
            const url = "{{ route('payment.show') }}?carbon_amount=" + totalCarbonValue.toFixed(2) + "&type=transportation";
            console.log("Redirecting to:", url); // DEBUG
            window.location.href = url;
        }
    });
</script>
@endauth

@endsection