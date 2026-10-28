@extends('layouts.master')
@section('topbar-title','Edit Job Billing')
@section('page-title','Edit Job Billing')
@section('content')
    <div class="content-area">
        <div class="mb-4">
            <h2 class="page-title font-weight-bold">
                Edit Job Billing
            </h2>
        </div>
        <form method="POST" action="{{ route('job-billables.update', $jobBillable) }}">
            @csrf
             @method('PUT') 
             @include('backend.job_billables._form',['jobBillable'=>$jobBillable])
            </form>
        </div>
@endsection
