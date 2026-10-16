@extends('layouts.master')

@section('topbar-title', 'Part Details')
@section('page-title', 'WorkOrder Pro - Part Details')

@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title font-weight-bold">{{ $part->part_number }}</h2>
            <p class="breadcrumb-text">Parts · Details</p>
        </div>
        <div class="wo-action-btns">
            <a href="{{ route('parts.index') }}" class="btn bg-white font-weight-bold btn-back-custom">Back</a>
            <a href="{{ route('parts.edit', $part) }}" class="btn btn-success text-white font-weight-bold btn-primary-custom">Edit</a>
        </div>
    </div>

    <div class="panel border">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="text-muted mb-1">Part number</div>
                <div class="font-weight-bold">{{ $part->part_number }}</div>
            </div>
            <div class="col-12">
                <div class="text-muted mb-1">Description</div>
                <div>{{ $part->description ?: '—' }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted mb-1">Created at</div>
                <div>{{ $part->created_at?->format('d M Y, h:i A') ?? '—' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
