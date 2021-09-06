<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProformaInvoice extends Model
{
    use HasFactory;

    public function lc(): BelongsTo
    {
        return $this->belongsTo(Lc::class, 'lc_num');
    }
}
