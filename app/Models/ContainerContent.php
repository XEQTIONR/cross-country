<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContainerContent extends Model
{
    use HasFactory;

    protected $casts = [
        'unit_price'   => 'float',
        'total_tax'    => 'float',
        'total_weight' => 'float',
    ];

    public function container(): BelongsTo
    {
        return $this->belongsTo(Container::class, 'container_num');
    }

    public function tyre(): BelongsTo
    {
        return $this->belongsTo(Tyre::class);
    }

    public function orderContents()
    {
        return $this->hasMany(OrderContent::class, 'container_content_id');
    }
}
