<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TechnicianPayroll extends Model {
 protected $table='technician_payrolls';
    protected $fillable=[
        'technician_id',
        'time_in_out',
        'authorized',
        'paid',
        'notes',
        'paid_check'
    ];
    protected $casts=[
        'time_in_out'=>'datetime',
        'authorized'=>'boolean',
        'paid'=>'boolean',
        'paid_check'=>'boolean'
    ];
    public function technician()
    {
        return $this->belongsTo(Technician::class,'technician_id','id'); 
    }
}
