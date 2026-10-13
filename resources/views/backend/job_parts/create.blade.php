@extends('layouts.master')
@section('topbar-title','Add Job Part')
@section('page-title','WorkOrder Pro - Add Job Part')
@section('content')
<div class="content-area"><div class="mb-4"><h2 class="page-title font-weight-bold">Add Job Part</h2><p class="breadcrumb-text">Assign a part to a work order.</p></div><form method="POST" action="{{ route('job-parts.store') }}">@csrf @include('backend.job_parts._form')</form></div>
@endsection
