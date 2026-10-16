@extends('layouts.master')
@section('topbar-title','Store / Site Pictures Details')
@section('page-title','WorkOrder Pro - Store / Site Pictures Details')
@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title font-weight-bold">
            Store / Site Pictures Details
        </h2>
        <div>
            <a href="{{ route('store-pictures.index') }}" class="btn bg-white">Back</a> <a href="{{ route('store-pictures.edit',$item) }}" class="btn btn-success text-white">Edit</a>
        </div>
    </div>
    <div class="panel border">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="text-muted mb-1">Site</div>
                <strong>{{ $item->site->name ?? ('Site #'.$item->site_id) }}</strong>
            </div>
            <div class="col-md-6">
                <div class="text-muted mb-1">Description</div>
                <strong>{{ $item->description ?: '—' }}</strong>
            </div>
            <div class="col-md-6">
                <div class="text-muted mb-1">Notes</div>
                <strong>{{ $item->notes ?: '—' }}</strong>
            </div>
            <div class="col-12">
                <div class="text-muted mb-2">Picture</div>
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
