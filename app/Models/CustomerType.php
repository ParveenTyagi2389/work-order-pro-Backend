<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomerType extends Model
{
    protected $table = 'customer_types';

    protected $fillable = [
        'name',
    ];

    /**
     * A customer type can be assigned to many sites.
     */
    public function sites(): HasMany
    {
        return $this->hasMany(Site::class, 'customer_type');
    }
}
