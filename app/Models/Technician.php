<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Technician extends Model
{
    use HasFactory;

    protected $table = 'technicians';

    protected $fillable = [
        'access',
        'name',
        'phone',
        'email',
        'notes',
        'active',
    ];

    protected $casts = [
        'access' => 'integer',
        'active' => 'boolean',
    ];

    public function jobs(): HasMany
    {
        return $this->hasMany(workOrder::class, 'technician_id');
    }

    public function payroll(): HasMany
    {
        return $this->hasMany(
            TechnicianPayroll::class,
            'technician_id'
        );
    }

    public function getInitialsAttribute(): string
    {
        return collect(
            preg_split('/\s+/', trim((string) $this->name))
        )
        ->filter()
        ->map(
            fn ($part) => strtoupper(substr($part, 0, 1))
        )
        ->take(2)
        ->implode('');
    }
}