@extends('layouts.master')
@section('topbar-title','Job Reimbursements')
@section('page-title','WorkOrder Pro - Job Reimbursements')
@section('content')
<div class="content-area">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Job Reimbursements</h2>
        <p class="breadcrumb-text">Manage job reimbursements for work orders.</p>
    </div>
    <div class="search-action-row">
        <form method="GET" action="{{ route('job-reimbursements.index') }}" class="search-input-width search-box-max-width">
            <input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom" name="search" value="{{ request('search') }}" placeholder="Search records">
            <button class="btn border btn-small-padding view-action" type="submit">Search</button>
        </form>
        <a class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none" href="{{ route('job-reimbursements.create') }}">+ Add Record</a>
    </div>
    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead>
                    <tr>
                        <th>Work order</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobReimbursements as $item)
                        <tr>
                            <td>{{ $item->workOrder->customer_work_order ?? ('WO-'.$item->work_order_id) }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->description ?? '—' }}</td>
                            <td>
                                <a href="{{ route('job-reimbursements.show',$item) }}">View</a> 
                                <a href="{{ route('job-reimbursements.edit',$item) }}">Edit</a>
                                <form class="d-inline" method="POST" action="{{ route('job-reimbursements.destroy',$item) }}" onsubmit="return confirm('Delete this record?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $jobReimbursements->links() }}
        </div>
    </div>
</div>
@endsection
