@extends('layouts.master')
@section('topbar-title','Edit Store / Site Pictures')
@section('page-title','WorkOrder Pro - Edit Store / Site Pictures')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Edit Store / Site Pictures</h2>
    </div>
    <form method="POST" enctype="multipart/form-data" action="{{ route('store-pictures.update', $storePicture) }}">
        @csrf
        @method('PUT')
        @include('backend.store_pictures._form', ['storePicture' => $storePicture])
    </form>
</div>
@endsection
