<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ══════════════════════════════════════════════════════════════
        // 1. TAMBAH KOLOM BARU ke tabel corporate_calculations
        //    (kolom lama tidak disentuh sama sekali)
        // ══════════════════════════════════════════════════════════════
        Schema::table('corporate_calculations', function (Blueprint $table) {

            // Identitas perusahaan (form baru)
            $table->string('company_siup')->nullable()->after('company_name');
            $table->string('company_affiliate')->nullable()->after('industry_type');
            $table->unsignedInteger('facility_count')->default(1)->after('company_affiliate');
            $table->string('company_location')->nullable()->after('facility_count');

            // Tingkat kerusakan lingkungan (pengganti scope1/2/3 input manual)
            $table->enum('damage_land',  ['none', 'low', 'medium', 'high'])->default('none')->after('company_location');
            $table->enum('damage_air',   ['none', 'low', 'medium', 'high'])->default('none')->after('damage_land');
            $table->enum('damage_water', ['none', 'low', 'medium', 'high'])->default('none')->after('damage_air');
            $table->text('damage_description')->nullable()->after('damage_water');

            // Skema pembayaran bertahap
            $table->enum('payment_scheme', ['annual', 'semi_annual', 'quarterly'])->default('annual')->after('compensation_cost');
            $table->unsignedTinyInteger('payment_cycles')->default(1)->after('payment_scheme');
            $table->decimal('compensation_per_cycle', 15, 2)->default(0)->after('payment_cycles');
        });

        // ══════════════════════════════════════════════════════════════
        // 2. BUAT TABEL BARU: corporate_payments
        //    Jadwal & riwayat pembayaran per siklus
        // ══════════════════════════════════════════════════════════════
        Schema::create('corporate_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calculation_id')
                  ->constrained('corporate_calculations')
                  ->cascadeOnDelete();
            $table->unsignedSmallInteger('cycle_number');        // siklus ke-1, ke-2, dst
            $table->decimal('amount', 15, 2);                   // nominal Rp
            $table->enum('status', ['scheduled', 'pending', 'paid', 'overdue'])->default('scheduled');
            $table->date('due_date');                            // tanggal jatuh tempo
            $table->timestamp('paid_at')->nullable();            // tanggal dibayar
            $table->string('payment_ref')->nullable();           // nomor referensi transfer
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // ══════════════════════════════════════════════════════════════
        // 3. BUAT TABEL BARU: restoration_programs
        //    Program restorasi & progress realtime per perusahaan
        // ══════════════════════════════════════════════════════════════
        Schema::create('restoration_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calculation_id')
                  ->constrained('corporate_calculations')
                  ->cascadeOnDelete();
            $table->string('pillar');                            // land | air | water
            $table->string('program_name');
            $table->string('icon')->nullable();                  // emoji icon
            $table->string('color', 10)->nullable();             // hex color untuk bar
            $table->string('level');                             // low | medium | high
            $table->decimal('progress_pct', 5, 2)->default(0);  // 0.00 - 100.00
            $table->decimal('co2e_offset', 12, 2)->default(0);  // ton CO2e yang sudah di-offset
            $table->date('target_date')->nullable();             // target selesai
            $table->timestamps();

            $table->index('calculation_id');
        });

        // ══════════════════════════════════════════════════════════════
        // 4. BUAT TABEL BARU: restoration_activities
        //    Log kegiatan lapangan yang diverifikasi auditor KLH
        // ══════════════════════════════════════════════════════════════
        Schema::create('restoration_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calculation_id')
                  ->constrained('corporate_calculations')
                  ->cascadeOnDelete();
            $table->string('activity_type');                     // planting | river_cleanup | air_monitoring, dll
            $table->string('activity_name');                     // nama kegiatan
            $table->string('location');                          // lokasi kegiatan
            $table->date('activity_date');                       // tanggal pelaksanaan
            $table->decimal('co2e_offset', 10, 2)->default(0);  // ton CO2e yang di-offset dari kegiatan ini
            $table->enum('status', ['planned', 'in_progress', 'completed', 'verified'])->default('planned');
            $table->text('description')->nullable();
            $table->timestamp('verified_at')->nullable();        // tanggal diverifikasi auditor
            $table->timestamps();

            $table->index('calculation_id');
        });
    }

    public function down(): void
    {
        // Hapus tabel baru (urutan terbalik karena ada foreign key)
        Schema::dropIfExists('restoration_activities');
        Schema::dropIfExists('restoration_programs');
        Schema::dropIfExists('corporate_payments');

        // Hapus kolom baru dari corporate_calculations
        Schema::table('corporate_calculations', function (Blueprint $table) {
            $table->dropColumn([
                'company_siup',
                'company_affiliate',
                'facility_count',
                'company_location',
                'damage_land',
                'damage_air',
                'damage_water',
                'damage_description',
                'payment_scheme',
                'payment_cycles',
                'compensation_per_cycle',
            ]);
        });
    }
};