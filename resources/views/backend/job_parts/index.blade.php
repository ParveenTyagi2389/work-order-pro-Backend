
@extends('layouts.master')

@section('topbar-title', 'Job Parts')
@section('page-title', 'WorkOrder Pro - Job Parts')

@section('content')
<div class="content-area">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <h2 class="page-title font-weight-bold">
            Job Parts
        </h2>
        <p class="breadcrumb-text">
            Manage parts assigned to work orders.
        </p>
    </div>

    <div class="panel search-action-row">
        <div class="search-input-width search-box-max-width">
            <input
                type="text"
                class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                data-live-search-for="#jobPartsTable"
                placeholder="Search part number or work order"
                autocomplete="off"
            >
            <i class="fi-rs-search filter-search-icon"></i>
        </div>

        <a
            class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none"
            href="{{ route('job-parts.create') }}"
        >
            + Add Job Part
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table
                id="jobPartsTable"
                class="table-custom log-idtimestampuseractionentit-text-alt"
            >
                <thead>
                    <tr>
                        <th>WORK ORDER</th>
                        <th>PART NUMBER</th>
                        <th>DESCRIPTION</th>
                        <th>QUANTITY</th>
                        <th>ORDERED</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jobParts as $item)
                        <tr>
                            <td>
                                <a
                                    class="tech-wo-green"
                                    href="{{ route('job-parts.show', $item) }}"
                                >
                                    {{ $item->workOrder->customer_work_order ?? ('WO-'.$item->work_order_id) }}
                                </a>
                            </td>

                            <td>
                                {{ $item->part->part_number ?? ('Part #'.$item->part_id) }}
                            </td>

                            <td>
                                {{ $item->part->description ?? '—' }}
                            </td>

                            <td>
                                {{ number_format((float)$item->quantity, 2) }}
                            </td>

                            <td>
                                {{ $item->ordered ? 'Yes' : 'No' }}
                            </td>

                            <td>
                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('job-parts.show', $item) }}"
                                >
                                    View
                                </a>

                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('job-parts.edit', $item) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    class="d-inline delete-job-part-form"
                                    method="POST"
                                    action="{{ route('job-parts.destroy', $item) }}"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn-action-simple"
                                        type="submit"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No job parts found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $jobParts->links() }}
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    // ================= SWEETALERT DELETE CONFIRMATION =================
    document.querySelectorAll('.delete-job-part-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Fallback if SweetAlert2 is not loaded.
            if (typeof Swal === 'undefined') {
                if (window.confirm('This job part will be permanently deleted. Continue?')) {
                    form.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'This job part will be permanently deleted.',
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