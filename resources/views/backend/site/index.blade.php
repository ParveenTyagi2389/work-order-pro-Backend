@extends('layouts.master')

@section('title', 'WorkOrder Pro - Sites')
@section('page-title', 'Sites')

@section('content')
    <div class="panel custom-box-shadow-none content-area-div">
        <div class="custom-map-container log-idtimestampuseractionentit-text-alt">
            <img alt="Map" class="custom-opacity map-container-img"
                 src="https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=1200&q=80" />
            <div class="map-pin map-position-primary"></div>
            <div class="map-circle map-circle-gray map-position-secondary"></div>
            <div class="map-circle map-circle-green map-pos-tertiary"></div>
            <div class="map-circle map-circle-red map-pos"></div>
            <div class="map-circle map-circle-green map-pos-primary"></div>
            <div class="map-circle map-circle-gray map-pos-secondary"></div>
        </div>
    </div>

    <div class="search-action-row">
        <form method="GET" action="{{ route('sites.index') }}"
              class="search-input-width search-box-max-width">
            <input class="form-control-custom custom-search-padding search-icon-wrapper-input-custom"
                   name="q" value="{{ request('q') }}"
                   placeholder="Search sites..." type="text" />
            <i class="fi-rs-search custom-icon-left-center display-flex-i"></i>
        </form>
        <a class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none"
           href="{{ route('sites.create') }}">+ Add Site</a>
    </div>

    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead>
                <tr>
                    <th class="font-weight-bold log-id-text">SITE</th>
                    <th class="font-weight-bold log-id-text">ADDRESS</th>
                    <th class="font-weight-bold log-id-text">CUSTOMER</th>
                    <th class="font-weight-bold log-id-text">CONTACT</th>
                    <th class="font-weight-bold log-id-text">STATUS</th>
                    <th class="font-weight-bold log-id-text">ACTION</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($sites as $site)
                    <tr>
                        <td class="site-table-name">{{ $site->name }}</td>
                        <td class="semantic-text-primary">
                            {{ $site->address }}
                            @if ($site->city || $site->state)
                                , {{ trim($site->city . ' ' . $site->state) }}
                            @endif
                        </td>
                        <td class="semantic-text-primary">{{ $site->billTo?->name }}</td>
                        <td class="semantic-text-primary">{{ $site->contact_name }}</td>
                        <td class="jajohn-admin-text">
                            @if ($site->is_active)
                                <span class="badge-status green badge-status-inline">active</span>
                            @else
                                <span class="badge-status-gray">inactive</span>
                            @endif
                        </td>
                        <td class="jajohn-admin-text">
                            <a class="btn-action-simple text-decoration-none"
                               href="{{ route('sites.edit', $site) }}">Edit</a>
                            <form action="{{ route('sites.destroy', $site) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Delete this site?');">
                                @csrf @method('DELETE')
                                <button class="btn-action-simple text-decoration-none border-0 bg-transparent"
                                        type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No sites found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $sites->links() }}</div>
    </div>
@endsection