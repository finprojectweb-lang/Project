<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarbonTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'status',
        'amount',
        'payment_method',
        'paid_at',
        'calculator_type',
        'co2_emission',
        'co2_offset',
        'price_per_kg',
        'calculator_data',
        'offset_project',
        'offset_description',
        'certificate_number',
    ];

    protected $casts = [
        'calculator_data' => 'array',
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'co2_emission' => 'decimal:3',
        'co2_offset' => 'decimal:3',
        'price_per_kg' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('calculator_type', $type);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    public function scopeThisYear($query)
    {
        return $query->whereYear('created_at', now()->year);
    }

    // Accessors
    public function getCalculatorTypeNameAttribute()
    {
        $types = [
            'transport' => 'Transportasi',
            'electricity' => 'Listrik',
            'waste' => 'Limbah',
            'event' => 'Event',
        ];

        return $types[$this->calculator_type] ?? $this->calculator_type;
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'paid' => 'success',
            'failed' => 'danger',
            'cancelled' => 'secondary',
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Berhasil',
            'failed' => 'Gagal',
            'cancelled' => 'Dibatalkan',
        ];

        return $texts[$this->status] ?? $this->status;
    }

    public function getEfficiencyAttribute()
    {
        if ($this->co2_offset <= 0) return 0;
        return $this->amount / $this->co2_offset;
    }
}