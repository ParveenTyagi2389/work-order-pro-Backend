@extends('layouts.master')

@section('topbar-title', 'Add Part')
@section('page-title', 'WorkOrder Pro - Add Part')

@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Add Part</h2>
        <p class="breadcrumb-text">Parts · Create a part record</p>
    </div>

    <form method="POST" action="{{ route('parts.store') }}">
        @csrf
        @include('backend.parts._form')
    </form>
</div>
@endsection
