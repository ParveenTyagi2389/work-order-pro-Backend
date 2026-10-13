<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class WorkOrder extends Model {
    protected $table = 'work_orders';
    protected $fillable = ['site_id','job_created_at','technician_id','job_code_id','customer_work_order','problem','solution','override_travel','override_labor','fuel_reimbursement','serviced','billed'];
    protected $casts = ['job_created_at'=>'datetime','override_travel'=>'decimal:2','override_labor'=>'decimal:2','fuel_reimbursement'=>'boolean','serviced'=>'boolean','billed'=>'boolean'];
    public function site(): BelongsTo { return $this->belongsTo(Site::class, 'site_id', 'id'); }
    public function technician(): BelongsTo { return $this->belongsTo(Technician::class, 'technician_id', 'id'); }
    public function jobCode(): BelongsTo { return $this->belongsTo(JobCode::class, 'job_code_id', 'id'); }
}
