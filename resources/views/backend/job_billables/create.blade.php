@extends('layouts.master')
@section('topbar-title','Add Job Billing')
@section('page-title','Add Job Billing')
@section('content')
<div class="content-area"><div class="mb-4"><h2 class="page-title font-weight-bold">Add Job Billing</h2></div><form method="POST" action="{{ route('job-billables.store') }}">@csrf @include('backend.job_billables._form')</form></div>
@endsection
