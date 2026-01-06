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
        'status'
    ];

    protected $casts = [
        'scope1_data' => 'array',
        'scope2_data' => 'array',
        'scope3_data' => 'array',
        'scope1_total' => 'decimal:2',
        'scope2_total' => 'decimal:2',
        'scope3_total' => 'decimal:2',
        'total_emission' => 'decimal:2',
        'compensation_cost' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}