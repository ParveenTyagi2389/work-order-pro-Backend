@extends('layouts.master')
@section('topbar-title','Job Codes Details')
@section('page-title','WorkOrder Pro - Job Codes Details')
@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title font-weight-bold">
            {{ $jobCode->foldername }}
        </h2>
    </div>
    <div class="panel border">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-muted mb-1">
                    Job code name
                </div>
                <strong>
                    {{ $jobCode->foldername ?: "—" }}
                </strong>
            </div>
            <div class="col-md-4">
                <div class="text-muted mb-1">
                    Color
                </div>
                <strong>
                    {{ $jobCode->foldercolor ?: "—" }}
                </strong>
            </div>
            <div class="col-md-4">
                <div class="text-muted mb-1">
                    Shape
                </div>
                <strong>
                    {{ $jobCode->foldershape ?: "—" }}
                </strong>
            </div>
        </div>
    </div>
    <div class="display-flex justify-content-end gap-3 mt-4 mb-5">
        <a href="{{ route('job-codes.index') }}" class="btn-back-custom">
            Back
        </a>
        <a href="{{ route('job-codes.edit',$jobCode) }}" class="btn-primary-custom">
            Edit
        </a>
    </div>
</div>
@endsection