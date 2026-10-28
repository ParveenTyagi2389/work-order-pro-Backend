@extends('layouts.master')
@section('page-title','Edit Invoice')
@section('content')
<div class="container-fluid invoice-page">
    <div class="page-heading"><h2>Edit Invoice</h2><p>Build and send a professional invoice</p></div>
    @include('invoices._form', ['invoice' => $invoice, 'action' => route('invoices.update', $invoice), 'method' => 'PUT'])
</div>
@endsection
