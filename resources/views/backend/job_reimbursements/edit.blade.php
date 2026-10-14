@extends('layouts.master')
@section('topbar-title','Edit Job Reimbursements')
@section('page-title','WorkOrder Pro - Edit Job Reimbursements')
@section('content')
<div class="content-area"><div class="mb-4"><h2 class="page-title font-weight-bold">Edit Job Reimbursements</h2></div><form method="POST" action="{{ route('job-reimbursements.update', $jobReimbursement) }}">@csrf @method('PUT') @include('backend.job_reimbursements._form',['jobReimbursement'=>$jobReimbursement])</form></div>
@endsection
