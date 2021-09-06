<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Waste extends Model
{
    use HasFactory;

    protected $table = 'waste';

    public function containerContent(): BelongsTo
    {
        return $this->belongsTo(ContainerContent::class);
    }
}
