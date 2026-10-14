@extends('layouts.master')
@section('topbar-title','Job Billing Details')
@section('page-title','WorkOrder Pro - Job Billing Details')
@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title font-weight-bold">
            Job Billing Details
        </h2>
        <div>
            <a href="{{ route('job-billables.index') }}" class="btn bg-white">
                Back
            </a> 
            <a href="{{ route('job-billables.edit',$jobBillable) }}" class="btn btn-success text-white">
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
                    {{ $jobBillable->workOrder->customer_work_order ?? ('WO-'.$jobBillable->work_order_id) }}
                </strong>
            </div>
            <div class="col-md-6">
                <div class="text-muted mb-1">
                    Check-in
                </div>
                <strong>
                    {{ $jobBillable->check_in?->format('d M Y, h:i A') ?? '—' }}
                </strong>
            </div>
            <div class="col-md-6">
                <div class="text-muted mb-1">
                    Check-out
                </div>
                <strong>
                    {{ $jobBillable->check_out?->format('d M Y, h:i A') ?? '—' }}
                </strong>
            </div>
            <div class="col-md-6">
                <div class="text-muted mb-1">
                    Description
                </div>
                <strong>
                    {{ $jobBillable->description ?? '—' }}
                </strong>
            </div>
        </div>
    </div>
@endsection
