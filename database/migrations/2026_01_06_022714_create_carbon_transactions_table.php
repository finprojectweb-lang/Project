<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carbon_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Transaction Info
            $table->string('transaction_id')->unique();
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending');
            $table->decimal('amount', 15, 2);
            $table->string('payment_method')->nullable();
            $table->timestamp('paid_at')->nullable();
            
            // Calculator Type
            $table->enum('calculator_type', ['transport', 'electricity', 'waste', 'event']);
            
            // Carbon Data
            $table->decimal('co2_emission', 10, 3); // dalam kg
            $table->decimal('co2_offset', 10, 3); // dalam kg
            $table->decimal('price_per_kg', 10, 2);
            
            // Calculator Specific Data (JSON)
            $table->json('calculator_data');
            
            // Offset Details
            $table->string('offset_project')->nullable();
            $table->text('offset_description')->nullable();
            $table->string('certificate_number')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['user_id', 'created_at']);
            $table->index('calculator_type');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carbon_transactions');
    }
};