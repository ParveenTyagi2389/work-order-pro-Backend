@extends('layouts.master')
@section('topbar-title','Add Job Flat Rates')
@section('page-title','WorkOrder Pro - Add Job Flat Rates')
@section('content')
<div class="content-area"><div class="mb-4"><h2 class="page-title font-weight-bold">Add Job Flat Rates</h2></div><form method="POST" action="{{ route('job-flat-rates.store') }}">@csrf @include('backend.job_flat_rates._form')</form></div>
@endsection
