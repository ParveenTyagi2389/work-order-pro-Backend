<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    protected $table = 'sites';

    protected $fillable = [
        'customer_type',
        'name',
        'bill_to',
        'site_id',
        'address',
        'city',
        'state',
        'zip',
        'latitude',
        'longitude',
        'hours',
        'notes',
        'cvs_link',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // customer_type is stored as a text name in sites, not as a customer_type_id.
    public function customerType(): BelongsTo
    {
        return $this->belongsTo(CustomerType::class, 'customer_type', 'name');
    }

    public function billTo(): BelongsTo
    {
        return $this->belongsTo(BillTo::class, 'bill_to', 'id');
    }

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class, 'site_id', 'id');
    }

    public function storePictures(): HasMany
    {
        return $this->hasMany(StorePicture::class, 'site_id', 'id');
    }
}
