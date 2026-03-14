<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'carbon_calculation_id',
        'corporate_calculation_id', // TAMBAHAN BARU
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
        'transaction_id', // TAMBAHAN (jika perlu)
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

    // RELATIONSHIP BARU UNTUK CORPORATE
    public function corporateCalculation()
    {
        return $this->belongsTo(CorporateCalculation::class);
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

    // METHOD BARU: Get calculation details (support both types)
    public function getCalculationAttribute()
    {
        if ($this->calculator_type === 'corporate' && $this->corporateCalculation) {
            return $this->corporateCalculation;
        }
        
        return $this->carbonCalculation;
    }

    // METHOD BARU: Get company or user name
    public function getCalculationNameAttribute()
    {
        if ($this->calculator_type === 'corporate' && $this->corporateCalculation) {
            return $this->corporateCalculation->company_name;
        }
        
        return $this->user->name ?? $this->name;
    }

    // Helper method
    public static function generateOrderId()
    {
        return 'NC-' . strtoupper(uniqid()) . '-' . time();
    }

    // SCOPE BARU: Filter by calculator type
    public function scopeCorporate($query)
    {
        return $query->where('calculator_type', 'corporate');
    }

    public function scopeGeneral($query)
    {
        return $query->where('calculator_type', '!=', 'corporate');
    }

    // SCOPE BARU: Filter by status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeSuccess($query)
    {
        return $query->where('status', 'success');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }
}