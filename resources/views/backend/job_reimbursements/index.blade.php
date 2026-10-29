
@extends('layouts.master')

@section('topbar-title', 'Job Reimbursements')
@section('page-title', 'WorkOrder Pro - Job Reimbursements')

@section('content')
<div class="content-area">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Job Reimbursements</h2>
        <p class="breadcrumb-text">Manage job reimbursements for work orders.</p>
    </div>

    <div class="search-action-row">
        <div class="search-input-width search-box-max-width">
            <input
                type="text"
                class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                data-live-search-for="#jobReimbursementsTable"
                placeholder="Search records"
                autocomplete="off"
            >
        </div>

        <a
            class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none"
            href="{{ route('job-reimbursements.create') }}"
        >
            + Add Record
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table
                id="jobReimbursementsTable"
                class="table-custom log-idtimestampuseractionentit-text-alt"
            >
                <thead>
                    <tr>
                        <th>Work order</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jobReimbursements as $item)
                        <tr>
                            <td>
                                {{ $item->workOrder->customer_work_order ?? ('WO-'.$item->work_order_id) }}
                            </td>

                            <td>{{ $item->amount }}</td>

                            <td>{{ $item->description ?? '—' }}</td>

                            <td class="jajohn-admin-text">
                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('job-reimbursements.show', $item) }}"
                                >
                                    View
                                </a>

                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('job-reimbursements.edit', $item) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    class="d-inline delete-job-reimbursement-form"
                                    method="POST"
                                    action="{{ route('job-reimbursements.destroy', $item) }}"
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
            {{ $jobReimbursements->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // ================= SWEETALERT DELETE CONFIRMATION =================
    document.querySelectorAll('.delete-job-reimbursement-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Fallback if SweetAlert2 is not loaded.
            if (typeof Swal === 'undefined') {
                if (window.confirm('This job reimbursement will be permanently deleted. Continue?')) {
                    form.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'This job reimbursement will be permanently deleted.',
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