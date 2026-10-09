@extends('layouts.master')

@section('topbar-title', 'Customer Types')

@section('page-title', 'WorkOrder Pro - Customer Types')

@section('content')
<div class="content-area">

    <div class="row acacme-corporationactivecommer-text manage-usersall-work-ordersvie-text">
        <div class="col-md-4">
        <div class="stat-card border upload-box-dashed total-customers-text-alt">
            <div class="stat-details">
            <span class="stat-label font-weight-semibold custom-d-block total-customers-text">
                Total Customers
            </span>
            <span class="stat-value font-weight-bold custom-d-block text-dark-lg">
               {{ $totalTypes }}
            </span>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="stat-card border upload-box-dashed total-customers-text-alt">
            <div class="stat-details">
            <span class="stat-label font-weight-semibold custom-d-block total-customers-text">
                Active
            </span>
            <span class="stat-value font-weight-bold custom-d-block semantic-text">
                {{ $typesInUse }}
            </span>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="stat-card border upload-box-dashed total-customers-text-alt">
            <div class="stat-details">
            <span class="stat-label font-weight-semibold custom-d-block total-customers-text">
                New This Month
            </span>
            <span class="stat-value clr-blue font-weight-bold custom-d-block stat-details-span">
                {{ $newThisMonth }}
            </span>
            </div>
        </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-4">{{ session('error') }}</div>
    @endif

    <div class="panel display-flex panel-header-padding code-usageactive-text">
        <form class="display-flex all-statusall-types-text w-100" method="GET" action="{{ route('customer-types.index') }}">
            <div class="search-input-width search-box-max-width">
                <input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                    name="search" value="{{ $search }}" placeholder="Search customer types..." type="text" />
                <i class="fi-rs-search custom-icon-left-center display-flex-i"></i>
            </div>
            <button class="btn-custom btn-outline-secondary ms-2" type="submit">Search</button>
            <a class="btn-custom btn-primary-custom add-customer-action ms-auto"
            href="{{ route('customer-types.create') }}">+ Add Customer Type</a>
        </form>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead>
                    <tr>
                        <th class="font-weight-bold customer-text">CUSTOMER TYPE</th>
                        <th class="font-weight-bold customer-text">SITES</th>
                        <th class="font-weight-bold customer-text">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($customerTypes as $customerType)
                    @php($initials = collect(preg_split('/\s+/', trim($customerType->name)))->map(fn($part) => strtoupper(substr($part, 0, 1)))->take(2)->join(''))
                    <tr class="cursor-pointer">
                        <td class="jajohn-admin-text">
                            <div class="all-actionsall-usersall-entiti-text-secondary">
                                <div class="avatar-square avatar-square-green">{{ $initials ?: 'CT' }}</div>
                                <div>
                                    <div class="font-weight-bold john-admin-text">{{ $customerType->name }}</div>
                                    <div class="jajohn-admin-text-div-custom">ID #{{ $customerType->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="semantic-text-primary">{{ $customerType->sites_count }}</td>
                        <td class="viewedit-text">
                            <div class="display-flex viewedit-text-div-custom">
                                <a class="btn border btn-small-padding view-action"
                                href="{{ route('customer-types.show', $customerType) }}">View</a>
                                <a class="btn border btn-small-padding view-action"
                                href="{{ route('customer-types.edit', $customerType) }}">Edit</a>
                                <form method="POST" action="{{ route('customer-types.destroy', $customerType) }}"
                                    onsubmit="return confirm('Delete this customer type?');">
                                    @csrf @method('DELETE')
                                    <button class="btn border btn-small-padding view-action" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center py-4">No customer types found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-box display-flex pagination-box-padding total-text-primary">
            <span class="users-text">
                Showing {{ $customerTypes->firstItem() ?? 0 }}-{{ $customerTypes->lastItem() ?? 0 }}
                of {{ $customerTypes->total() }} customer types
            </span>
            <div>{{ $customerTypes->links() }}</div>
        </div>
    </div>
</div>
@endsection
