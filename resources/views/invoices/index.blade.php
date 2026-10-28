@extends('layouts.master')
@section('page-title','Invoices')
@section('content')
<div class="container-fluid invoice-page">
    <div class="invoice-list-heading"><h2>Invoices</h2><a href="{{ route('invoices.create') }}" class="green-button">+ Create Invoice</a></div>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="summary-grid">
        <div class="summary-card"><span>TOTAL OUTSTANDING</span><strong class="green-text">${{ number_format($summary['outstanding'],2) }}</strong><small>Across {{ $summary['count'] }} invoices</small></div>
        <div class="summary-card"><span>PAID THIS MONTH</span><strong>${{ number_format($summary['paid_month'],2) }}</strong><small>Paid invoices this month</small></div>
        <div class="summary-card"><span>OVERDUE</span><strong class="red-text">${{ number_format($summary['overdue'],2) }}</strong><small>{{ \App\Models\Invoice::where('status','overdue')->count() }} invoices</small></div>
        <div class="summary-card"><span>AVG. PAYMENT TIME</span><strong>—</strong><small>Not calculated yet</small></div>
    </div>
    <form class="invoice-filters" method="GET" action="{{ route('invoices.index') }}">
        <input type="search" name="search" value="{{ request('search') }}" placeholder="⌕  Search invoices..." class="form-control form-control-styled">
        <select name="status" class="form-control form-control-styled"><option value="">All Statuses</option>@foreach(['draft','sent','paid','overdue','cancelled'] as $s)<option value="{{ $s }}" @selected(request('status')===$s)>{{ ucfirst($s) }}</option>@endforeach</select>
        <select name="bill_to_id" class="form-control form-control-styled"><option value="">All Customers</option>@foreach($billTos as $b)<option value="{{ $b->id }}" @selected(request('bill_to_id')==$b->id)>{{ $b->bill_name }}</option>@endforeach</select>
        <div class="date-filter"><input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control form-control-styled" aria-label="From date"><input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control form-control-styled" aria-label="To date"></div>
        <button class="outline-button" type="submit">Filter</button>
        <a href="{{ route('invoices.export', request()->query()) }}" class="outline-button">⇩ Export CSV</a>
        <a href="{{ route('invoices.create') }}" class="green-button">+ Create Invoice</a>
    </form>
    <div class="invoice-table-card"><div class="table-responsive"><table class="table invoice-table">
        <thead><tr><th>INVOICE #</th><th>CUSTOMER</th><th>WORK ORDER</th><th>ISSUE DATE</th><th>DUE DATE</th><th>AMOUNT</th><th>STATUS</th><th>SOURCE</th><th>ACTIONS</th></tr></thead>
        <tbody>
        @forelse($invoices as $inv)
            <tr>
                <td><a class="invoice-number" href="{{ route('invoices.show',$inv) }}">{{ $inv->invoice_number }}</a></td>
                <td><strong>{{ $inv->billTo->bill_name ?? '—' }}</strong><small>{{ $inv->recipient_email }}</small></td>
                <td class="green-text">{{ $inv->work_order_id ? 'WO-'.$inv->work_order_id : '—' }}</td>
                <td>{{ $inv->invoice_date?->format('M d, Y') }}</td><td>{{ $inv->due_date?->format('M d, Y') ?? '—' }}</td>
                <td><strong>${{ number_format((float)$inv->total,2) }}</strong></td>
                <td><span class="status-pill status-{{ $inv->status }}">{{ ucfirst($inv->status) }}</span></td>
                <td><span class="source-pill">Manual</span></td>
                <td class="action-cell">
                    <a href="{{ route('invoices.show',$inv) }}">View</a><a href="{{ route('invoices.edit',$inv) }}">Edit</a>
                    @if($inv->status !== 'paid')<a href="{{ route('invoices.edit',$inv) }}#invoiceSettings">Send</a>@else<a href="{{ route('invoices.pdf',$inv) }}">PDF</a>@endif
                </td>
            </tr>
        @empty<tr><td colspan="9" class="text-center py-5">No invoices found. Create your first invoice.</td></tr>@endforelse
        </tbody></table></div>{{ $invoices->links() }}</div>
</div>
@endsection
