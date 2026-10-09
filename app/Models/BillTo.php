<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BillTo extends Model
{
    protected $table = 'bill_tos';

    protected $fillable = [
        'bill_travel',
        'bill_labor',
        'bill_fuel',
        'bill_name',
        'bill_address',
        'bill_account',
        'bill_po',
        'bill_city',
        'bill_state',
        'bill_zip',
        'bill_phone',
    ];

    protected $casts = [
        'bill_travel' => 'decimal:2',
        'bill_labor' => 'decimal:2',
        'bill_fuel' => 'decimal:2',
    ];

    public function emails(): HasMany
    {
        return $this->hasMany(
            BillToEmail::class,
            'bill_to',
            'id'
        );
    }

    public function sites(): HasMany
    {
        return $this->hasMany(
            Site::class,
            'bill_to',
            'id'
        );
    }
}