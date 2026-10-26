@extends('layouts.master')

@section('topbar-title', 'Add Part')
@section('page-title', 'WorkOrder Pro - Add Part')

@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Add Part</h2>
        <p class="breadcrumb-text">Parts · Create a part record</p>
    </div>

    <form method="POST" action="{{ route('parts.store') }}" id="partForm">
        @csrf
        @include('backend.parts._form')
    </form>
</div>
@endsection

@section('script')
<script>
$(function () {
    $("#partForm").validate({
        rules: {
            part_number: {
                required: true
            }  
        },
        messages: {
            part_number: {
                required: "Please enter a part number."
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
