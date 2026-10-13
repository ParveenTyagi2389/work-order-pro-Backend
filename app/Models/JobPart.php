<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JobPart extends Model
{
    protected $table = 'job_parts';
    protected $fillable = ['work_order_id', 'part_id', 'quantity', 'ordered'];
    protected $casts = ['quantity' => 'decimal:2', 'ordered' => 'boolean'];
    public function workOrder() { return $this->belongsTo(WorkOrder::class, 'work_order_id', 'id'); }
    public function part() { return $this->belongsTo(Part::class, 'part_id', 'id'); }
}
