<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lc extends Model
{
    use HasFactory;

    protected $primaryKey = 'lc_num';

    protected $casts = [
        'lc_num'            => 'string',
        'foreign_amount'    => 'float',
        'foreign_expense'   => 'float',
        'domestic_expense'  => 'float',
        'exchange_rate'     => 'float',
    ];

    protected $dates = [
        'date_issued',
        'date_expiry',
    ];

    public function proformaInvoice(): HasMany
    {
        return $this->hasMany(ProformaInvoice::class, 'lc_num');
    }

    public function consignments(): HasMany
    {
        return $this->hasMany(Consignment::class, 'lc_num');
    }

}
