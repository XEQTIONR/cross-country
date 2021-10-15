<?php

namespace App\Models;

use App\Http\Resources\OrderResource;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Customer extends Model
{
    use HasFactory;
    use Searchable;

    public static $searchable = [
        'id',
        'name',
        'address',
        'phone'
    ];

    protected static $resourceClass = OrderResource::class;

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function orderedItems(): HasManyThrough
    {
        return $this->hasManyThrough(
            OrderContent::class,
            Order::class,
            'customer_id',
            'order_num'

        );
    }

    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(
            Payment::class,
            Order::class,
            'customer_id',
            'order_num',
        )->orderBy('created_at', 'desc');
    }
}
