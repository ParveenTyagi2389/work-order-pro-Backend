@extends('layouts.master')
@section('topbar-title','Colors Details')
@section('page-title','WorkOrder Pro - Colors Details')
@section('content')
<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title font-weight-bold">{{ $color->color_name }}</h2>
        <div class ="wo-action-btns"><a href="{{ route('colors.index') }}" class="btn bg-white font-weight-bold btn-back-custom">Back</a> <a href="{{ route('colors.edit',$color) }}" class="btn btn-success text-white font-weight-bold btn-primary-custom">Edit</a></div>
    </div>
    <div class="panel border">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-muted mb-1">Color name</div><strong>{{ $color->color_name ?: "—" }}</strong>
            </div>
            <div class="col-md-4">
                <div class="text-muted mb-1">Color code</div><strong>{{ $color->color_code ?: "—" }}</strong>
            </div>
        </div>
    </div>
</div>
@endsection