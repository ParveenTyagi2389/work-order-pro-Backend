@extends('layouts.master')
@section('topbar-title', 'Technicians')
@section('page-title', 'WorkOrder Pro - Technicians')
@section('content')
<div class="content-area">
    @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if (session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    <div class="mb-4"><h2 class="page-title font-weight-bold">Technicians</h2><p class="breadcrumb-text">Manage technician contact details and access.</p></div>
    <div class="search-action-row">
        <form method="GET" action="{{ route('technicians.index') }}" class="search-input-width search-box-max-width">
            <input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom" type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email or phone">
            <i class="fi-rs-search custom-icon-left-center display-flex-i"></i>
            <select class="form-control form-control-styled status-select" name="status">
                <option value="">All statuses</option>
                <option value="active" @selected(request('status') === 'active')>Active</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
            </select>
            <button class="btn border btn-small-padding view-action" type="submit">Search</button>
            @if(request()->filled('search') || request()->filled('status'))<a class="btn border btn-small-padding view-action" href="{{ route('technicians.index') }}">Clear</a>@endif
        </form>
        <a class="btn-custom btn-primary-custom text-decoration-none" href="{{ route('technicians.create') }}">+ Add Technician</a>
    </div>
    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead><tr><th class="font-weight-bold log-id-text">NAME</th><th class="font-weight-bold log-id-text">PHONE</th><th class="font-weight-bold log-id-text">EMAIL</th><th class="font-weight-bold log-id-text">ACCESS</th><th class="font-weight-bold log-id-text">STATUS</th><th class="font-weight-bold log-id-text">ACTIONS</th></tr></thead>
                <tbody>
                @forelse ($technicians as $technician)
                    <tr>
                        <td class="site-table-name"><a class= "tech-wo-green" href="{{ route('technicians.show', $technician) }}">{{ $technician->name }}</a></td>
                        <td class="semantic-text-primary">{{ $technician->phone ?: '—' }}</td>
                        <td class="semantic-text-primary">{{ $technician->email ?: '—' }}</td>
                        <td class="semantic-text-primary">{{ $technician->access }}</td>
                        <td>@if ($technician->active)<span class="badge bg-success">Active</span>@else<span class="badge bg-secondary">Inactive</span>@endif</td>
                        <td class="jajohn-admin-text">
                            <a class="btn-action-simple text-decoration-none" href="{{ route('technicians.show', $technician) }}">View</a>
                            <a class="btn-action-simple text-decoration-none" href="{{ route('technicians.edit', $technician) }}">Edit</a>
                            <form action="{{ route('technicians.destroy', $technician) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this technician?');">
                                @csrf @method('DELETE')
                                <button class="btn-action-simple" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No technicians found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $technicians->links() }}</div>
    </div>
</div>
@endsection
