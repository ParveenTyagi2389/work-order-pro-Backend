@extends('layouts.master')
@section('topbar-title','Store / Site Pictures')
@section('page-title','WorkOrder Pro - Store / Site Pictures')
@section('content')
<div class="content-area">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-4">
        <h2 class="page-title font-weight-bold">
            Store / Site Pictures
        </h2>
        <p class="breadcrumb-text">
            Manage uploaded pictures and related records.
        </p>
    </div>
    <div class="search-action-row">
        <form method="GET" action="{{ route('store-pictures.index') }}" class="search-input-width search-box-max-width">
            <input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom" name="search" value="{{ request('search') }}" placeholder="Search records">
            <button class="btn border btn-small-padding view-action" type="submit">
                Search
            </button>
        </form>
        <a class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none" href="{{ route('store-pictures.create') }}">
            + Add Picture
        </a>
    </div>
    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead>
                    <tr>
                        <th>SITE</th>
                        <th>DESCRIPTION</th>
                        <th>NOTES</th>
                        <th>PICTURE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($storePictures as $item)
                        <tr>
                            <td>{{ $item->site->name ?? ('Site #'.$item->site_id) }}</td>
                            <td>{{ $item->description ?: '—' }}</td>
                            <td>{{ $item->notes ?: '—' }}</td>
                            <td>
                                @if($item->picture)
                                    <img src="{{ asset('storage/'.$item->picture) }}" alt="Picture" style="width:70px;height:55px;object-fit:cover">
                                @else
                                    —
                                @endif
                            </td>
                            <td class="jajohn-admin-text">
                                <a class="btn-action-simple text-decoration-none" href="{{ route('store-pictures.show',$item) }}">View</a>
                                <a class="btn-action-simple text-decoration-none" href="{{ route('store-pictures.edit',$item) }}">Edit</a>
                                <form class="d-inline" method="POST" action="{{ route('store-pictures.destroy',$item) }}" onsubmit="return confirm('Delete this picture?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-simple">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No pictures found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $storePictures->links() }}
        </div>
    </div>
</div>
@endsection
