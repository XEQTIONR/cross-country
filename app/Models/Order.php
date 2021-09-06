<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_num';

    protected $casts = [
        'discount_percentage' => 'float',
        'discount_amount'     => 'float',
        'tax_percentage'      => 'float',
        'tax_amount'          => 'float',
    ];

    protected $dates = [
      'order_date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(OrderContent::class, 'order_num');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'order_num');
    }

    public function returns(): HasMany
    {
        return $this->hasMany( OrderReturn::class, 'order_num');
    }
}
