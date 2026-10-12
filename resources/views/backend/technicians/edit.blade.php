@extends('layouts.master')
@section('topbar-title', 'Edit Technician')
@section('page-title', 'WorkOrder Pro - Edit Technician')
@section('content')
<div class="content-area">
    @if ($errors->any())<div class="alert alert-danger">Please correct the highlighted fields.</div>@endif
    <div class="mb-4"><h2 class="page-title font-weight-bold">Edit Technician</h2><p class="breadcrumb-text">Technicians · {{ $technician->name }}</p></div>
    <form method="POST" action="{{ route('technicians.update', $technician) }}">
        @csrf
        @method('PUT')
        @include('backend.technicians._form', ['technician' => $technician])
    </form>
</div>
@endsection
