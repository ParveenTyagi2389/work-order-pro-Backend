<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
      use HasFactory;
    protected $table = 'sites';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false; // sites table has no created_at / updated_at

    protected $fillable = [
        'cust_type_id',
        'name',
        'bill_to_id',
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
        'latitude'  => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    /* ---------- Relationships ---------- */

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class, 'cust_type_id', 'customer_type_id');
    }

    public function billTo()
    {
        return $this->belongsTo(BillTo::class, 'bill_to_id', 'id');
    }

    public function workOrder()
    {
        return $this->hasMany(workOrder::class, 'site_id', 'id');
    }

    public function storePictures()
    {
        return $this->hasMany(StorePicture::class, 'site_id', 'id');
    }
}
