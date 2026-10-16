<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JobPicture extends Model {
    protected $table = 'job_pictures';
    protected $fillable = ['work_order_id', 'description', 'picture'];
    public function workOrder() { return $this->belongsTo(WorkOrder::class, 'work_order_id', 'id'); }
}
