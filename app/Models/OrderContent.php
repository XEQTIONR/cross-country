<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderContent extends Model
{
    use HasFactory;

    protected $casts = [
        'unit_price' => 'float',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_num');
    }
    public function containerContent(): BelongsTo
    {
        return $this->belongsTo(ContainerContent::class);
    }

}
