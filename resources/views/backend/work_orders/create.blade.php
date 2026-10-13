@extends('layouts.master')
@section('topbar-title','Add Work Order')
@section('page-title','WorkOrder Pro - Add Work Order')
@section('content')
<div class="content-area"><div class="mb-4"><h2 class="page-title font-weight-bold">Add Work Order</h2><p class="breadcrumb-text">Work Orders · Create a new work order</p></div><form method="POST" action="{{ route('work-orders.store') }}">@csrf @include('backend.work_orders._form')</form></div>
@endsection
