@extends('layouts.master')
@section('topbar-title','Edit Technician Payroll')
@section('page-title','WorkOrder Pro - Edit Technician Payroll')
@section('content')<div class="content-area"><h2 class="page-title font-weight-bold mb-4">Edit Technician Payroll</h2><form method="POST" action="{{ route('technician-payroll.update',$payroll) }}">@csrf @method('PUT') @include('backend.technician_payroll._form')</form></div>@endsection