@extends('layouts.master')
@section('topbar-title','Job Codes')
@section('page-title','Job Codes')
@section('content')
<div class="content-area">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    <div class="mb-4"><h2 class="page-title font-weight-bold">Job Codes</h2></div>
    <div class="search-action-row">
        <form method="GET" action="{{ route('job-codes.index') }}" class="search-input-width search-box-max-width">
            <input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom" name="search" value="{{ request('search') }}" placeholder="Search job codes">
            <i class="fi-rs-search filter-search-icon"></i>
            <button class="btn border btn-small-padding view-action">Search</button>
        </form>
        <a class="btn-custom btn-primary-custom text-decoration-none" href="{{ route('job-codes.create') }}">+ Add</a>
    </div>
    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead>
                    <tr>
                        <th class="font-weight-bold log-id-text">JOB CODE NAME</th>
                        <th class="font-weight-bold log-id-text">COLOR</th>
                        <th class="font-weight-bold log-id-text">SHAPE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobCodes as $item)
                    <tr>
                        <td class="site-table-name">
                            <a class ="tech-wo-green" href="{{ route('job-codes.show',$item) }}">
                                {{ $item->foldername }}
                            </a>
                        </td>
                        <td class="semantic-text-primary">{{ $item->foldercolor ?: "—" }}</td>
                        <td class="semantic-text-primary">{{ $item->foldershape ?: "—" }}</td>
                        <td>
                            <a class="btn-action-simple text-decoration-none" href="{{ route('job-codes.show',$item) }}">View</a>
                            <a class="btn-action-simple text-decoration-none" href="{{ route('job-codes.edit',$item) }}">Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('job-codes.destroy',$item) }}" onsubmit="return confirm('Delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-action-simple">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $jobCodes->links() }}
        </div>
    </div>
</div>
@endsection
