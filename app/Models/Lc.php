<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lc extends Model
{
    use HasFactory;

    protected $primaryKey = 'lc_num';

    public function proformaInvoice(): HasMany
    {
        return $this->hasMany(ProformaInvoice::class, 'lc_num');
    }

    public function consignments(): HasMany
    {
        return $this->hasMany(Consignment::class, 'lc_num');
    }

}
