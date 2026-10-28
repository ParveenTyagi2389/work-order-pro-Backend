<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number','bill_to_id','work_order_id','recipient_email','cc_email',
        'invoice_date','due_date','status','tax_rate','discount','subtotal',
        'tax_amount','total','notes','email_message','attach_pdf','send_reminder',
    ];

    protected $casts = [
        'invoice_date'=>'date','due_date'=>'date','tax_rate'=>'decimal:3',
        'discount'=>'decimal:2','subtotal'=>'decimal:2','tax_amount'=>'decimal:2',
        'total'=>'decimal:2','attach_pdf'=>'boolean','send_reminder'=>'boolean',
    ];

    public function billTo(): BelongsTo { return $this->belongsTo(BillTo::class, 'bill_to_id'); }
    public function items(): HasMany { return $this->hasMany(InvoiceItem::class); }
    public function workOrder(): BelongsTo { return $this->belongsTo(WorkOrder::class, 'work_order_id'); }
}
