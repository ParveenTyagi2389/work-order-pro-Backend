
@extends('layouts.master')

@section('topbar-title', 'Job Codes')
@section('page-title', 'Job Codes')

@section('content')
<div class="content-area">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Job Codes</h2>
    </div>

    <div class="search-action-row">
        <div class="search-input-width search-box-max-width">
            <input
                type="text"
                class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                data-live-search-for="#jobCodesTable"
                placeholder="Search job codes"
                autocomplete="off"
            >
            <i class="fi-rs-search filter-search-icon"></i>
        </div>

        <a
            class="btn-custom btn-primary-custom text-decoration-none"
            href="{{ route('job-codes.create') }}"
        >
            + Add
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table
                id="jobCodesTable"
                class="table-custom log-idtimestampuseractionentit-text-alt"
            >
                <thead>
                    <tr>
                        <th class="font-weight-bold log-id-text">JOB CODE NAME</th>
                        <th class="font-weight-bold log-id-text">COLOR</th>
                        <th class="font-weight-bold log-id-text">SHAPE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jobCodes as $item)
                        <tr>
                            <td class="site-table-name">
                                <a
                                    class="tech-wo-green"
                                    href="{{ route('job-codes.show', $item) }}"
                                >
                                    {{ $item->foldername }}
                                </a>
                            </td>

                            <td class="semantic-text-primary">
                                {{ $item->foldercolor ?: '—' }}
                            </td>

                            <td class="semantic-text-primary">
                                {{ $item->foldershape ?: '—' }}
                            </td>

                            <td>
                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('job-codes.show', $item) }}"
                                >
                                    View
                                </a>

                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('job-codes.edit', $item) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    class="d-inline delete-job-code-form"
                                    method="POST"
                                    action="{{ route('job-codes.destroy', $item) }}"
                                    onsubmit="return confirm('Delete this record?')"
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
            {{ $jobCodes->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // ================= SWEETALERT DELETE CONFIRMATION =================
    document.querySelectorAll('.delete-job-code-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Fallback if SweetAlert2 is not loaded.
            if (typeof Swal === 'undefined') {
                if (window.confirm('This job code will be permanently deleted. Continue?')) {
                    form.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'This job code will be permanently deleted.',
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
