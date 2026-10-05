@extends('layouts.master')

@section('title', 'WorkOrder Pro - Add Site')
@section('page-title', 'Sites')

@section('content')
    <div class="mb-4">
        <h2 class="page-title-custom mb-1">Add site</h2>
        <p class="text-muted text-base">Sites · New location and access details</p>
    </div>

    <form method="POST" action="{{ route('sites.store') }}">
        @include('backend.site._form')
    </form>
@endsection