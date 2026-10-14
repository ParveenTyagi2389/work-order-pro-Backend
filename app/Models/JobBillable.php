<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JobBillable extends Model
{
    protected $table = 'job_billables';
    protected $fillable = ['work_order_id', 'check_in', 'check_out', 'description'];
    protected $casts = ['check_in' => 'datetime', 'check_out' => 'datetime'];
    public function workOrder() { return $this->belongsTo(WorkOrder::class, 'work_order_id', 'id'); }
}
