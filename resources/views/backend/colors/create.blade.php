@extends('layouts.master')
@section('topbar-title','Add Color')
@section('page-title','WorkOrder Pro - Add Color')
@section('content')
<div class="content-area"><div class="mb-4"><h2 class="page-title font-weight-bold">Add Color</h2></div>
<form method="POST" action="{{ route('colors.store') }}">@csrf @include('backend.colors._form')</form></div>
@endsection
