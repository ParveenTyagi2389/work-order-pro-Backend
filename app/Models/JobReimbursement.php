<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JobReimbursement extends Model
{
    protected $table = 'job_reimbursements';
    protected $fillable = ['work_order_id', 'description', 'amount'];
    protected $casts = ['amount' => 'decimal:2'];
    public function workOrder() { return $this->belongsTo(WorkOrder::class, 'work_order_id', 'id'); }
}
