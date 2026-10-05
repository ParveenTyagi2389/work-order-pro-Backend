<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    use HasFactory;

    protected $table = 'customer_types';
    protected $primaryKey = 'customer_type_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /* ---------- Relationships ---------- */

    public function sites()
    {
        return $this->hasMany(Site::class, 'cust_type_id', 'customer_type_id');
    }
}