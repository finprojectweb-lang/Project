<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan dengan: php artisan migrate
     *
     * Perubahan:
     * - offset_program  → text  (untuk simpan JSON array program)
     * - program_count   → tambah kolom (jumlah program yang dipilih)
     * - split_amount    → tambah kolom (nominal per program setelah dibagi)
     * - tax             → tambah kolom (pajak Rp 30/kg CO2)
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            // Ubah offset_program ke text agar bisa simpan JSON
            $table->text('offset_program')->change();

            // Kolom program split
            if (!Schema::hasColumn('payments', 'program_count')) {
                $table->unsignedTinyInteger('program_count')->default(1)->after('offset_program');
            }

            if (!Schema::hasColumn('payments', 'split_amount')) {
                $table->decimal('split_amount', 15, 2)->default(0)->after('program_count');
            }

            // Kolom pajak
            if (!Schema::hasColumn('payments', 'tax')) {
                $table->decimal('tax', 15, 2)->default(0)->after('admin_fee');
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('offset_program')->change();

            if (Schema::hasColumn('payments', 'program_count')) {
                $table->dropColumn('program_count');
            }

            if (Schema::hasColumn('payments', 'split_amount')) {
                $table->dropColumn('split_amount');
            }

            if (Schema::hasColumn('payments', 'tax')) {
                $table->dropColumn('tax');
            }
        });
    }
};