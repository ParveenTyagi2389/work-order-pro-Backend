@extends('layouts.master')
@section('topbar-title','Job Reimbursements Details')
@section('page-title','WorkOrder Pro - Job Reimbursements Details')
@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title font-weight-bold">
            Job Reimbursements Details
        </h2>
        <div>
            <a href="{{ route('job-reimbursements.index') }}" class="btn bg-white">
                Back
            </a>
            <a href="{{ route('job-reimbursements.edit',$jobItem) }}" class="btn btn-success text-white">
                Edit
            </a>
        </div>
    </div>
    <div class="panel border">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="text-muted mb-1">
                    Work order
                </div>
                <strong>
                    {{ $jobItem->workOrder->customer_work_order ?? ('WO-'.$jobItem->work_order_id) }}
                </strong>
            </div>
            <div class="col-md-6">
                <div class="text-muted mb-1">
                    Description
                </div>
                <strong>
                    {{ $jobItem->description ?? '—' }}
                </strong>
            </div>
            <div class="col-md-6">
                <div class="text-muted mb-1">
                    Amount
                </div>
                <strong>
                    {{ $jobItem->amount ?? '—' }}
                </strong>
            </div>
        </div>
    </div>
</div>
@endsection
