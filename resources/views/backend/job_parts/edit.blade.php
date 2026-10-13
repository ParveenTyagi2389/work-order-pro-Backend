@extends('layouts.master')
@section('topbar-title','Edit Job Part')
@section('page-title','WorkOrder Pro - Edit Job Part')
@section('content')
<div class="content-area"><div class="mb-4"><h2 class="page-title font-weight-bold">Edit Job Part</h2></div><form method="POST" action="{{ route('job-parts.update',$jobPart) }}">@csrf @method('PUT') @include('backend.job_parts._form',['jobPart'=>$jobPart])</form></div>
@endsection
