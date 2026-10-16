@extends('layouts.master')

@section('topbar-title', 'Add Customer Type')

@section('page-title', 'WorkOrder Pro - Add Customer Type')


@section('content')
<div class="content-area">
<div>
    <h2 class="page-title font-weight-bold">Add Customer Type</h2>
    <p class="breadcrumb-text">Create a customer type used to classify Sites.</p>
</div>

<form method="POST" action="{{ route('customer-types.store') }}">
    @include('backend.customer._form')
    <div class="display-flex justify-content-end gap-3 mt-4">
        <a class="btn bg-white font-weight-bold btn-back-custom"
           href="{{ route('customer-types.index') }}">Cancel</a>
        <button class="btn btn-success text-white font-weight-bold btn-primary-custom" type="submit">Save</button>
    </div>
</form>
</div>
@endsection
