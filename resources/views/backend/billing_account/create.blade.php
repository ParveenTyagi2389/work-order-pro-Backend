@extends('layouts.master')

@section('topbar-title', 'Add Billing Account')

@section('page-title', 'WorkOrder Pro - Add Billing Account')

@section('content')
<div class="content-area">
  <div>
    <h2 class="page-title font-weight-bold">Add Billing Account</h2>
    <p class="breadcrumb-text">Create a billing account used by Sites.</p>
  </div>

  <form method="POST" action="{{ route('bill-to.store') }}">
    @csrf
    @include('backend.billing_account._form')

    <div class="display-flex justify-content-end gap-3 mt-4">
      <a class="btn btn-outline-secondary px-4 py-2 font-weight-bold text-decoration-none"
         href="{{ route('bill-to.index') }}">Cancel</a>
      <button class="btn btn-success px-4 py-2 font-weight-bold text-white" type="submit">Save</button>
    </div>
  </form>
</div>
@endsection
