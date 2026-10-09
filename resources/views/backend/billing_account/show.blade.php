@extends('layouts.master')

@section('topbar-title', 'Billing Account')
@section('page-title', 'WorkOrder Pro - Billing Account')

@section('content')
<div class="content-area">
    <div class="manage-usersall-work-ordersvie-text">
        <h2 class="page-title font-weight-bold manage-usersall-work-ordersvie-text-h-custom">Billing Account detail</h2>
        <p class="manage-usersall-work-ordersvie-text-p-custom-primary">
            Billing Accounts / {{ $billTo->bill_name }} · #{{ $billTo->id }}
        </p>
    </div>

    <div class="panel border display-flex acacme-corporationactivecommer-text">
        <div class="avatar-square avatar-square-green display-flex avatar-square-lg panel-div-secondary">
            {{ strtoupper(substr($billTo->bill_name ?? 'BA', 0, 2)) }}
        </div>
        <div>
            <div class="font-weight-bold display-flex acme-corporationactive-text-alt">
                {{ $billTo->bill_name }}
            </div>
            <div class="users-text">Billing account details</div>
        </div>
    </div>

    <div class="row g-4 manage-usersall-work-ordersvie-text">
        <div class="column-full col-md-6">
            <div class="panel border role-identityrole-nameemaildes-text">
                <h4 class="font-weight-bold part-details-text">Billing account information</h4>
                <p><strong>Account number:</strong> {{ $billTo->bill_account ?? '—' }}</p>
                <p><strong>Purchase order:</strong> {{ $billTo->bill_po ?? '—' }}</p>
                <p><strong>Phone:</strong> {{ $billTo->bill_phone ?? '—' }}</p>
                <p><strong>Address:</strong> {{ $billTo->bill_address ?? '—' }}</p>
                <p><strong>City:</strong> {{ $billTo->bill_city ?? '—' }}</p>
                <p><strong>State:</strong> {{ $billTo->bill_state ?? '—' }}</p>
                <p><strong>ZIP:</strong> {{ $billTo->bill_zip ?? '—' }}</p>
            </div>
        </div>

        <div class="column-full col-md-6">
            <div class="panel border role-identityrole-nameemaildes-text">
                <h4 class="font-weight-bold part-details-text">Primary billing contact</h4>
                @php($primaryEmail = $billTo->emails->first())
                <p><strong>Contact name:</strong> {{ $primaryEmail->bill_name ?? '—' }}</p>
                <p><strong>Email:</strong> {{ $primaryEmail->bill_email ?? '—' }}</p>
                <p><strong>Status:</strong>
                    @if($primaryEmail && $primaryEmail->bill_active)
                        <span class="badge-status green badge-status-inline">Active</span>
                    @else
                        <span class="badge-status badge-status-inline">Inactive / not set</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="panel border role-identityrole-nameemaildes-text">
        <h4 class="font-weight-bold part-details-text">Billing rates</h4>
        <div class="row">
            <div class="col-6 super-admin-userssystempermis-text">
                <div class="font-weight-bold standard-labor-text">TRAVEL CHARGE</div>
                <div class="john-admin-text">{{ $billTo->bill_travel !== null ? '$'.number_format((float) $billTo->bill_travel, 2) : '—' }}</div>
            </div>
            <div class="col-6 super-admin-userssystempermis-text">
                <div class="font-weight-bold standard-labor-text">LABOR CHARGE</div>
                <div class="john-admin-text">{{ $billTo->bill_labor !== null ? '$'.number_format((float) $billTo->bill_labor, 2) : '—' }}</div>
            </div>
            <div class="col-6 super-admin-userssystempermis-text">
                <div class="font-weight-bold standard-labor-text">FUEL CHARGE</div>
                <div class="john-admin-text">{{ $billTo->bill_fuel !== null ? '$'.number_format((float) $billTo->bill_fuel, 2) : '—' }}</div>
            </div>
        </div>
    </div>

    <div class="panel border siteaddressactive-woslast-serv-text">
        <h4 class="font-weight-bold part-details-text">Sites</h4>
        <div class="table-responsive-custom">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead>
                    <tr>
                        <th class="font-weight-bold log-id-text">SITE</th>
                        <th class="font-weight-bold log-id-text">ADDRESS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($billTo->sites as $site)
                        <tr>
                            <td class="font-weight-bold jun-am-text">{{ $site->name ?? '—' }}</td>
                            <td class="market-st-san-francisco-text">{{ $site->address ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="market-st-san-francisco-text">No Sites are assigned to this billing account.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="display-flex create-role-text">
        <a class="btn-custom btn-outline-secondary border font-weight-bold btn-outline-padding-wide back-action-box text-decoration-none"
           href="{{ route('bill-to.index') }}">Back to Billing Accounts</a>
        <a class="btn btn-success px-4 py-2 font-weight-bold text-white" href="{{ route('bill-to.edit', $billTo) }}">Edit</a>
    </div>
</div>
@endsection
