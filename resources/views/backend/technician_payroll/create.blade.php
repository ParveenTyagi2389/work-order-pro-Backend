@extends('layouts.master')
@section('topbar-title','Add Technician Payroll')
@section('page-title','WorkOrder Pro - Add Technician Payroll')
@section('content')
<div class="content-area">
    <h2 class="page-title font-weight-bold mb-4">
        Add Technician Payroll
    </h2>
    <form method="POST" action="{{ route('technician-payroll.store') }}">
        @csrf 
        @include('backend.technician_payroll._form')
    </form>
</div>
@endsection