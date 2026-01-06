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

/* Transport Section */
.transport-section {
    box-shadow: none;
    border: none;
    max-width: 800px;
    margin: 0 auto;
}

.transport-section .card-body {
    background: linear-gradient(180deg, #6AD3CA, #39CD4A);
    padding: 20px;
    border-radius:30px;
}

.transport-section .form-control {
    height: 38px;
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
}

/* Row Gap */
.transport-section .row {
    row-gap: 20px;
}

/* Column padding */
.transport-section .row .col-md-4 {
    padding: 0 8px;
}

/* Vehicle Box */
.vehicle-box {
    border: 1px solid #064E3B;
    border-radius: 12px;
    padding: 15px;
    background-color: rgba(255, 255, 255, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.vehicle-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Label with icon left and text right */
.vehicle-box label {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    cursor: pointer;
}

.vehicle-box .icon-text {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 4px;
}

.vehicle-box .icon-text img.vehicle-icon {
    width: 24px;
    height: 24px;
}

.vehicle-box .avg-text {
    font-size: 0.8rem;
    color: #555;
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

    <!-- TRANSPORT SECTION -->
    <div class="card border-0 rounded-4 transport-section">
        <div class="card-body">
            <h5 class="fw-bold mb-3 section-title">Transportation</h5>

            <div class="row g-3">
                <!-- MOTORCYCLE -->
                <div class="col-md-4">
                    <div class="vehicle-box">
                        <label class="form-label">
                            <div class="icon-text">
                                <img src="/images/icons/motorcycle.png" alt="Motorcycle" class="vehicle-icon">
                                <span>Motorcycle</span>
                            </div>
                            <div class="avg-text">Average Distance per Day</div>
                        </label>
                        <input type="number" class="form-control calc" id="motorcycle" placeholder="Type here">
                    </div>
                </div>

                <!-- CAR -->
                <div class="col-md-4">
                    <div class="vehicle-box">
                        <label class="form-label">
                            <div class="icon-text">
                                <img src="/images/icons/car.png" alt="Car" class="vehicle-icon">
                                <span>Car</span>
                            </div>
                            <div class="avg-text">Average Distance per Day</div>
                        </label>
                        <input type="number" class="form-control calc" id="car" placeholder="Type here">
                    </div>
                </div>

                <!-- BUS -->
                <div class="col-md-4">
                    <div class="vehicle-box">
                        <label class="form-label">
                            <div class="icon-text">
                                <img src="/images/icons/bus.png" alt="Bus" class="vehicle-icon">
                                <span>Bus</span>
                            </div>
                            <div class="avg-text">Average Distance per Day</div>
                        </label>
                        <input type="number" class="form-control calc" id="bus" placeholder="Type here">
                    </div>
                </div>

                <!-- TRAIN ROUTE -->
                <div class="col-md-4">
                    <div class="vehicle-box">
                        <label class="form-label">
                            <div class="icon-text">
                                <img src="/images/icons/train.png" alt="Train" class="vehicle-icon">
                                <span>Train Route</span>
                            </div>
                            <div class="avg-text">Average Distance per Day</div>
                        </label>
                        <select id="trainRoute" class="form-select">
                            <option value="">-- Select Train Route --</option>
                            <option value="GMR-BDG">Gambir → Bandung</option>
                            <option value="GMR-YK">Gambir → Yogyakarta</option>
                            <option value="BDG-CMHI">Bandung → Cirebon</option>
                            <option value="YK-SLO">Yogyakarta → Solo</option>
                        </select>
                        <input type="hidden" id="train">
                    </div>
                </div>

                <!-- TAXI -->
                <div class="col-md-4">
                    <div class="vehicle-box">
                        <label class="form-label">
                            <div class="icon-text">
                                <img src="/images/icons/taxi.png" alt="Taxi" class="vehicle-icon">
                                <span>Taxi</span>
                            </div>
                            <div class="avg-text">Average Distance per Day</div>
                        </label>
                        <input type="number" class="form-control calc" id="taxi" placeholder="Type here">
                    </div>
                </div>

                <!-- PLANE ROUTE -->
                <div class="col-md-4">
                    <div class="vehicle-box">
                        <label class="form-label">
                            <div class="icon-text">
                                <img src="/images/icons/airplane.png" alt="Plane" class="vehicle-icon">
                                <span>Flight Route</span>
                            </div>
                            <div class="avg-text">Average Distance per Day</div>
                        </label>
                        <select id="planeRoute" class="form-select">
                            <option value="">-- Select Flight Route --</option>
                            <option value="CGK-SUB">Jakarta (CGK) → Surabaya (SUB)</option>
                            <option value="CGK-DPS">Jakarta (CGK) → Bali (DPS)</option>
                            <option value="SUB-BPN">Surabaya (SUB) → Balikpapan (BPN)</option>
                            <option value="DPS-LOP">Bali (DPS) → Lombok (LOP)</option>
                        </select>
                        <input type="hidden" id="plane">
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
    // Emission factors
    const factors = {
        motorcycle: 0.103,
        car: 0.153,
        bus: 0.102,
        train: 0.041,
        taxi: 0.192,
        plane: 0.255
    };

    // Predefined distances
    const trainRoutes = {
        "GMR-BDG": 150,
        "GMR-YK": 520,
        "BDG-CMHI": 110,
        "YK-SLO": 63
    };

    const planeRoutes = {
        "CGK-SUB": 660,
        "CGK-DPS": 983,
        "SUB-BPN": 748,
        "DPS-LOP": 116
    };

    // Store total carbon globally
    let totalCarbonValue = 0;

    // Event listeners
    document.getElementById("trainRoute").addEventListener("change", e=>{
        document.getElementById("train").value = trainRoutes[e.target.value] || 0;
        calculateCarbon();
    });

    document.getElementById("planeRoute").addEventListener("change", e=>{
        document.getElementById("plane").value = planeRoutes[e.target.value] || 0;
        calculateCarbon();
    });

    // Calculate carbon
    function calculateCarbon(){
        let total = 0;
        const details = {};
        
        for(const id in factors){
            const val = parseFloat(document.getElementById(id).value) || 0;
            const emission = val * factors[id];
            total += emission;
            
            if(val > 0) {
                details[id] = {
                    distance: val,
                    emission: emission.toFixed(2)
                };
            }
        }
        
        totalCarbonValue = total;
        
        document.getElementById("totalCarbon").innerText = total.toFixed(2)+" kgCO₂e";
        document.getElementById("plasticEq").innerText = (total/1.67).toFixed(1)+" Kg";
        document.getElementById("treeEq").innerText   = (total/3.3).toFixed(2)+" Tree(s)";
        document.getElementById("coralEq").innerText  = (total/10).toFixed(2)+" Fragment";
        
        // Store in sessionStorage for payment page
        sessionStorage.setItem('carbonData', JSON.stringify({
            type: 'transport',
            total: total.toFixed(2),
            details: details,
            plasticEq: (total/1.67).toFixed(1),
            treeEq: (total/3.3).toFixed(2),
            coralEq: (total/10).toFixed(2),
            calculatedAt: new Date().toISOString()
        }));
    }

    document.querySelectorAll(".calc").forEach(el=>{
        el.addEventListener("input", calculateCarbon);
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