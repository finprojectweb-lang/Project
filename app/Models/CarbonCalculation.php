<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarbonCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'carbon_amount',
        'price',
        'price_per_kg',
        'details',
        'plastic_eq',
        'tree_eq',
        'coral_eq'
    ];

    protected $casts = [
        'details' => 'array',
        'carbon_amount' => 'decimal:2',
        'price' => 'decimal:2',
        'plastic_eq' => 'decimal:2',
        'tree_eq' => 'decimal:2',
        'coral_eq' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}