<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class workOrder extends Model
{
    //


    public function technician(): BelongsTo
    {
        return $this->belongsTo(Technician::class);
    }

    public function jobCode(): BelongsTo
    {
        return $this->belongsTo(JobCode::class);
    }
}
