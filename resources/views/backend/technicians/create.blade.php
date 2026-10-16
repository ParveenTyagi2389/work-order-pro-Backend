@extends('layouts.master')
@section('topbar-title', 'Add Technician')
@section('page-title', 'WorkOrder Pro - Add Technician')
@section('content')
<div class="content-area">
    @if ($errors->any())<div class="alert alert-danger">Please correct the highlighted fields.</div>@endif
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">
            Add Technician
        </h2>
        <p class="breadcrumb-text">
            Technicians · Add technician details
        </p>
    </div>
    <form method="POST" action="{{ route('technicians.store') }}">
        @csrf
        @include('backend.technicians._form')
    </form>
</div>
@endsection
