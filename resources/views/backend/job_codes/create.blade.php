@extends('layouts.master')
@section('topbar-title','Add Job Code')
@section('page-title','WorkOrder Pro - Add Job Code')
@section('content')
<div class="content-area"><div class="mb-4"><h2 class="page-title font-weight-bold">Add Job Code</h2></div>
<form method="POST" action="{{ route('job-codes.store') }}">@csrf @include('backend.job_codes._form')</form></div>
@endsection
