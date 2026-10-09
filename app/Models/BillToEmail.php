<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillToEmail extends Model
{
    protected $table = 'bill_to_emails';

    protected $fillable = [
        'bill_to',
        'bill_email',
        'bill_name',
        'bill_active',
    ];

    protected $casts = [
        'bill_active' => 'boolean',
    ];

    public function billTo(): BelongsTo
    {
        return $this->belongsTo(
            BillTo::class,
            'bill_to',
            'id'
        );
    }
}