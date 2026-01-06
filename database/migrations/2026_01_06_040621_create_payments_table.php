<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('carbon_calculation_id')->nullable()->constrained()->onDelete('set null');
            $table->string('order_id')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->decimal('carbon_amount', 10, 2);
            $table->decimal('subtotal', 12, 2);
            $table->decimal('admin_fee', 12, 2)->default(5000);
            $table->decimal('total_amount', 12, 2);
            $table->enum('offset_program', ['water_turbine', 'mangrove', 'waste_recycle', 'coral_reef']);
            $table->enum('payment_method', ['bank_transfer', 'e_wallet', 'credit_card']);
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending');
            $table->string('calculator_type')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};