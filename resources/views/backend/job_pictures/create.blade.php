@extends('layouts.master')
@section('topbar-title','Add Job Pictures')
@section('page-title','WorkOrder Pro - Add Job Pictures')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">
            Add Job Pictures
        </h2>
    </div>
    <form method="POST" enctype="multipart/form-data" action="{{ route('job-pictures.store') }}">
        @csrf
        @include('backend.job_pictures._form')
    </form>
</div>
@endsection
