
@extends('layouts.master')

@section('topbar-title', 'Shapes')
@section('page-title', 'WorkOrder Pro - Shapes')

@section('content')
<div class="content-area">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Shapes</h2>
    </div>

    <div class="panel search-action-row">
        <div class="search-input-width search-box-max-width">
            <input
                id="shapeSearch"
                class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                type="search"
                data-live-search-for="#shapesTable"
                value="{{ request('search') }}"
                placeholder="Search shapes"
                autocomplete="off"
            >
            <i class="fi-rs-search filter-search-icon"></i>
        </div>

        <a class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none"
           href="{{ route('shapes.create') }}">
            + Add
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table id="shapesTable"
                   class="table-custom log-idtimestampuseractionentit-text-alt">

                <thead>
                    <tr>
                        <th class="font-weight-bold log-id-text">SHAPE NAME</th>
                        <th class="font-weight-bold log-id-text">SHAPE CODE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($shapes as $item)
                        <tr>
                            <td class="site-table-name">
                                <a class="tech-wo-green"
                                   href="{{ route('shapes.show', $item) }}">
                                    {{ $item->shape_name }}
                                </a>
                            </td>

                            <td class="semantic-text-primary">
                                {{ $item->shape_code ?: '—' }}
                            </td>

                            <td>
                                <a class="btn-action-simple text-decoration-none"
                                   href="{{ route('shapes.show', $item) }}">
                                    View
                                </a>

                                <a class="btn-action-simple text-decoration-none"
                                   href="{{ route('shapes.edit', $item) }}">
                                    Edit
                                </a>

                                <form class="d-inline delete-shape-form"
                                      method="POST"
                                      action="{{ route('shapes.destroy', $item) }}">
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
                            <td colspan="3" class="text-center">
                                No records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="mt-3">
            {{ $shapes->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // ================= SWEETALERT DELETE CONFIRMATION =================
    document.querySelectorAll('.delete-shape-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Fallback if SweetAlert2 is not loaded.
            if (typeof Swal === 'undefined') {
                if (window.confirm('This shape will be permanently deleted. Continue?')) {
                    form.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'This shape will be permanently deleted.',
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
