<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JobFlatRate extends Model
{
    protected $table = 'job_flat_rates';
    protected $fillable = ['work_order_id', 'rate', 'description'];
    protected $casts = ['rate' => 'decimal:2'];
    public function workOrder() { return $this->belongsTo(WorkOrder::class, 'work_order_id', 'id'); }
}
