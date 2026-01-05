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

/* Housing & Energy Section */
.housing-energy-section {
    box-shadow: none;
    border: none;
    max-width: 400px; /* Dikurangi dari 800px menjadi 400px */
    margin: 0 auto;
}

.housing-energy-section .card-body {
    background: linear-gradient(180deg, #6AD3CA, #39CD4A);
    padding: 20px; /* Dikurangi dari 30px menjadi 20px */
    border-radius: 20px; /* Dikurangi dari 30px menjadi 20px */
}

/* Section Box */
.section-box {
    background-color: rgba(255, 255, 255, 0.15);
    border-radius: 15px; /* Dikurangi dari 20px menjadi 15px */
    padding: 15px; /* Dikurangi dari 25px menjadi 15px */
    margin-bottom: 15px; /* Dikurangi dari 20px menjadi 15px */
}

.section-box h6 {
    color: #064E3B;
    font-weight: 700;
    font-size: 1rem; /* Dikurangi dari 1.1rem menjadi 1rem */
    margin-bottom: 15px; /* Dikurangi dari 20px menjadi 15px */
    text-align: center;
    padding-bottom: 10px;
    border-bottom: 1px solid #064E3B;
}

/* Form Group */
.form-group {
    margin-bottom: 12px; /* Dikurangi dari 15px menjadi 12px */
}

.form-group label {
    display: block;
    color: #064E3B;
    font-weight: 600;
    margin-bottom: 6px; /* Dikurangi dari 8px menjadi 6px */
    font-size: 0.85rem; /* Dikurangi dari 0.95rem menjadi 0.85rem */
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 8px 12px; /* Dikurangi dari 10px 15px menjadi 8px 12px */
    border: 2px solid rgba(6, 78, 59, 0.2);
    border-radius: 10px; /* Dikurangi dari 12px menjadi 10px */
    font-size: 0.85rem; /* Dikurangi dari 0.9rem menjadi 0.85rem */
    transition: all 0.3s ease;
    background-color: white;
}

.form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: #064E3B;
    box-shadow: 0 0 0 3px rgba(6, 78, 59, 0.1);
}

.form-group input::placeholder {
    color: #999;
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
    
    .housing-energy-section {
        max-width: 100%; /* Full width pada mobile */
    }
    
    .housing-energy-section .card-body {
        padding: 15px; /* Dikurangi untuk mobile */
    }
    
    .section-box {
        padding: 12px; /* Dikurangi untuk mobile */
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

    <!-- HOUSING & ENERGY SECTION -->
    <div class="card border-0 rounded-4 housing-energy-section">
        <div class="card-body">
            
            <!-- HOUSING SECTION -->
            <div class="section-box">
                <h6>Housing</h6>
                
                <div class="form-group">
                    <label for="householdPeople">Number of people in the household</label>
                    <input type="number" class="calc" id="householdPeople" placeholder="Enter number of people" min="1">
                </div>
                
                <div class="form-group">
                    <label for="houseSize">Size of housing (m²)</label>
                    <input type="number" class="calc" id="houseSize" placeholder="Enter house size in m²" min="1">
                </div>
            </div>

            <!-- ENERGY SECTION -->
            <div class="section-box">
                <h6>Energy</h6>
                
                <div class="form-group">
                    <label for="electricityKwh">Electricity (kWh/month)</label>
                    <input type="number" class="calc" id="electricityKwh" placeholder="Enter kWh per month" min="0" step="0.01">
                </div>
                
                <div class="form-group">
                    <label for="energyResource">Energy Resources</label>
                    <select id="energyResource" class="calc">
                        <option value="">-- Select Energy Resource --</option>
                        <option value="coal">Coal</option>
                        <option value="natural_gas">Natural Gas</option>
                        <option value="lpg">LPG (Liquefied Petroleum Gas)</option>
                        <option value="solar">Solar Energy</option>
                        <option value="wind">Wind Energy</option>
                        <option value="hydro">Hydroelectric</option>
                        <option value="biomass">Biomass</option>
                    </select>
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
    // Emission factors
    const emissionFactors = {
        // Housing base emission per person per m²
        housingBase: 0.5, // kgCO₂e per m² per month
        
        // Electricity emission factor (kgCO₂e per kWh)
        // Based on average grid emission factor in Indonesia
        electricityPerKwh: 0.85, // kgCO₂e per kWh
        
        // Energy Resources emission factors (kgCO₂e per kWh equivalent)
        energyResources: {
            coal: 0.95,           // Highest emission
            natural_gas: 0.45,    // Medium-low emission
            lpg: 0.23,            // Lower emission
            solar: 0.05,          // Very low emission (manufacturing impact)
            wind: 0.02,           // Very low emission
            hydro: 0.02,          // Very low emission
            biomass: 0.18         // Low-medium emission (carbon neutral if sustainable)
        }
    };

    // Store total carbon globally
    let totalCarbonValue = 0;

    // Calculate carbon
    function calculateCarbon(){
        let total = 0;
        const details = {};
        
        // Housing calculation
        const householdPeople = parseFloat(document.getElementById("householdPeople").value) || 0;
        const houseSize = parseFloat(document.getElementById("houseSize").value) || 0;
        
        if(householdPeople > 0 && houseSize > 0) {
            const housingEmission = (houseSize * emissionFactors.housingBase) / householdPeople;
            total += housingEmission;
            details.housing = {
                people: householdPeople,
                size: houseSize,
                emission: housingEmission.toFixed(2)
            };
        }
        
        // Electricity calculation (user input kWh)
        const electricityKwh = parseFloat(document.getElementById("electricityKwh").value) || 0;
        if(electricityKwh > 0) {
            const electricityEmission = electricityKwh * emissionFactors.electricityPerKwh;
            total += electricityEmission;
            details.electricity = {
                kwh: electricityKwh,
                emission: electricityEmission.toFixed(2)
            };
        }
        
        // Energy Resource calculation
        const energyResource = document.getElementById("energyResource").value;
        if(energyResource && emissionFactors.energyResources[energyResource] !== undefined) {
            // Assume 100 kWh equivalent usage for energy resource
            // User can adjust this based on their actual consumption
            const resourceUsage = 100; // kWh equivalent
            const resourceEmission = resourceUsage * emissionFactors.energyResources[energyResource];
            total += resourceEmission;
            details.energyResource = {
                type: energyResource,
                usage: resourceUsage,
                emission: resourceEmission.toFixed(2)
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
            type: 'housing_energy',
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
    // Handle Proceed to Payment button
    document.getElementById("proceedPayment").addEventListener("click", function() {
        if(totalCarbonValue === 0) {
            alert('Silakan isi data kalkulator terlebih dahulu!');
            return;
        }
        
        // Show confirmation
        if(confirm(`Total emisi karbon Anda: ${totalCarbonValue.toFixed(2)} kgCO₂e\n\nLanjutkan ke pembayaran?`)) {
            window.location.href = "{{ route('payment') }}";
        }
    });
</script>
@endauth

@endsection