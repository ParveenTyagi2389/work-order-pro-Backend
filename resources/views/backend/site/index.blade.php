@extends('layouts.master')

@section('title', 'WorkOrder Pro - Sites')
@section('page-title', 'Sites')

@section('content')
<div class="content-area">
    @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="search-action-row">
        <form method="GET" action="{{ route('sites.index') }}" class="search-input-width search-box-max-width">
            <input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                   type="text" name="q" value="{{ request('q') }}" placeholder="Search sites..." />
            <i class="fi-rs-search custom-icon-left-center display-flex-i"></i>
            <select name="customer_type" class="form-control-custom">
                <option value="">All customer types</option>
                @foreach ($customerTypes as $type)
                    <option value="{{ $type->name }}" @selected(request('customer_type') == $type->name)>{{ $type->name }}</option>
                @endforeach
            </select>
            <button class="btn border btn-small-padding view-action" type="submit">Search</button>
        </form>
        <a class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none"
           href="{{ route('sites.create') }}">+ Add Site</a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead><tr>
                    <th class="font-weight-bold log-id-text">SITE</th>
                    <th class="font-weight-bold log-id-text">ADDRESS</th>
                    <th class="font-weight-bold log-id-text">CUSTOMER TYPE</th>
                    <th class="font-weight-bold log-id-text">BILL TO</th>
                    <th class="font-weight-bold log-id-text">ACTIONS</th>
                </tr></thead>
                <tbody>
                @forelse ($sites as $site)
                    <tr>
                        <td class="site-table-name">
                            <a href="{{ route('sites.show', $site) }}">{{ $site->name }}</a>
                            <div class="jajohn-admin-text-div-custom">{{ $site->site_id ?? '—' }}</div>
                        </td>
                        <td class="semantic-text-primary">
                            {{ $site->address ?? '—' }}
                            <div>{{ trim(($site->city ?? '') . ' ' . ($site->state ?? '') . ' ' . ($site->zip ?? '')) }}</div>
                        </td>
                        <td class="semantic-text-primary">{{ $site->customerType?->name ?? $site->customer_type }}</td>
                        <td class="semantic-text-primary">{{ $site->billTo?->bill_name ?? '—' }}</td>
                        <td class="jajohn-admin-text">
                            <a class="btn-action-simple text-decoration-none" href="{{ route('sites.show', $site) }}">View</a>
                            <a class="btn-action-simple text-decoration-none" href="{{ route('sites.edit', $site) }}">Edit</a>
                            <form action="{{ route('sites.destroy', $site) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this site?');">
                                @csrf @method('DELETE')
                                <button class="btn-action-simple text-decoration-none border-0 bg-transparent" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No sites found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $sites->links() }}</div>
    </div>
</div>
@endsection
