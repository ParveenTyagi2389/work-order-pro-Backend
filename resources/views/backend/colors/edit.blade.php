@extends('layouts.master')
@section('topbar-title','Edit Color')
@section('page-title','WorkOrder Pro - Edit Color')
@section('content')
<div class="content-area">
    <div class="mb-4"><h2 class="page-title font-weight-bold">Edit Color</h2></div>
    <form method="POST" action="{{ route('colors.update', $color) }}">
        @csrf
        @method('PUT')
        @include('backend.colors._form', ['color' => $color])
    </form>
</div>
@endsection
