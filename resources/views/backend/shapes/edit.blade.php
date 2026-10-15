@extends('layouts.master')
@section('topbar-title','Edit Shape')
@section('page-title','WorkOrder Pro - Edit Shape')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Edit Shape</h2>
    </div>
    <form method="POST" action="{{ route('shapes.update', $shape) }}">@csrf @method('PUT') @include('backend.shapes._form',['shape' => $shape])</form>
</div>
@endsection
