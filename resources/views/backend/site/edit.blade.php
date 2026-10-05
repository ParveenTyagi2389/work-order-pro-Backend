@extends('layouts.master')

@section('title', 'WorkOrder Pro - Edit Site')
@section('page-title', 'Sites')

@section('content')
    <div class="mb-4">
        <h2 class="page-title-custom mb-1">Edit site · {{ $site->name }}</h2>
        <p class="text-muted text-base">
            Sites / {{ $site->site_id ?? '—' }} · {{ $site->billTo?->name }} · Location and access details
        </p>
    </div>

    <form method="POST" action="{{ route('sites.update', $site) }}">
        @include('backend.site._form', ['site' => $site])
    </form>
@endsection