@extends('layouts.master')
@section('topbar-title','Job Pictures')
@section('page-title','WorkOrder Pro - Job Pictures')
@section('content')
<div class="content-area">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">
            Job Pictures
        </h2>
        <p class="breadcrumb-text">
            Manage uploaded pictures and related records.
        </p>
    </div>
    <div class="search-action-row">
        <form method="GET" action="{{ route('job-pictures.index') }}" class="search-input-width search-box-max-width">
            <input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom" name="search" value="{{ request('search') }}" placeholder="Search records">
            <i class="fi-rs-search filter-search-icon"></i>
            <button class="btn border btn-small-padding view-action" type="submit">
                Search
            </button>
        </form>
        <a class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none" href="{{ route('job-pictures.create') }}">
            + Add Picture
        </a>
    </div>
    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead>
                    <tr>
                        <th>WORK ORDER</th>
                        <th>DESCRIPTION</th>
                        <th>PICTURE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobPictures as $item)
                        <tr>
                            <td>{{ $item->workOrder->customer_work_order ?? ('WO-'.$item->work_order_id) }}</td>
                            <td>{{ $item->description ?: '—' }}</td>
                            <td>
                                @if($item->picture)
                                    <img src="{{ asset('storage/'.$item->picture) }}" alt="Picture" style="width:70px;height:55px;object-fit:cover">
                                @else
                                    —
                                @endif
                            </td>
                            <td class="jajohn-admin-text">
                                <a class="btn-action-simple text-decoration-none" href="{{ route('job-pictures.show',$item) }}">View</a>
                                <a class="btn-action-simple text-decoration-none" href="{{ route('job-pictures.edit',$item) }}">Edit</a>
                                <form class="d-inline" method="POST" action="{{ route('job-pictures.destroy',$item) }}" onsubmit="return confirm('Delete this picture?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-simple">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No pictures found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $jobPictures->links() }}
        </div>
    </div>
</div>
@endsection
