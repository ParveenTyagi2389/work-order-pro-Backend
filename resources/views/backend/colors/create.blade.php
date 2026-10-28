@extends('layouts.master')
@section('topbar-title','Add Color')
@section('page-title','Add Color')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">
            Add Color
        </h2>
    </div>
    <form method="POST" action="{{ route('colors.store') }}" id="colorForm" >
        @csrf
        @include('backend.colors._form')
    </form>
</div>
@endsection
@section('script')
<script>
$(function () {
    $("#colorForm").validate({
        rules: {
            color_name: {
                required: true
            },
            color_code: {
                required: true
            },
            
        },

        messages: {
            color_name: {
                required: "Please enter a color name."
            },
            color_code: {
                required: "Please enter a color code."
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

