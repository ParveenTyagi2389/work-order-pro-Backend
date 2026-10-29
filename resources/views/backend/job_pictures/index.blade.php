
@extends('layouts.master')

@section('topbar-title', 'Job Pictures')
@section('page-title', 'WorkOrder Pro - Job Pictures')

@section('content')
<div class="content-area">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <h2 class="page-title font-weight-bold">
            Job Pictures
        </h2>
        <p class="breadcrumb-text">
            Manage uploaded pictures and related records.
        </p>
    </div>

    <div class="panel search-action-row">
        <div class="search-input-width search-box-max-width">
            <input
                type="text"
                class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                data-live-search-for="#jobPicturesTable"
                placeholder="Search records"
                autocomplete="off"
            >
            <i class="fi-rs-search filter-search-icon"></i>
        </div>

        <a
            class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none"
            href="{{ route('job-pictures.create') }}"
        >
            + Add Picture
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table
                id="jobPicturesTable"
                class="table-custom log-idtimestampuseractionentit-text-alt"
            >
                <thead>
                    <tr>
                        <th>WORK ORDER</th>
                        <th>DESCRIPTION</th>
                        <th>PICTURE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jobPictures as $item)
                        <tr>
                            <td>
                                {{ $item->workOrder->customer_work_order ?? ('WO-'.$item->work_order_id) }}
                            </td>

                            <td>
                                {{ $item->description ?: '—' }}
                            </td>

                            <td>
                                @if($item->picture)
                                    <img
                                        src="{{ asset('storage/'.$item->picture) }}"
                                        alt="Picture"
                                        style="width:70px;height:55px;object-fit:cover"
                                    >
                                @else
                                    —
                                @endif
                            </td>

                            <td class="jajohn-admin-text">
                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('job-pictures.show', $item) }}"
                                >
                                    View
                                </a>

                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('job-pictures.edit', $item) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    class="d-inline delete-job-picture-form"
                                    method="POST"
                                    action="{{ route('job-pictures.destroy', $item) }}"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-action-simple"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                No pictures found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $jobPictures->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // ================= SWEETALERT DELETE CONFIRMATION =================
    document.querySelectorAll('.delete-job-picture-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Fallback if SweetAlert2 is not loaded.
            if (typeof Swal === 'undefined') {
                if (window.confirm('This job picture will be permanently deleted. Continue?')) {
                    form.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'This job picture will be permanently deleted.',
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