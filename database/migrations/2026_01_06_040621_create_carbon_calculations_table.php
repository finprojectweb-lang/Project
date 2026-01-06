<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carbon_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['transport', 'food', 'expenditure', 'housing_energy']);
            $table->decimal('carbon_amount', 10, 2); // Total karbon dalam kgCO2e
            $table->decimal('price', 12, 2); // Harga kompensasi
            $table->integer('price_per_kg')->default(15000);
            $table->json('details'); // Detail perhitungan (transport, food, dll)
            $table->decimal('plastic_eq', 10, 2)->nullable();
            $table->decimal('tree_eq', 10, 2)->nullable();
            $table->decimal('coral_eq', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carbon_calculations');
    }
};