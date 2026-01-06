<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'carbon_calculation_id',
        'order_id',
        'name',
        'email',
        'phone',
        'carbon_amount',
        'subtotal',
        'admin_fee',
        'total_amount',
        'offset_program',
        'payment_method',
        'calculator_type',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'carbon_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carbonCalculation()
    {
        return $this->belongsTo(CarbonCalculation::class);
    }

    // Accessors
    public function getProgramNameAttribute()
    {
        $programs = [
            'water_turbine' => '💧 Water Turbine Development',
            'mangrove' => '🌿 Mangrove Planting',
            'waste_recycle' => '♻️ Waste Recycling Program',
            'coral_reef' => '🪸 Coral Reef Restoration',
        ];
        
        return $programs[$this->offset_program] ?? ucfirst(str_replace('_', ' ', $this->offset_program));
    }

    public function getPaymentMethodNameAttribute()
    {
        $methods = [
            'bank_transfer' => '🏦 Bank Transfer',
            'e_wallet' => '📱 E-Wallet',
            'credit_card' => '💳 Credit/Debit Card',
        ];
        
        return $methods[$this->payment_method] ?? ucfirst(str_replace('_', ' ', $this->payment_method));
    }

    // Helper method
    public static function generateOrderId()
    {
        return 'NC-' . strtoupper(uniqid()) . '-' . time();
    }
}