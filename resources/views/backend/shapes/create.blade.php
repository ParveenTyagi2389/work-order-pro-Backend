@extends('layouts.master')
@section('topbar-title','Add Shape')
@section('page-title','WorkOrder Pro - Add Shape')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Add Shape</h2>
    </div>
    <form method="POST" action="{{ route('shapes.store') }}">@csrf @include('backend.shapes._form')</form>
</div>
@endsection
