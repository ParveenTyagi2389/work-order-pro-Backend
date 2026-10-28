@extends('layouts.master')

@section('topbar-title', 'Edit Billing Account')

@section('page-title', 'Edit Billing Account')

@section('content')
<div class="content-area">
  <div>
    <h2 class="page-title font-weight-bold">Edit Billing Account</h2>
    <p class="breadcrumb-text">Update the billing account used by Sites.</p>
  </div>

  <form method="POST" action="{{ route('bill-to.update', $billTo) }}">
    @csrf
    @method('PUT')
    @include('backend.billing_account._form', ['billTo' => $billTo, 'primaryEmail' => $primaryEmail])

    <div class="display-flex justify-content-end gap-3 mt-4">
      <a class="btn-back-custom"
         href="{{ route('bill-to.index') }}">Cancel</a>
      <button class="btn-primary-custom" type="submit">Save</button>
    </div>
  </form>
</div>
@endsection
