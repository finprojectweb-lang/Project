<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_email',
        'company_phone',
        'industry_type',
        'employee_count',
        'calculation_year',
        'scope1_data',
        'scope2_data',
        'scope3_data',
        'scope1_total',
        'scope2_total',
        'scope3_total',
        'total_emission',
        'compensation_cost',
        'status',
    ];

    protected $casts = [
        'scope1_data' => 'array',
        'scope2_data' => 'array',
        'scope3_data' => 'array',
        'scope1_total' => 'decimal:2',
        'scope2_total' => 'decimal:2',
        'scope3_total' => 'decimal:2',
        'total_emission' => 'decimal:2',
        'compensation_cost' => 'decimal:2',
        'employee_count' => 'integer',
        'calculation_year' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the calculation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get emission breakdown by scope
     */
    public function getEmissionBreakdown()
    {
        return [
            'scope1' => [
                'data' => $this->scope1_data ?? [],
                'total' => $this->scope1_total,
                'percentage' => $this->total_emission > 0 
                    ? round(($this->scope1_total / $this->total_emission) * 100, 2) 
                    : 0,
            ],
            'scope2' => [
                'data' => $this->scope2_data ?? [],
                'total' => $this->scope2_total,
                'percentage' => $this->total_emission > 0 
                    ? round(($this->scope2_total / $this->total_emission) * 100, 2) 
                    : 0,
            ],
            'scope3' => [
                'data' => $this->scope3_data ?? [],
                'total' => $this->scope3_total,
                'percentage' => $this->total_emission > 0 
                    ? round(($this->scope3_total / $this->total_emission) * 100, 2) 
                    : 0,
            ],
            'total' => $this->total_emission,
        ];
    }

    /**
     * Get percentage contribution of each scope
     */
    public function getScopePercentages()
    {
        if ($this->total_emission == 0) {
            return [
                'scope1' => 0,
                'scope2' => 0,
                'scope3' => 0,
            ];
        }

        return [
            'scope1' => round(($this->scope1_total / $this->total_emission) * 100, 2),
            'scope2' => round(($this->scope2_total / $this->total_emission) * 100, 2),
            'scope3' => round(($this->scope3_total / $this->total_emission) * 100, 2),
        ];
    }

    /**
     * Get compensation cost in formatted Rupiah
     */
    public function getFormattedCompensationCost()
    {
        return 'Rp ' . number_format($this->compensation_cost, 0, ',', '.');
    }

    /**
     * Get total emission in tons
     */
    public function getTotalEmissionInTons()
    {
        return round($this->total_emission / 1000, 2);
    }

    /**
     * Get formatted date
     */
    public function getFormattedDate()
    {
        return $this->created_at->format('d M Y, H:i');
    }

    /**
     * Scope a query to only include calculations from a specific year
     */
    public function scopeYear($query, $year)
    {
        return $query->where('calculation_year', $year);
    }

    /**
     * Scope a query to only include completed calculations
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include draft calculations
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope a query to filter by industry type
     */
    public function scopeIndustry($query, $industry)
    {
        return $query->where('industry_type', $industry);
    }

    /**
     * Get emission factor details for display
     */
    public function getScope1Details()
    {
        $data = $this->scope1_data ?? [];
        $details = [];

        if (isset($data['diesel']) && $data['diesel'] > 0) {
            $details[] = [
                'type' => 'Diesel',
                'amount' => number_format($data['diesel'], 2),
                'unit' => 'liter',
                'emission' => number_format($data['diesel'] * 2.68, 2),
            ];
        }

        if (isset($data['gasoline']) && $data['gasoline'] > 0) {
            $details[] = [
                'type' => 'Gasoline',
                'amount' => number_format($data['gasoline'], 2),
                'unit' => 'liter',
                'emission' => number_format($data['gasoline'] * 2.31, 2),
            ];
        }

        if (isset($data['natural_gas']) && $data['natural_gas'] > 0) {
            $details[] = [
                'type' => 'Natural Gas',
                'amount' => number_format($data['natural_gas'], 2),
                'unit' => 'm³',
                'emission' => number_format($data['natural_gas'] * 1.96, 2),
            ];
        }

        if (isset($data['lpg']) && $data['lpg'] > 0) {
            $details[] = [
                'type' => 'LPG',
                'amount' => number_format($data['lpg'], 2),
                'unit' => 'kg',
                'emission' => number_format($data['lpg'] * 1.51, 2),
            ];
        }

        return $details;
    }

    /**
     * Get emission factor details for Scope 2
     */
    public function getScope2Details()
    {
        $data = $this->scope2_data ?? [];
        $details = [];

        if (isset($data['electricity']) && $data['electricity'] > 0) {
            $details[] = [
                'type' => 'Electricity',
                'amount' => number_format($data['electricity'], 2),
                'unit' => 'kWh',
                'emission' => number_format($data['electricity'] * 0.85, 2),
            ];
        }

        return $details;
    }

    /**
     * Get emission factor details for Scope 3
     */
    public function getScope3Details()
    {
        $data = $this->scope3_data ?? [];
        $details = [];

        if (isset($data['flight_domestic_km']) && $data['flight_domestic_km'] > 0) {
            $details[] = [
                'type' => 'Flight Domestic',
                'amount' => number_format($data['flight_domestic_km'], 2),
                'unit' => 'km',
                'emission' => number_format($data['flight_domestic_km'] * 0.255, 2),
            ];
        }

        if (isset($data['flight_international_km']) && $data['flight_international_km'] > 0) {
            $details[] = [
                'type' => 'Flight International',
                'amount' => number_format($data['flight_international_km'], 2),
                'unit' => 'km',
                'emission' => number_format($data['flight_international_km'] * 0.195, 2),
            ];
        }

        if (isset($data['shipping_ton_km']) && $data['shipping_ton_km'] > 0) {
            $details[] = [
                'type' => 'Shipping',
                'amount' => number_format($data['shipping_ton_km'], 2),
                'unit' => 'ton-km',
                'emission' => number_format($data['shipping_ton_km'] * 0.01, 2),
            ];
        }

        if (isset($data['employee_commute_km']) && $data['employee_commute_km'] > 0) {
            $details[] = [
                'type' => 'Employee Commute',
                'amount' => number_format($data['employee_commute_km'], 2),
                'unit' => 'km',
                'emission' => number_format($data['employee_commute_km'] * 0.12, 2),
            ];
        }

        return $details;
    }
}