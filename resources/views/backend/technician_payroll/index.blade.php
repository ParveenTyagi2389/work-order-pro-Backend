@extends('layouts.master')

@section('topbar-title', 'Technician Payroll')
@section('page-title', 'WorkOrder Pro - Technician Payroll')

@section('content')
<div class="content-area">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="page-title font-weight-bold mb-4">
        Technician Payroll
    </h2>

    <div class="search-action-row">
        <div class="search-input-width search-box-max-width">
            <input
                type="text"
                data-live-search-for="#technicianPayrollTable"
                placeholder="Search technician or notes"
                class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                autocomplete="off"
            >
        </div>

        <select
            id="payrollPaidFilter"
            class="form-control-custom"
        >
            <option value="">All payment statuses</option>
            <option value="1">Paid</option>
            <option value="0">Unpaid</option>
        </select>

        <a
            href="{{ route('technician-payroll.create') }}"
            class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none"
        >
            + Add Payroll
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table
                id="technicianPayrollTable"
                class="table-custom log-idtimestampuseractionentit-text-alt"
            >
                <thead>
                    <tr>
                        <th>TECHNICIAN</th>
                        <th>TIME IN / OUT</th>
                        <th>AUTHORIZED</th>
                        <th>PAID</th>
                        <th>PAID CHECK</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($payrolls as $p)
                        <tr>
                            <td>
                                {{ $p->technician->name ?? 'Unknown technician' }}
                            </td>

                            <td>
                                {{ $p->time_in_out?->format('M d, Y H:i') ?? '—' }}
                            </td>

                            <td>{{ $p->authorized ? 'Yes' : 'No' }}</td>

                            <td class="payroll-paid-status">
                                {{ $p->paid ? 'Yes' : 'No' }}
                            </td>

                            <td>{{ $p->paid_check ? 'Yes' : 'No' }}</td>

                            <td class="jajohn-admin-text">
                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('technician-payroll.show', $p) }}"
                                >
                                    View
                                </a>

                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('technician-payroll.edit', $p) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('technician-payroll.destroy', $p) }}"
                                    class="d-inline delete-technician-payroll-form  "
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
                            <td colspan="6" class="text-center">
                                No payroll records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $payrolls->links() }}
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    const $table = $('#technicianPayrollTable');
    const $searchInput = $('input[data-live-search-for="#technicianPayrollTable"]');
    const $paidFilter = $('#payrollPaidFilter');

    function filterPayrolls() {
        const searchText = ($searchInput.val() || '').toLowerCase().trim();
        const paidValue = $paidFilter.val();

        $table.find('tbody tr').each(function () {
            const $row = $(this);
            const $cells = $row.find('td');

            // Keep the empty-state row visible.
            if ($cells.length === 1 && $cells.attr('colspan')) {
                return;
            }

            const rowText = $row.text().toLowerCase();

            // PAID is the fourth column (index 3).
            const isPaid = $row.find('.payroll-paid-status')
                .text()
                .trim()
                .toLowerCase() === 'yes';

            const matchesSearch = rowText.includes(searchText);
            const matchesPaid =
                paidValue === '' ||
                (paidValue === '1' && isPaid) ||
                (paidValue === '0' && !isPaid);

            $row.toggle(matchesSearch && matchesPaid);
        });
    }

    $searchInput.on('input', filterPayrolls);
    $paidFilter.on('change', filterPayrolls);
});

    // ================= SWEETALERT DELETE CONFIRMATION =================
    document.querySelectorAll('.delete-technician-payroll-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Fallback if SweetAlert2 is not loaded.
            if (typeof Swal === 'undefined') {
                if (window.confirm('This technician payroll record will be permanently deleted. Continue?')) {
                    form.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'This technician payroll record will be permanently deleted.',
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
