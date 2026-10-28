<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            body {
                font-family: DejaVu Sans, sans-serif;
                color: #243047;
                font-size: 12px;
            }
            .head {
                background: #008f43;
                color: white;
                padding: 22px;
            }
            .muted {
                color: #8395b2;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 22px;
            }
            th, td {
                padding: 10px;
                border-bottom: 1px solid #e6ebf2;
                text-align: left;
            }
            th {
                background: #f4f7fb;
                color: #8395b2;
            }
            .right {
                text-align: right;
            }
            .total {
                font-size: 18px;
                color: #008f43;
                font-weight: bold;
            }
            .cols {
                width: 100%;
                margin-top: 22px;
            }
            .cols td {
                vertical-align: top;
                border: 0;
            }
        </style>
    </head>
    <body>
        <div class="head">
            <h1>INVOICE</h1>
            <strong>#{{ $invoice->invoice_number }}</strong>
        </div>
        <table class="cols">
            <tr>
                <td>
                    <span class="muted">FROM</span><br>
                    <strong>{{ $company }}</strong><br>
                    {{ config('mail.from.address') }}
                </td>
                <td>
                    <span class="muted">BILL TO</span><br>
                    <strong>{{ $invoice->billTo->bill_name ?? '—' }}</strong><br>
                    {{ $invoice->recipient_email }}
                </td>
                <td>
                    <span class="muted">DETAILS</span><br>
                    Invoice Date: {{ $invoice->invoice_date?->format('M d, Y') }}<br>
                    Due Date: {{ $invoice->due_date?->format('M d, Y') ?? '—' }}<br>
                    Status: {{ ucfirst($invoice->status) }}
                </td>
            </tr>
        </table>
<table><thead><tr><th>Description</th><th>Job Code</th><th class="right">Qty</th><th class="right">Unit Price</th><th class="right">Total</th></tr></thead><tbody>@foreach($invoice->items as $item)<tr><td>{{ $item->description }}</td><td>{{ $item->job_code }}</td><td class="right">{{ $item->quantity }}</td><td class="right">${{ number_format((float)$item->unit_price,2) }}</td><td class="right">${{ number_format((float)$item->line_total,2) }}</td></tr>@endforeach</tbody></table>
<table><tr><td class="right">Subtotal</td><td class="right">${{ number_format((float)$invoice->subtotal,2) }}</td></tr><tr><td class="right">Tax</td><td class="right">${{ number_format((float)$invoice->tax_amount,2) }}</td></tr><tr><td class="right">Discount</td><td class="right">${{ number_format((float)$invoice->discount,2) }}</td></tr><tr><td class="right total">Total</td><td class="right total">${{ number_format((float)$invoice->total,2) }}</td></tr></table>
@if($invoice->notes)<p><strong>Notes:</strong> {{ $invoice->notes }}</p>@endif
</body></html>
