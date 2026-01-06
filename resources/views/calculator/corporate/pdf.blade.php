<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Emisi Karbon - {{ $calculation->company_name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* HEADER */
        .header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 10px;
        }

        .logo {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        /* COMPANY INFO */
        .company-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .company-info h2 {
            font-size: 18px;
            color: #064e3b;
            margin-bottom: 15px;
            border-bottom: 2px solid #10b981;
            padding-bottom: 8px;
        }

        .info-grid {
            display: table;
            width: 100%;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            font-weight: bold;
            color: #64748b;
            padding: 8px 0;
            width: 35%;
        }

        .info-value {
            display: table-cell;
            padding: 8px 0;
            color: #1e293b;
        }

        /* SUMMARY BOX */
        .summary-box {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 25px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .summary-value {
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .summary-unit {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 15px;
        }

        .summary-desc {
            font-size: 13px;
            opacity: 0.85;
            margin-bottom: 20px;
        }

        .compensation-value {
            background: rgba(255,255,255,0.2);
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
        }

        .compensation-amount {
            font-size: 22px;
            font-weight: bold;
            margin-top: 5px;
        }

        /* SCOPE BREAKDOWN */
        .section-title {
            font-size: 18px;
            color: #064e3b;
            font-weight: bold;
            margin: 25px 0 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #10b981;
        }

        .scope-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .scope-item {
            display: table-row;
        }

        .scope-header {
            display: table-cell;
            background: #f8f9fa;
            padding: 12px;
            font-weight: bold;
            border-bottom: 2px solid #e2e8f0;
        }

        .scope-cell {
            display: table-cell;
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .scope-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            color: white;
            margin-right: 8px;
        }

        .badge-scope1 { background: #ef4444; }
        .badge-scope2 { background: #3b82f6; }
        .badge-scope3 { background: #a855f7; }

        .emission-value {
            font-size: 18px;
            font-weight: bold;
            color: #10b981;
        }

        .percentage {
            color: #64748b;
            font-size: 11px;
        }

        /* DETAILS TABLE */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details-table th {
            background: #f8f9fa;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border-bottom: 2px solid #e2e8f0;
        }

        .details-table td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        /* RECOMMENDATIONS */
        .recommendations {
            background: #fef3c7;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #f59e0b;
        }

        .recommendations h3 {
            font-size: 16px;
            color: #92400e;
            margin-bottom: 12px;
        }

        .recommendations ul {
            list-style: none;
            padding-left: 0;
        }

        .recommendations li {
            padding: 8px 0 8px 25px;
            position: relative;
            color: #78350f;
            font-size: 11px;
            line-height: 1.5;
        }

        .recommendations li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #f59e0b;
            font-weight: bold;
            font-size: 14px;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            padding-top: 25px;
            margin-top: 30px;
            border-top: 2px solid #e2e8f0;
            color: #64748b;
            font-size: 11px;
        }

        .footer-info {
            margin-bottom: 10px;
        }

        .footer-date {
            font-weight: bold;
            color: #1e293b;
        }

        /* PAGE BREAK */
        .page-break {
            page-break-after: always;
        }

        /* CHART PLACEHOLDER */
        .chart-info {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            border: 2px dashed #cbd5e1;
            margin: 20px 0;
        }

        .chart-info-text {
            color: #64748b;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- HEADER -->
        <div class="header">
            <div class="logo">🌍</div>
            <h1>LAPORAN EMISI KARBON KORPORAT</h1>
            <p>Berdasarkan GHG Protocol</p>
        </div>

        <!-- COMPANY INFO -->
        <div class="company-info">
            <h2>Informasi Perusahaan</h2>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Nama Perusahaan:</div>
                    <div class="info-value">{{ $calculation->company_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value">{{ $calculation->company_email }}</div>
                </div>
                @if($calculation->company_phone)
                <div class="info-row">
                    <div class="info-label">Telepon:</div>
                    <div class="info-value">{{ $calculation->company_phone }}</div>
                </div>
                @endif
                <div class="info-row">
                    <div class="info-label">Jenis Industri:</div>
                    <div class="info-value">{{ ucfirst($calculation->industry_type) }}</div>
                </div>
                @if($calculation->employee_count)
                <div class="info-row">
                    <div class="info-label">Jumlah Karyawan:</div>
                    <div class="info-value">{{ number_format($calculation->employee_count) }} orang</div>
                </div>
                @endif
                <div class="info-row">
                    <div class="info-label">Tahun Perhitungan:</div>
                    <div class="info-value">{{ $calculation->calculation_year }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Laporan:</div>
                    <div class="info-value">{{ $calculation->created_at->format('d F Y') }}</div>
                </div>
            </div>
        </div>

        <!-- SUMMARY -->
        <div class="summary-box">
            <div class="summary-value">{{ number_format($calculation->total_emission / 1000, 2) }}</div>
            <div class="summary-unit">Ton CO₂e per Tahun</div>
            <div class="summary-desc">Total emisi karbon dari semua aktivitas perusahaan di tahun {{ $calculation->calculation_year }}</div>
            <div class="compensation-value">
                <div>Estimasi Biaya Kompensasi Karbon</div>
                <div class="compensation-amount">Rp {{ number_format($calculation->compensation_cost, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- SCOPE BREAKDOWN -->
        <h2 class="section-title">Rincian Emisi per Scope</h2>
        
        <div class="scope-grid">
            <div class="scope-item">
                <div class="scope-header">Scope</div>
                <div class="scope-header">Emisi (Ton CO₂e)</div>
                <div class="scope-header">Persentase</div>
            </div>
            <div class="scope-item">
                <div class="scope-cell">
                    <span class="scope-badge badge-scope1">SCOPE 1</span>
                    <strong>Emisi Langsung</strong>
                </div>
                <div class="scope-cell">
                    <span class="emission-value">{{ number_format($calculation->scope1_total / 1000, 2) }}</span>
                </div>
                <div class="scope-cell">
                    <span class="percentage">{{ number_format(($calculation->scope1_total / $calculation->total_emission) * 100, 1) }}%</span>
                </div>
            </div>
            <div class="scope-item">
                <div class="scope-cell">
                    <span class="scope-badge badge-scope2">SCOPE 2</span>
                    <strong>Emisi Energi</strong>
                </div>
                <div class="scope-cell">
                    <span class="emission-value">{{ number_format($calculation->scope2_total / 1000, 2) }}</span>
                </div>
                <div class="scope-cell">
                    <span class="percentage">{{ number_format(($calculation->scope2_total / $calculation->total_emission) * 100, 1) }}%</span>
                </div>
            </div>
            <div class="scope-item">
                <div class="scope-cell">
                    <span class="scope-badge badge-scope3">SCOPE 3</span>
                    <strong>Emisi Rantai Nilai</strong>
                </div>
                <div class="scope-cell">
                    <span class="emission-value">{{ number_format($calculation->scope3_total / 1000, 2) }}</span>
                </div>
                <div class="scope-cell">
                    <span class="percentage">{{ number_format(($calculation->scope3_total / $calculation->total_emission) * 100, 1) }}%</span>
                </div>
            </div>
        </div>

        <!-- SCOPE 1 DETAILS -->
        @if($calculation->scope1_data && array_sum($calculation->scope1_data) > 0)
        <h3 class="section-title" style="font-size: 14px; margin-top: 20px;">Detail Scope 1 - Emisi Langsung</h3>
        <table class="details-table">
            <thead>
                <tr>
                    <th>Sumber Emisi</th>
                    <th>Konsumsi</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($calculation->scope1_data as $key => $value)
                    @if($value > 0)
                    <tr>
                        <td>
                            @if($key == 'diesel') Solar/Diesel
                            @elseif($key == 'gasoline') Bensin
                            @elseif($key == 'natural_gas') Gas Alam
                            @elseif($key == 'lpg') LPG
                            @endif
                        </td>
                        <td>{{ number_format($value, 2, ',', '.') }}</td>
                        <td>
                            @if($key == 'diesel' || $key == 'gasoline') Liter
                            @elseif($key == 'natural_gas') m³
                            @elseif($key == 'lpg') Kg
                            @endif
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        @endif

        <!-- SCOPE 2 DETAILS -->
        @if($calculation->scope2_data && array_sum($calculation->scope2_data) > 0)
        <h3 class="section-title" style="font-size: 14px; margin-top: 20px;">Detail Scope 2 - Emisi Energi</h3>
        <table class="details-table">
            <thead>
                <tr>
                    <th>Sumber Emisi</th>
                    <th>Konsumsi</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($calculation->scope2_data as $key => $value)
                    @if($value > 0)
                    <tr>
                        <td>Listrik PLN</td>
                        <td>{{ number_format($value, 2, ',', '.') }}</td>
                        <td>kWh</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        @endif

        <!-- SCOPE 3 DETAILS -->
        @if($calculation->scope3_data && array_sum($calculation->scope3_data) > 0)
        <h3 class="section-title" style="font-size: 14px; margin-top: 20px;">Detail Scope 3 - Emisi Rantai Nilai</h3>
        <table class="details-table">
            <thead>
                <tr>
                    <th>Sumber Emisi</th>
                    <th>Konsumsi</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($calculation->scope3_data as $key => $value)
                    @if($value > 0)
                    <tr>
                        <td>
                            @if($key == 'flight_domestic_km') Penerbangan Domestik
                            @elseif($key == 'flight_international_km') Penerbangan Internasional
                            @elseif($key == 'shipping_ton_km') Pengiriman Barang
                            @elseif($key == 'employee_commute_km') Komuter Karyawan
                            @endif
                        </td>
                        <td>{{ number_format($value, 2, ',', '.') }}</td>
                        <td>
                            @if(str_contains($key, 'ton_km')) Ton-Km
                            @else Km
                            @endif
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        @endif

        <!-- CHART INFO -->
        <div class="chart-info">
            <p class="chart-info-text">
                📊 Grafik visualisasi emisi tersedia di versi web.<br>
                Akses laporan online untuk melihat chart interaktif.
            </p>
        </div>

        <!-- PAGE BREAK -->
        <div class="page-break"></div>

        <!-- RECOMMENDATIONS -->
        <h2 class="section-title">Rekomendasi Pengurangan Emisi</h2>
        <div class="recommendations">
            <h3>💡 Langkah-langkah yang Dapat Dilakukan</h3>
            <ul>
                @if($calculation->scope1_total > $calculation->scope2_total)
                    <li>Pertimbangkan untuk menggunakan kendaraan listrik atau hybrid untuk mengurangi emisi Scope 1</li>
                    <li>Lakukan maintenance rutin pada kendaraan dan mesin untuk meningkatkan efisiensi bahan bakar</li>
                @endif
                
                @if($calculation->scope2_total > 0)
                    <li>Instalasi panel surya dapat mengurangi ketergantungan pada listrik PLN dan menurunkan emisi Scope 2</li>
                    <li>Gunakan peralatan hemat energi dan implementasikan kebijakan penghematan listrik di seluruh fasilitas</li>
                @endif
                
                @if($calculation->scope3_total > 0)
                    <li>Dorong penggunaan transportasi umum atau carpool untuk karyawan guna mengurangi emisi komuter</li>
                    <li>Gunakan video conference untuk mengurangi perjalanan dinas yang tidak perlu</li>
                    <li>Optimalkan rute pengiriman dan gunakan transportasi yang lebih efisien</li>
                @endif
                
                <li>Lakukan audit energi berkala untuk mengidentifikasi area yang perlu diperbaiki</li>
                <li>Set target pengurangan emisi 20-30% dalam 3-5 tahun ke depan</li>
                <li>Edukasi karyawan tentang praktik-praktik ramah lingkungan di tempat kerja</li>
                <li>Pertimbangkan untuk mendapatkan sertifikasi ISO 14001 untuk manajemen lingkungan</li>
                <li>Investasi dalam program offsetting karbon melalui proyek kehutanan atau energi terbarukan</li>
            </ul>
        </div>

        <!-- METHODOLOGY -->
        <h2 class="section-title">Metodologi Perhitungan</h2>
        <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; font-size: 11px; line-height: 1.6;">
            <p style="margin-bottom: 10px;">
                <strong>Standar:</strong> Perhitungan emisi karbon ini menggunakan metodologi GHG Protocol Corporate Standard, 
                yang merupakan standar internasional yang paling banyak digunakan untuk perhitungan dan pelaporan emisi GRK.
            </p>
            <p style="margin-bottom: 10px;">
                <strong>Faktor Emisi:</strong> Faktor emisi yang digunakan mengacu pada standar Indonesia dan IPCC Guidelines untuk 
                konversi konsumsi bahan bakar dan energi menjadi emisi CO₂ ekuivalen.
            </p>
            <p>
                <strong>Cakupan:</strong> Laporan ini mencakup Scope 1 (emisi langsung), Scope 2 (emisi tidak langsung dari energi), 
                dan Scope 3 terpilih (perjalanan bisnis, komuter karyawan, dan logistik).
            </p>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <div class="footer-info">
                Laporan ini dihasilkan secara otomatis oleh Sistem Kalkulator Emisi Karbon Korporat
            </div>
            <div class="footer-date">
                Dicetak pada: {{ now()->format('d F Y, H:i') }} WIB
            </div>
            <div style="margin-top: 10px; color: #10b981; font-weight: bold;">
                🌱 Bersama Kita Ciptakan Masa Depan yang Lebih Hijau
            </div>
        </div>
    </div>
</body>
</html>