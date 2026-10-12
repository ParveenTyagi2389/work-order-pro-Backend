@extends('layouts.master')

@section('topbar-title', 'Edit Part')
@section('page-title', 'WorkOrder Pro - Edit Part')

@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Edit Part</h2>
        <p class="breadcrumb-text">Update {{ $part->part_number }}</p>
    </div>

    <form method="POST" action="{{ route('parts.update', $part) }}">
        @csrf
        @method('PUT')
        @include('backend.parts._form', ['part' => $part])
    </form>
</div>
@endsection
