<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Carbon Compensation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    
    <!-- Include Header -->
    @include('partials.header')
    
    <!-- Notifikasi Success -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" 
             style="position: fixed; top: 80px; right: 20px; z-index: 9999; min-width: 350px;">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">
                            <i class="fas fa-credit-card text-success me-2"></i>
                            Kompensasi Karbon
                        </h2>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Selamat datang, <strong>{{ Auth::user()->name }}</strong>! 
                            Terima kasih telah memilih untuk berkontribusi.
                        </div>
                        
                        <form action="#" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Pilih Paket Kompensasi</label>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="card border-success">
                                            <div class="card-body text-center">
                                                <h5 class="text-success">Basic</h5>
                                                <h3 class="fw-bold">Rp 50.000</h3>
                                                <p class="small text-muted">Offset 100kg CO₂</p>
                                                <button type="button" class="btn btn-outline-success btn-sm">Pilih</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border-success">
                                            <div class="card-body text-center">
                                                <h5 class="text-success">Standard</h5>
                                                <h3 class="fw-bold">Rp 150.000</h3>
                                                <p class="small text-muted">Offset 500kg CO₂</p>
                                                <button type="button" class="btn btn-outline-success btn-sm">Pilih</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border-success">
                                            <div class="card-body text-center">
                                                <h5 class="text-success">Premium</h5>
                                                <h3 class="fw-bold">Rp 500.000</h3>
                                                <p class="small text-muted">Offset 2 ton CO₂</p>
                                                <button type="button" class="btn btn-success btn-sm">Pilih</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="fas fa-lock me-2"></i>Lanjutkan Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>