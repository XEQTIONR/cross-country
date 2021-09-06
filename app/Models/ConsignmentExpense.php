<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsignmentExpense extends Model
{
    use HasFactory;

    public function consignment(): BelongsTo
    {
        return $this->belongsTo(Consignment::class, 'bol');
    }
}
