@extends('layouts.master')
@section('topbar-title', 'Add Technician')
@section('page-title', 'WorkOrder Pro - Add Technician')
@section('content')
<div class="content-area">
    @if ($errors->any())<div class="alert alert-danger">Please correct the highlighted fields.</div>@endif
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">
            Add Technician
        </h2>
        <p class="breadcrumb-text">
            Technicians · Add technician details
        </p>
    </div>
    <form method="POST" action="{{ route('technicians.store') }}" id="technicianForm">
        @csrf
        @include('backend.technicians._form')
    </form>
</div>
@endsection

@section('script')
<script>
$(function () {
    $("#technicianForm").validate({
        rules: {
            name: {
                required: true
            },
            phone: {
                required: true
            },
            email: {
                email: true,
                required: true
            },
            technician_id: {
                required: true
            }
        },

        messages: {
            name: {
                required: "Please enter a technician name."
            },
            phone: {
                required: "Please enter a phone number."
            },
            email: {
                email: "Please enter a valid email address.",
                required: "Please enter an email address."
            },
            technician_id: {
                required: "Please select a technician."
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

