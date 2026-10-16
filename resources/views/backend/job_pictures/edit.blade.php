@extends('layouts.master')
@section('topbar-title','Edit Job Pictures')
@section('page-title','WorkOrder Pro - Edit Job Pictures')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">
            Edit Job Pictures
        </h2>
    </div>
    <form method="POST" enctype="multipart/form-data" action="{{ route('job-pictures.update', $jobPicture) }}">
        @csrf
        @method('PUT')
        @include('backend.job_pictures._form', ['jobPicture' => $jobPicture])
    </form>
</div>
@endsection
