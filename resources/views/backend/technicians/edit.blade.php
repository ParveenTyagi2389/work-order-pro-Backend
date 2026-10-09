@extends('layouts.master')
@section('title','WorkOrder Pro - Edit Technician')
@section('header-title','Technician')
@section('content')
<div class="manage-usersall-work-ordersvie-text"><h2 class="page-title font-weight-bold manage-usersall-work-ordersvie-text-h-custom">Edit Technician</h2><p class="users-text">Complete the profile to update the field technician</p></div>
@include('backend.technicians._form')
@endsection
