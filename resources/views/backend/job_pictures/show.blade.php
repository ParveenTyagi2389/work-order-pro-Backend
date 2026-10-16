@extends('layouts.master')
@section('topbar-title','Job Pictures Details')
@section('page-title','WorkOrder Pro - Job Pictures Details')
@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title font-weight-bold">
            Job Pictures Details
        </h2>
        <div>
            <a href="{{ route('job-pictures.index') }}" class="btn bg-white">
                Back
            </a>
            <a href="{{ route('job-pictures.edit',$item) }}" class="btn btn-success text-white">
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
                <strong>{{ $item->workOrder->customer_work_order ?? ('WO-'.$item->work_order_id) }}</strong>
            </div>
            <div class="col-md-6">
                <div class="text-muted mb-1">
                    Description
                </div>
                <strong>{{ $item->description ?: '—' }}</strong>
            </div>
            <div class="col-12">
                <div class="text-muted mb-2">
                    Picture
                </div>
                @if($item->picture)
                    <img src="{{ asset('storage/'.$item->picture) }}" alt="Picture" style="max-width:480px;max-height:360px;object-fit:contain">
                @else
                    —
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
