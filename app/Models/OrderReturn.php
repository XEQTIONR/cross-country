<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderReturn extends Model
{
    use HasFactory;

    protected $casts = [
      'unit_price' => 'float'
    ];

    public function containerContent(): BelongsTo
    {
        return $this->belongsTo(ContainerContent::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_num');
    }
}
