<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Tambah column corporate_calculation_id setelah carbon_calculation_id
            $table->foreignId('corporate_calculation_id')
                  ->nullable()
                  ->after('carbon_calculation_id')
                  ->constrained('corporate_calculations')
                  ->onDelete('cascade');
            
            // Tambah transaction_id jika belum ada (opsional)
            if (!Schema::hasColumn('payments', 'transaction_id')) {
                $table->string('transaction_id')->nullable()->after('status');
            }
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['corporate_calculation_id']);
            $table->dropColumn('corporate_calculation_id');
            
            if (Schema::hasColumn('payments', 'transaction_id')) {
                $table->dropColumn('transaction_id');
            }
        });
    }
};