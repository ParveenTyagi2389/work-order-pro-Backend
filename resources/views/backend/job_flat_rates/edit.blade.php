@extends('layouts.master')
@section('topbar-title','Edit Job Flat Rates')
@section('page-title','WorkOrder Pro - Edit Job Flat Rates')
@section('content')
<div class="content-area"><div class="mb-4"><h2 class="page-title font-weight-bold">Edit Job Flat Rates</h2></div><form method="POST" action="{{ route('job-flat-rates.update', $jobFlatRate) }}">@csrf @method('PUT') @include('backend.job_flat_rates._form',['jobFlatRate'=>$jobFlatRate])</form></div>
@endsection
