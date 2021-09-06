<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consignment extends Model
{
    use HasFactory;

    protected $primaryKey = 'bol';

    public function lc(): BelongsTo
    {
        return $this->belongsTo(Lc::class, 'lc_num');
    }

    public function containers(): HasMany
    {
        return $this->hasMany(Container::class, 'bol');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(ConsignmentExpense::class, 'bol');
    }
}
