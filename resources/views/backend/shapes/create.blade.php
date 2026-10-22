@extends('layouts.master')
@section('topbar-title','Add Shape')
@section('page-title','WorkOrder Pro - Add Shape')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Add Shape</h2>
    </div>
    <form method="POST" action="{{ route('shapes.store') }}" id="shapeForm">
        @csrf
        @include('backend.shapes._form')
    </form>
</div>
@endsection
@section('script')
<script>
$(function () {
    $("#shapeForm").validate({
        rules: {
            shape_name: {
                required: true
            },
            shape_code: {
                required: true
            },
            
        },

        messages: {
            shape_name: {
                required: "Please enter a shape name."
            },
            shape_code: {
                required: "Please enter a shape code."
            },
            
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
