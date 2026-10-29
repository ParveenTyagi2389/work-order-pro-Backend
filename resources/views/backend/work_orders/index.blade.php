
@extends('layouts.master')

@section('topbar-title', 'Work Orders')
@section('page-title', 'WorkOrder Pro - Work Orders')

@section('content')
<div class="content-area">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Work Orders</h2>
        <p class="breadcrumb-text">Manage scheduled and completed work.</p>
    </div>

    <div class="search-action-row">
        <div class="search-input-width search-box-max-width">
            <input
                type="text"
                class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                data-live-search-for="#workOrdersTable"
                placeholder="Search work order or problem"
                autocomplete="off"
            >
            <i class="fi-rs-search filter-search-icon"></i>
        </div>

        {{-- <select id="workOrderStatusFilter" class="form-control form-control-styled status-select">
            <option value="">All statuses</option>
            <option value="serviced">Serviced</option>
            <option value="not_serviced">Not serviced</option>
            <option value="billed">Billed</option>
            <option value="not_billed">Not billed</option>
        </select> --}}

        <a
            class="btn-custom btn-primary-custom text-decoration-none"
            href="{{ route('work-orders.create') }}"
        >
            + Add Work Order
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table
                id="workOrdersTable"
                class="table-custom log-idtimestampuseractionentit-text-alt"
            >
                <thead>
                    <tr>
                        <th class="font-weight-bold log-id-text">WORK ORDER</th>
                        <th class="font-weight-bold log-id-text">SITE</th>
                        <th class="font-weight-bold log-id-text">TECHNICIAN</th>
                        <th class="font-weight-bold log-id-text">JOB CODE</th>
                        <th class="font-weight-bold log-id-text">CREATED</th>
                        <th class="font-weight-bold log-id-text">STATUS</th>
                        <th class="font-weight-bold log-id-text">ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($workOrders as $workOrder)
                        <tr>
                            <td class="site-table-name">
                                <a
                                    class="tech-wo-green"
                                    href="{{ route('work-orders.show', $workOrder) }}"
                                >
                                    {{ $workOrder->customer_work_order ?: ('WO-'.$workOrder->id) }}
                                </a>
                            </td>

                            <td>
                                {{ $workOrder->site->name ?? ('Site #'.$workOrder->site_id) }}
                            </td>

                            <td>
                                {{ $workOrder->technician->name ?? '—' }}
                            </td>

                            <td>
                                <span class="badge-cert-gray text-xs">
                                    {{ $workOrder->jobCode->foldername ?? '—' }}
                                </span>
                            </td>

                            <td>
                                {{ $workOrder->job_created_at?->format('d M Y') ?? '—' }}
                            </td>

                            <td class="work-order-status">
                                <span class="badge-status-warning">
                                    {{ $workOrder->serviced ? 'Serviced' : 'Open' }}
                                    /
                                    {{ $workOrder->billed ? 'Billed' : 'Unbilled' }}
                                </span>
                            </td>

                            <td>
                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('work-orders.show', $workOrder) }}"
                                >
                                    View
                                </a>

                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('work-orders.edit', $workOrder) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    class="d-inline delete-work-order-form"
                                    method="POST"
                                    action="{{ route('work-orders.destroy', $workOrder) }}"
                                    >
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn-action-simple" type="submit">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                No work orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $workOrders->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ================= LIVE SEARCH =================
    const table = document.getElementById('workOrdersTable');
    const searchInput = document.querySelector(
        'input[data-live-search-for="#workOrdersTable"]'
    );

    function filterWorkOrders() {
        if (!table || !searchInput) return;

        const searchText = searchInput.value.toLowerCase().trim();

        table.querySelectorAll('tbody tr').forEach(function (row) {
            const cells = row.querySelectorAll('td');

            // Keep the empty-state row visible.
            if (cells.length === 1 && cells[0].hasAttribute('colspan')) {
                return;
            }

            const rowText = row.innerText.toLowerCase();

            row.style.display = rowText.includes(searchText) ? '' : 'none';
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterWorkOrders);
    }


    // ================= SWEETALERT DELETE CONFIRMATION =================
    document.querySelectorAll('.delete-work-order-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Fallback if SweetAlert2 is not loaded.
            if (typeof Swal === 'undefined') {
                if (window.confirm('This work order will be permanently deleted. Continue?')) {
                    form.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'This work order will be permanently deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#078b4d',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true
            }).then(function (result) {

                if (result.isConfirmed) {
                    // Submit the form without triggering the handler again.
                    form.submit();
                }

            });
        });

    });

});
</script>
@endsection
