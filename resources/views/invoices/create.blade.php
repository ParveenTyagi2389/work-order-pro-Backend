@extends('layouts.master')
@section('page-title','Create Invoice')
@section('content')
<div class="container-fluid invoice-page">
    <div class="page-heading"><h2>Create Invoice</h2><p>Build and send a professional invoice</p></div>
    @include('invoices._form', ['invoice' => null, 'action' => route('invoices.store'), 'method' => 'POST'])
</div>
@endsection
