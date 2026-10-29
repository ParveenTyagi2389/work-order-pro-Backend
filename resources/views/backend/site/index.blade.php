
@extends('layouts.master')

@section('title', 'WorkOrder Pro - Sites')
@section('page-title', 'Sites')

@section('content')
<div class="content-area">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="panel search-action-row">
        <div class="search-input-width search-box-max-width">
            <input
                class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                type="text"
                data-live-search-for="#sitesTable"
                placeholder="Search sites..."
                autocomplete="off"
            />
            <i class="fi-rs-search custom-icon-left-center display-flex-i"></i>
        </div>

        <select
            id="siteCustomerTypeFilter"
            class="form-control-custom"
        >
            <option value="">All customer types</option>

            @foreach ($customerTypes as $type)
                <option value="{{ $type->name }}">
                    {{ $type->name }}
                </option>
            @endforeach
        </select>

        <a
            class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none"
            href="{{ route('sites.create') }}"
        >
            + Add Site
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table
                id="sitesTable"
                class="table-custom log-idtimestampuseractionentit-text-alt"
            >
                <thead>
                    <tr>
                        <th class="font-weight-bold log-id-text">SITE</th>
                        <th class="font-weight-bold log-id-text">ADDRESS</th>
                        <th class="font-weight-bold log-id-text">CUSTOMER TYPE</th>
                        <th class="font-weight-bold log-id-text">BILL TO</th>
                        <th class="font-weight-bold log-id-text">ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($sites as $site)
                        <tr>
                            <td class="site-table-name">
                                <a
                                    class="tech-wo-green"
                                    href="{{ route('sites.show', $site) }}"
                                >
                                    {{ $site->name }}
                                </a>

                                <div class="jajohn-admin-text-div-custom">
                                    {{ $site->site_id ?? '—' }}
                                </div>
                            </td>

                            <td class="semantic-text-primary">
                                {{ $site->address ?? '—' }}

                                <div>
                                    {{ trim(($site->city ?? '') . ' ' . ($site->state ?? '') . ' ' . ($site->zip ?? '')) }}
                                </div>
                            </td>

                            <td class="semantic-text-primary">
                                {{ $site->customerType?->name ?? $site->customer_type }}
                            </td>

                            <td class="semantic-text-primary">
                                {{ $site->billTo?->bill_name ?? '—' }}
                            </td>

                            <td class="jajohn-admin-text">
                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('sites.show', $site) }}"
                                >
                                    View
                                </a>

                                <a
                                    class="btn-action-simple text-decoration-none"
                                    href="{{ route('sites.edit', $site) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('sites.destroy', $site) }}"
                                    method="POST"
                                    class="d-inline delete-site-form"
                                    
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn border btn-small-padding view-action"
                                        type="submit"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No sites found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $sites->links() }}
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    const $sitesTable = $('#sitesTable');
    const $searchInput = $('input[data-live-search-for="#sitesTable"]');
    const $customerTypeFilter = $('#siteCustomerTypeFilter');

    function filterSites() {
        const searchText = ($searchInput.val() || '').toLowerCase().trim();
        const selectedType = ($customerTypeFilter.val() || '').toLowerCase().trim();

        $sitesTable.find('tbody tr').each(function () {
            const $row = $(this);
            const rowText = $row.text().toLowerCase();

            // Customer type is the third column (index 2).
            const customerType = $row.find('td').eq(2).text().toLowerCase().trim();

            // Keep the empty-state row visible if the table has no site records.
            if ($row.find('td').length === 1 && $row.find('td').attr('colspan')) {
                return;
            }

            const matchesSearch = rowText.includes(searchText);
            const matchesType = !selectedType || customerType === selectedType;

            $row.toggle(matchesSearch && matchesType);
        });
    }

    $searchInput.on('input', filterSites);
    $customerTypeFilter.on('change', filterSites);
});

    // ================= SWEETALERT DELETE CONFIRMATION =================
document.querySelectorAll('.delete-site-form').forEach(function (form) {

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Fallback if SweetAlert2 is not loaded.
        if (typeof Swal === 'undefined') {
            if (window.confirm('This site will be permanently deleted. Continue?')) {
                form.submit();
            }
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'This site will be permanently deleted.',
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
