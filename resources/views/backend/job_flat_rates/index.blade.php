@extends('layouts.master')
@section('topbar-title','Job Flat Rates')
@section('page-title','WorkOrder Pro - Job Flat Rates')
@section('content')
<div class="content-area">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Job Flat Rates</h2>
        <p class="breadcrumb-text">Manage job flat rates for work orders.</p>
    </div>
    <div class="panel search-action-row">
        <form method="GET" action="{{ route('job-flat-rates.index') }}" class="search-input-width search-box-max-width"><input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom" name="search" value="{{ request('search') }}" placeholder="Search records"><i class="fi-rs-search filter-search-icon"></i><button class="btn border btn-small-padding view-action" type="submit">Search</button></form><a class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none" href="{{ route('job-flat-rates.create') }}">+ Add Record</a>
    </div>
    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead>
                    <tr>
                        <th>Work order</th>
                        <th>Rate</th>
                        <th>Description</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobFlatRates as $item)<tr>
                        <td>{{ $item->workOrder->customer_work_order ?? ('WO-'.$item->work_order_id) }}</td>
                        <td>{{ $item->rate }}</td>
                        <td>{{ $item->description ?? '—' }}</td>
                        <td class="jajohn-admin-text">
                            <a class="btn-action-simple text-decoration-none" href="{{ route('job-flat-rates.show',$item) }}">View</a>
                            <a class="btn-action-simple text-decoration-none" href="{{ route('job-flat-rates.edit',$item) }}">Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('job-flat-rates.destroy',$item) }}" onsubmit="return confirm('Delete this record?')">@csrf @method('DELETE')<button type="submit" class="btn-action-simple">Delete</button></form>
                        </td>
                    </tr>@empty<tr>
                        <td colspan="4" class="text-center">No records found.</td>
                    </tr>@endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $jobFlatRates->links() }}</div>
    </div>
</div>
@endsection