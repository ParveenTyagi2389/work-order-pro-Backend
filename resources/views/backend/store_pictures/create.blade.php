@extends('layouts.master')
@section('topbar-title','Add Store / Site Pictures')
@section('page-title','WorkOrder Pro - Add Store / Site Pictures')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Add Store / Site Pictures</h2>
    </div>
    <form method="POST" enctype="multipart/form-data" action="{{ route('store-pictures.store') }}">
        @csrf
        @include('backend.store_pictures._form')
    </form>
</div>
@endsection
