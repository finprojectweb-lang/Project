<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // Perusahaan
        'company_name',
        'company_siup',
        'company_email',
        'company_phone',
        'industry_type',
        'company_affiliate',
        'facility_count',
        'company_location',
        'calculation_year',
        // PIC
        'pic_name',
        'pic_position',
        'pic_email',
        'pic_phone',
        // Damage
        'damage_land',
        'damage_air',
        'damage_water',
        'damage_description',
        // Scope
        'scope1_data',
        'scope2_data',
        'scope3_data',
        'scope1_total',
        'scope2_total',
        'scope3_total',
        'total_emission',
        // Compensation
        'compensation_cost',
        'payment_scheme',
        'payment_cycles',
        'compensation_per_cycle',
        'status',
    ];

    protected $casts = [
        'scope1_data'            => 'array',
        'scope2_data'            => 'array',
        'scope3_data'            => 'array',
        'scope1_total'           => 'decimal:2',
        'scope2_total'           => 'decimal:2',
        'scope3_total'           => 'decimal:2',
        'total_emission'         => 'decimal:2',
        'compensation_cost'      => 'decimal:2',
        'compensation_per_cycle' => 'decimal:2',
        'facility_count'         => 'integer',
        'payment_cycles'         => 'integer',
        'calculation_year'       => 'integer',
        'created_at'             => 'datetime',
        'updated_at'             => 'datetime',
    ];

    // Accessor: selalu build dari kolom individual (tidak butuh kolom damage_data di DB)
    public function getDamageDataAttribute()
    {
        return [
            'land'  => $this->attributes['damage_land']  ?? 'none',
            'air'   => $this->attributes['damage_air']   ?? 'none',
            'water' => $this->attributes['damage_water'] ?? 'none',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedCompensationCost()
    {
        return 'Rp ' . number_format($this->compensation_cost, 0, ',', '.');
    }

    public function getTotalEmissionInTons()
    {
        return round($this->total_emission / 1000, 2);
    }

    public function getFormattedDate()
    {
        return $this->created_at->format('d M Y, H:i');
    }

    public function scopeYear($query, $year)
    {
        return $query->where('calculation_year', $year);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeIndustry($query, $industry)
    {
        return $query->where('industry_type', $industry);
    }
}