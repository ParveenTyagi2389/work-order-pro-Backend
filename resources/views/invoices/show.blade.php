@extends('layouts.master')
@section('page-title','Invoice Details')
@section('content')
<div class="container-fluid invoice-page">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="invoice-list-heading"><h2>Invoice Details</h2><div class="d-flex gap-2"><a href="{{ route('invoices.pdf',$invoice) }}" class="outline-button">Download PDF</a><a href="{{ route('invoices.edit',$invoice) }}" class="green-button">Edit Invoice</a><a href="{{ route('invoices.index') }}" class="outline-button">Back</a></div></div>
    <div class="invoice-paper detail-paper">
        <div class="invoice-banner"><div><h2>INVOICE</h2><span>#{{ $invoice->invoice_number }}</span></div></div>
        <div class="invoice-body">
            <div class="invoice-parties">
                <div class="party-block"><h4>FROM</h4><strong>{{ config('app.name','FieldOps Services LLC') }}</strong><p>{{ config('mail.from.address') }}</p></div>
                <div class="party-block"><h4>BILL TO</h4><strong>{{ $invoice->billTo->bill_name ?? '—' }}</strong><p>{{ $invoice->recipient_email }}</p></div>
                <div class="party-block"><h4>DETAILS</h4><p>Invoice Date <strong>{{ $invoice->invoice_date?->format('M d, Y') }}</strong></p><p>Due Date <strong>{{ $invoice->due_date?->format('M d, Y') ?? '—' }}</strong></p><p>Work Order <strong>{{ $invoice->work_order_id ? 'WO-'.$invoice->work_order_id : '—' }}</strong></p><p>Status <span class="status-pill status-{{ $invoice->status }}">{{ ucfirst($invoice->status) }}</span></p></div>
            </div>
            @if($invoice->status === 'sent')<div class="import-notice">✉ Invoice emailed to {{ $invoice->recipient_email }}</div>@endif
            <div class="table-responsive"><table class="table"><thead><tr><th>DESCRIPTION</th><th>JOB CODE</th><th class="text-end">QTY</th><th class="text-end">UNIT PRICE</th><th class="text-end">TOTAL</th></tr></thead><tbody>@foreach($invoice->items as $item)<tr><td>{{ $item->description }}</td><td>{{ $item->job_code ?? '—' }}</td><td class="text-end">{{ number_format((float)$item->quantity,2) }}</td><td class="text-end">${{ number_format((float)$item->unit_price,2) }}</td><td class="text-end"><strong>${{ number_format((float)$item->line_total,2) }}</strong></td></tr>@endforeach</tbody></table></div>
            <div class="totals-area show-totals"><div><span>Subtotal</span><strong>${{ number_format((float)$invoice->subtotal,2) }}</strong></div><div><span>Tax ({{ number_format((float)$invoice->tax_rate,2) }}%)</span><strong>${{ number_format((float)$invoice->tax_amount,2) }}</strong></div><div><span>Discount</span><strong>${{ number_format((float)$invoice->discount,2) }}</strong></div><hr><div class="grand-total"><strong>Total</strong><strong>${{ number_format((float)$invoice->total,2) }}</strong></div></div>
            @if($invoice->notes)<div class="invoice-notes"><strong>Notes to Customer</strong><p>{{ $invoice->notes }}</p></div>@endif
        </div>
    </div>
    <div class="panel p-3 mt-3"><h5>Send invoice by email</h5><form method="POST" action="{{ route('invoices.send',$invoice) }}" class="row g-3">@csrf<div class="col-md-4"><label class="form-label">Send To *</label><input type="email" name="recipient_email" required value="{{ $invoice->recipient_email }}" class="form-control"></div><div class="col-md-4"><label class="form-label">CC</label><input type="email" name="cc_email" value="{{ $invoice->cc_email }}" class="form-control"></div><div class="col-md-4"><label class="form-label">Subject</label><input name="email_subject" value="Invoice {{ $invoice->invoice_number }} from {{ config('app.name') }}" class="form-control"></div><div class="col-md-12"><label class="form-label">Message</label><textarea name="email_message" rows="3" class="form-control">{{ $invoice->email_message ?: 'Hi, please find your invoice attached. Thank you for your business.' }}</textarea></div><div class="col-md-12"><label><input type="checkbox" name="attach_pdf" value="1" checked> Attach PDF copy (requires Dompdf)</label></div><div class="col-md-12"><button class="green-button" type="submit">📩 Send Invoice Email</button></div></form></div>
</div>
@endsection
