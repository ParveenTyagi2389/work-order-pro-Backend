
@extends('layouts.master')

@section('topbar-title', 'Job Billing')
@section('page-title', 'Job Billing')

@section('content')
<div class="content-area">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Job Billing</h2>
        <p class="breadcrumb-text">Manage job billing for work orders.</p>
    </div>

    <div class="search-action-row">
        <div class="search-input-width search-box-max-width">
            <input
                id="jobBillingSearch"
                class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                type="search"
                data-live-search-for="#jobBillablesTable"
                value="{{ request('search') }}"
                placeholder="Search records"
                autocomplete="off"
            >
        </div>

        <a class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none"
           href="{{ route('job-billables.create') }}">
            + Add Record
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table id="jobBillablesTable"
                   class="table-custom log-idtimestampuseractionentit-text-alt">

                <thead>
                    <tr>
                        <th>Work order</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Description</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jobBillables as $item)
                        <tr>
                            <td>
                                {{ $item->workOrder->customer_work_order ?? ('WO-'.$item->work_order_id) }}
                            </td>

                            <td>
                                {{ $item->check_in?->format('d M Y, h:i A') ?? '—' }}
                            </td>

                            <td>
                                {{ $item->check_out?->format('d M Y, h:i A') ?? '—' }}
                            </td>

                            <td>
                                {{ \Illuminate\Support\Str::limit($item->description ?? '—', 80) }}
                            </td>

                            <td class="jajohn-admin-text">
                                <a class="btn-action-simple text-decoration-none" href="{{ route('job-billables.show', $item) }}">View</a>
                                <a class="btn-action-simple text-decoration-none" href="{{ route('job-billables.edit', $item) }}">Edit</a>

                                <form class="d-inline delete-job-billable-form"
                                      method="POST"
                                      action="{{ route('job-billables.destroy', $item) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-action-simple">Delete</button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="mt-3">
            {{ $jobBillables->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // ================= SWEETALERT DELETE CONFIRMATION =================
    document.querySelectorAll('.delete-job-billable-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Fallback if SweetAlert2 is not loaded.
            if (typeof Swal === 'undefined') {
                if (window.confirm('This job billable will be permanently deleted. Continue?')) {
                    form.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'This job billable will be permanently deleted.',
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