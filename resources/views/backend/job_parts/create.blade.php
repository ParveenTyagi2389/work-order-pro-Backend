@extends('layouts.master')
@section('topbar-title','Add Job Part')
@section('page-title','WorkOrder Pro - Add Job Part')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">
            Add Job Part
        </h2>
        <p class="breadcrumb-text">
            Assign a part to a work order.
        </p>
    </div>
    <form method="POST" action="{{ route('job-parts.store') }}" id="jobPartForm">
        @csrf
         @include('backend.job_parts._form')
    </form>
</div>
@endsection

@section('script')
<script>
$(function () {
    $("#jobPartForm").validate({
        rules: {
            work_order_id: {
                required: true
            },
            part_id: {
                required: true
            },
            quantity: {
                required: true
            }

        },
        messages: {
            work_order_id: {
                required: "Please select a work order."
            },
            part_id: {
                required: "Please select a part."
            },
            quantity: {
                required: "Please enter a quantity."
            }

        },

        errorElement: "div",

        errorClass: "text-danger small",

        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },

        highlight: function (element) {
            $(element).addClass("is-invalid");
        },

        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});
</script>
@endsection
