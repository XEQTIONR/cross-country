<?php

namespace App\Models;

use App\Http\Resources\TyreResource;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tyre extends Model
{
    use HasFactory;
    use Searchable;

    public static $searchable = [
        'id',
        'brand',
        'size',
        'pattern',
        'lisi',
    ];

    protected static $resourceClass = TyreResource::class;
}
