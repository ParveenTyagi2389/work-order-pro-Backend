@extends('layouts.master')

@section('title', 'WorkOrder Pro - Site Details')
@section('page-title', 'Sites')

@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title-custom mb-1">{{ $site->name }}</h2>
        <p class="text-muted text-base">Sites / {{ $site->site_id ?? '—' }} · Location and access details</p>
    </div>
    <div class="panel">
        <div class="row g-3">
            <div class="col-md-6"><strong>Site name:</strong> {{ $site->name }}</div>
            <div class="col-md-6"><strong>External site ID:</strong> {{ $site->site_id ?? '—' }}</div>
            <div class="col-md-6"><strong>Customer type:</strong> {{ $site->customerType?->name ?? $site->customer_type }}</div>
            <div class="col-md-6"><strong>Bill to:</strong> {{ $site->billTo?->bill_name ?? '—' }}</div>
            <div class="col-md-6"><strong>Address:</strong> {{ $site->address ?? '—' }}</div>
            <div class="col-md-6"><strong>City:</strong> {{ $site->city ?? '—' }}</div>
            <div class="col-md-6"><strong>State:</strong> {{ $site->state ?? '—' }}</div>
            <div class="col-md-6"><strong>ZIP:</strong> {{ $site->zip ?? '—' }}</div>
            <div class="col-md-6"><strong>Latitude:</strong> {{ $site->latitude ?? '—' }}</div>
            <div class="col-md-6"><strong>Longitude:</strong> {{ $site->longitude ?? '—' }}</div>
            <div class="col-md-6"><strong>Service window:</strong> {{ $site->hours ?? '—' }}</div>
            <div class="col-12"><strong>Arrival instructions:</strong> {{ $site->notes ?? '—' }}</div>
            <div class="col-12"><strong>CVS link:</strong>
                @if($site->cvs_link)<a href="{{ $site->cvs_link }}" target="_blank" rel="noopener noreferrer">{{ $site->cvs_link }}</a>@else — @endif
            </div>
        </div>
        <div class="display-flex justify-content-end gap-3 mt-4">
            <a class="btn bg-white font-weight-bold w-fixed-sm" href="{{ route('sites.index') }}">Back</a>
            <a class="btn btn-success font-weight-bold text-white w-fixed-sm" href="{{ route('sites.edit', $site) }}">Edit</a>
        </div>
    </div>
</div>
@endsection
