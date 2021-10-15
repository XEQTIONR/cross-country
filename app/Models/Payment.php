<?php

namespace App\Models;

use App\Http\Resources\PaymentResource;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    use Searchable;

    protected $casts = [
        'payment_amount' => 'float',
        'refund_amount' => 'float',
    ];

    public static $searchable = [
        'id',
        'order_num',
        'payment_amount',
        'refund_amount',
    ];

    protected static $resourceClass = PaymentResource::class;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_num');
    }
}
