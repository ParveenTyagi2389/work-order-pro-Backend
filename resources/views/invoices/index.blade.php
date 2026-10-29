
@extends('layouts.master')
@section('page-title', 'Invoices')

@section('content')
<div class="content-area">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    {{-- ================= SUMMARY CARDS ================= --}}
    <div class="row margin-btm-lg">
        <div class="column-full col-md-3">
            <div class="stat-card border">
                <div class="stat-details stat-invoice-green">
                    <span class="stat-label font-weight-bold custom-d-block text-uppercase">TOTAL OUTSTANDING</span>
                    <span class="stat-value font-weight-bold custom-d-block">${{ number_format($summary['outstanding'], 2) }}</span>
                    <span class="stat-subtext">Across {{ $summary['count'] }} invoices</span>
                </div>
            </div>
        </div>

        <div class="column-full col-md-3">
            <div class="stat-card border">
                <div class="stat-details">
                    <span class="stat-label font-weight-bold custom-d-block text-uppercase">PAID THIS MONTH</span>
                    <span class="stat-value font-weight-bold custom-d-block text-dark">${{ number_format($summary['paid_month'], 2) }}</span>
                    <span class="stat-subtext">Paid invoices this month</span>
                </div>
            </div>
        </div>

        <div class="column-full col-md-3">
            <div class="stat-card border">
                <div class="stat-details stat-invoice-red">
                    <span class="stat-label font-weight-bold custom-d-block text-uppercase">OVERDUE</span>
                    <span class="stat-value font-weight-bold custom-d-block">${{ number_format($summary['overdue'], 2) }}</span>
                    <span class="stat-subtext">{{ \App\Models\Invoice::where('status', 'overdue')->count() }} invoices</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= FILTER BAR ================= --}}
    <div class="panel border mb-large-padded">
        <div class="filter-bar-row mb-zero">
            <div class="filter-bar-left">
                <div class="filter-bar-search">
                    <input
                        id="invoiceSearch"
                        class="form-control-custom filter-search-input"
                        type="text"
                        placeholder="Search invoices..."
                        autocomplete="off"
                    />
                    <i class="fi-rs-search filter-search-icon"></i>
                </div>
            </div>

            <div class="filter-bar-right">
                <select id="invoiceStatusFilter" class="form-control-custom">
                    <option value="">All Statuses</option>
                    @foreach(['draft', 'sent', 'paid', 'overdue', 'cancelled'] as $s)
                        <option value="{{ $s }}">{{ ucfirst($s) }}</option>
                    @endforeach
                </select>

                <select id="invoiceCustomerFilter" class="form-control-custom">
                    <option value="">All Customers</option>
                    @foreach($billTos as $b)
                        <option value="{{ $b->id }}">{{ $b->bill_name }}</option>
                    @endforeach
                </select>

                <input
                    id="invoiceDateFrom"
                    type="date"
                    class="form-control-custom"
                    aria-label="From date"
                />

                <input
                    id="invoiceDateTo"
                    type="date"
                    class="form-control-custom"
                    aria-label="To date"
                />

                <button
                    type="button"
                    id="resetInvoiceFilters"
                    class="btn-custom btn-outline-custom filter-btn-outline"
                >
                    Reset
                </button>

                <a
                    class="btn-custom btn-outline-custom filter-btn-outline"
                    href="{{ route('invoices.export', request()->query()) }}"
                >
                    <i class="fi-rs-download"></i> Export CSV
                </a>

                <a
                    class="btn-custom btn-primary-custom filter-btn-primary font-weight-bold"
                    href="{{ route('invoices.create') }}"
                >
                    + Create Invoice
                </a>
            </div>
        </div>
    </div>

    {{-- ================= TABLE ================= --}}
    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table
                id="invoicesTable"
                class="table-custom log-idtimestampuseractionentit-text-alt"
            >
                <thead>
                    <tr>
                        <th class="font-weight-bold log-id-text">INVOICE #</th>
                        <th class="font-weight-bold log-id-text">CUSTOMER</th>
                        <th class="font-weight-bold log-id-text">WORK ORDER</th>
                        <th class="font-weight-bold log-id-text">ISSUE DATE</th>
                        <th class="font-weight-bold log-id-text">DUE DATE</th>
                        <th class="font-weight-bold log-id-text">AMOUNT</th>
                        <th class="font-weight-bold log-id-text">STATUS</th>
                        <th class="font-weight-bold log-id-text">SOURCE</th>
                        <th class="font-weight-bold log-id-text">ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $statusBadgeMap = [
                            'draft' => 'gray',
                            'sent' => 'yellow',
                            'pending' => 'yellow',
                            'paid' => 'green',
                            'overdue' => 'pink',
                            'cancelled' => 'gray',
                        ];
                    @endphp

                    @forelse($invoices as $inv)
                        @php
                            $badgeClass = $statusBadgeMap[$inv->status] ?? 'gray';
                            $sourceLabel = $inv->source ?? 'Manual';
                            $sourceClass = stripos($sourceLabel, 'iverte') !== false
                                ? 'badge-source-blue'
                                : 'badge-source-gray';
                        @endphp

                        <tr
                            data-invoice-status="{{ strtolower($inv->status) }}"
                            data-customer-id="{{ $inv->bill_to_id }}"
                            data-invoice-date="{{ $inv->invoice_date?->format('Y-m-d') }}"
                        >
                            <td class="font-weight-bold work-number wo-text">
                                <a class="work-number wo-text" href="{{ route('invoices.show', $inv) }}">
                                    {{ $inv->invoice_number }}
                                </a>
                            </td>

                            <td class="jajohn-admin-text">
                                <div class="font-weight-bold john-admin-text">
                                    {{ $inv->billTo->bill_name ?? '—' }}
                                </div>
                                <div class="system-role-cannot-delete-text">
                                    {{ $inv->recipient_email }}
                                </div>
                            </td>

                            <td class="work-number wo-text">
                                {{ $inv->work_order_id ? 'WO-' . $inv->work_order_id : '—' }}
                            </td>

                            <td class="semantic-text-primary">
                                {{ $inv->invoice_date?->format('M d, Y') ?? '—' }}
                            </td>

                            <td class="semantic-text-primary">
                                {{ $inv->due_date?->format('M d, Y') ?? '—' }}
                            </td>

                            <td class="font-weight-bold jun-am-text">
                                ${{ number_format((float) $inv->total, 2) }}
                            </td>

                            <td class="jajohn-admin-text">
                                <span class="badge-status {{ $badgeClass }} badge-status-inline">
                                    {{ ucfirst($inv->status) }}
                                </span>
                            </td>

                            <td class="jajohn-admin-text">
                                <span class="{{ $sourceClass }}">{{ $sourceLabel }}</span>
                            </td>

                            <td class="jajohn-admin-text">
                                <div class="flex-gap-sm">
                                    <a class="btn-outline-pill" href="{{ route('invoices.show', $inv) }}">View</a>
                                    <a class="btn-outline-pill" href="{{ route('invoices.edit', $inv) }}">Edit</a>

                                    @if($inv->status === 'paid')
                                        <a class="btn-outline-pill" href="{{ route('invoices.pdf', $inv) }}">Receipt</a>
                                    @elseif($inv->status === 'overdue')
                                        <button type="button" class="btn-outline-pill-red">Remind</button>
                                    @else
                                        <a class="btn-outline-pill" href="{{ route('invoices.edit', $inv) }}#invoiceSettings">Send</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                No invoices found. Create your first invoice.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= PAGINATION ================= --}}
    <div class="mt-3">
        {{ $invoices->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('invoiceSearch');
    const statusFilter = document.getElementById('invoiceStatusFilter');
    const customerFilter = document.getElementById('invoiceCustomerFilter');
    const dateFrom = document.getElementById('invoiceDateFrom');
    const dateTo = document.getElementById('invoiceDateTo');
    const resetButton = document.getElementById('resetInvoiceFilters');
    const table = document.getElementById('invoicesTable');

    function filterInvoices() {
        const searchText = searchInput.value.toLowerCase().trim();
        const selectedStatus = statusFilter.value.toLowerCase();
        const selectedCustomer = customerFilter.value;
        const fromDate = dateFrom.value;
        const toDate = dateTo.value;

        table.querySelectorAll('tbody tr').forEach(function (row) {
            const cells = row.querySelectorAll('td');

            // Keep the empty-state row visible.
            if (cells.length === 1 && cells[0].hasAttribute('colspan')) {
                return;
            }

            const rowText = row.innerText.toLowerCase();
            const invoiceStatus = row.dataset.invoiceStatus || '';
            const customerId = row.dataset.customerId || '';
            const invoiceDate = row.dataset.invoiceDate || '';

            const matchesSearch = rowText.includes(searchText);
            const matchesStatus =
                !selectedStatus || invoiceStatus === selectedStatus;
            const matchesCustomer =
                !selectedCustomer || customerId === selectedCustomer;
            const matchesFromDate =
                !fromDate || (invoiceDate && invoiceDate >= fromDate);
            const matchesToDate =
                !toDate || (invoiceDate && invoiceDate <= toDate);

            row.style.display =
                matchesSearch &&
                matchesStatus &&
                matchesCustomer &&
                matchesFromDate &&
                matchesToDate
                    ? ''
                    : 'none';
        });
    }

    searchInput.addEventListener('input', filterInvoices);
    statusFilter.addEventListener('change', filterInvoices);
    customerFilter.addEventListener('change', filterInvoices);
    dateFrom.addEventListener('change', filterInvoices);
    dateTo.addEventListener('change', filterInvoices);

    resetButton.addEventListener('click', function () {
        searchInput.value = '';
        statusFilter.value = '';
        customerFilter.value = '';
        dateFrom.value = '';
        dateTo.value = '';

        filterInvoices();
    });
});
</script>
@endsection
