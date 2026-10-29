@extends('layouts.master')

@section('topbar-title', 'Parts')
@section('page-title', 'WorkOrder Pro - Parts')

@section('content')
<div class="content-area">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">Please correct the highlighted fields.</div>
    @endif

    <div class="mb-4">
        <h2 class="page-title font-weight-bold">Parts</h2>
        <p class="breadcrumb-text">Manage part numbers and descriptions.</p>
    </div>

    <div class="panel search-action-row">
        <form method="GET" action="{{ route('parts.index') }}" class="search-input-width search-box-max-width">
            <input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                   type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search part number or description">
                   <i class="fi-rs-search filter-search-icon"></i>
            <button class="btn border btn-small-padding view-action" type="submit">Search</button>
            @if (request()->filled('search'))
                <a class="btn border btn-small-padding view-action" href="{{ route('parts.index') }}">Clear</a>
            @endif
        </form>

        <a class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none"
           href="{{ route('parts.create') }}">+ Add Part</a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead>
                    <tr>
                        <th class="font-weight-bold log-id-text">PART NUMBER</th>
                        <th class="font-weight-bold log-id-text">DESCRIPTION</th>
                        <th class="font-weight-bold log-id-text">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($parts as $part)
                        <tr>
                            <td class="site-table-name">
                                <a class ="tech-wo-green" href="{{ route('parts.show', $part) }}">{{ $part->part_number }}</a>
                            </td>
                            <td class="semantic-text-primary">{{ $part->description ?: '—' }}</td>
                            <td class="jajohn-admin-text">
                                <a class="btn-action-simple text-decoration-none" href="{{ route('parts.show', $part) }}">View</a>
                                <a class="btn-action-simple text-decoration-none" href="{{ route('parts.edit', $part) }}">Edit</a>
                                <form action="{{ route('parts.destroy', $part) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this part?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action-simple" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center">No parts found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $parts->links() }}</div>
    </div>
</div>
@endsection
