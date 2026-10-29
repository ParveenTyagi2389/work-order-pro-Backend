
@extends('layouts.master')

@section('topbar-title', 'Job Flat Rates')
@section('page-title', 'WorkOrder Pro - Job Flat Rates')

@section('content')
<div class="content-area">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Job Flat Rates</h2>
        <p class="breadcrumb-text">Manage job flat rates for work orders.</p>
    </div>

    <div class="panel search-action-row">
        <div class="search-input-width search-box-max-width">
            <input
                type="text"
                class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                data-live-search-for="#jobFlatRatesTable"
                placeholder="Search records"
                autocomplete="off"
            >
            <i class="fi-rs-search filter-search-icon"></i>
        </div>

        <a
            class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none"
            href="{{ route('job-flat-rates.create') }}"
        >
            + Add Record
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table
                id="jobFlatRatesTable"
                class="table-custom log-idtimestampuseractionentit-text-alt"
            >
                <thead>
                    <tr>
                        <th>Work order</th>
                        <th>Rate</th>
                        <th>Description</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jobFlatRates as $item)
                        <tr>
                            <td>
                                {{ $item->workOrder->customer_work_order ?? ('WO-'.$item->work_order_id) }}
                            </td>

                            <td>{{ $item->rate }}</td>

                            <td>{{ $item->description ?? '—' }}</td>

                            <td class="jajohn-admin-text">
                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('job-flat-rates.show', $item) }}"
                                >
                                    View
                                </a>

                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('job-flat-rates.edit', $item) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    class="d-inline delete-job-flat-rate-form"
                                    method="POST"
                                    action="{{ route('job-flat-rates.destroy', $item) }}"
                                    
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-action-simple">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                No records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $jobFlatRates->links() }}
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    // ================= SWEETALERT DELETE CONFIRMATION =================
    document.querySelectorAll('.delete-job-flat-rate-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Fallback if SweetAlert2 is not loaded.
            if (typeof Swal === 'undefined') {
                if (window.confirm('This job flat rate will be permanently deleted. Continue?')) {
                    form.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'This job flat rate will be permanently deleted.',
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

</script>
@endsection