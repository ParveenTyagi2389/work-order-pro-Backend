@extends('layouts.master')
@section('topbar-title','Colors')
@section('page-title','Colors')
@section('content')
<div class="content-area">
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="mb-4"><h2 class="page-title font-weight-bold">Colors</h2></div>
<div class="panel search-action-row">
    <form method="GET" action="{{ route('colors.index') }}" class="search-input-width search-box-max-width">
        <input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom" name="search" value="{{ request('search') }}" placeholder="Search colors">
        <i class="fi-rs-search filter-search-icon"></i>
        <button class="btn border btn-small-padding view-action">Search</button>
    </form>
    <a class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none" href="{{ route('colors.create') }}">+ Add</a>
</div>
<div class="panel customertypecontactphonesitesa-text">
    <div class="table-responsive-custom border">
        <table class="table-custom log-idtimestampuseractionentit-text-alt">
            <thead>
                <tr>
                    <th class="font-weight-bold log-id-text">COLOR NAME</th>
                    <th class="font-weight-bold log-id-text">COLOR CODE</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($colors as $item)
                <tr>
                    <td class="site-table-name">
                        <a class ="tech-wo-green" href="{{ route('colors.show',$item) }}">
                            {{ $item->color_name }}
                        </a>
                    </td>
                    <td class="semantic-text-primary">{{ $item->color_code ?: "—" }}</td>
                    <td>
                        <a class="btn-action-simple text-decoration-none" href="{{ route('colors.show',$item) }}">View</a>
                        <a class="btn-action-simple text-decoration-none" href="{{ route('colors.edit',$item) }}">Edit</a>
                        <form class="d-inline" method="POST" action="{{ route('colors.destroy',$item) }}" onsubmit="return confirm('Delete this record?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-action-simple">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $colors->links() }}
    </div>
</div>
@endsection
