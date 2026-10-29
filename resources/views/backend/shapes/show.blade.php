@extends('layouts.master')
@section('topbar-title','Shapes Details')
@section('page-title','WorkOrder Pro - Shapes Details')
@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title font-weight-bold">
            {{ $shape->shape_name }}
        </h2>
    </div>
    <div class="panel border">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-muted mb-1">Shape name</div>
                <strong>{{ $shape->shape_name ?: "—" }}</strong>
            </div>
            <div class="col-md-4">
                <div class="text-muted mb-1">Shape code</div>
                <strong>{{ $shape->shape_code ?: "—" }}</strong>
            </div>
        </div>
    </div>
    <div class="display-flex justify-content-end gap-3 mt-4 mb-5">
        <a href="{{ route('shapes.index') }}" class="btn-back-custom">
            Back
        </a>
        <a href="{{ route('shapes.edit',$shape) }}" class="btn-primary-custom">
            Edit
        </a>
    </div>
</div>
@endsection