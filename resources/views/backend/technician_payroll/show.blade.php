@extends('layouts.master')
@section('topbar-title','Technician Payroll Details')
@section('page-title','WorkOrder Pro - Technician Payroll Details')
@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between mb-4">
        <h2 class="page-title font-weight-bold">
            Technician Payroll Details
        </h2>
        <div>
            <a href="{{ route('technician-payroll.index') }}" class="btn-back-custom">
                Back
            </a>
            <a href="{{ route('technician-payroll.edit',$payroll) }}" class="btn-primary-custom">
                Edit
            </a>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="panel">
        <div class="row g-4">
            {{-- <div class="col-md-6">
                <strong>Payroll UID</strong>
                <p>{{ $payroll->tech_payroll_uid }}</p>
            </div> --}}
            <div class="col-md-6">
                <strong>Technician</strong>
                <p>{{ $payroll->technician->name ?? 'Unknown technician' }}</p>
            </div>
            <div class="col-md-6">
                <strong>Time In / Out</strong>
                <p>{{ $payroll->time_in_out->format('M d, Y H:i') }}</p>
            </div>
            <div class="col-md-6">
                <strong>Authorized</strong>
                <p>{{ $payroll->authorized?'Yes':'No' }}</p>
            </div>
            <div class="col-md-6">
                <strong>Paid</strong>
                <p>{{ $payroll->paid?'Yes':'No' }}</p>
            </div>
            <div class="col-md-6">
                <strong>Paid Check</strong>
                <p>{{ $payroll->paid_check?'Yes':'No' }}</p>
            </div>
            <div class="col-12">
                <strong>Notes</strong>
                <p>{{ $payroll->notes ?: '—' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection