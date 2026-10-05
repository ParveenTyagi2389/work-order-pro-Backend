@extends('layouts.master')

@section('title', 'WorkOrder Pro - Site Detail')
@section('page-title', 'Sites')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title-custom mb-1">{{ $site->name }}</h2>
            <p class="text-muted text-base">
                {{ $site->site_id }} · {{ $site->billTo?->name }}
            </p>
        </div>
        <div>
            <a href="{{ route('sites.edit', $site) }}" class="btn btn-success text-white font-weight-bold">Edit</a>
            <a href="{{ route('sites.index') }}" class="btn bg-white font-weight-bold">Back</a>
        </div>
    </div>

    <div class="panel">
        <div class="row g-3">
            <div class="col-md-4"><strong>Customer type:</strong> {{ $site->customerType?->name }}</div>
            <div class="col-md-4"><strong>Bill to:</strong> {{ $site->billTo?->name }}</div>
            <div class="col-md-4"><strong>Contact:</strong> {{ $site->contact_name }}</div>
            <div class="col-md-4"><strong>City:</strong> {{ $site->city }}</div>
            <div class="col-md-4"><strong>State:</strong> {{ $site->state }}</div>
            <div class="col-md-4"><strong>ZIP:</strong> {{ $site->zip }}</div>
            <div class="col-md-4"><strong>Latitude:</strong> {{ $site->latitude }}</div>
            <div class="col-md-4"><strong>Longitude:</strong> {{ $site->longitude }}</div>
            <div class="col-md-4"><strong>Hours:</strong> {{ $site->hours }}</div>
            <div class="col-12"><strong>Address:</strong> {{ $site->address }}</div>
            <div class="col-12"><strong>Notes:</strong> {{ $site->notes }}</div>
        </div>
    </div>
@endsection