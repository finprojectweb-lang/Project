<?php

namespace Database\Seeders;

use App\Models\CarbonTransaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class CarbonTransactionSeeder extends Seeder
{
    public function run(): void
    {
        // PILIH SALAH SATU METODE DI BAWAH:
        
        // Metode 1: Ambil user terakhir (recommended untuk testing)
        // $user = User::latest()->first();
        
        // Metode 2: Pakai email spesifik (ganti dengan email Google Anda)
        $user = User::where('email', 'cuaravent@gmail.com')->first();
        
        // Metode 3: Pakai ID spesifik
        // $user = User::find(1);
        
        // Validasi user
        if (!$user) {
            $this->command->error('❌ Tidak ada user di database. Silakan login terlebih dahulu.');
            $this->command->error('💡 Atau jalankan: php artisan tinker lalu ketik: User::all()');
            return;
        }

        $this->command->info('✓ Menggunakan user: ' . $user->name . ' (' . $user->email . ')');

        // Cek apakah user ini sudah punya transaksi
        $existingTransactions = CarbonTransaction::where('user_id', $user->id)->count();
        if ($existingTransactions > 0) {
            $this->command->warn('⚠️  User ini sudah punya ' . $existingTransactions . ' transaksi.');
            $this->command->warn('💡 Ingin menambah data lagi? (y/n)');
            // Untuk safety, kita skip jika sudah ada data
            // Hapus baris return di bawah jika ingin menambah data lagi
            // return;
        }

        // Sample data untuk berbagai jenis kalkulator
        $transactions = [
            // Transport
            [
                'user_id' => $user->id,
                'transaction_id' => 'TRX-' . strtoupper(uniqid()),
                'status' => 'paid',
                'amount' => 150000,
                'payment_method' => 'Credit Card',
                'paid_at' => now()->subDays(5),
                'calculator_type' => 'transport',
                'co2_emission' => 45.5,
                'co2_offset' => 45.5,
                'price_per_kg' => 3296.70,
                'calculator_data' => [
                    'vehicle_type' => 'Mobil Bensin',
                    'distance' => 150,
                    'frequency' => 'Harian',
                    'duration_days' => 30,
                ],
                'offset_project' => 'Reforestasi Kalimantan',
                'offset_description' => 'Penanaman 50 pohon di hutan Kalimantan',
                'certificate_number' => 'CERT-2025-' . rand(1000, 9999),
                'created_at' => now()->subDays(5),
            ],
            // Electricity
            [
                'user_id' => $user->id,
                'transaction_id' => 'TRX-' . strtoupper(uniqid()),
                'status' => 'paid',
                'amount' => 250000,
                'payment_method' => 'Bank Transfer',
                'paid_at' => now()->subDays(15),
                'calculator_type' => 'electricity',
                'co2_emission' => 78.2,
                'co2_offset' => 78.2,
                'price_per_kg' => 3196.42,
                'calculator_data' => [
                    'monthly_kwh' => 350,
                    'household_size' => 4,
                    'region' => 'Jawa Barat',
                ],
                'offset_project' => 'Solar Panel Installation',
                'offset_description' => 'Instalasi panel surya untuk 10 rumah',
                'certificate_number' => 'CERT-2025-' . rand(1000, 9999),
                'created_at' => now()->subDays(15),
            ],
            // Waste
            [
                'user_id' => $user->id,
                'transaction_id' => 'TRX-' . strtoupper(uniqid()),
                'status' => 'paid',
                'amount' => 100000,
                'payment_method' => 'E-Wallet',
                'paid_at' => now()->subDays(30),
                'calculator_type' => 'waste',
                'co2_emission' => 32.8,
                'co2_offset' => 32.8,
                'price_per_kg' => 3048.78,
                'calculator_data' => [
                    'waste_type' => 'Organik',
                    'daily_waste_kg' => 2.5,
                    'recycling_percentage' => 30,
                ],
                'offset_project' => 'Waste Management Program',
                'offset_description' => 'Program pengolahan limbah organik menjadi kompos',
                'certificate_number' => 'CERT-2025-' . rand(1000, 9999),
                'created_at' => now()->subDays(30),
            ],
            // Event
            [
                'user_id' => $user->id,
                'transaction_id' => 'TRX-' . strtoupper(uniqid()),
                'status' => 'paid',
                'amount' => 500000,
                'payment_method' => 'Credit Card',
                'paid_at' => now()->subDays(45),
                'calculator_type' => 'event',
                'co2_emission' => 156.5,
                'co2_offset' => 156.5,
                'price_per_kg' => 3194.89,
                'calculator_data' => [
                    'event_type' => 'Konferensi',
                    'attendees' => 200,
                    'duration_days' => 2,
                    'venue_type' => 'Hotel',
                    'catering' => 'Yes',
                ],
                'offset_project' => 'Green Energy Project',
                'offset_description' => 'Proyek energi terbarukan untuk komunitas',
                'certificate_number' => 'CERT-2025-' . rand(1000, 9999),
                'created_at' => now()->subDays(45),
            ],
            // Additional transactions for better charts
            [
                'user_id' => $user->id,
                'transaction_id' => 'TRX-' . strtoupper(uniqid()),
                'status' => 'paid',
                'amount' => 180000,
                'payment_method' => 'Bank Transfer',
                'paid_at' => now()->subDays(60),
                'calculator_type' => 'transport',
                'co2_emission' => 52.3,
                'co2_offset' => 52.3,
                'price_per_kg' => 3441.49,
                'calculator_data' => [
                    'vehicle_type' => 'Motor',
                    'distance' => 80,
                    'frequency' => 'Harian',
                    'duration_days' => 20,
                ],
                'offset_project' => 'Reforestasi Sumatra',
                'offset_description' => 'Penanaman pohon di Sumatra Utara',
                'certificate_number' => 'CERT-2025-' . rand(1000, 9999),
                'created_at' => now()->subDays(60),
            ],
            // Pending transaction
            [
                'user_id' => $user->id,
                'transaction_id' => 'TRX-' . strtoupper(uniqid()),
                'status' => 'pending',
                'amount' => 200000,
                'payment_method' => null,
                'paid_at' => null,
                'calculator_type' => 'electricity',
                'co2_emission' => 65.0,
                'co2_offset' => 65.0,
                'price_per_kg' => 3076.92,
                'calculator_data' => [
                    'monthly_kwh' => 300,
                    'household_size' => 3,
                    'region' => 'DKI Jakarta',
                ],
                'offset_project' => null,
                'offset_description' => null,
                'certificate_number' => null,
                'created_at' => now()->subHours(2),
            ],
        ];

        $this->command->info('🔄 Membuat transaksi sample...');
        
        foreach ($transactions as $index => $transaction) {
            CarbonTransaction::create($transaction);
            $this->command->info('  ✓ Transaksi ' . ($index + 1) . ' dibuat');
        }

        $this->command->info('');
        $this->command->info('🎉 Berhasil membuat ' . count($transactions) . ' transaksi sample!');
        $this->command->info('💡 Akses: http://localhost:8000/transactions');
    }
}