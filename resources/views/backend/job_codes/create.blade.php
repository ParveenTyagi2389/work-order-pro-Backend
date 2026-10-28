@extends('layouts.master')
@section('topbar-title','Add Job Code')
@section('page-title','Add Job Code')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Add Job Code</h2>
    </div>
    <form method="POST" action="{{ route('job-codes.store') }}" id="jobCodeForm">
        @csrf 
        @include('backend.job_codes._form')
    </form>
</div>
@endsection

@section('script')
<script>
$(function () {
    $("#jobCodeForm").validate({
        rules: {
            foldername: {
                required: true
            },
            foldercolor: {
                required: true
            },
            foldershape: {
                required: true
            }
        },

        messages: {
            foldername: {
                required: "Please enter a job code name."
            },
            foldercolor: {
                required: "Please select a folder color."
            },
            foldershape: {
                required: "Please select a folder shape."
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
