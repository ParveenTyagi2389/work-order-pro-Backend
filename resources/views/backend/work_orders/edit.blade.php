@extends('layouts.master')
@section('topbar-title','Edit Work Order')
@section('page-title','WorkOrder Pro - Edit Work Order')
@section('content')
<div class="content-area"><div class="mb-4"><h2 class="page-title font-weight-bold">Edit Work Order</h2><p class="breadcrumb-text">Update WO-{{ $workOrder->id }}</p></div><form method="POST" action="{{ route('work-orders.update',$workOrder) }}">@csrf @method('PUT') @include('backend.work_orders._form',['workOrder'=>$workOrder])</form></div>
@endsection
