@extends('layouts.app')

@section('content')

<style>
/* JARAK DARI NAVBAR (sesuaikan tinggi navbar kamu) */
body{
    padding-top: 80px;
    overflow-y: auto;
    overflow-x: hidden;
}

body::-webkit-scrollbar {
    display: none;
}
/* RESULT BOX STYLE */
.result-box{
    background: linear-gradient(#d9fff0,#c0ffe4);
    border: 2px solid #8be0b5;
}
.powered-by{
    display: block;          /* 🔹 berdiri sendiri */
    margin-top: 0;         /* jarak kecil dari tombol */
    line-height: 1;
}

.powered-by-inner{
    display: inline-flex;    /* teks + logo tetap sejajar */
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
    body{ padding-top: 95px; }   /* navbar biasanya lebih tinggi di mobile */
    .result-box h2{font-size:26px}
}
</style>


<div class="container py-4">

    <h4 class="text-center mb-3 fw-bold">Calculate Your Carbon Footprint</h4>

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


    <!-- TRANSPORT SECTION -->
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Transportation</h5>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Motorcycle (km/day)</label>
                    <input type="number" class="form-control calc" id="motorcycle">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Car (km/day)</label>
                    <input type="number" class="form-control calc" id="car">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Bus (km/day)</label>
                    <input type="number" class="form-control calc" id="bus">
                </div>

                <!-- TRAIN ROUTE -->
                <div class="col-md-4">
                    <label class="form-label">Train Route</label>
                    <select id="trainRoute" class="form-select">
                        <option value="">-- Select Train Route --</option>
                        <option value="GMR-BDG">Gambir → Bandung</option>
                        <option value="GMR-YK">Gambir → Yogyakarta</option>
                        <option value="BDG-CMHI">Bandung → Cirebon</option>
                        <option value="YK-SLO">Yogyakarta → Solo</option>
                    </select>
                </div>

                <input type="hidden" id="train">

                <div class="col-md-4">
                    <label class="form-label">Bicycle / Walk (km/day)</label>
                    <input type="number" class="form-control calc" id="bike">
                </div>

                <!-- PLANE ROUTE -->
                <div class="col-md-4">
                    <label class="form-label">Flight Route</label>
                    <select id="planeRoute" class="form-select">
                        <option value="">-- Select Flight Route --</option>
                        <option value="CGK-SUB">Jakarta (CGK) → Surabaya (SUB)</option>
                        <option value="CGK-DPS">Jakarta (CGK) → Bali (DPS)</option>
                        <option value="SUB-BPN">Surabaya (SUB) → Balikpapan (BPN)</option>
                        <option value="DPS-LOP">Bali (DPS) → Lombok (LOP)</option>
                    </select>
                </div>

                <input type="hidden" id="plane">

            </div>
        </div>
    </div>


    <div class="text-center mt-3">

        @auth
            <button id="proceedPayment" class="btn btn-success px-4 py-2">
                Proceed to Payment
            </button>
        @endauth

        @guest
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="btn btn-outline-success px-4 py-2">
                    Login to Proceed Payment
                </a>
            @else
                <button class="btn btn-outline-secondary px-4 py-2" disabled>
                    Login feature coming soon
                </button>
            @endif
        @endguest

        <div class="powered-by">
            <div class="powered-by-inner">
                <span class="powered-text">Powered by</span>
                <img src="/images/nullicarbon.png" class="powered-logo">
            </div>
        </div>

    </div>

</div>


<script>
// emission factors (kgCO2e per km)
const factors = {
    motorcycle: 0.082,
    car: 0.192,
    bus: 0.105,
    train: 0.041,
    bike: 0,
    plane: 0.255
};

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

document.getElementById("trainRoute").addEventListener("change", e=>{
    document.getElementById("train").value = trainRoutes[e.target.value] || 0;
    calculateCarbon();
});

document.getElementById("planeRoute").addEventListener("change", e=>{
    document.getElementById("plane").value = planeRoutes[e.target.value] || 0;
    calculateCarbon();
});

function calculateCarbon(){
    let total = 0;
    for(const id in factors){
        const val = parseFloat(document.getElementById(id).value) || 0;
        total += val * factors[id];
    }

    document.getElementById("totalCarbon").innerText = total.toFixed(2)+" kgCO₂e";
    document.getElementById("plasticEq").innerText = (total/1.67).toFixed(1)+" Kg";
    document.getElementById("treeEq").innerText   = (total/3.3).toFixed(2)+" Tree(s)";
    document.getElementById("coralEq").innerText  = (total/10).toFixed(2)+" Fragment";
}

document.querySelectorAll(".calc").forEach(el=>{
    el.addEventListener("input", calculateCarbon);
});
</script>

@endsection
