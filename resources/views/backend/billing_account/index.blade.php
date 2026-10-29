
@extends('layouts.master')

@section('topbar-title', 'Billing Accounts')
@section('page-title', 'Billing Accounts')

@section('content')
<div class="content-area">
    <div class="row g-4 manage-usersall-work-ordersvie-text">
        <div class="col-md-4">
            <div class="stat-card border upload-box-dashed total-customers-text-alt">
                <div class="stat-details">
                    <span class="stat-label font-weight-semibold custom-d-block total-customers-text">Total Billing Accounts</span>
                    <span class="stat-value font-weight-bold custom-d-block text-dark-lg">{{ $totalBillTos }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card border upload-box-dashed total-customers-text-alt">
                <div class="stat-details">
                    <span class="stat-label font-weight-semibold custom-d-block total-customers-text">Accounts with Active Contacts</span>
                    <span class="stat-value font-weight-bold custom-d-block semantic-text">{{ $activeBillTos }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card border upload-box-dashed total-customers-text-alt">
                <div class="stat-details">
                    <span class="stat-label font-weight-semibold custom-d-block total-customers-text">Accounts on This Page</span>
                    <span class="stat-value clr-blue font-weight-bold custom-d-block stat-details-span">{{ $billTos->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="panel display-flex panel-header-padding code-usageactive-text">

        {{-- Live search: no submit button --}}
        <div class="display-flex all-statusall-types-text gap-16 w-100">
            <div class="search-input-width search-box-max-width">
                <input
                    id="billingAccountSearch"
                    class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                    type="search"
                    data-live-search-for="#billingAccountsTable"
                    value="{{ request('search') }}"
                    placeholder="Search billing accounts..."
                    autocomplete="off"
                />
                <i class="fi-rs-search custom-icon-left-center display-flex-i"></i>
            </div>
        </div>

        <a class="btn-custom btn-primary-custom add-customer-action"
           href="{{ route('bill-to.create') }}">
            + Add Billing Account
        </a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table id="billingAccountsTable"
                   class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead>
                    <tr>
                        <th class="font-weight-bold customer-text">BILLING ACCOUNT</th>
                        <th class="font-weight-bold customer-text">ACCOUNT NUMBER</th>
                        <th class="font-weight-bold customer-text">PRIMARY CONTACT</th>
                        <th class="font-weight-bold customer-text">PHONE</th>
                        <th class="font-weight-bold customer-text">SITES</th>
                        <th class="font-weight-bold customer-text">TRAVEL RATE</th>
                        <th class="font-weight-bold customer-text">STATUS</th>
                        <th class="font-weight-bold customer-text">ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($billTos as $billTo)
                        @php
                            $primaryEmail = $billTo->emails->first();
                        @endphp

                        <tr>
                            <td class="jajohn-admin-text">
                                <div class="all-actionsall-usersall-entiti-text-secondary">
                                    <div class="avatar-square avatar-square-green">
                                        {{ strtoupper(substr($billTo->bill_name ?? 'BA', 0, 2)) }}
                                    </div>

                                    <div>
                                        <div class="font-weight-bold john-admin-text">
                                            {{ $billTo->bill_name ?? 'Unnamed billing account' }}
                                        </div>
                                        <div class="jajohn-admin-text-div-custom">
                                            Billing Account #{{ $billTo->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="semantic-text-primary">
                                {{ $billTo->bill_account ?? '—' }}
                            </td>

                            <td class="semantic-text-primary">
                                <div>{{ $primaryEmail->bill_name ?? '—' }}</div>
                                <div class="jajohn-admin-text-div-custom">
                                    {{ $primaryEmail->bill_email ?? '' }}
                                </div>
                            </td>

                            <td class="semantic-text-primary">
                                {{ $billTo->bill_phone ?? '—' }}
                            </td>

                            <td class="semantic-text-primary">
                                {{ $billTo->sites_count }}
                            </td>

                            <td class="semantic-text-primary">
                                {{ $billTo->bill_travel !== null
                                    ? number_format((float) $billTo->bill_travel, 2)
                                    : '—' }}
                            </td>

                            <td class="jajohn-admin-text">
                                @if($primaryEmail && $primaryEmail->bill_active)
                                    <span class="badge-status green badge-status-inline">
                                        Active
                                    </span>
                                @else
                                    <span class="badge-status badge-status-inline">
                                        No active contact
                                    </span>
                                @endif
                            </td>

                            <td class="viewedit-text">
                                <div class="display-flex viewedit-text-div-custom">
                                    <a class="btn border btn-small-padding view-action"
                                       href="{{ route('bill-to.show', $billTo) }}">
                                        View
                                    </a>

                                    <a class="btn border btn-small-padding view-action"
                                       href="{{ route('bill-to.edit', $billTo) }}">
                                        Edit
                                    </a>

                                    @if($billTo->sites_count === 0)
                                        <form method="POST"
                                              action="{{ route('bill-to.destroy', $billTo) }}"
                                              class="delete-bill-to-form">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn border btn-small-padding view-action"
                                                    type="submit">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="semantic-text-primary">
                                No billing accounts found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-box display-flex pagination-box-padding total-text-primary">
            <span class="users-text">
                Showing {{ $billTos->firstItem() ?? 0 }}–{{ $billTos->lastItem() ?? 0 }}
                of {{ $billTos->total() }} billing accounts
            </span>

            <div class="display-flex flex-gap-sm">
                {{ $billTos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    // ================= SWEETALERT DELETE CONFIRMATION =================
    document.querySelectorAll('.delete-bill-to-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Fallback if SweetAlert2 is not loaded.
            if (typeof Swal === 'undefined') {
                if (window.confirm('This billing account will be permanently deleted. Continue?')) {
                    form.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'This billing account will be permanently deleted.',
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