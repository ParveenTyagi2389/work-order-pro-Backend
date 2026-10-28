<!doctype html>
<html><body style="font-family:Arial,sans-serif;color:#263247;line-height:1.6">
    <h2 style="background:#008f43;color:#fff;padding:20px;margin:0">Invoice {{ $invoice->invoice_number }}</h2>
    <div style="padding:20px">
        <p>{{ $messageText }}</p>
        <p><strong>Invoice:</strong> {{ $invoice->invoice_number }}<br>
        <strong>Invoice date:</strong> {{ $invoice->invoice_date?->format('M d, Y') }}<br>
        <strong>Due date:</strong> {{ $invoice->due_date?->format('M d, Y') ?? 'Not specified' }}<br>
        <strong>Total due:</strong> ${{ number_format((float)$invoice->total,2) }}</p>
        @if($invoice->notes)<p><strong>Notes:</strong> {{ $invoice->notes }}</p>@endif
        <p>Thank you for your business.</p>
    </div>
</body></html>
