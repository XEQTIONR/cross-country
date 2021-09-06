<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $casts = [
        'payment_amount' => 'float',
        'refund_amount' => 'float',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_num');
    }
}
