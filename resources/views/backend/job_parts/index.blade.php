@extends('layouts.master')
@section('topbar-title','Job Parts')
@section('page-title','WorkOrder Pro - Job Parts')
@section('content')
<div class="content-area">
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<div class="mb-4"><h2 class="page-title font-weight-bold">Job Parts</h2><p class="breadcrumb-text">Manage parts assigned to work orders.</p></div>
<div class="search-action-row"><form method="GET" action="{{ route('job-parts.index') }}" class="search-input-width search-box-max-width"><input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom" name="search" value="{{ request('search') }}" placeholder="Search part number or work order"><button class="btn border btn-small-padding view-action" type="submit">Search</button></form><a class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none" href="{{ route('job-parts.create') }}">+ Add Job Part</a></div>
<div class="panel customertypecontactphonesitesa-text"><div class="table-responsive-custom border"><table class="table-custom log-idtimestampuseractionentit-text-alt"><thead><tr><th>WORK ORDER</th><th>PART NUMBER</th><th>DESCRIPTION</th><th>QUANTITY</th><th>ORDERED</th><th>ACTIONS</th></tr></thead><tbody>
@forelse($jobParts as $item)<tr><td><a href="{{ route('job-parts.show',$item) }}">{{ $item->workOrder->customer_work_order ?? ('WO-'.$item->work_order_id) }}</a></td><td>{{ $item->part->part_number ?? ('Part #'.$item->part_id) }}</td><td>{{ $item->part->description ?? '—' }}</td><td>{{ number_format((float)$item->quantity,2) }}</td><td>{{ $item->ordered ? 'Yes' : 'No' }}</td><td><a href="{{ route('job-parts.show',$item) }}">View</a> <a href="{{ route('job-parts.edit',$item) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('job-parts.destroy',$item) }}" onsubmit="return confirm('Delete this job part?')">@csrf @method('DELETE')<button type="submit">Delete</button></form></td></tr>@empty<tr><td colspan="6" class="text-center">No job parts found.</td></tr>@endforelse
</tbody></table></div><div class="mt-3">{{ $jobParts->links() }}</div></div></div>
@endsection
