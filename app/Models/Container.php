<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Container extends Model
{
    use HasFactory;

    protected $primaryKey = 'container_num';

    public function consignment(): BelongsTo
    {
        return $this->belongsTo(Consignment::class, 'bol');
    }

    public function contents(): HasMany
    {
        return $this->hasMany(ContainerContent::class, 'container_num');
    }
}
