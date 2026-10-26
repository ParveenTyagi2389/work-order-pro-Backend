@extends('layouts.master')
@section('topbar-title','Add Work Order')
@section('page-title','WorkOrder Pro - Add Work Order')
@section('content')
<div class="content-area">
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">
            Add Work Order
        </h2>
        <p class="breadcrumb-text">
            Work Orders · Create a new work order
        </p>
    </div>
    <form method="POST" action="{{ route('work-orders.store') }}" id="workOrderForm">
        @csrf
        @include('backend.work_orders._form')
    </form>
</div>
@endsection

@section('script')
<script>
$(function () {
    $("#workOrderForm").validate({
        rules: {
            site_id: {
                required: true
            },
            customer_work_order: {
                required: true
            },
            job_created_at: {
                date: true,
                required: true
            },
            technician_id: {
                required: true
            },
            job_code_id: {
                required: true
            },
            // override_travel: {
            //     number: true,
            //     min: 0
            // },
            // override_labor: {
            //     number: true,
            //     min: 0
            // }
        },

        messages: {
            site_id: {
                required: "Please select a site."
            },
            customer_work_order: {
                required: "Please enter a customer work order."
            },
            job_created_at: {
                date: "Please enter a valid date.",
                required: "Please enter the job creation date."
            },
             technician_id: {
                required: "Please select a technician."
            },
            job_code_id: {
                required: "Please select a job code."
            },
            // override_travel: {
            //     number: "Enter a valid travel amount.",
            //     min: "Travel amount cannot be negative."
            // },
            // override_labor: {
            //     number: "Enter a valid labor amount.",
            //     min: "Labor amount cannot be negative."
            // }
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
