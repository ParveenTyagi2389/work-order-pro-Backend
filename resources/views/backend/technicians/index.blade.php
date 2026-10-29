@extends('layouts.master')

@section('topbar-title', 'Technicians')
@section('page-title', 'WorkOrder Pro - Technicians')

@section('content')
<div class="content-area">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Technicians</h2>
        <p class="breadcrumb-text">Manage technician contact details and access.</p>
    </div>

    <div class="panel search-action-row">
        <div class="search-input-width search-box-max-width">
            <input
                class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                type="text"
                data-live-search-for="#techniciansTable"
                placeholder="Search name, email or phone"
                autocomplete="off"
            >
            <i class="fi-rs-search custom-icon-left-center display-flex-i"></i>
        </div>

        <select
            id="technicianStatusFilter"
            class="form-control form-control-styled status-select"
        >
            <option value="">All statuses</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>

        <a
            class="btn-custom btn-primary-custom text-decoration-none"
            href="{{ route('technicians.create') }}"
        >
            + Add Technician
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table
                id="techniciansTable"
                class="table-custom log-idtimestampuseractionentit-text-alt"
            >
                <thead>
                    <tr>
                        <th class="font-weight-bold log-id-text">NAME</th>
                        <th class="font-weight-bold log-id-text">PHONE</th>
                        <th class="font-weight-bold log-id-text">EMAIL</th>
                        <th class="font-weight-bold log-id-text">ACCESS</th>
                        <th class="font-weight-bold log-id-text">STATUS</th>
                        <th class="font-weight-bold log-id-text">ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($technicians as $technician)
                        <tr>
                            <td class="site-table-name">
                                <a
                                    class="tech-wo-green"
                                    href="{{ route('technicians.show', $technician) }}"
                                >
                                    {{ $technician->name }}
                                </a>
                            </td>

                            <td class="semantic-text-primary">
                                {{ $technician->phone ?: '—' }}
                            </td>

                            <td class="semantic-text-primary">
                                {{ $technician->email ?: '—' }}
                            </td>

                            <td class="semantic-text-primary">
                                {{ $technician->access }}
                            </td>

                            <td class="technician-status">
                                @if ($technician->active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            <td class="jajohn-admin-text">
                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('technicians.show', $technician) }}"
                                >
                                    View
                                </a>

                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('technicians.edit', $technician) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('technicians.destroy', $technician) }}"
                                    method="POST"
                                    class="d-inline delete-technician-form"
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
                            <td colspan="6" class="text-center">
                                No technicians found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $technicians->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('techniciansTable');
    const searchInput = document.querySelector(
        'input[data-live-search-for="#techniciansTable"]'
    );
    const statusFilter = document.getElementById('technicianStatusFilter');

    function filterTechnicians() {
        const searchText = searchInput.value.toLowerCase().trim();
        const selectedStatus = statusFilter.value.toLowerCase();

        table.querySelectorAll('tbody tr').forEach(function (row) {
            const cells = row.querySelectorAll('td');

            // Preserve the empty-state row.
            if (cells.length === 1 && cells[0].hasAttribute('colspan')) {
                return;
            }

            const rowText = row.innerText.toLowerCase();
            const statusCell = row.querySelector('.technician-status');
            const statusText = statusCell
                ? statusCell.innerText.trim().toLowerCase()
                : '';

            const matchesSearch = rowText.includes(searchText);
            const matchesStatus =
                selectedStatus === '' || statusText === selectedStatus;

            row.style.display =
                matchesSearch && matchesStatus ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTechnicians);
    statusFilter.addEventListener('change', filterTechnicians);

    // SweetAlert delete confirmation
    document.querySelectorAll('.delete-technician-form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            if (typeof Swal === 'undefined') {
                if (confirm('This technician will be permanently deleted. Continue?')) {
                    form.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'This technician will be permanently deleted.',
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
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection
