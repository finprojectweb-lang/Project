// database/migrations/xxxx_create_corporate_calculations_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('corporate_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_phone')->nullable();
            $table->string('industry_type');
            $table->integer('employee_count')->nullable();
            $table->year('calculation_year');
            
            // Scope 1 Data
            $table->json('scope1_data')->nullable();
            $table->decimal('scope1_total', 15, 2)->default(0);
            
            // Scope 2 Data
            $table->json('scope2_data')->nullable();
            $table->decimal('scope2_total', 15, 2)->default(0);
            
            // Scope 3 Data
            $table->json('scope3_data')->nullable();
            $table->decimal('scope3_total', 15, 2)->default(0);
            
            // Totals
            $table->decimal('total_emission', 15, 2)->default(0);
            $table->decimal('compensation_cost', 15, 2)->default(0);
            $table->string('status')->default('draft'); // draft, completed
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('corporate_calculations');
    }
};