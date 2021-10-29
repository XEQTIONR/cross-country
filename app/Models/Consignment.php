<?php

namespace App\Models;

use App\Http\Resources\ConsignmentResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\Searchable;

class Consignment extends Model
{
    use HasFactory;
    use Searchable;

    protected $primaryKey = 'bol';

    public static $searchable = ['bol', 'lc_num'];

    protected static $resourceClass = ConsignmentResource::class;

    protected $casts = [
        'bol'   => 'string',
        'lc_num'=> 'string',
        'value' => 'float',
        'tax'   => 'float',
    ];

    protected $dates = [
        'land_date',
    ];

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
