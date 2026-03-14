<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('corporate_calculations', function (Blueprint $table) {

            // Kolom perusahaan yang belum ada
            if (!Schema::hasColumn('corporate_calculations', 'company_siup')) {
                $table->string('company_siup', 100)->nullable()->after('company_name');
            }
            if (!Schema::hasColumn('corporate_calculations', 'company_affiliate')) {
                $table->string('company_affiliate', 255)->nullable()->after('industry_type');
            }
            if (!Schema::hasColumn('corporate_calculations', 'facility_count')) {
                $table->integer('facility_count')->default(1)->after('company_affiliate');
            }
            if (!Schema::hasColumn('corporate_calculations', 'company_location')) {
                $table->string('company_location', 255)->nullable()->after('facility_count');
            }

            // PIC columns
            if (!Schema::hasColumn('corporate_calculations', 'pic_name')) {
                $table->string('pic_name', 255)->nullable()->after('company_location');
            }
            if (!Schema::hasColumn('corporate_calculations', 'pic_position')) {
                $table->string('pic_position', 255)->nullable()->after('pic_name');
            }
            if (!Schema::hasColumn('corporate_calculations', 'pic_email')) {
                $table->string('pic_email', 255)->nullable()->after('pic_position');
            }
            if (!Schema::hasColumn('corporate_calculations', 'pic_phone')) {
                $table->string('pic_phone', 30)->nullable()->after('pic_email');
            }

            // Damage columns
            if (!Schema::hasColumn('corporate_calculations', 'damage_land')) {
                $table->string('damage_land', 10)->default('none')->after('calculation_year');
            }
            if (!Schema::hasColumn('corporate_calculations', 'damage_air')) {
                $table->string('damage_air', 10)->default('none')->after('damage_land');
            }
            if (!Schema::hasColumn('corporate_calculations', 'damage_water')) {
                $table->string('damage_water', 10)->default('none')->after('damage_air');
            }
            if (!Schema::hasColumn('corporate_calculations', 'damage_description')) {
                $table->text('damage_description')->nullable()->after('damage_water');
            }
            if (!Schema::hasColumn('corporate_calculations', 'damage_data')) {
                $table->json('damage_data')->nullable()->after('damage_description');
            }

            // Payment columns
            if (!Schema::hasColumn('corporate_calculations', 'payment_scheme')) {
                $table->string('payment_scheme', 20)->default('annual')->after('compensation_cost');
            }
            if (!Schema::hasColumn('corporate_calculations', 'payment_cycles')) {
                $table->integer('payment_cycles')->default(1)->after('payment_scheme');
            }
            if (!Schema::hasColumn('corporate_calculations', 'compensation_per_cycle')) {
                $table->decimal('compensation_per_cycle', 20, 2)->default(0)->after('payment_cycles');
            }
        });
    }

    public function down(): void
    {
        Schema::table('corporate_calculations', function (Blueprint $table) {
            $cols = [
                'company_siup', 'company_affiliate', 'facility_count', 'company_location',
                'pic_name', 'pic_position', 'pic_email', 'pic_phone',
                'damage_land', 'damage_air', 'damage_water', 'damage_description', 'damage_data',
                'payment_scheme', 'payment_cycles', 'compensation_per_cycle',
            ];
            foreach ($cols as $col) {
                if (Schema::hasColumn('corporate_calculations', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};