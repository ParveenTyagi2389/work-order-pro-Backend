@extends('layouts.master')
@section('topbar-title','Add Job Reimbursements')
@section('page-title','WorkOrder Pro - Add Job Reimbursements')
@section('content')
<div class="content-area"><div class="mb-4"><h2 class="page-title font-weight-bold">Add Job Reimbursements</h2></div><form method="POST" action="{{ route('job-reimbursements.store') }}">@csrf @include('backend.job_reimbursements._form')</form></div>
@endsection
