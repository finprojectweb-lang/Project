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

/* Food Section */
.food-section {
    box-shadow: none;
    border: none;
    max-width: 800px;
    margin: 0 auto;
}

.food-section .card-body {
    background: linear-gradient(180deg, #6AD3CA, #39CD4A);
    padding: 20px;
    border-radius: 30px;
}

/* Row Gap */
.food-section .row {
    row-gap: 20px;
}

/* Column padding */
.food-section .row .col-4,
.food-section .row .col-6 {
    padding: 0 8px;
}

/* Food Box (similar to vehicle-box) */
.food-box {
    border: 1px solid #064E3B;
    border-radius: 12px;
    padding: 15px;
    background-color: rgba(255, 255, 255, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
    height: 100%;
}

.food-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.food-box label {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    cursor: pointer;
}

.food-box .icon-text {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 4px;
}

.food-box .icon-text img.food-icon {
    width: 24px;
    height: 24px;
}

.food-box .label-text {
    color: #064E3B;
    font-weight: 600;
    font-size: 0.875rem;
}

.food-box input {
    width: 100%;
    padding: 8px 12px;
    border: 2px solid rgba(6, 78, 59, 0.2);
    border-radius: 8px;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    background-color: white;
}

.food-box input:focus {
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
    
    .food-section {
        max-width: 100%;
    }
    
    .food-section .card-body {
        padding: 15px;
    }
    
    .section-box {
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

    <!-- FOOD SECTION -->
    <div class="card border-0 rounded-4 food-section">
        <div class="card-body">
            <h5 class="fw-bold mb-3 section-title">Food</h5>
            
            <div class="row g-3">
                <!-- Beef or Pork -->
                <div class="col-4">
                    <div class="food-box">
                        <label>
                            <div class="icon-text">
                                <img src="/images/icons/meat.png" alt="Beef" class="food-icon">
                                <span class="label-text">Beef(kg/week)</span>
                            </div>
                        </label>
                        <input type="number" class="calc" id="beefPork" placeholder="Type here" min="0" step="0.1">
                    </div>
                </div>
                
                <!-- Chicken or Fish -->
                <div class="col-4">
                    <div class="food-box">
                        <label>
                            <div class="icon-text">
                                <img src="/images/icons/fish.png" alt="Chicken" class="food-icon">
                                <span class="label-text">Fish (kg/week)</span>
                            </div>
                        </label>
                        <input type="number" class="calc" id="chickenFish" placeholder="Type here" min="0" step="0.1">
                    </div>
                </div>
                
                <!-- Vegetable -->
                <div class="col-4">
                    <div class="food-box">
                        <label>
                            <div class="icon-text">
                                <img src="/images/icons/vegetable.png" alt="Vegetable" class="food-icon">
                                <span class="label-text">Vegetable (kg/week)</span>
                            </div>
                        </label>
                        <input type="number" class="calc" id="vegetable" placeholder="Type here" min="0" step="0.1">
                    </div>
                </div>
                
                <!-- Dairy Products -->
                <div class="col-4">
                    <div class="food-box">
                        <label>
                            <div class="icon-text">
                                <img src="/images/icons/dairy.png" alt="Dairy" class="food-icon">
                                <span class="label-text">Dairy products (kg/week)</span>
                            </div>
                        </label>
                        <input type="number" class="calc" id="dairy" placeholder="Type here" min="0" step="0.1">
                    </div>
                </div>
                
                <!-- Grains -->
                <div class="col-4">
                    <div class="food-box">
                        <label>
                            <div class="icon-text">
                                <img src="/images/icons/grains.png" alt="Grains" class="food-icon">
                                <span class="label-text">Grains (kg/week)</span>
                            </div>
                        </label>
                        <input type="number" class="calc" id="grains" placeholder="Type here" min="0" step="0.1">
                    </div>
                </div>
                
                <!-- Processed Food -->
                <div class="col-4">
                    <div class="food-box">
                        <label>
                            <div class="icon-text">
                                <img src="/images/icons/profood.png" alt="Processed" class="food-icon">
                                <span class="label-text">Processed food (kg/week)</span>
                            </div>
                        </label>
                        <input type="number" class="calc" id="processedFood" placeholder="Type here" min="0" step="0.1">
                    </div>
                </div>
                
                <!-- For how many people -->
                <div class="col-6">
                    <div class="food-box">
                        <label>
                            <div class="icon-text">
                                <img src="/images/icons/people.png" alt="People" class="food-icon">
                                <span class="label-text">For how many people</span>
                            </div>
                        </label>
                        <input type="number" class="calc" id="numPeople" placeholder="Type here" min="1" step="1" value="1">
                    </div>
                </div>
                
                <!-- For how long (days) -->
                <div class="col-6">
                    <div class="food-box">
                        <label>
                            <div class="icon-text">
                                <img src="/images/icons/days.png" alt="Days" class="food-icon">
                                <span class="label-text">For how long (days)</span>
                            </div>
                        </label>
                        <input type="number" class="calc" id="numDays" placeholder="Type here" min="1" step="1" value="7">
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
    // Emission factors for food (kgCO₂e per kg of food)
    const emissionFactors = {
        // Food emission factors per kg
        beefPork: 27.0,        // Beef and pork have highest emissions
        chickenFish: 6.9,      // Chicken and fish have medium emissions
        vegetable: 2.0,        // Vegetables have low emissions
        dairy: 13.5,           // Dairy products (milk, cheese, yogurt)
        grains: 2.5,           // Rice, wheat, bread, pasta
        processedFood: 5.0     // Processed and packaged foods
    };

    // Store total carbon globally
    let totalCarbonValue = 0;

    // Calculate carbon
    function calculateCarbon(){
        let total = 0;
        const details = {};
        
        // Get all input values (consumption in kg)
        const beefPork = parseFloat(document.getElementById("beefPork").value) || 0;
        const chickenFish = parseFloat(document.getElementById("chickenFish").value) || 0;
        const vegetable = parseFloat(document.getElementById("vegetable").value) || 0;
        const dairy = parseFloat(document.getElementById("dairy").value) || 0;
        const grains = parseFloat(document.getElementById("grains").value) || 0;
        const processedFood = parseFloat(document.getElementById("processedFood").value) || 0;
        
        // Get number of people and days
        const numPeople = parseFloat(document.getElementById("numPeople").value) || 1;
        const numDays = parseFloat(document.getElementById("numDays").value) || 7;
        
        // Calculate total food consumption
        const totalFoodPerWeek = beefPork + chickenFish + vegetable + dairy + grains + processedFood;
        
        // Calculate emissions for each food category per week
        const beefPorkEmission = beefPork * emissionFactors.beefPork;
        const chickenFishEmission = chickenFish * emissionFactors.chickenFish;
        const vegetableEmission = vegetable * emissionFactors.vegetable;
        const dairyEmission = dairy * emissionFactors.dairy;
        const grainsEmission = grains * emissionFactors.grains;
        const processedFoodEmission = processedFood * emissionFactors.processedFood;
        
        // Sum all emissions for one person per week
        const weeklyEmissionPerPerson = beefPorkEmission + chickenFishEmission + vegetableEmission + 
                                       dairyEmission + grainsEmission + processedFoodEmission;
        
        // Calculate total emissions: multiply by number of people and adjust for number of days
        // (numDays / 7) converts weekly data to the specified number of days
        total = weeklyEmissionPerPerson * numPeople * (numDays / 7);
        
        // Store details
        details.beefPork = { weight: beefPork, emission: beefPorkEmission.toFixed(2) };
        details.chickenFish = { weight: chickenFish, emission: chickenFishEmission.toFixed(2) };
        details.vegetable = { weight: vegetable, emission: vegetableEmission.toFixed(2) };
        details.dairy = { weight: dairy, emission: dairyEmission.toFixed(2) };
        details.grains = { weight: grains, emission: grainsEmission.toFixed(2) };
        details.processedFood = { weight: processedFood, emission: processedFoodEmission.toFixed(2) };
        details.numPeople = numPeople;
        details.numDays = numDays;
        details.weeklyEmissionPerPerson = weeklyEmissionPerPerson.toFixed(2);
        details.totalEmission = total.toFixed(2);
        
        totalCarbonValue = total;
        
        // Update display
        document.getElementById("totalCarbon").innerText = total.toFixed(2)+" kgCO₂e";
        document.getElementById("plasticEq").innerText = (total/1.67).toFixed(1)+" Kg";
        document.getElementById("treeEq").innerText   = (total/3.3).toFixed(2)+" Tree(s)";
        document.getElementById("coralEq").innerText  = (total/10).toFixed(2)+" Fragment";
        
        // Store in sessionStorage for payment page
        sessionStorage.setItem('carbonData', JSON.stringify({
            type: 'food',
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
    
    // Calculate on page load with default values
    calculateCarbon();
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