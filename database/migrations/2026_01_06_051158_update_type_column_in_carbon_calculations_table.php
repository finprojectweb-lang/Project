<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Cara 1: Ubah ENUM ke VARCHAR (Recommended - Lebih Fleksibel)
        Schema::table('carbon_calculations', function (Blueprint $table) {
            $table->string('type', 50)->change();
        });
        
        // ATAU
        
        // Cara 2: Tambahkan nilai baru ke ENUM
        // DB::statement("ALTER TABLE carbon_calculations MODIFY COLUMN type ENUM('transport', 'food', 'expenditure', 'housing_energy', 'transportation', 'general', 'household', 'electricity', 'waste', 'water') NOT NULL");
    }

    public function down()
    {
        // Rollback ke ENUM original
        DB::statement("ALTER TABLE carbon_calculations MODIFY COLUMN type ENUM('transport', 'food', 'expenditure', 'housing_energy') NOT NULL");
    }
};