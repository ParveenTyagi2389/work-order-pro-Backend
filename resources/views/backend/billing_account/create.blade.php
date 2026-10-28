@extends('layouts.master')

@section('topbar-title', 'Add Billing Account')

@section('page-title', 'Add Billing Account')

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
      <a class="btn-back-custom"
         href="{{ route('bill-to.index') }}">Cancel</a>
      <button class="btn-primary-custom" type="submit">Save</button>
    </div>
  </form>
</div>
@endsection
