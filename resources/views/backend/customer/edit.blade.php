@extends('layouts.master')

@section('topbar-title', 'Edit Customer Type')

@section('page-title', 'WorkOrder Pro - Edit Customer Type')

@section('content')
<div>
    <h2 class="page-title font-weight-bold">Edit Customer Type</h2>
    <p class="breadcrumb-text">Update the customer type name.</p>
</div>

<div class="panel border customer-profile-panel display-flex align-items-center justify-content-between mb-4">
    <div class="display-flex align-items-center gap-3">
        <div class="avatar-circle-light-green display-flex align-items-center justify-content-center">
            {{ collect(preg_split('/\s+/', trim($customerType->name)))->map(fn($p) => strtoupper(substr($p,0,1)))->take(2)->join('') }}
        </div>
        <div>
            <div class="font-weight-bold">{{ $customerType->name }}</div>
            <div class="breadcrumb-text">Customer Type ID #{{ $customerType->id }} · {{ $customerType->sites_count }} sites</div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('customer-types.update', $customerType) }}">
    @method('PUT')
    @include('backend.customer._form', ['customerType' => $customerType])
    <div class="display-flex justify-content-end gap-3 mt-4">
        <a class="btn btn-outline-secondary px-4 py-2 font-weight-bold text-decoration-none"
           href="{{ route('customer-types.show', $customerType) }}">Cancel</a>
        <button class="btn btn-success px-4 py-2 font-weight-bold text-white" type="submit">Update</button>
    </div>
</form>
@endsection
