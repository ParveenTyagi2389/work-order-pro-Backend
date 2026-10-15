@extends('layouts.master')
@section('topbar-title','Edit Job Code')
@section('page-title','WorkOrder Pro - Edit Job Code')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Edit Job Code</h2>
    </div>
    <form method="POST" action="{{ route('job-codes.update', $jobCode) }}">
        @csrf
        @method('PUT')
        @include('backend.job_codes._form', ['jobCode' => $jobCode])
    </form>
</div>
@endsection
