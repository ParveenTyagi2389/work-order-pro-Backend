@extends('layouts.master')
@section('topbar-title', 'Technician Details')
@section('page-title', 'WorkOrder Pro - Technician Details')
@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div><h2 class="page-title font-weight-bold">{{ $technician->name }}</h2><p class="breadcrumb-text">Technicians · Details</p></div>
    </div>
    <div class="panel border">
        <div class="row g-4">
            <div class="col-md-6"><div class="text-muted mb-1">Name</div><div class="font-weight-bold">{{ $technician->name }}</div></div>
            <div class="col-md-6"><div class="text-muted mb-1">Access</div><div class="font-weight-bold">{{ $technician->access }}</div></div>
            <div class="col-md-6"><div class="text-muted mb-1">Phone</div><div class="font-weight-bold">{{ $technician->phone ?: '—' }}</div></div>
            <div class="col-md-6"><div class="text-muted mb-1">Email</div><div class="font-weight-bold">{{ $technician->email ?: '—' }}</div></div>
            <div class="col-md-6"><div class="text-muted mb-1">Status</div><div class="font-weight-bold">{{ $technician->active ? 'Active' : 'Inactive' }}</div></div>
            <div class="col-12"><div class="text-muted mb-1">Notes</div><div>{{ $technician->notes ?: '—' }}</div></div>
        </div>
    </div>
            <div class="display-flex justify-content-end gap-3 mt-4 mb-5"><a href="{{ route('technicians.index') }}" class="btn-back-custom">Back</a><a href="{{ route('technicians.edit', $technician) }}" class="btn-primary-custom">Edit</a></div>
</div>
@endsection
