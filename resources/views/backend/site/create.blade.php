@extends('layouts.master')

@section('title', 'WorkOrder Pro - Add Site')
@section('page-title', 'Sites')

@section('content')
    <div class="content-area">
        <div class="mb-4">
            <h2 class="page-title-custom mb-1">Add site</h2>
            <p class="text-muted text-base">Sites · New location and access details</p>
        </div>

        <form method="POST" action="{{ route('sites.store') }}" id="siteForm">
            @csrf
            @include('backend.site._form')
        </form>
    </div>
@endsection

@section('script')
<script>
$(function () {
    $("#siteForm").validate({
        rules: {
            name: {
                required: true
            },
            site_id: {
                required: true
            },
            quantity: {
                required: true
            }

        },
        messages: {
            name: {
                required: "Please enter a site name."
            },
            site_id: {
                required: "Please select a site."
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